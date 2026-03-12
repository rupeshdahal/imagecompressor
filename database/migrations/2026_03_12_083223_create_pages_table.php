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

            // ── Classification ───────────────────────────────
            $table->string('type', 20)->index();           // tool | blog | page
            $table->string('slug')->unique();               // URL slug

            // ── SEO Meta ─────────────────────────────────────
            $table->string('title');                         // <title> tag
            $table->text('meta_description');
            $table->string('og_title')->nullable();
            $table->string('og_description')->nullable();
            $table->string('og_type', 30)->default('website');
            $table->string('canonical_path')->nullable();    // e.g. "/tools/compress"
            $table->json('schema_markup')->nullable();       // JSON-LD structured data

            // ── Hero Section ─────────────────────────────────
            $table->string('breadcrumb_label')->nullable();
            $table->string('hero_badge')->nullable();        // "🗜️ Free · No Signup · Unlimited"
            $table->string('hero_badge_color', 30)->default('brand');
            $table->string('hero_title')->nullable();
            $table->string('hero_title_gradient')->nullable(); // gradient-highlighted text
            $table->text('hero_description')->nullable();

            // ── CTA Block (tool pages) ───────────────────────
            $table->string('cta_icon')->nullable();          // SVG or emoji
            $table->string('cta_title')->nullable();
            $table->text('cta_description')->nullable();
            $table->string('cta_button_text')->nullable();
            $table->string('cta_button_url')->nullable();
            $table->string('cta_color', 30)->default('brand');

            // ── Body Content ─────────────────────────────────
            $table->longText('body')->nullable();            // HTML prose

            // ── Related Items ────────────────────────────────
            $table->json('related_tools')->nullable();       // [{slug, emoji, title, description}]
            $table->json('related_posts')->nullable();       // [{slug, title, description}]

            // ── Blog-specific ────────────────────────────────
            $table->string('category')->nullable();
            $table->string('category_color', 30)->nullable();
            $table->date('published_at')->nullable();
            $table->string('read_time')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->text('excerpt')->nullable();
            $table->string('listing_emoji')->nullable();

            // ── Status / Ordering ────────────────────────────
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);

            $table->timestamps();

            $table->index(['type', 'is_active', 'sort_order']);
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
