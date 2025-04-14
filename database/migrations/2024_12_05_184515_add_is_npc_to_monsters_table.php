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
            $table->boolean('is_npc')->default(0)->after('categoria_id'); // 0 para monstro, 1 para NPC
        });
    }

    public function down()
    {
        Schema::table('monsters', function (Blueprint $table) {
            $table->dropColumn('is_npc');
        });
    }

};
