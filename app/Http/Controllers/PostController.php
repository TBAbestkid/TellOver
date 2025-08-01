<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StorePostRequest;
use Illuminate\Support\Facades\Log;

class PostController extends Controller
{
    public function index()
    {
        // Recupera todos os posts mais recentes
        $posts = Post::latest()->get();

        //dd($posts); // Debugging: para ver se os posts estão sendo recuperados

        // Retorna a view 'home' com a variável $posts
        return view('home', compact('posts'));
    }

    public function show(Post $post, $username)
    {
        // Verifica se o username da URL bate com o autor do post
        if ($post->user->name !== $username) {
            abort(404);
        }

        if (strtolower($post->user->name) !== strtolower($username)) {
            abort(404);
        }

        return view('post', ['post' => $post,]);
    }

    // Armazena um novo post
    public function store(StorePostRequest $request)
    {
        try{
            $user = Auth::user();
            if (!$user) {
                return response()->json(['error' => 'Usuário não autenticado.'], 401);
            }
            $post = new Post();
            $post->user_id = $user->id;
            $post->body = $request->body;
            $post->visibility = $request->visibility;
            $post->allow_comments = $request->boolean('allow_comments', true); // true default

            $post->save();

            $paths = [];
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $paths[] = $image->store('posts', 'public');
                }
                $post->image_path = json_encode($paths);
                $post->save();
            }
            $post->load('user');

            return response()->json([
                'message' => 'Post criado com sucesso.',
                'html' => view('partials.post', compact('post'))->render()
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao criar post.'], 500);
        }
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
