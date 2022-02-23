<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\EmployeeJobController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserJobController;

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

Route::middleware(['api'])->group(function () {
    Route::post('/jobs', [JobController::class, 'store']);

    Route::prefix('employees')->group(function () {
        Route::post('/', [EmployeeController::class, 'store']);
        Route::put('/{employee}', [EmployeeController::class, 'update']);
        Route::post('/{employee}/jobs', [EmployeeJobController::class, 'store']);
    });

    Route::prefix('users')->group(function () {
        Route::get('/{user}/jobs', [UserJobController::class, 'index']);
        Route::get('/{user}', [UserController::class, 'show']);
    });

    Route::prefix('auth')->controller(AuthController::class)->group(function () {
            Route::post('login', 'login');
            Route::post('logout', 'logout');
            Route::post('refresh', 'refresh');
            Route::get('me', 'me');
    });
});

