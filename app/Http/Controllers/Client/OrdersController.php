<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    function __invoke(){
        return $this->view('client.orders.all');
    }

    function create(){
        return $this->view('client.orders.create');
    }
}
