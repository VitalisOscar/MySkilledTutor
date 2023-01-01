<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    function __invoke(Request $request){
        $user = $request->user('web');

        return $this->view('client.dashboard', [
            'all_orders' => $user->orders()->countable()->count(),
            'active_orders' => $user->orders()->active()->count(),
            'completed_orders' => $user->orders()->completed()->count(),
            'notifications' => []
        ]);
    }
}
