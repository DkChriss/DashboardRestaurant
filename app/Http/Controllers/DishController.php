<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Dish;
use App\Drink;
use App\Http\Requests\DishRequest;
use App\Http\Requests\DishRequestFilter;
use Yajra\DataTables\DataTables;

class DishController extends Controller
{
    public function index()
    {
        return view('dishes.index');
    }

    public function list(Request $request)
    {
        if($request->ajax()) {

            $data = Dish::all();

            return DataTables::of($data)
            ->addColumn('DT_RowId', function ($dish) {
                return $dish->id;
            })->make(true);

        }
    }

    public function store(DishRequest $request)
    {
        Dish::create($request->all());

        return $this->successResponse('Se ha registrado correctamente el plato');
    }

    public function show(Dish $dish)
    {
        return $this->successResponse($dish);
    }

    public function update(DishRequest $request, Dish $dish)
    {
        $dish->update($request->all());
        return $this->successResponse("Se ha actuailizado los datos del plato correctamente");
    }

    public function destroy(Dish $dish)
    {
        $dish->delete();

        return $this->successResponse('Se ha eliminado correctamente el plato');
    }

    public function dishFilter(DishRequestFilter $request)
    {
        $data = Drink::filter($request->all())->get();

        return $this->successResponse($data);
    }
}
