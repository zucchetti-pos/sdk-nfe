<?php

namespace App\Modules\NFE\Builder\DTO;

/**
 * @author Jonathan Muller Kunz <jonathanmullerkunz@gmail.com>
 */
class Emissor
{
    public $CNPJ = null;
    public $xNome = null;
    public $xFant = null;
    public $enderEmit = null;
    public $IE = null;
    public $IEST = null;
    public $IM = null;
    public $CNAE = null;
    public $CRT = null;
    public $optanteSimples = null;
    public $aliquotaSimples = null;
    public $cMunFG = null;
    public $authorized = [];
    public $icmsCalculationUseFreight = false;
    public $icmsCalculationUseInsurance = false;
    public $icmsCalculationUseIpi = false;
    public $icmsCalculationUseExpenses = false;
    public $icmsCalculationUseConditionalUnconditional = false;
    public $icmsUnencumberedSubtractOnNfe = false;
    public $icmsUnencumberedSubtractOnNfce = false;
    public $defaultReasonIcmsUnenbumberedCst20 = null;
    public $defaultReasonIcmsUnenbumberedCst40 = null;

    public function __construct()
    {
        $this->enderEmit = new Endereco();
    }
}
