<?php

namespace Database\Seeders;

use App\Models\BlogPost;
use Illuminate\Database\Seeder;

class BlogPostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $posts = [
            [
                'title' => 'The Complete Guide to Image Compression for the Web in 2026',
                'slug' => 'how-to-compress-images-for-web',
                'category' => 'Compression',
                'excerpt' => 'Everything you need to know about compressing images for websites, from choosing the right format to advanced performance techniques.',
                'content' => '<p>Images can dominate page weight, so this guide covers the practical choices that reduce file size without hurting quality.</p>',
                'is_featured' => true,
                'is_published' => true,
                'published_at' => '2026-03-10 09:00:00',
            ],
            [
                'title' => 'WebP vs JPG vs PNG: Which Image Format Should You Use?',
                'slug' => 'webp-vs-jpg-vs-png',
                'category' => 'Formats',
                'excerpt' => 'A practical comparison of the three most common web image formats and when to use each one.',
                'content' => '<p>Choose the right image format based on transparency, compression, browser support, and visual fidelity.</p>',
                'is_published' => true,
                'published_at' => '2026-03-08 09:00:00',
            ],
            [
                'title' => 'Image SEO Best Practices: How to Rank Images in Google',
                'slug' => 'image-seo-best-practices',
                'category' => 'SEO',
                'excerpt' => 'Learn how to optimise file names, alt text, lazy loading, and structured data for image search.',
                'content' => '<p>Search engines need context, and this article breaks down the metadata and performance signals that help your images rank.</p>',
                'is_published' => true,
                'published_at' => '2026-03-05 09:00:00',
            ],
            [
                'title' => 'How to Reduce Image Size for Email Attachments',
                'slug' => 'reduce-image-size-for-email',
                'category' => 'Practical',
                'excerpt' => 'Step-by-step advice for compressing photos and graphics so they stay email-friendly.',
                'content' => '<p>Email providers reward smaller attachments. This guide explains the exact settings to use for common providers and use cases.</p>',
                'is_published' => true,
                'published_at' => '2026-03-01 09:00:00',
            ],
            [
                'title' => 'Core Web Vitals: How Images Impact Your Google Rankings',
                'slug' => 'core-web-vitals-image-optimization',
                'category' => 'Performance',
                'excerpt' => 'Understand how LCP, CLS, and INP relate to image optimisation and overall page experience.',
                'content' => '<p>Images are often the largest visible assets on a page, so their size and loading strategy directly affect Core Web Vitals.</p>',
                'is_published' => true,
                'published_at' => '2026-02-25 09:00:00',
            ],
            [
                'title' => 'The Ultimate Batch Image Compression Workflow for Bloggers',
                'slug' => 'batch-image-compression-workflow',
                'category' => 'Workflow',
                'excerpt' => 'A repeatable workflow for compressing dozens of images at once and uploading them efficiently.',
                'content' => '<p>Batch workflows save time for content teams, especially when image counts grow faster than editorial bandwidth.</p>',
                'is_published' => true,
                'published_at' => '2026-02-20 09:00:00',
            ],
            [
                'title' => 'Best Image Formats for Social Media in 2025 — Complete Size Guide',
                'slug' => 'best-image-formats-for-social-media',
                'category' => 'Social Media',
                'excerpt' => 'Recommended dimensions and formats for major social platforms, with quick references for each channel.',
                'content' => '<p>Social platforms resize aggressively, so this guide focuses on protecting quality while staying within platform limits.</p>',
                'is_published' => true,
                'published_at' => '2025-03-15 09:00:00',
            ],
            [
                'title' => 'How to Add a Watermark to Photos — Protect Your Images Online',
                'slug' => 'how-to-add-watermark-to-photos',
                'category' => 'Protection',
                'excerpt' => 'Best practices for watermark placement, opacity, and protection levels for image sharing.',
                'content' => '<p>Watermarks are a balance between visibility and usability. This article shows how to protect work without ruining presentation.</p>',
                'is_published' => true,
                'published_at' => '2025-03-18 09:00:00',
            ],
            [
                'title' => 'How to Optimise Images for WordPress — Speed Up Your Website',
                'slug' => 'optimize-images-for-wordpress',
                'category' => 'WordPress',
                'excerpt' => 'Practical WordPress image optimisation advice to reduce load times and improve Core Web Vitals.',
                'content' => '<p>WordPress sites benefit from a disciplined image pipeline, especially when editors publish frequently.</p>',
                'is_published' => true,
                'published_at' => '2025-03-20 09:00:00',
            ],
            [
                'title' => 'How to Convert Images to PDF — Complete Step-by-Step Guide',
                'slug' => 'convert-images-to-pdf-guide',
                'category' => 'Conversion',
                'excerpt' => 'Convert JPG, PNG, and WebP images into PDFs and merge multiple files with custom settings.',
                'content' => '<p>This guide covers a straightforward image-to-PDF workflow, including when to merge pages and how to control output quality.</p>',
                'is_published' => true,
                'published_at' => '2025-03-22 09:00:00',
            ],
        ];

        foreach ($posts as $post) {
            BlogPost::updateOrCreate(
                ['slug' => $post['slug']],
                $post,
            );
        }
    }
}