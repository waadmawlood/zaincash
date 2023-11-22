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

Route::middleware('guest')->prefix('payment')->as('payment.')->group(function () {
    Route::post('create/request/transaction', 'PaymentController@initialTransaction');
    Route::get('check/transaction/{id}', 'PaymentController@checkTransaction');
    Route::post('proccessing/transaction/{id}', 'PaymentController@processingTransaction');
    Route::post('pay/transaction/{id}', 'PaymentController@payTransaction');
    Route::post('cancel/transaction/{id}', 'PaymentController@cancelTransaction');
});
