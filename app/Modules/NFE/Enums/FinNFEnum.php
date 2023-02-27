<?php

namespace App\Modules\NFE\Enums;

/**
 * @author Jonathan Muller Kunz <jonathanmullerkunz@gmail.com>
 */
enum FinNFEnum: string {
    case DEFAULT = '1';
    case NF_COMPL = '2';
    case NF_ADJUST = '3';
    case NF_DEVOLUTION = '4';
}