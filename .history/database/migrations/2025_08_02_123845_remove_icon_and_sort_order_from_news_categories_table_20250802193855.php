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
        Schema::table('news_categories', function (Blueprint $table) {
            $table->dropColumn(['icon', 'sort_order']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('news_categories', function (Blueprint $table) {
            $table->string('icon')->nullable()->after('description');
            $table->integer('sort_order')->default(0)->after('is_active');
        });
    }
};
