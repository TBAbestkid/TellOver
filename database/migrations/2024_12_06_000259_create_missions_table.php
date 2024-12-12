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
        Schema::create('missions', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->foreignId('guild_id')->constrained('guilds');
            $table->enum('status', ['pending', 'in_progress', 'completed'])->default('pending');
            $table->integer('level')->default(0);
            $table->integer('player_count')->default(1);
            $table->unsignedBigInteger('narrator_id');
            $table->timestamps();

            // Adicionando chave estrangeira para o narrador (usuário)
            $table->foreign('narrator_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('missions');
    }
};
