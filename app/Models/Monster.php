<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Monster extends Model
{
    use HasFactory;

    // Campos permitidos
    protected $fillable = [
        'narrador_id', 'categoria_id', 'nome', 'nivel', 'idade', 'personalidade',
        'altura', 'tipo', 'local_vive', 'comportamento', 'gosta', 'nao_gosta',
        'habilidades', 'hp', 'determinacao', 'armadura_global', 'armadura_fisica',
        'armadura_elemental', 'armadura_magica', 'resistencia','forca', 'precisao',
        'velocidade', 'drops', 'is_npc', 'imagem',
    ];

    // Relacionamento com categorias
    public function category()
    {
        return $this->belongsTo(Category::class, 'categoria_id');
    }

    public function narrador()
    {
        return $this->belongsTo(User::class, 'narrador_id');
    }

}
