<?php

namespace App\Modules\NFE\Builder\DTO;

/**
 * @author Jonathan Muller Kunz <jonathanmullerkunz@gmail.com>
 */
class Destinatario
{
    public $CNPJ = null;
    public $CPF = null;
    public $xNome = null;
    public $enderDest = null;
    public $indIEDest = null;
    public $IE = null;
    public $ISUF = null;
    public $IM = null;
    public $idEstrangeiro = null;
    public $email = null;

    public function __construct()
    {
        $this->enderDest = new Endereco();
    }
}
