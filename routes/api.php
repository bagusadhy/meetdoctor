<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AuthenticationController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/v1/users', [UserController::class, 'index'])->middleware('auth:sanctum');
Route::get('/v1/users/{id}', [UserController::class, 'show'])->middleware('auth:sanctum');
Route::post('/v1/login', [AuthenticationController::class, 'login']);
Route::get('/v1/logout', [AuthenticationController::class, 'logout'])->middleware('auth:sanctum');
