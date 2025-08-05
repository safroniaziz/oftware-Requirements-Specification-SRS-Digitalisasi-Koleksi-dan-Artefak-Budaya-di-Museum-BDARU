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
        Schema::table('hero_images', function (Blueprint $table) {
            $table->string('title')->after('id');
            $table->string('subtitle')->after('title');
            $table->text('description')->after('subtitle');
            $table->string('image_path')->after('description');
            $table->string('alt_text')->after('image_path');
            $table->integer('sort_order')->default(0)->after('alt_text');
            $table->boolean('is_active')->default(true)->after('sort_order');
            $table->softDeletes()->after('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('hero_images', function (Blueprint $table) {
            $table->dropColumn([
                'title',
                'subtitle',
                'description',
                'image_path',
                'alt_text',
                'sort_order',
                'is_active',
                'deleted_at'
            ]);
        });
    }
};
