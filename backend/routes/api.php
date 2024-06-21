<?php

use App\Http\Controllers\API\PostController;
use App\Http\Controllers\APi\Province\ProvinceController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::post('/register', [AuthController::class, 'register']);
Route::post('/registerOwner', [AuthController::class, 'registerOner'])->name('register.owner');
Route::get('/me', [AuthController::class, 'index'])->middleware('auth:sanctum');
Route::get('/post/list', [PostController::class, 'index'])->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->prefix('province')->group(function (){
    Route::post('/list', [ProvinceController::class, 'index']);
    Route::post('/create', [ProvinceController::class, 'store']);
    Route::post('/update', [ProvinceController::class, 'update']);
    Route::post('/destroy', [ProvinceController::class, 'destroy']);

});