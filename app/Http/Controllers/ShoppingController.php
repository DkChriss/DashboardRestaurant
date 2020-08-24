<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShoppingRequest;
use Illuminate\Http\Request;
use App\Shopping;
use Yajra\DataTables\Facades\DataTables;

class ShoppingController extends Controller
{
    public function index()
    {
        return view('shoppings.index');
    }

    public function list (Request $request)
    {
        if ($request->ajax()) {
            $data = Shopping::with([
                'user:id,name,lastname',
            ]);

            return DataTables::of($data)
                ->addColumn('DT_RowId', function ($shopping) {
                    return $shopping->id;
                })
                ->addColumn('user', function ($shopping) {
                    return $shopping->user->name . ' ' . $shopping->user->lastname;
                })
                ->make(true);
        }
    }

    public function store (ShoppingRequest $request)
    {
        Shopping::create($request->all());

        return $this->successResponse('Se ha registrado la compra');
    }

    public function show(Shopping $shopping)
    {
        return $this->successResponse($shopping);
    }

    public function update(ShoppingRequest $request, Shopping $shopping)
    {
        $shopping->update($request->all());

        return $this->successResponse('Se ha actualizado la compra');
    }

    public function destroy(Shopping $shopping)
    {
        $shopping->delete();

        return $this->successResponse('Se ha eliminado la compra');
    }
}
