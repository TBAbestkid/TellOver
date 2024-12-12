<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Equipamento extends Model
{
    use HasFactory;

    protected $fillable = ['personagem_id', 'item_id', 'local'];

    public function personagem()
    {
        return $this->belongsTo(Personagem::class);
    }

    public function itens()
    {
        return $this->belongsTo(Item::class);
    }
}
