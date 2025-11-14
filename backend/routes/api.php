<?php

use App\Http\Middleware\CorsMiddleware;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::middleware([CorsMiddleware::class])->group(function () {
    Route::get('/test', function () {
        return ['message' => 'CORS works!'];
    });

});
Route::post('/verify-email',[AuthController::class,'verifyEmail']);
Route::post('register',[AuthController::class,'register']);
Route::post('login',[AuthController::class,'login']);
Route::post('logout',[AuthController::class,'logout'])->middleware('auth:sanctum');
Route::post('forget-password',[AuthController::class,'forgetPassword']);
Route::post('reset-password',[AuthController::class,'resetPassword']);

