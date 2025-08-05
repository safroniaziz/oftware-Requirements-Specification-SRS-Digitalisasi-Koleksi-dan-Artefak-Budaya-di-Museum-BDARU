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
            $table->string('museum_name')->default('Museum Digital Indonesia BDARU');
            $table->text('address')->nullable();
            $table->string('city')->default('Jakarta Pusat');
            $table->string('province')->default('DKI Jakarta');
            $table->string('postal_code')->default('10110');
            $table->string('country')->default('Indonesia');
            $table->decimal('latitude', 10, 8)->default(-6.175392);
            $table->decimal('longitude', 11, 8)->default(106.827183);
            $table->string('phone_1')->nullable();
            $table->string('phone_2')->nullable();
            $table->string('email_info')->nullable();
            $table->string('email_support')->nullable();
            $table->string('email_partnership')->nullable();
            $table->string('website')->nullable();
            $table->text('opening_hours')->nullable();
            $table->text('description')->nullable();
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
