<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdatePersonagensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('personagens', function (Blueprint $table) {
            // Alterando para 'text' ao invés de 'string' para maior flexibilidade
            $table->text('personalidade')->nullable()->change(); // Modificando para 'text'
            $table->text('sexualidade')->nullable()->change(); // Alterando para 'text'
            $table->text('gosta')->nullable()->change(); // Alterando para 'text'
            $table->text('nao_gosta')->nullable()->change(); // Alterando para 'text'
            $table->text('historia')->nullable()->change(); // Alterando para 'text'
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('personagens', function (Blueprint $table) {
            // Caso precise reverter, voltamos para 'string' com tamanhos limitados
            $table->string('personalidade', 100)->nullable()->change(); // Voltando para 'string(100)'
            $table->string('sexualidade', 255)->nullable()->change(); // Voltando para 'string(255)'
            $table->string('gosta', 255)->nullable()->change(); // Voltando para 'string(255)'
            $table->string('nao_gosta', 255)->nullable()->change(); // Voltando para 'string(255)'
            $table->string('historia', 255)->nullable()->change(); // Voltando para 'string(255)'
        });
    }
}
