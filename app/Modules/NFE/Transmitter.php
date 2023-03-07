<?php

namespace App\Modules\NFE;

use App\Modules\NFE\Builder\Builder;
use App\Modules\NFE\Builder\NFeTools;

class Transmitter
{
    private $builder;
    private $nfeTools;

    public function __construct()
    {
        $this->builder = new Builder();
        $this->nfeTools = new NFeTools();
    }

    public function execute($params)
    {
        $xml = $this->builder->execute($params);

        $tools = $this->nfeTools->execute($params);
        
        try {
            $xmlAssinado = $tools->signNFe($xml); 
        } catch (\Exception $e) {
            exit($e->getMessage());
        }

        $idLote = str_pad(100, 15, '0', STR_PAD_LEFT); 
        $resp = $tools->sefazEnviaLote([$xmlAssinado], $idLote);

        $st = new \NFePHP\NFe\Common\Standardize();
        $std = $st->toStd($resp);

        if ($std->cStat != 103) {
            //erro registrar e voltar
            exit("[$std->cStat] $std->xMotivo");
        }
        $recibo = $std->infRec->nRec; 
        return ["status" => $xmlAssinado];
    }
}
