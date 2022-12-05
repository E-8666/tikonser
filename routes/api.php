<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TiketController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AuthController;

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
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('tiket',[TiketController::class,'index']);
Route::get('tiket/{id}',[TiketController::class,'show']);

Route::middleware('auth:sanctum')->group(function(){

    Route::post('tiket',[TiketController::class,'store'])->middleware('admin');
    Route::put('tiket/{id}',[TiketController::class,'update'])->middleware('admin');
    Route::delete('tiket/{id}',[TiketController::class,'destroy'])->middleware('admin');
    
    Route::get('order',[OrderController::class,'index'])->middleware('admin');
    Route::get('order/{id}',[OrderController::class,'byid']);
    Route::get('order/user/{id}',[OrderController::class,'byuser']);
    Route::put('order/{id}',[OrderController::class,'pay']);
    Route::put('order/reedem/{id}',[OrderController::class,'reedem'])->middleware('admin');
    Route::post('order',[OrderController::class,'order']);
    

    Route::post('/logout', [AuthController::class, 'logout']);
});