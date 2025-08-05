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
            // Remove unwanted fields safely
            if (Schema::hasColumn('museum_settings', 'maintenance_mode')) {
                $table->dropColumn('maintenance_mode');
            }
            if (Schema::hasColumn('museum_settings', 'debug_mode')) {
                $table->dropColumn('debug_mode');
            }
            if (Schema::hasColumn('museum_settings', 'email_support')) {
                $table->dropColumn('email_support');
            }
            if (Schema::hasColumn('museum_settings', 'email_partnership')) {
                $table->dropColumn('email_partnership');
            }
            if (Schema::hasColumn('museum_settings', 'pagination_per_page')) {
                $table->dropColumn('pagination_per_page');
            }
            if (Schema::hasColumn('museum_settings', 'favicon_path')) {
                $table->dropColumn('favicon_path');
            }
            if (Schema::hasColumn('museum_settings', 'session_lifetime')) {
                $table->dropColumn('session_lifetime');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('museum_settings', function (Blueprint $table) {
            // Add back the removed fields
            $table->boolean('maintenance_mode')->default(false)->after('description');
            $table->boolean('debug_mode')->default(false)->after('maintenance_mode');
            $table->string('email_support')->nullable()->after('email_info');
            $table->string('email_partnership')->nullable()->after('email_support');
            $table->integer('pagination_per_page')->default(10)->after('debug_mode');
            $table->string('favicon_path')->nullable()->after('logo_path');
            $table->integer('session_lifetime')->default(120)->after('pagination_per_page');
        });
    }
};
