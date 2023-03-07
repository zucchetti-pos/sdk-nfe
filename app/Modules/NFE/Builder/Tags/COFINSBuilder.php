<?php

namespace App\Modules\NFE\Builder\Tags;

class COFINSBuilder
{
    public function execute($prod) 
    {
        $std = new \stdClass();
        $std->item = $prod['item'];
        $std->CST = $prod['COFINS']['CST'] ?? null;
        $std->vBC = $prod['COFINS']['vBC'] ?? 0;
        $std->pCOFINS = $prod['COFINS']['pCOFINS'] ?? 0;
        $std->vCOFINS = $prod['COFINS']['vCOFINS'] ?? 0;
        $std->qBCProd = $prod['COFINS']['qBCProd'] ?? 0;
        $std->vAliqProd = $prod['COFINS']['vAliqProd'] ?? 0;

        return $std;
    }
}