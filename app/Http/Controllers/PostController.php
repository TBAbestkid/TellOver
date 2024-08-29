<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Importar o facade Auth para verificar o usuário autenticado

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->get(); // Pega os posts mais recentes
        return view('home', compact('posts'));
    }
    
    
    // Armazena um novo post
    public function store(Request $request)
    {
        // Valida os dados do formulário
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        // Cria um novo post associado ao usuário autenticado
        Post::create([
            'title' => $request->title,
            'body' => $request->body,
            'user_id' => auth()->id(), // Associa o post ao usuário autenticado
        ]);

        // Redireciona para a página inicial com uma mensagem de sucesso
        return redirect()->route('home')->with('status', 'Post criado com sucesso!');
    }

    // Exibe o formulário de edição para um post específico
    public function edit(Post $post)
    {
        // Verifica se o usuário autenticado é o proprietário do post
        if (Auth::id() !== $post->user_id) {
            abort(403); // Se não for o proprietário, retorna um erro 403 (Proibido)
        }
        
        // Retorna a view de edição com o post
        return view('posts.edit', compact('post'));
    }

    // Atualiza um post específico
    public function update(Request $request, Post $post)
    {
        // Verifica se o usuário autenticado é o proprietário do post
        if (Auth::id() !== $post->user_id) {
            abort(403); // Se não for o proprietário, retorna um erro 403 (Proibido)
        }

        // Valida os dados do formulário
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        // Atualiza o post com os dados do formulário
        $post->update($request->only('title', 'body'));

        // Redireciona para a página inicial com uma mensagem de sucesso
        return redirect()->route('home')->with('status', 'Post atualizado com sucesso.');
    }

    // Remove um post específico
    public function destroy(Post $post)
    {
        // Verifica se o usuário autenticado é o proprietário do post
        if (Auth::id() !== $post->user_id) {
            abort(403); // Se não for o proprietário, retorna um erro 403 (Proibido)
        }

        // Deleta o post
        $post->delete();

        // Redireciona para a página inicial com uma mensagem de sucesso
        return redirect()->route('home')->with('status', 'Post deletado com sucesso!');
    }
}
