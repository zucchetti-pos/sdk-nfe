<?php

namespace App\Modules\NFE\Builder\Tags;

class ImpostoBuilder
{
    public function execute($prod) 
    {
        $std = new \stdClass();
        $std->item = $prod['item'];
        $std->vTotTrib = $prod['vTotTrib'];
        
        return $std;
    }
}