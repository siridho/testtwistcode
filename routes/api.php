<?php

use Illuminate\Http\Request;

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


Route::post('register', 'UserController@register');
Route::post('login', 'UserController@login');
Route::post('store', 'ProductController@store');

Route::middleware('jwt.auth')->any('users', function(Request $request) {
    return auth()->user();
});

Route::middleware('jwt.auth')->get('product', "ProductController@index");