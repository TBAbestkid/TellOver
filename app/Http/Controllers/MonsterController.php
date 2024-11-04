<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MonsterController extends Controller
{
    public function index()
    {
        return view('bestiario.bestiario');
    }

}
