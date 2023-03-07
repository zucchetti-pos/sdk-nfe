<?php

namespace App\Modules\NFE\Builder\Tags;

class PISBuilder
{
    public function execute($prod) 
    {
        $std = new \stdClass();
        $std->item = $prod['item'];
        $std->CST = $prod['PIS']['CST'];
        $std->vBC = $prod['PIS']['vBC'] ?? 0;
        $std->pPIS = $prod['PIS']['pPIS'] ?? 0;
        $std->vPIS = $prod['PIS']['vPIS'] ?? 0;
        
        return $std;
    }
}