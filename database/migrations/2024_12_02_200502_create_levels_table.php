<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('levels', function (Blueprint $table) {
            $table->id();  // ID do nível
            $table->foreignId('personagem_id')->constrained('personagens');  // Relacionamento com a tabela de personagens
            $table->integer('nivel');  // O nível do personagem (1, 2, 3, ...)
            $table->integer('xp_necessario');  // XP necessário para alcançar o próximo nível
            $table->integer('xp_atual')->default(0);  // XP atual do personagem
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('levels');
    }
};
