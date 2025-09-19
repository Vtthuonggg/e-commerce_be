<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\ProductController;

// Routes không cần xác thực
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/forgot-password', [AuthController::class, 'forgotPassword']);
Route::post('/reset-password', [AuthController::class, 'resetPassword']);

// Routes cần xác thực
Route::middleware('auth:sanctum')->group(function () {
    // Auth routes
    Route::get('/user', [AuthController::class, 'me']); // Sử dụng method me() trong AuthController
    Route::get('/user-list', [UserController::class, 'index']);
    Route::put('/user/update', [UserController::class, 'update']);

    // Image upload
    Route::post('/upload-image', [ImageController::class, 'upload']);

   Route::prefix('product')->group(function () {
 Route::get('/', [ProductController::class, 'index']);                    
        Route::post('/', [ProductController::class, 'store']);                
        Route::get('/{id}', [ProductController::class, 'show']);                 
        Route::put('/{id}', [ProductController::class, 'update']);               
        Route::delete('/{id}', [ProductController::class, 'destroy']);           
      
        Route::get('/ingredients', [ProductController::class, 'getIngredients']);
        Route::get('/sellable-products', [ProductController::class, 'getSellableProducts']);
        Route::post('/{product}/recipe', [ProductController::class, 'addRecipe']);
    });
});
