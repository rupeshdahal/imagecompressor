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
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('type')->index(); // 'tool', 'blog', 'page'
            $table->string('slug')->unique();
            $table->string('title');
            $table->text('meta_description')->nullable();
            
            // Hero / Content
            $table->string('hero_badge')->nullable();
            $table->string('hero_title')->nullable();
            $table->string('hero_title_gradient')->nullable();
            $table->text('hero_description')->nullable();
            $table->longText('body')->nullable();
            
            // SEO & Meta
            $table->string('og_title')->nullable();
            $table->text('og_description')->nullable();
            $table->string('canonical_path')->nullable();
            $table->json('schema_markup')->nullable();
            
            // Blog specific
            $table->string('category')->nullable();
            $table->string('listing_emoji')->nullable();
            $table->text('excerpt')->nullable();
            $table->string('read_time')->nullable();
            $table->date('published_at')->nullable();
            $table->boolean('is_featured')->default(false);
            
            // Related content
            $table->json('related_tools')->nullable();
            $table->json('related_posts')->nullable();
            
            // State
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pages');
    }
};
