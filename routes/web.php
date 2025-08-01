<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\NotificationController;
use Illuminate\Support\Facades\Mail;

Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google.login');
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);

Route::get('/teste-email', function () {
    $user = Auth::user();

    if (!$user) {
        return 'Usuário não autenticado.';
    }

    Mail::raw('Teste de email via Mailtrap', function ($message) use ($user) {
        $message->to($user->email)
                ->subject('Email de teste');
    });

    return 'Email enviado para ' . $user->email;
});

Auth::routes();

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Rota para a página inicial (posts)
Route::redirect('/', '/home');
Route::get('/home', [PostController::class, 'index'])->name('home');

// Notificações
Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
Route::post('/notifications/{id}/read', [NotificationController::class, 'markAsRead'])->name('notifications.markAsRead');
Route::post('/notifications/read-all', [NotificationController::class, 'markAllAsRead'])->name('notifications.markAllAsRead');

Route::get('/sobre', [HomeController::class, 'about'])->name('about');

// Rota para armazenar posts
Route::post('/posts', [PostController::class, 'store'])->middleware(['auth', 'validate.post']);
Route::resource('posts', PostController::class)->except(['index']);
Route::get('/post/{post}/{username}', [PostController::class, 'show'])->name('post');

// Perfil público por username
Route::get('/perfil/{identificador}', [ProfileController::class, 'show'])->name('profile.show');

// Página de configurações de conta
Route::get('/account/settings', [AccountController::class, 'settings'])->name('account.settings');

// Atualização das configurações de conta
Route::put('/account/update', [AccountController::class, 'update'])->name('account.update');

// para as futuras pesquisas nér
// Route::get('/search', [SearchController::class, 'search'])->name('search');

Route::get('/u/{username}', [ProfileController::class, 'showByUsername'])->name('profile.showByUsername');

Route::post('/follow/{id}', [ProfileController::class, 'toggleFollow'])->name('profile.toggleFollow');

Route::post('/profile/bio', [ProfileController::class, 'updateBio'])->name('profile.updateBio');
