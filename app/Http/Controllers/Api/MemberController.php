<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        //
        $members = Member::latest()->get();
        return response()->json(['ok' => true, 'data' => $members], 200);
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
        try {

            $member = new Member();
            $member->name = $request->name;
            $member->dad_last_name = $request->dad_last_name;
            $member->mom_last_name = $request->mom_last_name;
            $member->dir_photo = null;
            $file = $request->file('photo');
            if ($request->hasFile('photo')) {
//                abort('500', 'error en aqui');
                $member->dir_photo = $file->store('public/members');
            }
            $member->ci = $request->ci;
            $member->phone = $request->phone;
            $member->birth_date = $request->birth_date;
            $member->enabled = false;
            $member->save();

            return response()->json(['ok' => true, 'message' => ' se creo exitosamente'], 200);
        } catch (\Exception $e) {

            return response()->json(['ok' => false, 'message' => 'Miembro no encontrado', 'error' => $e->getMessage()], 404);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Member $member
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        try {
            $data = Member::FindOrFail($id);
            return response()->json(['ok' => true, 'data' => $data], 201);
        } catch (\Exception $e) {
            return response()->json(['ok' => false, 'message' => 'Miembro no encontrado', 'error' => $e], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Member $member
     * @return \Illuminate\Http\Response
     */
    public function edit(Member $member)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Member $member
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        try {
            $member = Member::FindOrFail($id);
            $member->name = $request->name;
            $member->dad_last_name = $request->dad_last_name;
            $member->mom_last_name = $request->mom_last_name;
            $member->dir_photo = $request->dir_photo;
            $member->ci = $request->ci;
            $member->phone = $request->phone;
            $member->birth_date = $request->birth_date;
            $member->save();
            return response()->json(['ok' => true, 'message' => ' se actualizo exitosamanete'], 200);
        } catch (\Exception $e) {
            return response()->json(['ok' => false, 'message' => 'Miembro no encontrado!', 'error' => $e], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Member $member
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $member = Member::FindOrFail($id);
        if ($member) {
            $member->delete();
        } else {
            return response()->json(['ok' => false, 'message' => 'error no existe mienbro.'], 409);
        }
        return response()->json(['ok' => true, 'message' => ' se elimino exitosamente'], 200);
    }

    public function enabled($id)
    {
        try {
            $member = Member::findOrFail($id);

            if ($member->enabled == true) {
                $member->enabled = false;
                $member->save();
                return response()->json(['ok' => true, 'message' => 'miembro inactivo'], 201);
            } else {
                $member->enabled = true;
                $member->save();
                return response()->json(['ok' => true, 'message' => 'miembro activo'], 201);
            }
        } catch (\Exception $e) {
            return response()->json(['ok' => false, 'message' => 'miembro not found!', 'error' => $e], 404);
        }
    }

    public function getAllMemberswithParcels()
    {

        $members = Member::with('parcels')->get();
        return response()->json(['ok' => true, 'data' => $members], 200);
    }
}
