<?php

namespace App\Modules\NFE\Builder\Tags;

use App\Modules\NFE\Builder\Enums\ExportationEnum;
use App\Modules\NFE\Builder\Enums\HomologDefaultEnum;
use App\Modules\NFE\Enums\ModeloEnum;
use App\Modules\Core\Identifier;

class DestBuilder
{
    public function execute($params) 
    {
        $std = new \stdClass();
        $std->enderDest = new \stdClass();

        if (!$this->buyerIsValid($params)) {
            return $std;
        }

        $identifier = $params['dest']['CPF'] ?? $params['dest']['CNPJ'];
        $std->CNPJ = Identifier::isCNPJ($params['dest']['CNPJ'] ?? '') ? $identifier : '';
        $std->CPF = Identifier::isCPF($params['dest']['CPF'] ?? '') ? $identifier : '';

        $name = $params['dest']['xNome'] ?? '';
        $std->xNome = ($params['isHomolog']) ? HomologDefaultEnum::NFE_SEM_VALOR->value : $name;

        $std->indIEDest = $params['dest']['indIEDest'] ?? null;
        $std->IE = $params['dest']['IE'] ?? null;
        $std->ISUF = $params['dest']['ISUF'] ?? null;
        $std = $this->buildEnderdest($std, $params);

        if (!empty($params['dest']['isForeign'])) {
            $std->idEstrangeiro = $params['dest']['idEstrangeiro'];
            $std = $this->buildForeignEnderdest($params, $std);
        }

        return $std;
    }

    private function buyerIsValid($params): bool
    {
        $identification = $params['dest']['CPF'] ?? $params['dest']['CNPJ']; 
        if (empty($params['dest'])) {
            return false;
        }

        if (
            $identification &&
            $params['mod'] == ModeloEnum::NFCE->value &&
            empty($params['dest']['isForeign'])
        ) {
            return false;
        }

        return true;
    }

    private function buildForeignEnderdest($params, $std)
    {
        if ($params['mod'] == ModeloEnum::NFCE->value) {
            $std->enderDest = null;

            return $std;
        }

        $std->enderDest->CEP = null;
        $std->enderDest->cMun = ExportationEnum::CMUN->value;
        $std->enderDest->xMun = ExportationEnum::XMun->value;
        $std->enderDest->cUF = null;
        $std->enderDest->UF = ExportationEnum::UF;
        $std->enderDest->cPais = $params['dest']['enderDest']['cPais'];
        $std->enderDest->xPais = $params['dest']['enderDest']['xPais'];

        return $std;
    }

    private function buildEnderdest($std, $params)
    {
        if ($params['mod'] == ModeloEnum::NFCE->value && !$params['isValidToPrintClientAddress']) {
            $std->enderDest = null;

            return $std;
        }

        if (isset($params['dest']['enderDest']['fone'])) {
            $area = $params['dest']['enderDest']['area'] ?? '';
            $std->enderDest->fone = $area . $params['dest']['ender']['fone'];
        }

        if (isset($params['dest']['email'])) {
            $std->email = $params['dest']['email'];
        }

        if (!isset($params['dest']['enderDest'])) {
            $std->enderDest = null;
            return $std;
        }

        $std->enderDest->xLgr = $params['dest']['enderDest']['xLgr'] ?? '';
        $std->enderDest->xBairro = $params['dest']['enderDest']['xBairro'] ?? '';

        if (!empty($params['dest']['enderDest']['xCpl'])) {
            $std->enderDest->xCpl = $params['dest']['enderDest']['xCpl'];
        }

        $noNumber = 'S/N';
        $std->enderDest->nro = $noNumber;
        
        if (!empty($params['dest']['enderDest']['nro'])) {
            $std->enderDest->nro = $params['dest']['enderDest']['nro'];
        }

        if (!$params['dest']['CEP']) {
            return $std;
        }

        $std->enderDest->CEP = $params['dest']['enderDest']['CEP'];
        $std->enderDest->cMun = $params['dest']['enderDest']['cMun'];
        $std->enderDest->xMun = $params['dest']['enderDest']['xMun'];
        $std->enderDest->cUF = $params['dest']['enderDest']['cUF'];
        $std->enderDest->UF = $params['dest']['enderDest']['UF'];
        $std->enderDest->cPais = $params['dest']['enderDest']['cPais'];
        $std->enderDest->xPais = $params['dest']['enderDest']['xPais'];

        return $std;
    }
}
