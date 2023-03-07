<?php

namespace App\Modules\NFE\Enums;

/**
 * @author Jonathan Muller Kunz <jonathanmullerkunz@gmail.com>
 */

enum FreteEnum: int {
    case REMENTE = 0;
    case DESTINATARIO = 1;
    case TRANSPORTE_PROPRIO_REMETENTE = 3;
    case TRANSPORTE_PROPRIO_DESTINATARIO = 4;
    case TERCEIROS = 2;
    case SEM_FRETE = 9;
}