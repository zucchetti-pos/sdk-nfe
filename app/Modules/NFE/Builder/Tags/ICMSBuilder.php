<?php

namespace App\Modules\NFE\Builder\Tags;

class ICMSBuilder
{
    public function execute($prod) 
    {
        $std = new \stdClass();
        $std->item = $prod['item'];
        $std->orig = $prod['orig'];
        $std->CST = $prod['CST'];
        $std->modBC = $prod['modBC'];
        $std->vBC = $prod['vBC'];
        $std->pICMS = $prod['pICMS'];
        $std->vICMS = $prod['vICMS'];
        
        return $std;
    }
}