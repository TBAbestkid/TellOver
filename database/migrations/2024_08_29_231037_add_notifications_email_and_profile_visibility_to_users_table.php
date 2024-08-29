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
        Schema::table('users', function (Blueprint $table) {
            // Adiciona a coluna notifications_email
            $table->boolean('notifications_email')->default(false);

            // Adiciona a coluna profile_visibility
            $table->enum('profile_visibility', ['public', 'private'])->default('public');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Remove a coluna notifications_email
            $table->dropColumn('notifications_email');

            // Remove a coluna profile_visibility
            $table->dropColumn('profile_visibility');
        });
    }
};
