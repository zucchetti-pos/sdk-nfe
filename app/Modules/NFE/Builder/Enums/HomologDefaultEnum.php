<?php

namespace App\Modules\NFE\Builder\Enums;

/**
 * @author Jonathan Muller Kunz <jonathanmullerkunz@gmail.com>
 */
enum HomologDefaultEnum: string {
    case NOTA_FISCAL_SEM_VALOR = 'NOTA FISCAL EMITIDA EM AMBIENTE DE HOMOLOGACAO - SEM VALOR FISCAL';
    case NFE_SEM_VALOR = 'NF-E EMITIDA EM AMBIENTE DE HOMOLOGACAO - SEM VALOR FISCAL';
}