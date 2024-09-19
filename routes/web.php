<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\ProfileController;


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

// Página de configurações de conta
Route::get('/account/settings', [AccountController::class, 'settings'])->name('account.settings');

// Atualização das configurações de conta
Route::put('/account/update', [AccountController::class, 'update'])->name('account.update');

// para as futuras pesquisas nér
Route::get('/search', [SearchController::class, 'search'])->name('search');

Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');

Route::middleware('auth')->group(function () {
    // Rota para a página de perfil
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
});

// Rotas para novas funcionalidades
Route::middleware('auth')->group(function () {
    // Rota para gerenciamento de narradores (somente admin)
    Route::get('/admin/gerenciar-role', [AdminController::class, 'manageRole'])->name('admin.gerenciar_role');

    // Rota para bestiário (gerenciamento de monstros/NPCs)
    Route::get('/bestiario', [MonsterController::class, 'index'])->name('gerenciar.bestiario');


    // Rota para histórico de missões
    Route::get('/historico-missoes', [MissionController::class, 'history'])->name('historico.missoes');

    // Rota para calculadora de dano
    Route::get('/calculadora-dano', [DamageCalculatorController::class, 'index'])->name('calculadora.dano');
});