<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\AccidentLogController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', [UserController::class, 'login']);
Route::post('register', [UserController::class, 'register']);
Route::post('logout', [UserController::class, 'logout'])->middleware('auth:sanctum');

Route::get('logs', 'AccidentLogController@index');
Route::group(['prefix' => 'log', 'middleware' => 'auth:sanctum'], function () {
    Route::post('store', 'AccidentLogController@store');
    Route::get('edit/{id}', 'AccidentLogController@edit');
    Route::post('update/{id}', 'AccidentLogController@update');
    Route::delete('destroy/{id}', 'AccidentLogController@destroy');
});
