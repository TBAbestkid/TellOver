<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItensTable extends Migration
{
    public function up()
    {
        Schema::create('itens', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('tipo'); // Cabeça, Pescoço, etc.
            $table->text('descricao')->nullable();
            $table->integer('nivel_necessario');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('itens');
    }
}
