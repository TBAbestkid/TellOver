<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    use HasFactory;

    // Definindo a tabela associada ao modelo, caso o nome não siga a convenção
    protected $table = 'regions';

    // Especificando os campos que são atribuíveis em massa
    protected $fillable = ['name', 'description'];

    public function guilds()
    {
        return $this->hasMany(Guild::class);
    }

}
