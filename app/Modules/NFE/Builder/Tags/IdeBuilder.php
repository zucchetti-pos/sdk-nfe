<?php

namespace App\Modules\NFE\Builder\Tags;

use App\Modules\NFE\Builder\Enums\IndPresEnum;
use App\Modules\NFE\Builder\Enums\ProcEmiEnum;
use App\Modules\NFE\Builder\Enums\TpEmisEnum;
use App\Modules\NFE\Builder\Enums\TpImpEnum;
use App\Modules\NFE\Builder\Enums\VerProcEnum;
use App\Modules\NFE\Enums\FinNFEnum;
use App\Modules\NFE\Enums\IEnum;
use App\Modules\NFE\Enums\ModeloEnum;
use App\Modules\NFE\Enums\SatSeriesEnum;
use App\Modules\NFE\Enums\TagTpNFEnum;
use App\Modules\NFE\Enums\TpAmbEnum;

class IdeBuilder
{
    public function execute($params)
    {
        $std = new \stdClass();
        $std->cUF = $params['cUF'] ?? null;
        $std->cNF = rand(10000000, 99999999);
        $std->natOp = $params['natOp'] ?? null;
        $std->natTributo = $params['natTributo'] ?? null;
        $std->mod = $params['mod'] ?? null;
        $std->serie = $this->getSerie($params);
        $std->nNF = $params['nNF'] ?? null;
        $std->idDest = $params['idDest'] ?? null;
        $std->cMunFG = $params['cMunFG'] ?? null;
        $std->tpAmb = $this->getTpAmb($params);
        $std->tpNF = $this->getTpNF($params);
        $std->tpEmis = TpEmisEnum::NORMAL->value;
        $std->indPres = IndPresEnum::PRESENTE->value;
        $std->procEmi = ProcEmiEnum::DEFAULT->value;
        $std->verProc = VerProcEnum::DEFAULT->value;
        $std->finNFe = $this->getFinNFe($params);
        $std = $this->getTpImp($params, $std);
        $std = $this->getIndFinal($params, $std);
        $dhEmi = new \DateTime($params['emissionDate']);
        $std->dhEmi = $dhEmi->format('Y-m-d\TH:i:sP');
        $std->dhSaiEnt = $this->getOutputDate($params);
        $std->refNFCe = $params['refNFCe'] ?? null;
        $std = $this->removeIntermed($std, $params);

        return $std;
    }

    private function getSerie($params)
    {
        return ($params['mod'] === ModeloEnum::SAT) ? SatSeriesEnum::DEFAULT : $params['serie'];
    }

    private function getTpAmb($params)
    {
        return $params['isHomolog'] ? TpAmbEnum::HOMOLOGACAO->value : TpAmbEnum::PRODUCAO->value;
    }

    private function getTpNF($params)
    {
        return !empty($params['tpNF']) ? $params['tpNF'] : TagTpNFEnum::SAIDA->value; 
    }

    private function getFinNFe($params)
    {
        return !empty($params['finNFe']) ? $params['finNFe'] : FinNFEnum::DEFAULT->value;
    }

    private function getTpImp($params, $std)
    {
        if ($params['mod'] == ModeloEnum::NFCE->value) {
            return $std;
        }

        $std->tpImp = TpImpEnum::DEFAULT->value;
    
        return $std;
    }

    private function getIndFinal($params, $std)
    {
        $isConsumidorFinal = !empty($params['isConsumidorFinal']) ? $params['isConsumidorFinal'] : false;

        if ($isConsumidorFinal || $params['indIEDest'] == IEnum::NAO_CONTRIBUINTE->value) {
            $std->indFinal = IEnum::CONTRIBUINTE_ICMS->value;
        }

        return $std;
    }

    private function getOutputDate($params)
    {
        if (empty($params['outputDateTime'])) {
            return null;
        }
        try {
            $dateTime = new \DateTime($params['outputDateTime']);

            return $dateTime->format('Y-m-d\TH:i:sP');
        } catch (\Exception $e) {
            return null;
        }
    }

    private function removeIntermed($std, $params)
    {
        if (!$this->enableToBuildIndIntermed($std, $params)) {
            unset($std->indIntermed);
            unset($std->infIntermed);
        }

        return $std;
    }

    private function enableToBuildIndIntermed($std, $params)
    {
        $mod = $std->mod;
        
        if ($mod == ModeloEnum::NFE->value && empty($params['enabledIntermediatorNFe'])) {
            return false;
        }

        if ($mod == ModeloEnum::NFCE->value && empty($params['enabledIntermediatorNFCe'])) {
            return false;
        }

        return true;
    }
}
