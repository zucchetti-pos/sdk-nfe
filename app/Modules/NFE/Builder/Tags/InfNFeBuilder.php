<?php

namespace App\Modules\NFE\Builder\Tags;

use App\Modules\NFE\Builder\Enums\InfNFEnum;

class InfNFeBuilder
{
    public function execute() 
    {
        $std = new \stdClass();
        $std->versao = (string) InfNFEnum::versao->value;

        return $std;
    }
}