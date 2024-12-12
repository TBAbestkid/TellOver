<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    use HasFactory;

    protected $fillable = [
        'personagem_id',
        'nivel',
        'xp_necessario',
        'xp_atual',
    ];

    public function personagem()
    {
        return $this->belongsTo(Personagem::class);
    }

    public function calcularXpNecessario()
    {
        return $this->nivel < 10 ? $this->nivel + 1 : 11;
    }

    public function adicionarXp($xpGanho)
    {
        $this->xp_atual += $xpGanho;

        while ($this->xp_atual >= $this->xp_necessario) {
            $this->xp_atual -= $this->xp_necessario;
            $this->nivel += 1;
            $this->xp_necessario = $this->calcularXpNecessario();
        }

        $this->save();
    }
}
