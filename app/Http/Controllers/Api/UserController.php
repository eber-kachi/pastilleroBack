<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::get();

        return response()->json($users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->username = $request->username;
        $user->enabled = false;
        $user->password = Hash::make($request->username);
        foreach ($request->rols as $rol) {
            if ($rol->selected == true) {
                $user->rol_id = $rol->id;
            }
        }
        $user->save();

        return response()->json(['ok' => true, 'message' => 'Se creo exitosamente'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $user = User::findOrFail($id)->withe('rols');

            return response()->json(['ok' => true, 'data' => $user], 201);

        } catch (\Exception $e) {
            return response()->json(['ok' => false, 'message' => 'user not found!', 'error' => $e], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->username = $request->username;
        $user->password = ($request->username) ? Hash::make($request->username) : $user->password;
        $user->save();
        return response()->json(['ok' => true, 'message' => ' se actualizo exitosamente'], 200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $usuario = User::findOrFail($id);


        if ($usuario) {
            $usuario->delete();
        } else {
            return response()->json(['ok' => false, 'message' => 'Error  no existe usuario.'], 409);
        }

        return response()->json(['ok' => true, 'message' => ' se elimino exitosamente'], 200);
    }

    public function enabled($id)
    {
        try {
            $user = User::findOrFail($id);

            if ($user->enabled == true) {
                $user->enabled = false;
                $user->save();
                return response()->json(['ok' => true, 'message' => 'Usuario inactivo'], 201);
            } else {
                $user->enabled = true;
                $user->save();
                return response()->json(['ok' => true, 'message' => 'Usuario activo'], 201);
            }
        } catch (\Exception $e) {
            return response()->json(['ok' => false, 'message' => 'user not found!', 'error' => $e], 404);
        }
    }
}
