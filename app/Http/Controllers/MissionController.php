<?php

namespace App\Http\Controllers;

use App\Models\Mission;
use Illuminate\Http\Request;
use App\Models\Monster;
use App\Models\Guild;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class MissionController extends Controller
{
    public function index()
    {
        $missoes = Mission::all();
        return view('misson.index', compact('missoes'));
    }

    public function criar()
    {
        $guilds = Guild::all();
        $monstros = Monster::where('is_npc', 0)->get();
        return view('misson.create', compact('monstros', 'guilds'));
    }

    public function store(Request $request)
    {
        // Log dos dados recebidos
        Log::info('Dados recebidos para criação de missão:', $request->all());

        // Validação dos campos
        $request->validate([
            'tipo' => 'required|string|in:missao,evento,guerra,dungeon', // O tipo é customizado
            'nivel' => 'required|integer|min:0', // O nível da missão
            'guilds_id' => 'required|exists:guilds,id', // Deve existir na tabela 'guilds'
            'quantidade_jogadores' => 'required|integer|min:1', // Quantidade mínima de jogadores
            'descricao' => 'required|string|max:500', // Descrição da missão
        ]);

        // Inserção na tabela 'missions'
        Mission::create([
            'title' => ucfirst($request->tipo), // 'tipo' armazenado como título
            'description' => $request->descricao, // Descrição do campo
            'guilds_id' => $request->guilds_id, // ID da guilda
            'status' => 'pending', // Status inicial
            'narrator_id' => Auth::id(), // Narrador é o usuário autenticado
            'level' => $request->nivel, // Nível da missão
            'player_count' => $request->quantidade_jogadores, // Número de jogadores
        ]);

        // Redirecionar com mensagem de sucesso
        return redirect()->route('misson.index')->with('success', 'Missão criada com sucesso!');
    }

    public function edit(Mission $mission)
    {
        return view('missions.edit', compact('mission'));
    }

    public function update(Request $request, Mission $mission)
    {
        $request->validate([
            'tipo' => 'required|string|in:missao,evento,guerra,dungeon',
            'nivel' => 'required|integer|min:0',
            'quantidade_jogadores' => 'required|integer|min:1',
            'descricao' => 'required|string|max:500',
        ]);

        $mission->update([
            'title' => ucfirst($request->tipo),
            'description' => $request->descricao,
            'nivel' => $request->nivel,
            'quantidade_jogadores' => $request->quantidade_jogadores,
        ]);

        return redirect()->route('missions.index')->with('success', 'Missão atualizada com sucesso!');
    }

    public function destroy(Mission $mission)
    {
        $mission->delete();
        return redirect()->route('missions.index')->with('success', 'Missão excluída com sucesso!');
    }
}
