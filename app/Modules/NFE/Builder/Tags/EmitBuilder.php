<?php

namespace App\Modules\NFE\Builder\Tags;

/**
 * @author Jonathan Muller Kunz <jonathanmullerkunz@gmail.com>
 */
class EmitBuilder
{
    public function execute($params) {
        $std = new \stdClass();

        $std->CNPJ = $params['emit']['CNPJ'] ?? $params['emit']['CPF'];
        $std->xNome = $params['emit']['xNome'];
        $std->xFant = $params['emit']['xFant'];
        $std->IE = str_replace(['.', '/', '-'], '', $params['emit']['IE']);
        $std->IM = $params['emit']['IM'] ?? null;
        $std->CNAE = $params['emit']['CNAE'] ?? null;
        $std->CRT = $params['emit']['CRT'];
        $std->optanteSimples = $params['emit']['optanteSimples'];
        $std->aliquotaSimples = $params['emit']['aliquotaSimples'] ?? null;

        if (!empty($params['fone'])) {
            $std->enderEmit = new \stdClass();
            $std->enderEmit->fone = $params['foneArea'].$params['fone'];
        }

        if (empty($params['emit']['enderEmit'])) {
            return $std;
        }
        
        $std->enderEmit = new \stdClass();
        $std->enderEmit->xLgr = $params['emit']['enderEmit']['xLgr'] ?? null;
        $std->enderEmit->nro = $params['emit']['enderEmit']['nro'] ?? null;
        
        if (!empty($params['emit']['enderEmit']['xCpl'])) {
            $std->enderEmit->xCpl = $params['emit']['enderEmit']['xCpl'] ?? null;
        }

        $std->enderEmit->xBairro = $params['emit']['enderEmit']['xBairro'] ?? null;

        if (empty($params['emit']['enderEmit']['CEP'])) {
            return $std;
        }

        $std->enderEmit->CEP = $params['emit']['enderEmit']['CEP'] ?? null;
        $std->enderEmit->cMun = $params['emit']['enderEmit']['cMun'] ?? null;
        $std->cMunFG = $params['emit']['enderEmit']['cMunFG'] ?? null;
        $std->enderEmit->xMun = $params['emit']['enderEmit']['xMun'] ?? null;
        $std->enderEmit->UF = $params['emit']['enderEmit']['UF'] ?? null;
        $std->enderEmit->cPais = $params['emit']['enderEmit']['cPais'] ?? null;
        $std->enderEmit->xPais = $params['emit']['enderEmit']['xPais'] ?? null;

        return $std;
    }
}
