<?php

use App\Http\Controllers\API\ExchangeRateController;
use App\Http\Controllers\API\OrderController;
use App\Http\Controllers\API\PriceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Orders
Route::post('orders', [OrderController::class, 'openOrder']);
Route::post('calculate-total-price', [PriceController::class, 'getPrice']);

// Exchagne Rates
Route::get('update-exchange-rates', [ExchangeRateController::class, 'updateRates']);
Route::get('exchange-rates', [ExchangeRateController::class, 'getRates']);