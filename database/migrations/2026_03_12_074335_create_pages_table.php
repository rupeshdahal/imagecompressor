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

            // Type: tool, blog, page (about, contact, privacy, terms)
            $table->string('type', 20)->index();           // tool | blog | page

            // Routing
            $table->string('slug')->unique();               // e.g. "compress", "how-to-compress-images-for-web"

            // SEO meta
            $table->string('title');                         // <title> tag
            $table->text('meta_description');                // <meta name="description">
            $table->string('og_title')->nullable();
            $table->string('og_description')->nullable();
            $table->string('og_type', 30)->default('website');
            $table->string('canonical_path')->nullable();    // e.g. "/tools/compress"
            $table->json('schema_markup')->nullable();       // JSON-LD structured data

            // Breadcrumb
            $table->string('breadcrumb_label')->nullable();  // e.g. "Image Compressor"

            // Page content
            $table->string('hero_badge')->nullable();        // "🗜️ Free · No Signup · Unlimited"
            $table->string('hero_badge_color', 30)->nullable(); // "brand", "green", "purple" etc.
            $table->string('hero_title')->nullable();        // "Compress Images"
            $table->string('hero_title_gradient')->nullable(); // "Online Free"
            $table->text('hero_description')->nullable();

            // CTA block (for tool pages)
            $table->string('cta_icon')->nullable();          // SVG path or emoji
            $table->string('cta_title')->nullable();
            $table->text('cta_description')->nullable();
            $table->string('cta_button_text')->nullable();
            $table->string('cta_button_url')->nullable();    // "/#compress"
            $table->string('cta_color', 30)->nullable();     // "brand", "green", "purple", "pink", "amber", "red"

            // Main body (HTML prose content)
            $table->longText('body')->nullable();

            // Related tools (JSON array of {slug, emoji, title, description})
            $table->json('related_tools')->nullable();

            // Related blog posts (JSON array of {slug, title, description})
            $table->json('related_posts')->nullable();

            // Blog-specific fields
            $table->string('category')->nullable();
            $table->string('category_color', 30)->nullable();
            $table->date('published_at')->nullable();
            $table->string('read_time')->nullable();         // "12 min read"
            $table->boolean('is_featured')->default(false);
            $table->text('excerpt')->nullable();              // Short description for listing cards
            $table->string('listing_emoji')->nullable();      // Emoji for blog index card

            // Status
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
