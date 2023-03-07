<?php

namespace App\Modules\NFE\Builder\Tags;

use App\Modules\NFE\Enums\FreteEnum;

class TranspBuilder
{
    public function execute($params) 
    {
        $std = new \stdClass();
        $std->modFrete = $params['modFrete'] ?? FreteEnum::DESTINATARIO->value; 
        
        return $std;
    }
}