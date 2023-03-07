<?php

namespace App\Modules\NFE\Builder\Tags;

class FatBuilder
{
    public function execute($params) 
    {
        $std = new \stdClass();
        $std->nFat = $params['fat']['nFat'] ?? null;
        $std->vOrig = $params['fat']['vOrig'] ?? null;
        $std->vLiq = $params['fat']['vLiq'] ?? null;
        
        return $std;
    }
}