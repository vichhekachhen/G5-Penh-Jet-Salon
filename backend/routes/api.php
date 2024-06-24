<?php

use App\Http\Controllers\API\PostController;
use App\Http\Controllers\APi\Province\ProvinceController;
use App\Http\Controllers\APi\Service\ServiceController;
use App\Http\Controllers\API\Store\StoreController;
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
    // Route::get('/list', [ProvinceController::class, 'index']);
    Route::post('/create', [ProvinceController::class, 'store']);
    Route::put('/update', [ProvinceController::class, 'update']);
    Route::delete('/destroy', [ProvinceController::class, 'destroy']);

});
Route::get('province/list', [ProvinceController::class, 'index']);


Route::middleware('auth:sanctum')->prefix('service')->group(function (){
    Route::get('/list', [ServiceController::class, 'index']);
    Route::get('/show', [ServiceController::class, 'show']);
    Route::post('/create', [ServiceController::class, 'store']);
    Route::put('/update/{id}', [ServiceController::class, 'update']);
    Route::delete('/destroy', [ServiceController::class, 'destroy']);
});

Route::get('store/list', [StoreController::class, 'index']);
Route::get('store/StoreByProvince', [StoreController::class, 'StoreByProvince']);
