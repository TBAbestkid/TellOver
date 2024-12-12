<?php

namespace App\Http\Controllers;

use App\Models\Guild;
use App\Models\Region;
use App\Models\Item;
use App\Models\Inventario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WorldController extends Controller
{
    // Método para exibir a página inicial ou uma visão de todas as regiões
    public function index()
    {
        // Recupera todas as regiões do banco de dados
        $regions = Region::all();

        return view('world.index', compact('regions'));
    }

    // Método para exibir detalhes de uma região
    public function show($id)
    {
        // Busca a região pelo ID no banco de dados
        $region = Region::findOrFail($id);

        // Define os mapas de cada região
        $maps = [
            'Gzat' => 'https://cdn.discordapp.com/attachments/1074190813308923935/1135580666382266398/Gzat_1.jpg',
            'Holdald' => 'https://cdn.discordapp.com/attachments/1074190813308923935/1135580711651377152/Holdald.jpg',
            'Whidifrohente' => 'https://cdn.discordapp.com/attachments/1074190813308923935/1135580782736457848/Whidifrohente.jpg',
            'Yagozashi' => 'https://cdn.discordapp.com/attachments/1074190813308923935/1135603152738066442/Yagozashi_1.jpg',
        ];

        // Adiciona o mapa correspondente à região, se existir
        $region->map = $maps[$region->name] ?? null;

        return view('world.region', compact('region'));
    }

    // Método para exibir detalhes de uma guilda
    public function showGuild($id)
    {
        // Busca a guilda pelo ID no banco de dados
        $guild = Guild::with('region')->findOrFail($id);

        // Define as imagens das guildas
        $images = [
            'Gzat' => 'https://media.discordapp.net/attachments/1077083472079892561/1077949051015807026/62e3f4a26751c0c5cf4d78c37f470d83.jpg',
            'Holdald' => 'https://media.discordapp.net/attachments/1077083783569883269/1077951090106056784/87b801f9b455b6c980b765a709625c2f.jpg',
            'Whidifrohente' => 'https://cdn.discordapp.com/attachments/1077084088323813456/1077953195181084742/fd5fdead5d642f3cb5b90221d356c6de.jpg',
            'Yagozashi' => 'https://cdn.discordapp.com/attachments/1077084561420333066/1077959428969611304/eea2ae7cee3f2893f044b56ac6b7efdc.jpg',
        ];

        // Adiciona a imagem correspondente à guilda, se existir
        $guild->image = $images[$guild->region->name] ?? null;

        return view('world.guild', compact('guild'));
    }

    // Método para exibir detalhes do hospital da região
    public function hospital($id)
    {
        // Busca a região pelo ID no banco de dados
        $region = Region::findOrFail($id);

        // Aqui você pode adicionar lógica adicional sobre o hospital, se necessário
        return view('world.hospital', compact('region'));
    }

    // public function buyPotion($id, $item_id)
    // {
    //     // Recupera a região
    //     $region = Region::findOrFail($id);

    //     // Preços das poções diretamente na função
    //     $precos = [
    //         1 => 870,  // Poção Leve
    //         2 => 1200, // Poção Média
    //         3 => 2400  // Poção Forte
    //     ];

    //     // Verifica se o item_id é válido
    //     if (!array_key_exists($item_id, $precos)) {
    //         return back()->with('erro', 'Poção não encontrada.');
    //     }

    //     // Recupera o preço da poção
    //     $preco = $precos[$item_id];

    //     // Verifica se o usuário está autenticado
    //     $usuario = Auth::user();

    //     // Verifica se o personagem foi selecionado
    //     $personagem = $usuario->personagens->find(request('personagem_id')); // Assumindo que o personagem é selecionado no formulário
    //     if (!$personagem) {
    //         return back()->with('erro', 'Personagem não encontrado.');
    //     }

    //     // Verifica se o usuário tem tabs suficientes para comprar a poção
    //     if ($usuario->tabs < $preco) {
    //         return back()->with('erro', 'Você não tem tabs suficientes para comprar esta poção.');
    //     }

    //     // Reduz os tabs do usuário
    //     $usuario->tabs -= $preco;
    //     $usuario->save();

    //     // Verifica se o item existe na tabela 'itens'
    //     $item = Item::find($item_id);
    //     if (!$item) {
    //         return back()->with('erro', 'Item não encontrado.');
    //     }

    //     // Adiciona o item ao inventário do personagem
    //     $inventario = new Inventario();
    //     $inventario->personagem_id = $personagem->id; // Usando o personagem selecionado
    //     $inventario->item_id = $item_id; // Armazena o ID do item
    //     $inventario->save();

    //     return back()->with('sucesso', 'Poção comprada com sucesso!');
    // }

    // Método para exibir detalhes da loja da região
    public function store($id)
    {
        $region = Region::findOrFail($id);

        return view('world.store', compact('region'));
    }
}
