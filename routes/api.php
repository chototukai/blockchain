<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\EhrController;
use App\Http\Controllers\AuController;
use App\Http\Controllers\diagonsisController;
use App\Http\Controllers\PatientController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::apiResources([
    'register' => RegisterController::class,
    'ehr' => EhrController::class,
    'au' => AuController::class,
    'diagonsis'=> diagonsisController::class,
    'patient'=> PatientController::class
]);
