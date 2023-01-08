<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotificationsController extends Controller
{
    function __invoke(Request $request){
        return $this->view('client.notifications', [
            'notifications' => $request->user()->notifications
        ]);
    }
}
