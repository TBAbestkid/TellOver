<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DamageCalculatorController extends Controller
{
    public function index()
    {
        return view('calculadora.dano'); 
    }
}
