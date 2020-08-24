<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\UserRequest;

class UserController extends Controller
{
    public function index ()
    {
        return view('users.index');
    }

    public function list (Request $request)
    {
        if ($request->ajax()) {
            $data = User::all();

            return DataTables::of($data)
            ->addColumn('full-name', function ($user) {
                return $user->name . ' ' . $user->lastname;
            })
            ->addColumn('DT_RowId', function ($user) {
                return $user->id;
            })
            ->make(true);
        }
    }
    
    public function show (User $user)
    {
        return $this->successResponse($user);
    }

    public function update (UserRequest $request, User $user)
    {
        if($request->password === null && $request->password_confirmation === null) {
            $input = $request->except(['password','password_confirmation']);
        } else {
            $input = $request->all();
        }
        $user->update($input);
        return $this->successResponse("Se actuailizaron los datos del usuario");
    }
    
    public function destroy(Request $request , User $user)
    {
        $user->delete();
        return $this->successResponse("Se elimino correctamente el usuario");
    }
}
