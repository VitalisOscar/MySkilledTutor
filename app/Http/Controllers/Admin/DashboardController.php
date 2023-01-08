<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    function __invoke(){
        return $this->view('admin.dashboard', [
            'users' => User::verified()->count(),
            'active_orders' => Order::active()->count(),
            'completed_orders' => Order::completed()->count(),
            'recent_orders' => Order::countable()->latest()->limit(3)->get()
        ]);
    }
}
