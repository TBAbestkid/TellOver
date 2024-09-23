<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMonstersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('monsters', function (Blueprint $table) {
            $table->id();
            $table->foreignId('narrador_id')->constrained('users')->onDelete('cascade'); // Narrador que criou
            $table->foreignId('categoria_id')->nullable()->constrained('categories')->onDelete('set null'); // Categoria
            $table->string('nome'); // Nome do monstro
            $table->integer('nivel'); // Nível
            $table->integer('idade')->nullable(); // Idade
            $table->text('personalidade')->nullable(); // Personalidade
            $table->string('altura')->nullable(); // Altura
            $table->string('tipo')->nullable(); // Tipo de monstro
            $table->string('local_vive')->nullable(); // Lugar onde vive
            $table->text('comportamento')->nullable(); // Comportamento
            $table->text('gosta')->nullable(); // Gosta
            $table->text('nao_gosta')->nullable(); // Não gosta
            $table->text('habilidades')->nullable(); // Habilidades
            $table->integer('hp'); // Hp
            $table->boolean('determinacao')->default(false); // Determinação
            $table->integer('armadura_global')->nullable(); // Armadura global
            $table->integer('armadura_fisica')->nullable(); // Armadura física
            $table->integer('armadura_elemental')->nullable(); // Armadura elemental
            $table->integer('armadura_magica')->nullable(); // Armadura mágica
            $table->integer('resistencia_fisica')->nullable(); // Resistência física
            $table->integer('resistencia_elemental')->nullable(); // Resistência elemental
            $table->integer('resistencia_magica')->nullable(); // Resistência mágica
            $table->integer('forca')->nullable(); // Força
            $table->integer('precisao')->nullable(); // Precisão
            $table->integer('velocidade')->nullable(); // Velocidade
            $table->text('drops')->nullable(); // Drop(s)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('monsters');
    }
}
