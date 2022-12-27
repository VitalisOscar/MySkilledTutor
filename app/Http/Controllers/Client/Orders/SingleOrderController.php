<?php

namespace App\Http\Controllers\Client\Orders;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SingleOrderController extends Controller
{
    function __invoke($order){
        return $this->view('client.orders.single');
    }
}
