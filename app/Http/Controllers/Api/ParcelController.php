<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Parcel;
use Illuminate\Http\Request;

class ParcelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $parcels = Parcel::all();
        return response()->json(['ok' => true, 'data' => $parcels], 200);

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
        $parcel = new Parcel();
        $parcel->latitude = $request->latitude;
        $parcel->length = $request->length;
        $parcel->enabled = false;
        $parcel->member_id = $request->member_id;
        $parcel->save();
        return response()->json(['ok' => true, 'message' => 'Se creo exitosamente'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Parcel $parcel
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        try {
            $data = Parcel::FindOrFail($id);
            return response()->json(['ok' => true, 'data' => $data], 201);
        } catch (\Exception $e) {
            return response()->json(['ok' => false, 'message' => 'terreno no encontrado', 'error' => $e], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Parcel $parcel
     * @return \Illuminate\Http\Response
     */
    public function edit(Parcel $parcel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Parcel $parcel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        try {
            $parcel = Parcel::FindOrFail($id);
            $parcel->latitude = $request->latitude;
            $parcel->length = $request->length;
            $parcel->member_id = $request->member_id;
            $parcel->save();
            return response()->json(['ok' => true, 'message' => ' se actualizo exitosamanete'], 200);

        } catch (\Exception $e) {
            return response()->json(['ok' => false, 'message' => 'terreno no encontrado!', 'error' => $e], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Parcel $parcel
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $parcel = Parcel::FindOrFail($id);
        if ($parcel) {
            $parcel->delete();
        } else {
            return response()->json(['ok' => false, 'message' => 'Error no existe terreno'], 409);
        }
        return response()->json(['ok' => true, 'message' => ' se elimino exitosamente'], 200);
    }

    public function enabled($id)
    {
        try {
            $parcel = Parcel::findOrFail($id);

            if ($parcel->enabled == true) {
                $parcel->enabled = false;
                $parcel->save();
                return response()->json(['ok' => true, 'message' => 'Parcel inactivo'], 201);
            } else {
                $parcel->enabled = true;
                $parcel->save();
                return response()->json(['ok' => true, 'message' => 'Parcel activo'], 201);
            }
        } catch (\Exception $e) {
            return response()->json(['ok' => false, 'message' => 'Parcel not found!', 'error' => $e], 404);
        }
    }
}
