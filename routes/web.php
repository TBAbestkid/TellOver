<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\HomeController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Rota para a página inicial (posts)
Route::get('/home', [PostController::class, 'index'])->name('home');

// Rota para armazenar posts
Route::post('/posts', [PostController::class, 'store'])->middleware('auth');

// Recursos para edição, atualização e exclusão de posts
Route::resource('posts', PostController::class)->except(['index']);

// Rota principal para exibir posts na home
Route::get('/home', [PostController::class, 'index'])->name('home');
