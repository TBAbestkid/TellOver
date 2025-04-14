<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEquipamentosTable extends Migration
{
    public function up()
    {
        Schema::create('equipamentos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('personagem_id')->constrained('personagens'); // Referência à tabela 'personagens'
            $table->foreignId('item_id')->constrained('itens'); // Referência à tabela 'itens'
            $table->string('local'); // Local do equipamento (cabeça, mãos, etc.)
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('equipamentos');
    }
}
