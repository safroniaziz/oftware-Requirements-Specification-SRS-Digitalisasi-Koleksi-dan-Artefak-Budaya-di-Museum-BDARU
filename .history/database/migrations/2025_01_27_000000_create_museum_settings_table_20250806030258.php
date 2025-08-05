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
        Schema::create('museum_settings', function (Blueprint $table) {
            $table->id();
            $table->string('app_name')->default('BDARU Museum');
            $table->text('app_description')->nullable();
            $table->string('app_logo')->nullable();
            $table->string('app_favicon')->nullable();
            $table->string('app_email')->nullable();
            $table->string('app_phone')->nullable();
            $table->text('app_address')->nullable();
            $table->text('app_about')->nullable();
            $table->string('app_facebook')->nullable();
            $table->string('app_instagram')->nullable();
            $table->string('app_twitter')->nullable();
            $table->string('app_youtube')->nullable();
            $table->text('app_maps_embed')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('museum_settings');
    }
};
