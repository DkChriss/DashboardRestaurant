<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Drink;
use App\Http\Requests\DrinkRequest;
use App\Http\Requests\DrinkRequestFilter;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Storage;

class DrinkController extends Controller
{
    public function index ()
    {
        return view('drinks.index');
    }

    public function list (Request $request)
    {
        if ($request->ajax()) {
            $data = Drink::all();

            return DataTables::of($data)
            ->addColumn('DT_RowId', function ($drink){
                return $drink->id;
            })
            ->make(true);
        }
    }

    public function store(DrinkRequest $request)
    {
        Drink::create($request->all());
        return $this->successResponse('Se ha registrado correctamente la bebibda');
    }

    public function show (Drink $drink)
    {
        return $this->successResponse($drink);
    }

    public function update(DrinkRequest $request, Drink $drink) 
    {
        $drink->update($request->all());
        
        return $this->successResponse('Se ha actualizado los datos de la bebida');
    }

    public function destroy(Drink $drink)
    {
        $drink->delete();

        return $this->successResponse('Se ha eliminado la bebida');
    }

    public function drinkFilter(DrinkRequestFilter $request)
    {
        $data = Drink::filter($request->all())->get();

        return $this->successResponse($data);
    }
}
