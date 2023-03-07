<?php

namespace App\Modules\NFE\Builder\Tags;

class ICMSTotBuilder
{
    public function execute($params) 
    {
        $std = new \stdClass();
        $std->vBC = $params['ICMSTot']['vBC'] ?? 0;
        $std->vICMS = $params['ICMSTot']['vICMS'] ?? 0;
        $std->vICMSDeson = $params['ICMSTot']['vICMSDeson'] ?? 0;
        $std->vBCST = $params['ICMSTot']['vBCST'] ?? 0;
        $std->vST = $params['ICMSTot']['vST'] ?? 0;
        $std->vProd = $params['ICMSTot']['vProd'] ?? 0; 
        $std->vFrete = $params['ICMSTot']['vFrete'] ?? 0;
        $std->vSeg = $params['ICMSTot']['vSeg'] ?? 0;
        $std->vDesc = $params['ICMSTot']['vDesc'] ?? 0;
        $std->vII = $params['ICMSTot']['vII'] ?? 0;
        $std->vIPI = $params['ICMSTot']['vIPI'] ?? 0;
        $std->vPIS = $params['ICMSTot']['vPIS'] ?? 0;
        $std->vCOFINS = $params['ICMSTot']['vCOFINS'] ?? 0;
        $std->vOutro = $params['ICMSTot']['vOutro'] ?? 0;
        $std->vNF = $params['ICMSTot']['vNF'] ?? 0; 
        $std->vTotTrib = $params['ICMSTot']['vTotTrib'] ?? 0;
        
        return $std;
    }
}