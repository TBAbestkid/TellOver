<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    // Defina a tabela, caso seja diferente do padrão
    protected $table = 'itens';

    // Campos que podem ser preenchidos em massa
    protected $fillable = [
        'nome',
        'descricao',
    ];
}
