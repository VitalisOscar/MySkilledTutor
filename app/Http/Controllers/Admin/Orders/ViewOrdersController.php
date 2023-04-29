<?php

namespace App\Http\Controllers\Admin\Orders;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class ViewOrdersController extends Controller
{
    function __invoke(Request $request)
    {
        $client = Route::current()->parameter('client');
        $status = Route::current()->parameter('status');

        if($client){
            $query = $client->orders();
        }else{
            $query = Order::query();
        }

        // Filter by status
        if($status == 'completed') $query->completed();
        else if($status == 'pending') $query->pendingPayment();
        else if($status == 'active') $query->active();
        else if($status == 'cancelled') $query->cancelled();
        else if($status == 'draft') $query->draft();
        else if($status != 'search') abort(404);

        if($status == 'search'){
            if($request->filled('search')){
                $query
                    ->whereIn('status', [Order::STATUS_ACTIVE, Order::STATUS_COMPLETED, Order::STATUS_CANCELLED])
                    ->where(function($q) use($request){
                        $q->where('title', 'like', '%'.$request->get('search').'%')
                            ->orWhere('order_number', 'like', '%'.$request->get('search').'%');
                    });
            }else{
                return redirect()->route('admin.orders.all', 'active');
            }
        }

        return $this->view(
            'admin.orders.all',
            [
                'orders' => $query->paginate(15),
                'status' => $status,
                'client' => $client
            ]
        );
    }
}
