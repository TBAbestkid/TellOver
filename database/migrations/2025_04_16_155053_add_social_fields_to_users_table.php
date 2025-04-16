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
            $table->string('username')->unique()->nullable()->after('name');
            $table->text('bio')->nullable()->after('profile_visibility');
            $table->string('location', 100)->nullable()->after('bio');
            $table->string('website')->nullable()->after('location');
            $table->date('birthday')->nullable()->after('website');
            $table->string('avatar')->nullable()->after('birthday'); // URL do avatar
            $table->string('banner')->nullable()->after('avatar');   // URL da capa
            $table->string('status')->nullable()->after('banner');   // status atual
            $table->timestamp('last_active_at')->nullable()->after('updated_at');
            $table->boolean('is_verified')->default(false)->after('last_active_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'username',
                'bio',
                'location',
                'website',
                'birthday',
                'avatar',
                'banner',
                'status',
                'last_active_at',
                'is_verified',
            ]);
        });
    }

};
