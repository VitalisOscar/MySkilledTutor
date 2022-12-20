<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Route;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    function view($view, $data = []){
        if(!isset($data['user'])){
            $data['user'] = auth()->user();
        }

        // Add the current route
        $data['current_route'] = Route::current();

        return response()->view($view, $data);
    }
}
