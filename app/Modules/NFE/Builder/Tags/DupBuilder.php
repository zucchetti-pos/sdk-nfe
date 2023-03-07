<?php

namespace App\Modules\NFE\Builder\Tags;

class DupBuilder
{
    public function execute($params) 
    {
        $std = new \stdClass();
        $std->nDup = $params['dup']['nDup'] ?? null;
        $std->dVenc = $params['dup']['dVenc'] ?? date('Y-m-d');
        $std->vDup = $params['dup']['vDup'];
        
        return $std;
    }
}