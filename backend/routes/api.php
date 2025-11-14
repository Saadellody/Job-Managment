<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
use App\Http\Middleware\CorsMiddleware;
use App\Http\Controllers\AuthController;

Route::middleware([CorsMiddleware::class])->group(function () {
    Route::get('/test', function () {
        return ['message' => 'CORS works!'];
    });

});
Route::post('/verify-email',[AuthController::class,'verifyEmail']);

