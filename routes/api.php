<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*

    Route::get('/user', function (Request $request) {
        return $request->user();
    })->middleware('auth:sanctum');

*/

Route::group([
    'prefix' => 'v1',
], function () {

    Route::post('/auth/login', [\App\Http\Controllers\Api\V1\AuthController::class, 'login']);


    Route::get('test', function (Request $request) {
        return \Illuminate\Support\Facades\Hash::make('123456');
    });


});




Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('jwt');
