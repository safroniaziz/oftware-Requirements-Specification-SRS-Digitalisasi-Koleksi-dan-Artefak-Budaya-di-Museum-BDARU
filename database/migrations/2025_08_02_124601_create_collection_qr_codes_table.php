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
        Schema::create('collection_qr_codes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('collection_id')->constrained()->onDelete('cascade');
            $table->string('qr_code')->unique(); // Unique QR code identifier
            $table->string('qr_image_path')->nullable(); // Path to generated QR image
            $table->boolean('is_active')->default(true); // Whether this QR code is active
            $table->integer('scan_count')->default(0); // Track how many times scanned
            $table->timestamp('last_scanned_at')->nullable(); // Last time scanned
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('collection_qr_codes');
    }
};
