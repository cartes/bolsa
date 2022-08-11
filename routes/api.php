<?php

use App\Http\Controllers\AuthController;
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

Route::group([
    'middleware' => ['auth:sanctum'],
    'prefix' => 'admin'
], function () {
    Route::get('/users', function () {
        return User::all();
    });
});

Route::post('register', [AuthController::class, 'register']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
