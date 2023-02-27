<?php

namespace App\Http\Controllers;

use App\Modules\NFE\Transmitter;
use Illuminate\Http\Request;

class TransmitterController extends Controller
{
    private $transmitter;

    public function __construct()
    {
        $this->transmitter = new Transmitter();
    }

    public function execute(Request $req)
    {
        $params = $req->all();
        
        return $this->transmitter->execute($params);
    }
}
