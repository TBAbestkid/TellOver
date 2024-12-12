<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventario extends Model
{
    // Defina a tabela, caso seja diferente do padrão
    protected $table = 'inventarios';

    // Defina os campos que podem ser preenchidos em massa
    protected $fillable = [
        'personagem_id',
        'item_id',
    ];

    // Relacionamento com Personagem
    public function personagem()
    {
        return $this->belongsTo(Personagem::class); // No singular
    }

    // Relacionamento com Item
    public function item()
    {
        return $this->belongsTo(Item::class); // No singular
    }
}
