<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Device;
use Illuminate\Http\Request;


class DeviceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $datas = Device::all();

        return response()->json($datas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $data = new Device;
        $data->model = $request->model;
        $data->brand = $request->brand;
        $data->uuid = $request->uuid;
        $data->token = $request->token;
        $data->enabled = true;
        $data->member_id = $request->member_id;
        $data->save();

        return response()->json(['ok' => true, 'message' => 'Se creo exitosamente'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Device $device
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        try {
            $data = Device::findOrFail($id);

            return response()->json(['ok' => true, 'data' => $data], 201);

        } catch (\Exception $e) {
            return response()->json(['ok' => false, 'message' => 'Fispositivo not found!', 'error' => $e], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Device $device
     * @return \Illuminate\Http\Response
     */
    public function edit(Device $device)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Device $device
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {

        try {
            $data = Device::findOrFail($id);
            $data->model = $request->model;
            $data->brand = $request->brand;
            $data->uuid = $request->uuid;
            $data->token = $request->token;
            $data->member_id = $request->member_id;
            $data->save();

            return response()->json(['ok' => true, 'message' => 'Se actualizo exitosamente'], 200);
        } catch (\Exception $e) {
            return response()->json(['ok' => false, 'message' => 'Dispositivo not found!', 'error' => $e], 404);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Device $device
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $Dispositivo = Device::findOrFail($id);


        if ($Dispositivo) {
            $Dispositivo->delete();
        } else {
            return response()->json(['ok' => false, 'message' => 'Error  no existe Dispositivo.'], 409);
        }

        return response()->json(['ok' => true, 'message' => 'Se elimino exitosamente'], 200);
    }

    public function enabled($id)
    {
        try {
            $data = Device::findOrFail($id);

            if ($data->enabled == true) {
                $data->enabled = false;
                $data->save();
                return response()->json(['ok' => true, 'message' => 'Dispositivo inactivo'], 201);
            } else {
                $data->enabled = true;
                $data->save();
                return response()->json(['ok' => true, 'message' => 'Dispositivo activo'], 201);
            }
        } catch (\Exception $e) {
            return response()->json(['ok' => false, 'message' => 'Dispositivo not found!', 'error' => $e], 404);
        }
    }
}
