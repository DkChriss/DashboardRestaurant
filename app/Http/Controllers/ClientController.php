<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client;
use App\Http\Requests\ClientRequest;
use Yajra\DataTables\Facades\DataTables;

class ClientController extends Controller
{
    public function index ()
    {
        return view ('clients.index');
    }

    public function list (Request $request)
    {
        if ($request->ajax()) {
            $data = Client::with(['user:id,name,lastname']);

            return DataTables::of($data)
            ->addColumn('usuario', function ($client) {
                return $client->user->name . ' ' . $client->user->lastname;
            })
            ->addColumn('DT_RowId', function ($client) {
                return $client->id;
            })
            ->make(true);

        }
    }

    public function store(ClientRequest $request)
    {
        Client::create($request->all());

        return $this->successResponse('Se ha registrado correctamente el cliente');
    }

    public function show(Client $client)
    {
        return $this->successResponse($client);
    }

    public function update(ClientRequest $request, Client $client)
    {
        $client->update($request->all());
        return $this->successResponse('Se ha actualizado los datos del cliente correctamente');
    }

    public function destroy(Client $client)
    {
        $client->delete();
        return $this->successResponse('Se ha eliminado el cliente correctamente');
    }
}
