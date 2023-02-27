<?php

namespace App\Modules\NFE\Builder\DTO;

/**
 * @author Jonathan Muller Kunz <jonathanmullerkunz@gmail.com>
 */
class Imposto
{
    /**
     * @var PIS
     */
    public $PIS;

    /**
     * @var COFINS
     */
    public $COFINS;

    /**
     * @var ICMS
     */
    public $ICMS;

    /**
     * @var IPI
     */
    public $IPI;

    /**
     * @var ICMSSN
     */
    public $ICMSSN;

    public $vTotTrib;

    public $ICMSUFDest;

    public $IBPT;

    /**
     * @var II|null
     */
    public $II;
}
