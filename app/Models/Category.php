<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Monster;

class Category extends Model
{
    use HasFactory;

    // Campos que podem ser preenchidos em massa
    protected $fillable = ['nome', 'descricao'];

    // Relacionamento com monstros
    public function monsters()
    {
        return $this->hasMany(Monster::class, 'categoria_id');
    }

}
