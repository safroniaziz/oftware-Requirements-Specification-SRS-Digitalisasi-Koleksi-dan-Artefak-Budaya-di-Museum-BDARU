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
        Schema::create('collection_ratings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('collection_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade'); // Nullable for guest ratings
            $table->string('visitor_ip')->nullable(); // For guest ratings
            $table->string('visitor_session')->nullable(); // For guest ratings
            $table->decimal('rating', 2, 1); // Rating 1.0 to 5.0
            $table->text('comment')->nullable(); // Optional comment
            $table->boolean('is_approved')->default(true); // For moderation
            $table->timestamps();

            // Prevent duplicate ratings from same user/IP
            $table->unique(['collection_id', 'user_id'], 'unique_user_rating');
            $table->unique(['collection_id', 'visitor_ip'], 'unique_ip_rating');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('collection_ratings');
    }
};
