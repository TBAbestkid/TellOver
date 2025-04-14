<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveForeignKeyFromEquipamentos extends Migration
{
    public function up()
    {
        Schema::table('equipamentos', function (Blueprint $table) {
            // Remover a chave estrangeira
            $table->dropForeign(['personagem_id']);
        });
    }

    public function down()
    {
        Schema::table('equipamentos', function (Blueprint $table) {
            // Caso queira reverter, você pode adicionar a chave estrangeira de volta
            $table->foreign('personagem_id')->references('id')->on('personagens')->onDelete('cascade');
        });
    }
}
