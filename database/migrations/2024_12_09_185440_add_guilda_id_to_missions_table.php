<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddGuildaIdToMissionsTable extends Migration
{
    public function up()
    {
        Schema::table('missions', function (Blueprint $table) {
            $table->unsignedBigInteger('guilda_id')->nullable()->after('narrator_id'); // Adiciona a coluna guilda_id

            // Se você quiser garantir que a coluna guilda_id seja uma chave estrangeira que referencia a tabela guildas
            $table->foreign('guilda_id')->references('id')->on('guilds')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('missions', function (Blueprint $table) {
            // Remove a chave estrangeira e a coluna guilda_id
            $table->dropForeign(['guilda_id']);
            $table->dropColumn('guilda_id');
        });
    }
}
