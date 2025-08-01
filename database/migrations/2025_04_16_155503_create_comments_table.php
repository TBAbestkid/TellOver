<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();

            $table->foreignId('post_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            $table->foreignId('parent_id')->nullable()->constrained('comments')->onDelete('cascade'); // resposta a comentário
            $table->text('body')->nullable();
            $table->string('image_path')->nullable(); // Caminho da imagem

            $table->unsignedInteger('likes_count')->default(0); // Contador de likes

            $table->timestamp('edited_at')->nullable(); // Data da edição
            $table->softDeletes(); // Para exclusão lógica (deleted_at)

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
