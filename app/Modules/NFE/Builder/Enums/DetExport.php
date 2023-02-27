<?php

namespace App\Modules\NFE\Builder\DTO;

/**
 * @author Jonathan Muller Kunz <jonathanmullerkunz@gmail.com>
 */
class DetExport
{
    public $item = null;
    public $nDraw = null;

    /**
     * @var DetExportInd
     */
    public $detExportInd;

    public function __construct()
    {
        $this->detExportInd = new DetExportInd();
    }
}
