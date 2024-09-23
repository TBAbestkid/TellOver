<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MonsterController extends Controller
{
    public function index()
    {
        $monstros = Monstro::all(); // Busca todos os monstros do banco de dados
        return view('bestiario.index', compact('monstros'));
    }

}
