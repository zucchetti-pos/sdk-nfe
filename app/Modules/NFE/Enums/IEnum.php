<?php

namespace App\Modules\NFE\Enums;

/**
 * @author Jonathan Muller Kunz <jonathanmullerkunz@gmail.com>
 */

enum IEnum: string {
    case IND_FINAL_CONSUMER = '0';
    case CONTRIBUINTE_ICMS = '1';
    case CONTRIBUINTE_INSENTO = '2';
    case NAO_CONTRIBUINTE = '9';
}