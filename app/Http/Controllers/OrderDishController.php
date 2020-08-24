<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\OrderDish;
use App\Client;
use Yajra\DataTables\DataTables;

class OrderDishController extends Controller
{
    public function index()
    {
        return view('orders-dishes.index');
    }

    public function list(Request $request)
    {
        if($request->ajax()) {

            $data = OrderDish::join('clients','order_dishes.client_id','clients.id')
            ->join('dishes','order_dishes.dish_id','dishes.id')
            ->select(['clients.ci','order_dishes.total','order_dishes.quantity'])
            ->selectRaw("CONCAT(clients.name,' ',clients.lastname) as fullName")
            ->selectRaw("CONCAT(dishes.name,'-',dishes.price) as dish");
    
            return DataTables::of($data)->make(true);
        }
    }
}
