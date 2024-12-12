<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mission extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'status',
        'type',
        'level',
        'player_count',
        'narrator_id',
    ];

    /**
     * Relacionamento com o narrador (usuário)
     */
    public function narrator()
    {
        return $this->belongsTo(User::class, 'narrator_id');
    }

    public function players()
    {
        return $this->belongsToMany(Personagem::class, 'mission_players', 'mission_id', 'player_id');
    }

    // Relacionamento com monstros
    public function monsters()
    {
        return $this->belongsToMany(Monster::class, 'mission_monsters', 'mission_id', 'monster_id')
            ->withPivot('quantidade');
    }
    public function guild()
    {
        return $this->belongsTo(Guild::class); // Missão pertence a uma guilda
    }
}
