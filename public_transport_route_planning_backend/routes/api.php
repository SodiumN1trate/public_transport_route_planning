<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TransportController;
use App\Http\Controllers\Api\StopController;
use App\Http\Controllers\Api\RouteCalculatorController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
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

Route::apiResources([
    'transports' => TransportController::class,
    'stops' => StopController::class
]);

Route::get('/routes/{from_id}/{to_id}', [RouteCalculatorController::class, 'route_calculator']);


Route::post('/login', [AuthController::class, 'login']);

Route::post('/upload_json', [AdminController::class, 'upload_json']);
