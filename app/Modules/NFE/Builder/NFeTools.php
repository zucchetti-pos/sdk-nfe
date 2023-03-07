<?php

namespace App\Modules\NFE\Builder;

class NFeTools
{
    public function execute($params)
    {
        $config  = [
            "tpAmb" => $params['isHomolog'] ? 2 : 1,
            "razaosocial" => $params['razaoSocial'],
            "cnpj" => (string) $params['emit']['CNPJ'],
            "siglaUF" => (string) $params['emit']['enderEmit']['UF'],
            "versao" => '4.00',
            "schemes" => "PL_009_V4",
        ];
        
        $configJson = json_encode($config);
        $certificadoDigital = file_get_contents("/tmp/cert.pfx");

        $tools = new \NFePHP\NFe\Tools($configJson, \NFePHP\Common\Certificate::readPfx($certificadoDigital, '123456'));

        return $tools;
    }
}
