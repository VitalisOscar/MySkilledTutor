<?php

namespace App\Http\Controllers\Client\Orders;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrdersController extends Controller
{

    function __invoke(Request $request, $status = 'active'){
        $query = $request->user()
            ->orders();

        // Filter by status
        if($status == 'completed') $query->completed();
        else if($status == 'pending') $query->pendingPayment();
        else if($status == 'active') $query->active();
        else if($status == 'cancelled') $query->cancelled();
        else if($status == 'draft') $query->draft();
        else abort(404);

        return $this->view(
            'client.orders.all',
            [
                'orders' => $query->paginate(15),
                'status' => $status
            ]
        );
    }

}
