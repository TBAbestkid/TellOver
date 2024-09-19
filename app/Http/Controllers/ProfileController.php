<?php

// app/Http/Controllers/ProfileController.php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Post; // Correção na importação
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
        // Passa o usuário autenticado e seus posts para a view
        $user = Auth::user();
        $posts = Post::where('user_id', $user->id)->get(); // Busca posts do usuário autenticado
        return view('profile', compact('user', 'posts'));
    }
}
