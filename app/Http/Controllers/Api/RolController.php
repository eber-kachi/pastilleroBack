<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Rol;
use Illuminate\Http\Request;

class RolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $rols=Rol::all();
        return response()->json(['ok' => true,'data'=>$rols], 200);
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
        //
        $rol = new Rol();
        $rol->name = $request->name;
        $rol->enabled = false;
        $rol->save();

        return response()->json(['ok' => true, 'message' => ' se creo exitosamente'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        try {
            $data = Rol::FindOrFail($id);
            return response()->json(['ok' => true, 'data' => $data], 201);
        } catch (\Exception $e) {
            return response()->json(['ok' => false, 'message' => 'Rol no encontrado', 'error' => $e], 404);
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
        //
        $rol = Rol::find($id);
        $rol->name = $request->name;
        $rol->enabled = false;
        $rol->save();

        return response()->json(['ok' => true, 'message' => ' se actualizo exitosamanete'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        //
        $Rol = Rol::FindOrFail($id);
        if ($Rol) {
            $Rol->delete();
        } else {
            return response()->json(['ok' => false, 'message' => 'Error does not exist Rol'], 409);
        }
        return response()->json(['ok' => true, 'message' => ' se elimino exitosamente'], 200);

    }
    public function enabled($id)
    {
        try {
            $rol = Rol::findOrFail($id);

            if ($rol->enabled == true) {
                $rol->enabled = false;
                $rol->save();
                return response()->json(['ok' => true, 'message' => 'rol inactivo'], 201);
            } else {
                $rol->enabled = true;
                $rol->save();
                return response()->json(['ok' => true, 'message' => 'rol activo'], 201);
            }
        } catch (\Exception $e) {
            return response()->json(['ok' => false, 'message' => 'Rol not found!', 'error' => $e], 404);
        }
    }
}
