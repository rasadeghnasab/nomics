<?php

use App\Http\Controllers\API\V1\NomicsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\V1\AuthController;

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

//Route::post('register', [AuthController::class, 'register']);
Route::group(['prefix' => 'auth'], function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('check', [AuthController::class, 'check']);
});

Route::group(['prefix' => 'nomics'], function () {
    Route::get('currencies', [NomicsController::class, 'currencies']);
    Route::get('currencies/rate', [NomicsController::class, 'currencyRate']);
});
