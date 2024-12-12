<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guild extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'region_id'];

    // Relacionamento com as missões
    public function missions()
    {
        return $this->hasMany(Mission::class); // Guild tem muitas missões
    }

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

}
