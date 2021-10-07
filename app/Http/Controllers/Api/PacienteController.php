<?php

namespace App\Http\Controllers\Api;

use App\Models\Paciente;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PacienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $pacientes = Paciente::all();
        return response()->json(['ok' => true, 'data' => $pacientes], 200);
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $parcel = new Paciente();
        $parcel->nombres = $request->nombres;
        $parcel->apellidos = $request->apellidos;
        $parcel->fecha_nacimiento = $request->fecha_nacimiento;
        $parcel->direccion = $request->direccion;
        $parcel->celular = $request->celular;
        $parcel->user_id = $request->user_id;
        $parcel->save();
        return response()->json(['ok' => true, 'message' => 'Se creo exitosamente'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Paciente $paciente
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        try {
            $data = Paciente::FindOrFail($id);
            return response()->json(['ok' => true, 'data' => $data], 201);
        } catch (\Exception $e) {
            return response()->json(['ok' => false, 'message' => 'terreno no encontrado', 'error' => $e], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Paciente $paciente
     * @return \Illuminate\Http\Response
     */
    public function edit(Paciente $paciente)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Paciente $paciente
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        try {
            $parcel = Paciente::FindOrFail($id);
            $parcel->nombres = $request->nombres;
            $parcel->apellidos = $request->apellidos;
            $parcel->fecha_nacimiento = $request->fecha_nacimiento;
            $parcel->direccion = $request->direccion;
            $parcel->celular = $request->celular;
            $parcel->save();
            return response()->json(['ok' => true, 'message' => ' se actualizo exitosamanete'], 200);

        } catch (\Exception $e) {
            return response()->json(['ok' => false, 'message' => 'Error No encontrado!', 'error' => $e], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Paciente $paciente
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $parcel = Paciente::FindOrFail($id);
        if ($parcel) {
            $parcel->delete();
        } else {
            return response()->json(['ok' => false, 'message' => 'Error no existe terreno'], 409);
        }
        return response()->json(['ok' => true, 'message' => 'Se elimino exitosamente'], 200);
    }
}
