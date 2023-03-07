<?php

namespace App\Modules\NFE\Builder\Tags;

class DetPagBuilder
{
    public function execute($params) 
    {
        $std = new \stdClass();
        $std->indPag = $params['detPag']['indPag'];
        $std->tPag = $params['detPag']['tPag'];
        $std->vPag = $params['detPag']['vPag'];
        
        return $std;
    }
}

