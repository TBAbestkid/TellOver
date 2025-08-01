<?php

// app/Http/Controllers/ProfileController.php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Post; // Correção na importação
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $posts = Post::all(); // Busca todos os posts no banco de dados
        return view('home', ['posts' => $posts]); // Retorna a view com a variável $posts
    }

    public function show($identificador)
    {
        $identificador = strtolower(str_replace(' ', '', $identificador));

        $user = User::whereRaw('LOWER(REPLACE(username, " ", "")) = ?', [$identificador])
            ->orWhereRaw('LOWER(REPLACE(name, " ", "")) = ?', [$identificador])
            ->firstOrFail();

        $isOwner = Auth::check() && Auth::id() === $user->id;

        $posts = $user->posts()->latest()->get();

        return view('profile', compact('user', 'posts', 'isOwner'));
    }
}
