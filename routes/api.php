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

Route::post('auth', 'AuthenticationController@auth');

Route::get('formato', function () {
    return response()->download('./../files/formato.xlsx');
});

Route::apiResource('fichas', 'CardController');
Route::apiResource('user', 'UserController');
Route::apiResource('asistencia', 'AssistenceController');
Route::put('confirmar', 'AssistenceController@config');
Route::get('inasistencia', 'AssistenceController@inasistencia');
