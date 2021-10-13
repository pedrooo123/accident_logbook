<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::middleware('auth:api')->get('user', function (Request $request) {
//     return $request->user();
// });

Route::get('logs', 'AccidentLogController@index');
Route::group(['prefix' => 'log'], function () {
    Route::post('store', 'AccidentLogController@store');
    Route::get('edit/{id}', 'AccidentLogController@edit');
    Route::post('update/{id}', 'AccidentLogController@update');
    Route::delete('destroy/{id}', 'AccidentLogController@destroy');
});
