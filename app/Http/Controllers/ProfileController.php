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

    public function show()
    {
        $user = User::with(['followers', 'following', 'posts'])->find(Auth::id());

        $posts = $user->posts()->latest()->get();

        return view('profile', compact('user', 'posts'));
    }

}
