<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\OrderCombo;
use App\OrderDish;
use App\OrderDrink;
use App\Client;
use App\Dish;
use App\Drink;
use App\Combo;
use App\Http\Requests\OrderRequest;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class OrderController extends Controller
{
    public function index ()
    {
        return view ('orders.index');
    }

    public function indexList()
    {
        return view('orders-dishes.index');
    }

    public function list (Request $request)
    {
        if($request->ajax()) {
            $data = Client::join('order_dishes','clients.id','order_dishes.client_id')
            ->join('order_drinks', 'clients.id', 'order_drinks.client_id')
            ->join('order_combo', 'clients.id', 'order_combo.client_id')
            ->join('dishes', 'order_dishes.dish_id', 'dishes.id')
            ->join('drinks', 'order_drinks.drink_id', 'drinks.id')
            ->join('combos', 'order_combo.combo_id',  'combos.id')
            ->select(['clients.ci',
                'order_dishes.total as dish_total',
                'order_dishes.quantity as dish_q',
                'order_drinks.total as drink_total',
                'order_drinks.quantity as drink_q',
                'order_combo.total as combos_total',
                'order_combo.quantity as    combo_q'
            ])
            ->selectRaw("CONCAT(dishes.name,'-',dishes.price) as dishPrice")
            ->selectRaw("CONCAT(drinks.name,'-',drinks.price) as drinkPrice")
            ->selectRaw("CONCAT(combos.name,'-',combos.price) as CombohPrice")
            ->selectRaw("CONCAT(clients.name,' ',clients.lastname) as fullName");
            return DataTables::of($data)->make(true);
        }
    }

    public function dishes(Request $request)
    {
        if($request->ajax()) {

            $data = Dish::all();
            
            return $this->successResponse($data);
        }
    }

    public function drinks(Request $request)
    {
        if ($request->ajax()) {

            $data = Drink::all();

            return $this->successResponse($data);
        }
    }

    public function combos(Request $request)
    {
        if ($request->ajax()) {

            $data = Combo::all();

            return $this->successResponse($data);
        }
    }

    public function store(Request $request) 
    {
        try {
            DB::beginTransaction();
        
            $client = Client::where('ci',$request->ci)->first();
            if(empty($client)) {

                $client = new Client();

                $client->ci = $request->ci;
                $client->name = $request->name;
                $client->lastname = $request->lastname;
                $client->user_id = $request->user_id;
                $client->saveOrFail();
            }

            if(!empty($request->dish_id) && !empty($request->dish_total)) {
                foreach ($request->dish_id as $key => $value) {

                    $dish = Dish::findOrFail($value);
                    
                    $total = $dish->price * $request->dish_total[$value];

                    $dishOrder = new OrderDish();
                    
                    $dishOrder->dish_id = $dish->id;
                    $dishOrder->client_id = $client->id;
                    $dishOrder->quantity = $request->dish_total[$value];
                    $dishOrder->total = $total;
                    
                    $dishOrder->saveOrFail();
                }
            }
            if(!empty($request->drink_id) && !empty($request->drink_total)) {
                foreach($request->drink_id as $key => $value) {

                    $drink = Drink::findOrFail($value);
                    
                    $total = $drink->price * $request->drink_total[$value];

                    $drinkOrder = new OrderDrink();

                    $drinkOrder->drink_id =  $drink->id;
                    $drinkOrder->client_id = $client->id;
                    $drinkOrder->quantity = $request->drink_total[$value];
                    $drinkOrder->total = $total;

                    $drinkOrder->saveOrFail();
                }
            }
            if(!empty($request->combo_id) && !empty($request->combo_total)) {
                foreach($request->combo_id as $key => $value) {
                    $combo = Combo::findOrFail($value);

                    $total = $combo->price * $request->combo_total[$value];

                    $comboOrder = new OrderCombo();

                    $comboOrder->combo_id = $combo->id;
                    $comboOrder->client_id = $client->id;
                    $comboOrder->quantity = $request->combo_total[$value];
                    $comboOrder->total = $total;

                    $comboOrder->saveOrFail();
                }
            }
            DB::commit();
            return $this->successResponse('Se ha registrado correctamnte el pedido');

        } catch (\Throwable $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
