<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    //
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users',
            'name' => 'required|string|max:50',
            'username' => 'required|string|max:50',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()],422);
//            return redirect()->route('abc')
//                ->withInputs($request->all())
//                ->withErrors($validator);
        }

        $user = new User([
            'email' => $request->email,
            'name' => $request->name,
            'username' => $request->username,
            'enabled' => true,
            'rol_id' => 1,
            'password' => bcrypt($request->password),
        ]);

        $user->save();

        $token = $user->createToken('authToken')->accessToken;

        return response()->json([
            'ok' => true,
            'user' => $user,
            'token' => $token
        ]);
    }

    public function login(Request $request)
    {

//        $data = $request->only('email', 'password');
        $val = '';
        if ($request->email) {
            $val = $request->email;
        }
        if ($request->username) {
            $val = $request->username;
        }

        if (Auth::attempt(['email' => $val, 'password' => $request->password]) || Auth::attempt(['username' => $val, 'password' => $request->password])) {

            $token = Auth::user()->createToken('authToken')->accessToken;

            return response()->json([
                'ok' => true,
                'user' => Auth::user(),
                'token' => $token
            ]);
        } else {
            return response()->json('Usuario no registrado', 409);
        }
//        if (! Auth::attempt($data)) {
//            return response()->json([
//                'ok' =>false,
//                'message'=> 'error de credenciales',
//            ]);
//        }
    }

    public function me()
    {
        return response()->json([
            'ok' => true,
            'user' => Auth::user()
        ]);
    }
}
