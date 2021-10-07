<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('auth/register', [AuthController::class, 'register'])->name('api.auth.register');
Route::post('auth/login', [AuthController::class, 'login'])->name('api.auth.login');
//Route::get('auth/me', [AuthController::class, 'me'])
//    ->middleware('auth:api');

//Route::post('message/send', [MessageController::class, 'send']);
//    ->middleware('auth:api');
//
//Route::post('message/sendDM', [MessageController::class, 'sendDM'])
//    ->middleware('auth:api');

Route::apiResource('pacientes', 'App\Http\Controllers\Api\PacienteController');
//Route::get('users/enabled/{id}', 'App\Http\Controllers\Api\UserController@enabled');
//
//Route::apiResource('rols', 'App\Http\Controllers\Api\RolController');
//Route::get('rols/enabled/{id}', 'App\Http\Controllers\Api\RolController@enabled');
//Route::apiResource('devices', 'App\Http\Controllers\Api\DeviceController');
//
//Route::apiResource('members', 'App\Http\Controllers\Api\MemberController');
//Route::get('members/enabled/{id}', 'App\Http\Controllers\Api\MemberController@enabled');
//Route::get('members/parcels/getall', 'App\Http\Controllers\Api\MemberController@getAllMemberswithParcels');
//
//Route::apiResource('parcels', 'App\Http\Controllers\Api\ParcelController');
//Route::get('parcels/enabled/{id}', 'App\Http\Controllers\Api\ParcelController@enabled');
//Route::apiResource('settings', 'App\Http\Controllers\Api\SettingController');
//
//Route::apiResource('cobro_aguas', 'App\Http\Controllers\Api\CobroAguaController');
//Route::get('cobro_aguas/enabled/{id}', 'App\Http\Controllers\Api\CobroAguaController@enabled');
