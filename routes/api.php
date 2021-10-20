<?php


use App\Http\Controllers\Api\MedicamentosController;
use App\Http\Controllers\Api\PacienteMedicamentosController;
use App\Http\Controllers\Api\TipoMedicamentosController;
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


Route::group([
    'prefix' => 'tipo_medicamentos',
], function () {
    Route::get('/', [TipoMedicamentosController::class, 'index'])
        ->name('api.tipo_medicamentos.tipo_medicamento.index');
    Route::get('/show/{tipoMedicamento}', [TipoMedicamentosController::class, 'show'])
        ->name('api.tipo_medicamentos.tipo_medicamento.show');
    Route::post('/', [TipoMedicamentosController::class, 'store'])
        ->name('api.tipo_medicamentos.tipo_medicamento.store');
    Route::put('tipo_medicamento/{tipoMedicamento}', [TipoMedicamentosController::class, 'update'])
        ->name('api.tipo_medicamentos.tipo_medicamento.update');
    Route::delete('/tipo_medicamento/{tipoMedicamento}', [TipoMedicamentosController::class, 'destroy'])
        ->name('api.tipo_medicamentos.tipo_medicamento.destroy');
});

Route::group([
    'prefix' => 'medicamentos',
], function () {
    Route::get('/', [MedicamentosController::class, 'index'])
        ->name('api.medicamentos.medicamento.index');
    Route::get('/show/{medicamento}', [MedicamentosController::class, 'show'])
        ->name('api.medicamentos.medicamento.show');
    Route::post('/', [MedicamentosController::class, 'store'])
        ->name('api.medicamentos.medicamento.store');
    Route::put('medicamento/{medicamento}', [MedicamentosController::class, 'update'])
        ->name('api.medicamentos.medicamento.update');
    Route::delete('/medicamento/{medicamento}', [MedicamentosController::class, 'destroy'])
        ->name('api.medicamentos.medicamento.destroy');
});

Route::group([
    'prefix' => 'paciente_medicamentos',
], function () {
    Route::get('/', [PacienteMedicamentosController::class, 'index'])
        ->name('api.paciente_medicamentos.paciente_medicamento.index');
    Route::get('/show/{pacienteMedicamento}', [PacienteMedicamentosController::class, 'show'])
        ->name('api.paciente_medicamentos.paciente_medicamento.show');
    Route::post('/', [PacienteMedicamentosController::class, 'store'])
        ->name('api.paciente_medicamentos.paciente_medicamento.store');
    Route::put('paciente_medicamento/{pacienteMedicamento}', [PacienteMedicamentosController::class, 'update'])
        ->name('api.paciente_medicamentos.paciente_medicamento.update');
    Route::delete('/paciente_medicamento/{pacienteMedicamento}', [PacienteMedicamentosController::class, 'destroy'])
        ->name('api.paciente_medicamentos.paciente_medicamento.destroy');
});
