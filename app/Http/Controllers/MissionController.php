<?php

namespace App\Http\Controllers;

use App\Models\HistoricoMissao;
use Illuminate\Http\Request;

class MissionController extends Controller
{
    public function index()
    {
        // Busca todas as missões do banco de dados
        // $missoes = HistoricoMissao::all();

        // Retorna a view e passa os dados das missões para ela
        return view('misson.historico_missoes');
    }
    public function criarMission(){
        return view('misson.mission');
    }
}
