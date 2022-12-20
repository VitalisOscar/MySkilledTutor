<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SingleOrderController extends Controller
{
    function __invoke(){
        return $this->view('client.orders.single');
    }
}
