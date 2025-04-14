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
        Schema::table('monsters', function (Blueprint $table) {
            // Remover os campos de resistência específicos
            $table->dropColumn([
                'resistencia_fisica',
                'resistencia_elemental',
                'resistencia_magica',
            ]);

            // Adicionar o campo de resistência geral
            $table->integer('resistencia')->nullable();

            // Adicionar o campo de imagem para o monstro
            $table->string('imagem')->nullable();
        });
    }

    public function down()
    {
        Schema::table('monsters', function (Blueprint $table) {
            // Reverter as mudanças no caso de rollback
            $table->dropColumn('resistencia');
            $table->dropColumn('imagem');

            // Recriar os campos de resistência específicos
            $table->integer('resistencia_fisica')->nullable();
            $table->integer('resistencia_elemental')->nullable();
            $table->integer('resistencia_magica')->nullable();
        });
    }

};
