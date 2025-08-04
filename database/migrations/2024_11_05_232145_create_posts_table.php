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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->text('body')->nullable();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            $table->foreignId('parent_id')->nullable()->constrained('posts')->onDelete('cascade'); // <- relação recursiva
            $table->enum('type', ['post', 'comment', 'work'])->default('post'); // <- tipo de conteúdo

            $table->string('image_path')->nullable();
            $table->string('video_path')->nullable();
            $table->enum('visibility', ['public', 'private', 'followers'])->default('public');
            $table->unsignedInteger('likes_count')->default(0);
            $table->unsignedInteger('comments_count')->default(0);
            $table->timestamp('edited_at')->nullable();
            $table->string('location')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('posts');
    }
};
