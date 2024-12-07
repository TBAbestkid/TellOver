<?php

namespace App\Http\Controllers;

use App\Models\Mission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MissionController extends Controller
{
    public function index()
    {
        $missoes = Mission::all();
        return view('misson.index', compact('missoes'));
    }

    public function criar()
    {
        // dd('Função chamada');
        return view('misson.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tipo' => 'required|string|in:missao,evento,guerra,dungeon',
            'nivel' => 'required|integer|min:0',
            'quantidade_jogadores' => 'required|integer|min:1',
            'descricao' => 'required|string|max:500',
        ]);

        Mission::create([
            'title' => ucfirst($request->tipo),
            'description' => $request->descricao,
            'status' => 'pending',
            'narrator_id' => Auth::id(),
            'nivel' => $request->nivel,
            'quantidade_jogadores' => $request->quantidade_jogadores,
        ]);

        return redirect()->route('missions.index')->with('success', 'Missão criada com sucesso!');
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
