<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        //
        $settings = Setting::all();

        if (sizeof($settings) == 1) {
            return response()->json(['ok' => true, 'data' => $settings[0]], 200);
        } else {
            return response()->json(['ok' => false, 'message' => 'No existe ninguna configuracion'], 409);
        }

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
        //
        $setting = new Setting();
        $setting->name = $request->name;
        $setting->dir_logo = $request->dir_logo;
        $setting->color = $request->color;
        $setting->save();
        return response()->json(['ok' => true, 'message' => 'Se creo exitosamente'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\setting $setting
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        //
        try {
            $data = Setting::FindOrFail($id);
            return response()->json(['ok' => true, 'data' => $data], 201);
        } catch (\Exception $e) {
            return response()->json(['ok' => false, 'message' => 'Ajustes no encontrado', 'error' => $e], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\setting $setting
     * @return \Illuminate\Http\Response
     */
    public function edit(setting $setting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\setting $setting
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        //
        try {
            $setting = Setting::findOrFail($id);
            $setting->name = $request->name;
            $setting->dir_logo = $request->dir_logo;
            $setting->color = $request->color;
            $setting->save();
            return response()->json(['ok' => true, 'message' => 'Se actualizo exitosamente'], 200);
        } catch (\Exception $e) {
            return response()->json(['ok' => false, 'message' => 'Ajustes not found!', 'error' => $e], 404);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\setting $setting
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        //
        $setting = Setting::FindOrFail($id);
        if ($setting) {
            $setting->delete();
        } else {
            return response()->json(['ok' => false, 'message' => 'Error no existe ajustes..'], 409);
        }
        return response()->json(['ok' => true, 'message' => ' se elimino exitosamente'], 200);
    }

}
