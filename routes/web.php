<?php

use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Route;

Route::get('/', [BookController::class, 'index'])->name('home');
Route::post('/book/add', [BookController::class, 'create'])->name('create');
Route::get('/book', [BookController::class, 'show'])->name('show');
Route::get('/book/{id}', [BookController::class, 'edit'])->name('edit');
Route::patch('/book/{id}', [BookController::class, 'update'])->name('update');
Route::delete('/book/{id}', [BookController::class, 'destroy'])->name('delete');
