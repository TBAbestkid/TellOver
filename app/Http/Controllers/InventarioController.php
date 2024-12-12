<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventario;
use App\Models\Item;
use App\Models\Region;
use App\Models\User;
use App\Models\Personagem;
use Illuminate\Support\Facades\Auth;

class InventarioController extends Controller
{
    // Exibe o inventário do personagem
    public function show($personagemId)
    {
        $personagem = Personagem::findOrFail($personagemId);
        $inventario = $personagem->itens()->get();

        return view('personagem.index', compact('personagem', 'inventario'));
    }

    // Adiciona um item ao inventário
    public function add(Request $request, $personagemId)
    {
        $personagem = Personagem::findOrFail($personagemId);
        $item = Item::findOrFail($request->input('item_id'));

        // Adiciona o item ao inventário
        Inventario::create([
            'personagem_id' => $personagemId,
            'item_id' => $item->id,
        ]);

        return redirect()->route('inventario.show', ['personagemId' => $personagemId])
                         ->with('success', 'Item adicionado ao inventário!');
    }

    public function buyPotion($region_id, $item_id)
{
    // Recupera a região onde a compra está sendo feita
    $region = Region::findOrFail($region_id);

    // Recupera o item (poção) baseado no ID
    $item = Item::findOrFail($item_id);
    $preco = $item->preco;  // Preço do item vindo diretamente do banco de dados

    // Verifica se o usuário está autenticado
    $usuario = Auth::user();

    // Verifica se o usuário tem tabs suficientes para comprar a poção
    if ($usuario->tabs < $preco) {
        return back()->with('erro', 'Você não tem tabs suficientes para comprar esta poção.');
    }

    // Reduz os tabs do usuário
    $usuario->tabs -= $preco;
    $usuario->save();

    // Recupera o personagem do usuário
    $personagem = session('personagem_selecionado');

    if (!$personagem) {
        return back()->with('erro', 'Nenhum personagem selecionado.');
    }

    // Adiciona a poção ao inventário do personagem
    Inventario::create([
        'personagem_id' => $personagem->id,  // Relaciona o item ao personagem
        'item_id' => $item->id,
    ]);

    return back()->with('sucesso', 'Poção comprada e adicionada ao inventário!');
}


    // Remove um item do inventário
    public function remove(Request $request, $personagemId)
    {
        $personagem = Personagem::findOrFail($personagemId);
        $itemId = $request->input('item_id');

        // Remove o item do inventário
        Inventario::where('personagem_id', $personagemId)
                  ->where('item_id', $itemId)
                  ->delete();

        return redirect()->route('inventario.show', ['personagemId' => $personagemId])
                         ->with('success', 'Item removido do inventário!');
    }

    // Transfere um item para os equipamentos
    public function equip(Request $request, $personagemId)
    {
        $personagem = Personagem::findOrFail($personagemId);
        $itemId = $request->input('item_id');
        $local = $request->input('local'); // Ex: "cabeça", "mãos"

        $item = Item::findOrFail($itemId);

        if ($item->nivel_necessario <= $personagem->nivel) {
            // Atualiza ou cria o equipamento
            $personagem->equipamentos()->updateOrCreate(
                ['local' => $local],
                ['item_id' => $itemId]
            );

            // Remove do inventário
            Inventario::where('personagem_id', $personagemId)
                      ->where('item_id', $itemId)
                      ->delete();

            return redirect()->route('inventario.show', ['personagemId' => $personagemId])
                             ->with('success', 'Item equipado com sucesso!');
        }

        return redirect()->route('inventario.show', ['personagemId' => $personagemId])
                         ->with('error', 'Você não tem nível suficiente para equipar este item.');
    }
}
