<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Admin as Controller;


Route::prefix('admin-api')
    ->middleware('admin')
    ->group(function () {

        Route::post('auth/login', [Controller\Auth\LoginController::class, 'login']);

        Route::middleware([
            'admin.auth',
            'admin.permission',
        ])->group(function () {

            Route::get('user/roles', [Controller\UserController::class, 'getUserRoles']);

        });


    });
