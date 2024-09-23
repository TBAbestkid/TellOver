<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoricoMissaoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historico_missao', function (Blueprint $table) {
            $table->id();
            $table->string('tipo_missao'); // Título do tipo de missão
            $table->string('nome_players'); // Nomes dos jogadores na missão
            $table->integer('quantidade_players'); // Quantidade de jogadores
            $table->text('descricao_missao'); // Descrição da missão
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
        Schema::dropIfExists('historico_missao');
    }
}
