<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Monster;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class MonsterController extends Controller
{
    public function index()
    {
        // Carregar monstros e NPCs
        $monstros = Monster::where('is_npc', 0)->get();
        $npcs = Monster::where('is_npc', 1)->get();

        return view('bestiario.index', compact('monstros', 'npcs'));
    }

    public function create()
    {
        $categorias = Category::all();
        return view('bestiario.create', compact('categorias')); // Retorne a view create.blade.php
    }


    public function store(Request $request)
    {
        // Verificar se o usuário está autenticado
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Você precisa estar logado para adicionar um monstro!');
        }

        // Adicionar narrador_id, que é o ID do usuário autenticado
        $request['narrador_id'] = Auth::id();

        // Validação
        $request->validate([
            'nome' => 'required|string|max:255',
            'nivel' => 'required|integer',
            'is_npc' => 'required|boolean',
            'imagem' => 'nullable|image|max:2048', // Validação da imagem
        ]);

        // Se o campo categoria_id não for passado, defina como 0
        if (!$request->has('categoria_id')) {
            $request->merge(['categoria_id' => 0]); // Se não houver categoria, insere 0 como nulo
        }

        // Verifica se a imagem foi enviada e a armazena
        if ($request->hasFile('imagem')) {
            // Armazena a nova imagem
            $imagePath = $request->file('imagem')->store('public/imagens');
            $request->merge(['imagem' => $imagePath]); // Adiciona o caminho da nova imagem ao request
        }

        // Criar o monstro com os dados validados
        Monster::create($request->all());

        // Defina a mensagem de sucesso conforme o tipo
        $mensagem = $request->is_npc ? 'NPC adicionado com sucesso!' : 'Monstro adicionado com sucesso!';

        return redirect()->route('bestiario.index')->with('success', $mensagem);
    }

    public function edit($id)
    {
        $monstro = Monster::findOrFail($id); // Recupera o monstro com o id fornecido
        $categorias = Category::all(); // Recupera todas as categorias, se necessário

        return view('bestiario.edit', compact('monstro', 'categorias')); // Passa o monstro para a view
    }


    public function update(Request $request, Monster $monster)
    {
        // Validar os dados do formulário
        $request->validate([
            'nome' => 'required|string|max:255',
            'nivel' => 'required|integer',
            'is_npc' => 'required|boolean',
            'imagem' => 'nullable|image|max:2048',
        ]);

        // Atualiza os dados do monstro
        $monster->update($request->all());

        // Verifica se a imagem foi enviada e a armazena
        if ($request->hasFile('imagem')) {
            // Se já houver uma imagem antiga, exclua
            if ($monster->imagem) {
                Storage::delete($monster->imagem); // Deleta a imagem antiga
            }

            // Armazena a nova imagem
            $imagePath = $request->file('imagem')->store('public/imagens');
            $monster->imagem = $imagePath;
        }

        // Salvar e redirecionar
        $monster->save();

        return redirect()->route('bestiario.index')->with('success', 'Monstro/NPC atualizado com sucesso!');
    }


    public function destroy(Monster $monster)
    {
        $mensagem = $monster->is_npc ? 'NPC removido com sucesso!' : 'Monstro removido com sucesso!';

        $monster->delete();

        return redirect()->back()->with('success', $mensagem);
    }
}

