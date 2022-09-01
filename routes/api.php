<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Response;

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

/** Private routes */
Route::group([
    'middleware' => ['auth:sanctum'],
], function () {
    Route::get('/users', [UserController::class, 'index']);
    Route::post('logout', [AuthController::class, 'logout']);
});

/** Public routes */
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

