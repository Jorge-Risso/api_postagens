<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\PostController;

Route::prefix('v1')->group(function () {
    Route::post('/register', [AuthController::class,'register']);
    Route::post('/login', [AuthController::class,'login']);

    Route::get('/posts', [PostController::class,'index']);
    Route::get('/posts/{id}', [PostController::class,'show']);

    Route::middleware('auth:api')->group(function () {
        Route::get('/profile', [AuthController::class,'profile']);
        Route::post('/logout', [AuthController::class,'logout']);

        Route::post('/posts', [PostController::class,'store']);
        Route::put('/posts/{id}', [PostController::class,'update']);
        Route::delete('/posts/{id}', [PostController::class,'destroy']);
    });
});
