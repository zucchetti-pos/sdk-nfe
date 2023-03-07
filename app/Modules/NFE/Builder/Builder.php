<?php

namespace App\Modules\NFE\Builder;

use App\Modules\NFE\Builder\Tags\COFINSBuilder;
use App\Modules\NFE\Builder\Tags\COFINSSTBuilder;
use App\Modules\NFE\Builder\Tags\DestBuilder;
use App\Modules\NFE\Builder\Tags\DetPagBuilder;
use App\Modules\NFE\Builder\Tags\DupBuilder;
use App\Modules\NFE\Builder\Tags\EmitBuilder;
use App\Modules\NFE\Builder\Tags\FatBuilder;
use App\Modules\NFE\Builder\Tags\ICMSBuilder;
use App\Modules\NFE\Builder\Tags\ICMSTotBuilder;
use App\Modules\NFE\Builder\Tags\InfNFeBuilder;
use App\Modules\NFE\Builder\Tags\IdeBuilder;
use App\Modules\NFE\Builder\Tags\ImpostoBuilder;
use App\Modules\NFE\Builder\Tags\IPIBuilder;
use App\Modules\NFE\Builder\Tags\PagBuilder;
use App\Modules\NFE\Builder\Tags\PISBuilder;
use App\Modules\NFE\Builder\Tags\ProdBuilder;
use App\Modules\NFE\Builder\Tags\TranspBuilder;
use App\Modules\NFE\Builder\Tags\VolBuilder;
use NFePHP\NFe\Make;

class Builder
{
    private InfNFeBuilder $infNFe;
    private IdeBuilder $ide;
    private EmitBuilder $emit;
    private DestBuilder $dest;
    private ProdBuilder $prod;
    private ImpostoBuilder $imposto;
    private ICMSBuilder $icms;
    private IPIBuilder $ipi;
    private PISBuilder $pis;
    private COFINSSTBuilder $cofinsST;
    private COFINSBuilder $cofins;
    private ICMSTotBuilder $icmsTot;
    private TranspBuilder $transp;
    private VolBuilder $vol;
    private FatBuilder $fat;
    private DupBuilder $dup;
    private PagBuilder $pag;
    private DetPagBuilder $detPag;

    public function __construct() {
        $this->infNFe = new InfNFeBuilder();
        $this->ide = new IdeBuilder();
        $this->emit = new EmitBuilder();
        $this->dest = new DestBuilder();
        $this->prod = new ProdBuilder();
        $this->imposto = new ImpostoBuilder();
        $this->icms = new ICMSBuilder();
        $this->ipi = new IPIBuilder();
        $this->pis = new PISBuilder();
        $this->cofinsST = new COFINSSTBuilder();
        $this->cofins = new COFINSBuilder();
        $this->icmsTot = new ICMSTotBuilder();
        $this->transp = new TranspBuilder();
        $this->vol = new VolBuilder();
        $this->fat = new FatBuilder();
        $this->dup = new DupBuilder();
        $this->pag = new PagBuilder();
        $this->detPag = new DetPagBuilder();
    }

    public function execute($params)
    {
        $nfe = new Make();

        $infNFe = (object) $this->infNFe->execute();
        $ide = (object) $this->ide->execute($params);
        $emit = (object) $this->emit->execute($params);
        $dest = (object) $this->dest->execute($params);

        foreach ($params['prodCollection'] as $prod) {
            $produto = (object) $this->prod->execute($prod, $params);
            $imposto = (object) $this->imposto->execute($prod);
            $icms = (object) $this->icms->execute($prod);
            $ipi = (object) $this->ipi->execute($prod);
            $pis = (object) $this->pis->execute($prod);
            $cofinsST = (object) $this->cofinsST->execute($prod);
            $cofins = (object) $this->cofins->execute($prod);
            $vol = (object) $this->vol->execute($prod);

            $nfe->tagprod($produto);
            $nfe->tagimposto($imposto);
            $nfe->tagICMS($icms);
            $nfe->tagIPI($ipi);
            $nfe->tagPIS($pis);
            $nfe->tagCOFINS($cofins);
            $nfe->tagCOFINSST($cofinsST);
            $nfe->tagvol($vol);
        }

        $nfe->taginfNFe($infNFe);
        $nfe->tagide($ide);
        $nfe->tagemit($emit);
        $nfe->tagdest($dest);

        if (!empty($emit->enderEmit)) {
            $nfe->tagenderEmit($emit->enderEmit);
        }

        if (!empty($dest->enderDest)) {
            $nfe->tagenderDest($dest->enderDest);
        }

        $icmsTot = $this->icmsTot->execute($params);
        $transp = $this->transp->execute($params);
        $fat = $this->fat->execute($params);
        $dup = $this->dup->execute($params);
        $pag = $this->pag->execute($params);
        $detPag = $this->detPag->execute($params);

        $nfe->tagICMSTot($icmsTot);
        $nfe->tagtransp($transp);
        $nfe->tagfat($fat);
        $nfe->tagdup($dup);
        $nfe->tagpag($pag);
        $nfe->tagdetPag($detPag);
        
        $xml = $nfe->getXML();

        return $xml;
    }
}
