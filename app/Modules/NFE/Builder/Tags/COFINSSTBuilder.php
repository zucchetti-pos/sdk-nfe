<?php

namespace App\Modules\NFE\Builder\Tags;

class COFINSSTBuilder
{
    public function execute($prod) 
    {
        $std = new \stdClass();
        $std->item = $prod['item'];
        $std->vCOFINS = $prod['COFINSST']['vCOFINS'] ?? 0;
        $std->vBC = $prod['COFINSST']['vBC'] ?? 0;
        $std->pCOFINS = $prod['COFINSST']['pCOFINS'] ?? 0;
        
        return $std;
    }
}