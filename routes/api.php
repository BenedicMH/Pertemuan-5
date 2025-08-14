<?php

use App\Http\Controllers\Api\AuthApiController;
use App\Http\Controllers\Api\BookApiController;
use App\Http\Controllers\Api\CategoryApiController;
use App\Http\Controllers\Api\UserApiController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Public authentication endpoints
Route::prefix('auth')->group(function () {
    Route::post('/login', [AuthApiController::class, 'login']);
    Route::post('/register', [AuthApiController::class, 'register']);
});

// Protected API routes
Route::middleware('auth:sanctum')->group(function () {
    
    // Authentication endpoints
    Route::prefix('auth')->group(function () {
        Route::post('/logout', [AuthApiController::class, 'logout']);
        Route::get('/user', [AuthApiController::class, 'user']);
    });
    
    // Books API - Full CRUD
    Route::apiResource('books', BookApiController::class);
    Route::get('/books/search/{query}', [BookApiController::class, 'search']);
    
    // Categories API - Full CRUD
    Route::apiResource('categories', CategoryApiController::class);
    
    // Users API - Admin only
    Route::middleware('simple.auth:admin')->group(function () {
        Route::apiResource('users', UserApiController::class);
        Route::patch('/users/{user}/role', [UserApiController::class, 'updateRole']);
    });
    
    // Dashboard/Statistics endpoints
    Route::get('/dashboard/stats', function () {
        return response()->json([
            'books_count' => \App\Models\Book::count(),
            'categories_count' => \App\Models\Category::count(),
            'users_count' => \App\Models\User::count(),
            'recent_books' => \App\Models\Book::with('category')->latest()->take(5)->get()
        ]);
    });
});

// Health check endpoint (public)
Route::get('/health', function () {
    return response()->json([
        'status' => 'OK',
        'message' => 'API is running',
        'timestamp' => now(),
        'version' => '1.0.0'
    ]);
});