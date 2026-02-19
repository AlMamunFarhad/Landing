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
        Schema::create('landing_pages', function (Blueprint $table) {
            $table->id();
            // ===============================
            // Basic Page Info
            // ===============================
            $table->string('title');
            $table->string('slug')->unique();
            $table->boolean('is_published')->default(false);
            $table->string('button_text')->nullable();
            $table->string('contact_number')->nullable();
            // =====================================================
            // Section 1: Hero Section (Top Banner Area)
            // =====================================================
            $table->string('hero_title')->nullable();
            $table->string('hero_subtitle')->nullable();
            $table->text('hero_youtube_link')->nullable();
            // =====================================================
            // Section 2: Products Section
            // =====================================================
            $table->string('product_title')->nullable();
            $table->decimal('product_subtitle', 10, 2)->nullable();
            $table->string('product_image')->nullable();
            // =====================================================
            // Section 3: Why Trust Us Section
            // =====================================================
            $table->string('why_trust_us_title')->nullable();
            $table->text('why_trust_us_description')->nullable();
            $table->string('why_trust_us_image')->nullable();
            // =====================================================
            // Section 4: Why Choose Us Section
            // =====================================================
            $table->string('why_choose_title')->nullable();
            $table->text('why_choose_description')->nullable();
            // =====================================================
            // Protucts ID (JSON Array)
            // =====================================================
            $table->json('product_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('landing_pages');
    }
};
