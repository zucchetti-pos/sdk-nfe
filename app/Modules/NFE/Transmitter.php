<?php

namespace App\Modules\NFE;

use App\Modules\NFE\Builder\Builder;

class Transmitter
{
    private $builder;

    public function __construct()
    {
        $this->builder = new Builder();
    }

    public function execute($params)
    {
        return $this->builder->execute($params);
    }
}
