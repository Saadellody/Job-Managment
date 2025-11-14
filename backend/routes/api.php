<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
use App\Http\Middleware\CorsMiddleware;

Route::middleware([CorsMiddleware::class])->group(function () {
    Route::get('/test', function () {
        return ['message' => 'CORS works!'];
    });

    // other routes you want CORS enabled
});

