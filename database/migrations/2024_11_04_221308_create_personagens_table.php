<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('personagens', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Relacionamento com usuários
            $table->string('nome', 100);
            $table->integer('idade')->nullable();
            $table->string('altura', 10)->nullable();
            $table->string('tipo_monstro', 50)->nullable();
            $table->string('genero', 20)->nullable();
            $table->string('sexualidade', 20)->nullable();
            $table->string('personalidade', 100)->nullable();
            $table->string('origem', 100)->nullable();
            $table->string('lugar', 100)->nullable();
            $table->string('faz_parte_de', 100)->nullable();
            $table->string('relacao_personagens', 100)->nullable();
            $table->string('gosta', 100)->nullable();
            $table->string('nao_gosta', 100)->nullable();
            $table->json('habilidades')->nullable(); // array de habilidades
            $table->text('historia')->nullable();
            $table->string('imagem', 255)->nullable();
            $table->integer('hp')->default(3); // Valor inicial de HP
            $table->integer('resistencia')->default(0);
            $table->integer('armadura')->nullable();
            $table->integer('hp_mecanico')->nullable();
            $table->integer('forca')->nullable();
            $table->integer('velocidade')->nullable();
            $table->integer('mira')->nullable();
            $table->integer('armadura_atributo')->nullable();
            $table->integer('resistencia_atributo')->nullable();
            $table->integer('percepcao')->nullable();
            $table->integer('regeneracao')->nullable();
            $table->integer('vampirismo')->nullable();
            $table->integer('multi_ataque')->nullable();
            $table->integer('teleporte_curto')->nullable();
            $table->integer('teleporte_global')->nullable();
            $table->integer('nivel')->default(1);
            $table->timestamps();
        });
    }   


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personagens');
    }
};
