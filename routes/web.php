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

Route::get('/', function() {
   return 'Welcome to payment system';
});

Route::post('/init', 'Api\V1\PaymentController@init');
Route::post('/pay', 'Api\V1\PaymentController@pay');//->middleware('apisession');
