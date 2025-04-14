<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MonsterController;
use App\Http\Controllers\MissionController;
use App\Http\Controllers\PersonagemController;
use App\Http\Controllers\DamageCalculatorController;
use App\Http\Controllers\WorldController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Response;

Route::get('/', function () {
    return view('home');
});

Auth::routes();

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

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
// Route::get('/search', [SearchController::class, 'search'])->name('search');

Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');

Route::middleware('auth')->group(function() {
    // Página de listagem de personagens
    Route::get('/personagem', [PersonagemController::class, 'index'])->name('personagem');

    // Página para criar um personagem
    Route::get('/personagens/criar', [PersonagemController::class, 'create'])->name('criarpersonagem');

    // Rota para o envio do formulário de criação de personagem
    Route::post('/criar-personagem', [PersonagemController::class, 'criarPersonagem'])->name('criarpersonagem.post');

    Route::get('/personagem/{personagem}/edit', [PersonagemController::class, 'edit'])->name('personagem.edit');

    Route::put('/personagem/{personagem}', [PersonagemController::class, 'update'])->name('personagem.update');

    Route::delete('/personagem/{personagem}', [PersonagemController::class, 'destroy'])->name('personagem.destroy');

    // Rota para exibir inventário do personagem
    Route::get('personagem/{personagem}/inventory', [PersonagemController::class, 'showInventory'])->name('personagem.inventory');

    // Rota para equipar um item
    Route::post('personagem/{personagem}/equip', [PersonagemController::class, 'equipItem'])->name('equipItem');

    // Rota para adicionar item ao inventário
    Route::post('personagem/{personagem}/add-item', [PersonagemController::class, 'addItemToInventory'])->name('addItemToInventory');
    // Rota para exibir a página de seleção de personagens (GET)
    Route::get('/personagem/selecionar', [PersonagemController::class, 'showCharacterSelection'])->name('personagem.selecao');

    // Rota para selecionar um personagem (POST)
    Route::post('/personagem/selecionar/{id}', [PersonagemController::class, 'select'])->name('personagem.select');

});

Route::middleware('auth')->group(function () {
    // Rota para a página de perfil
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
});

Route::get('/calculadora-dano', [DamageCalculatorController::class, 'index'])->name('calculadora.dano');

// Rotas para novas funcionalidades
Route::middleware('auth')->group(function () {
    // Rota para gerenciamento de narradores (somente admin)
    Route::get('/admin/gerenciar-role', [AdminController::class, 'manageRole'])->name('admin.gerenciar_role');

    // Rota para bestiário (gerenciamento de monstros/NPCs)
    Route::get('/bestiario', [MonsterController::class, 'index'])->name('bestiario.index');

    // Rota para exibir o formulário de criação de monstro/NPC
    Route::get('/bestiario/criar', [MonsterController::class, 'create'])->name('bestiario.create');

    // Rota para salvar o monstro/NPC
    Route::post('/bestiario', [MonsterController::class, 'store'])->name('bestiario.store');

    // Rota para editar um monstro/NPC
    Route::get('/bestiario/{monster}/editar', [MonsterController::class, 'edit'])->name('bestiario.edit');

    // Rota para atualizar um monstro/NPC
    Route::put('/bestiario/{monster}', [MonsterController::class, 'update'])->name('bestiario.update');

    // Rota para as missões
    Route::get('/gerencia-missoes', [MissionController::class, 'index'])->name('misson.index');

    Route::get('/missao/criar', [MissionController::class, 'criar'])->name('misson.create');

    // Alterar a rota para aceitar POST para a criação da missão
    Route::post('/missao', [MissionController::class, 'store'])->name('misson.store');

    Route::get('/calculadora-dano', [DamageCalculatorController::class, 'index'])->name('calculadora.dano');

    Route::get('/regras-rpg', [DamageCalculatorController::class, 'regras'])->name('calculadora.regras');

    // Rota para exibir a tela inicial (Title Screen)
    Route::get('/menuinicial', [WorldController::class, 'titleScreen'])->name('world.titlescreen');

    // Rota para seleção de mundo
    Route::get('/SolarSystem', [WorldController::class, 'sistemasolar'])->name('world.systemsun');

    // Rota para exibir a introdução do jogo
    Route::get('/introducao', [WorldController::class, 'introducao'])->name('world.introducao');

    // Rota para exibir todas as regiões
    Route::get('/world', [WorldController::class, 'index'])->name('world.index');

    // Rota para exibir detalhes de uma região
    Route::get('/world/region/{id}', [WorldController::class, 'show'])->name('world.region');

    // Rota para exibir detalhes do hospital da região
    Route::get('/world/region/{id}/hospital', [WorldController::class, 'hospital'])->name('world.hospital');

    Route::post('/hospital/{id}/comprar/{item_id}', [WorldController::class, 'buyPotion'])->name('hospital.comprar');

    // Rota para exibir detalhes da guilda da região
    Route::get('/world/region/{id}/guild', [WorldController::class, 'showGuild'])->name('world.guild');

    // Rota para exibir detalhes da loja da região
    Route::get('/world/region/{id}/store', [WorldController::class, 'store'])->name('world.store');

});

