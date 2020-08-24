<?php

namespace App\Http\Controllers;

use App\OrderDrink;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class OrderDrinkController extends Controller
{
    public function index()
    {
        return view('orders-drinks.index');
    }
    public function list(Request $request)
    {
        if($request->ajax()) {

            $data = OrderDrink::join('clients','order_drinks.client_id','clients.id')
            ->join('drinks','order_drinks.drink_id','drinks.id')
            ->select(['clients.ci','order_drinks.total','order_drinks.quantity'])
            ->selectRaw("CONCAT(clients.name,' ',clients.lastname) as fullName")
            ->selectRaw("CONCAT(drinks.name,'-',drinks.price) as dish");
    
            return DataTables::of($data)->make(true);
        }
    }
}
