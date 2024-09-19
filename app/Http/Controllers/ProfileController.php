<?php

// app/Http/Controllers/ProfileController.php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $posts = Post::all(); // ou qualquer lógica para buscar os posts
        return view('posts.index', compact('posts')); // Certifique-se de que a view correta está sendo chamada
    }

    public function show()
    {
        // Passa o usuário autenticado para a view
        $user = Auth::user();
        return view('profile', compact('user'));
    }
}
