<?php

namespace App\Http\Controllers\Admin\Clients;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ClientsController extends Controller
{
    function __invoke(){
        $query = User::verified()->withCount('countable_orders');

        // Filter by name or email
        if($search = request()->get('search')){
            $query->where(function($q) use($search){
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // Ordering
        if($order = request()->get('order')){
            $order = strtolower($order);

            if($order == 'oldest') $query->orderBy('created_at', 'asc');
            elseif($order == 'atoz') $query->orderBy('name', 'asc');
            elseif($order == 'ztoa') $query->orderBy('name', 'desc');
            else $query->latest();
        }else{
            $query->latest();
        }

        return $this->view('admin.clients.all', [
            'clients' => $query->paginate(15)
        ]);
    }
}
