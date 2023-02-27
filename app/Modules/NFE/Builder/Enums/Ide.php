<?php

namespace App\Modules\NFE\Builder\Enums;

use App\Modules\NFE\Enums\FinNFEnum;
use App\Modules\NFE\Enums\IEnum;

/**
 * @author Jonathan Muller Kunz <jonathanmullerkunz@gmail.com>
 */
enum IdeEnum: string {
    case cUF = null;
    case cNF = null;
    case natOp = null;
    case natTributo = null;
    case mod = null;
    case serie = null;
    case nNF = null;
    case indPag = '2';
    case dhEmi = null;
    case dhSaiEnt = null;
    case tpNF = '1';
    case idDest = null;
    case cMunFG = null;
    case tpImp = '1';
    case tpEmis = '1';
    case cDV = null;
    case tpAmb = null;
    case finNFe = FinNFEnum::DEFAULT;
    case indFinal = IEnum::IND_FINAL_CONSUMER;
    case indPres = '1';
    case indIntermed = '0';
    case infIntermed = null;
    case procEmi = '0';
    case verProc = '3.22.8';
    case dhCont = null;
    case xJust = null;
    case refNFCe = null;
}