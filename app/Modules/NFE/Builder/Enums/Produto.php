<?php

namespace App\Modules\NFE\Builder\DTO;

/**
 * @author Jonathan Muller Kunz <jonathanmullerkunz@gmail.com>
 */
class Produto
{
    public $nItem = null;
    public $uuid = null;
    public $cProd = null;
    public $xProd = null;
    public $NCM = null;
    public $NVE = null;
    public $CEST = null;
    public $EXTIPI = null;
    public $CFOP = null;
    public $uCom = null;
    public $qCom = null;
    public $vUnCom = null;
    public $vProd = null;
    public $cEAN = 'SEM GTIN';
    public $cEANTrib = 'SEM GTIN';
    public $uTrib = null;
    public $qTrib = null;
    public $vUnTrib = null;
    public $vFrete;
    public $vSeg;
    public $vDesc;
    public $vOutro;
    public $indTot = '1';
    public $xPed = null;
    public $nItemPed = null;
    public $nFCI = null;
    public $infAdProd = null;
    public $ANP = null;
    public $aliquotaST = null;
    public $detExport = null;
    public $baseICMSSTRetido = null;
    public $valorICMSSTRetido = 0;
    public $valorICMSSubstituto = 0;
    public $valorICMSST = 0;
    public $valorBCST = 0;
    public $pGLP = null;
    public $pGNn = null;
    public $pGNi = null;
    public $vPart = null;
    public $cBenef = null;
    public $unitOfMeasureTribut = null;
    public $DI = null;
    public $vImpostoImportacao = 0;

    const GLP_UTRIB = 'KG';
    const GLP_ANP_COD = '210203001';
}
