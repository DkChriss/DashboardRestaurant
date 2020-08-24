<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\OrderCombo;
use Yajra\DataTables\Facades\DataTables;

class OrderComboController extends Controller
{
    public function index()
    {
        return view('orders-combos.index');
    }
    public function list(Request $request)
    {
        if($request->ajax()) {

            $data = OrderCombo::join('clients','order_combo.client_id','clients.id')
            ->join('combos','order_combo.combo_id','combos.id')
            ->select(['clients.ci','order_combo.total','order_combo.quantity'])
            ->selectRaw("CONCAT(clients.name,' ',clients.lastname) as fullName")
            ->selectRaw("CONCAT(combos.name,'-',combos.price) as dish");
    
            return DataTables::of($data)->make(true);
        }
    }
}
