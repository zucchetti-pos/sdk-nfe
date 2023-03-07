<?php

namespace App\Modules\NFE\Builder\Tags;

class VolBuilder
{
    public function execute($prod) 
    {
        $std = new \stdClass();
        $std->item = $prod['item'];
        $std->qVol = $prod['vol']['qVol'] ?? null;
        $std->esp = $prod['vol']['esp'] ?? null;
        $std->marca = $prod['vol']['marca'] ?? null;
        $std->nVol = $prod['vol']['nVol'] ?? null;
        $std->pesoL = $prod['vol']['pesoL'] ?? null;
        $std->pesoB = $prod['vol']['pesoB'] ?? null;
        
        return $std;
    }
}