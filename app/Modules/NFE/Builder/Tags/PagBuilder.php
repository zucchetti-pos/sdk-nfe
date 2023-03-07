<?php

namespace App\Modules\NFE\Builder\Tags;

class PagBuilder
{
    public function execute($params) 
    {
        $std = new \stdClass();
        $std->vTroco = $params['pag']['vTroco'] ?? 0;
        
        return $std;
    }
}