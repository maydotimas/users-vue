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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::middleware('auth:api')->get('/users', 'Api\UserController@get_user_list')->name('users.list');
Route::middleware('auth:api')->post('/users', 'Api\UserController@store')->name('users.store');
Route::middleware('auth:api')->put('/users/{id}/update', 'Api\UserController@edit')->name('users.update');
Route::middleware('auth:api')->delete('/users/{id}/delete', 'Api\UserController@delete')->name('users.delete');
