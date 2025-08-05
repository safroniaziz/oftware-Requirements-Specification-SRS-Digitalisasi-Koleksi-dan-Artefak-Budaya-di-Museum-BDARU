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
        Schema::table('museum_settings', function (Blueprint $table) {
            $table->boolean('maintenance_mode')->default(false)->after('description');
            $table->boolean('debug_mode')->default(false)->after('maintenance_mode');
            $table->integer('pagination_per_page')->default(10)->after('debug_mode');
            $table->integer('session_lifetime')->default(120)->after('pagination_per_page');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('museum_settings', function (Blueprint $table) {
            $table->dropColumn(['maintenance_mode', 'debug_mode', 'pagination_per_page', 'session_lifetime']);
        });
    }
};
