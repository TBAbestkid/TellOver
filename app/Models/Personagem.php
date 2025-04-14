<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Personagem extends Model
{
    use HasFactory;

    protected $table = 'personagens';

    protected $fillable = [
        'user_id', 'nome', 'idade', 'altura', 'tipo_monstro', 'genero',
        'sexualidade', 'personalidade', 'origem', 'lugar', 'faz_parte_de',
        'relacao_personagens', 'gosta', 'nao_gosta', 'habilidades', 'historia',
        'imagem', 'hp', 'resistencia', 'armadura', 'hp_mecanico', 'forca',
        'velocidade', 'mira', 'armadura_atributo', 'resistencia_atributo',
        'percepcao', 'regeneracao', 'vampirismo', 'multi_ataque',
        'teleporte_curto', 'teleporte_global', 'nivel'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function level()
    {
        return $this->hasOne(Level::class, 'personagem_id');
    }
    public function itens()
    {
        return $this->belongsToMany(Item::class, 'inventarios', 'personagem_id', 'item_id');
    }

    public function equipamentos()
    {
        return $this->belongsToMany(Item::class, 'equipamentos', 'personagem_id', 'item_id');
    }

    public function inventario()
    {
        return $this->hasMany(Inventario::class);
    }

}
