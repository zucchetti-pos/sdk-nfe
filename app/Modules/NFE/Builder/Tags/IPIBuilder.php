<?php

namespace App\Modules\NFE\Builder\Tags;

class IPIBuilder
{
    public function execute($prod) 
    {
        $std = new \stdClass();
        $std->item = $prod['item'];
        $std->cEnq = $prod['IPI']['cEnq'];
        $std->CST = $prod['IPI']['CST'];
        $std->vIPI = $prod['IPI']['vIPI'] ?? 0;
        $std->vBC = $prod['IPI']['vBC'] ?? 0;;
        $std->pIPI = $prod['IPI']['pIPI'] ?? 0;;
        
        return $std;
    }
}