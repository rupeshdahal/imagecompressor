<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('blog_posts', function (Blueprint $table) {
            $table->id();

            // Core content
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('excerpt');
            $table->longText('content'); // full HTML

            // SEO meta
            $table->string('meta_title')->nullable();
            $table->string('meta_description', 320)->nullable();
            $table->text('meta_keywords')->nullable();

            // Open Graph
            $table->string('og_title')->nullable();
            $table->string('og_description', 320)->nullable();

            // Taxonomy
            $table->string('category')->default('General');
            $table->json('tags')->nullable(); // e.g. ["Compression","WebP"]

            // Article metadata
            $table->unsignedSmallInteger('read_time')->default(5);  // minutes
            $table->unsignedSmallInteger('word_count')->default(0);
            $table->text('schema_keywords')->nullable();

            // Dates
            $table->date('date_published');
            $table->date('date_modified');

            // Publishing
            $table->boolean('is_published')->default(true);
            $table->boolean('is_featured')->default(false);
            $table->unsignedSmallInteger('sort_order')->default(0);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('blog_posts');
    }
};
