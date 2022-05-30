<?php

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('v1/trade', 'Api\TradeController@index');
Route::get('v1/count', 'Api\CoinBalanceController@count');
Route::get('v1/trades', 'Api\TradeController@index');

// READ BALANCE
Route::get('v1/balance/{wallet_id}', 'Api\CoinBalanceController@walletBalance');
