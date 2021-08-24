<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CobroAgua;
use Illuminate\Http\Request;

class CobroAguaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $cobro_aguas = CobroAgua::all();
        return response()->json(['ok' => true, 'data' => $cobro_aguas], 200);
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $cobro_agua = new CobroAgua();
        $cobro_agua->name = $request->name;
        $cobro_agua->mes = $request->mes;
        $cobro_agua->save();
        return response()->json(['ok' => true, 'message' => ' se creo exitosamente'], 200);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CobroAgua  $cobroAgua
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        try {
            $data = CobroAgua::FindOrFail($id);
            return response()->json(['ok' => true, 'data' => $data], 201);
        } catch (\Exception $e) {
            return response()->json(['ok' => false, 'message' => 'Cobro de agua no encontrado','error' => $e], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CobroAgua  $cobroAgua
     * @return \Illuminate\Http\Response
     */
    public function edit(CobroAgua $cobroAgua)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CobroAgua  $cobroAgua
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        try {
            $cobro_agua = CobroAgua::findOrFail($id);
            $cobro_agua->name = $request->name;
            $cobro_agua->mes = $request->mes;
            $cobro_agua->save();
            return response()->json(['ok' => true, 'message' => 'Se actualizo exitosamente'], 200);
        } catch (\Exception $e) {
            return response()->json(['ok' => false, 'message' => 'Cobro de agua not found!', 'error' => $e], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CobroAgua  $cobroAgua
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $cobro_agua = CobroAgua::FindOrFail($id);
        if ($cobro_agua) {
            $cobro_agua->delete();
        } else {
            return response()->json(['ok' => false, 'message' => 'Error no existe cobro de agua..'], 409);
        }
        return response()->json(['ok' => true, 'message' => ' se elimino exitosamente'], 200);
    }
    public function enabled($id)
    {
        try {
            $cobro_agua = CobroAgua::findOrFail($id);

            if ($cobro_agua->enabled == true) {
                $cobro_agua->enabled = false;
                $cobro_agua->save();
                return response()->json(['ok' => true, 'message' => 'Cobro de agua inactivo'], 201);
            } else {
                $cobro_agua->enabled = true;
                $cobro_agua->save();
                return response()->json(['ok' => true, 'message' => 'Cobro de agua activo'], 201);
            }
        } catch (\Exception $e) {
            return response()->json(['ok' => false, 'message' => 'cobro de agua no encontrado!', 'error' => $e], 404);
        }
    }
}
