<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoricoMissao extends Model
{
    use HasFactory;

    // Define a tabela associada ao modelo
    protected $table = 'historico_missao';

    // Permitir atribuição em massa para os campos especificados
    protected $fillable = [
        'tipo_missao',
        'nome_players',
        'quantidade_players',
        'descricao_missao',
    ];
}
