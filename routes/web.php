<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Route;

Route::get('/', [BookController::class, 'index'])->name('home')->middleware('simple.auth');;
Route::post('/book/add', [BookController::class, 'create'])->name('create')->middleware('simple.auth');
Route::get('/book', [BookController::class, 'show'])->name('show')->middleware('simple.auth:admin');;
Route::get('/book/{id}', [BookController::class, 'edit'])->name('edit')->middleware('simple.auth');;
Route::patch('/book/{id}', [BookController::class, 'update'])->name('update')->middleware('simple.auth');;
Route::delete('/book/{id}', [BookController::class, 'destroy'])->name('delete')->middleware('simple.auth');;

//Login
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);


//register
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
