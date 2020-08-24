<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Combo;
use App\Http\Requests\ComboRequest;
use Yajra\DataTables\DataTables;

class ComboController extends Controller
{
    public function index ()
    {
        return view('combos.index');
    }

    public function list (Request $request)
    {
        if($request->ajax()) {
            $data = Combo::with([
                'drink:id,name',
                'dish:id,name'
            ]);

            return DataTables::of($data)
            ->addColumn('drink', function ($combo) {
                return $combo->drink->name;
            })
            ->addColumn('dish', function ($combo) {
                return $combo->dish->name;
            })
            ->addColumn('DT_RowId', function($combo) {
                return $combo->id;
            })
            ->make(true);
        }
    }

    public function store(ComboRequest $request)
    {
        Combo::create($request->all());

        return $this->successResponse('Se ha registrado correctamente el combo');
    }

    public function show(Combo $combo)
    {
        $combo->dish;
        $combo->drink;
        return $this->successResponse($combo);
    }

    public function update(ComboRequest $request, Combo $combo)
    {
        $combo->update($request->all());

        return $this->successResponse('Se ha actualizado los datos del combo');
    }

    public function destroy(Combo $combo)
    {
        $combo->delete();

        return $this->successResponse('Se ha eliminado el combo');
    }
}
