<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\Models\Monster;
use app\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categorias = Category::all();
        return view('bestiario.index', compact('categorias'));
    }

    // Criar nova categoria
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string',
        ]);

        Category::create($request->only('nome', 'descricao'));

        return redirect()->back()->with('success', 'Categoria criada com sucesso!');
    }

    // Atualizar categoria
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string',
        ]);

        $category->update($request->only('nome', 'descricao'));

        return redirect()->back()->with('success', 'Categoria atualizada com sucesso!');
    }

    // Excluir categoria
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->back()->with('success', 'Categoria excluída com sucesso!');
    }

}
