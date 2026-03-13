<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PageSeeder extends Seeder
{
    public function run(): void
    {
        $pages = [
            ['type' => 'tool', 'slug' => 'compress', 'title' => 'Compress Image', 'view' => 'tools.compress'],
            ['type' => 'tool', 'slug' => 'convert', 'title' => 'Convert Image', 'view' => 'tools.convert'],
            ['type' => 'tool', 'slug' => 'resize', 'title' => 'Resize Image', 'view' => 'tools.resize'],
            ['type' => 'tool', 'slug' => 'batch-compress', 'title' => 'Batch Compress', 'view' => 'tools.batch-compress'],
            ['type' => 'tool', 'slug' => 'watermark', 'title' => 'Add Watermark', 'view' => 'tools.watermark'],
            ['type' => 'tool', 'slug' => 'image-to-pdf', 'title' => 'Image to PDF', 'view' => 'tools.image-to-pdf'],
            ['type' => 'tool', 'slug' => 'pdf-to-image', 'title' => 'PDF to Image', 'view' => 'tools.pdf-to-image'],

            [
                'type' => 'blog', 'slug' => 'how-to-compress-images-for-web', 'title' => 'The Complete Guide to Image Compression for the Web in 2026', 'view' => 'blog.how-to-compress-images-for-web', 
                'category' => 'Featured Guide', 'listing_emoji' => '🚀', 'excerpt' => 'Everything you need to know about compressing images for websites — from choosing the right format and quality settings to advanced techniques for Core Web Vitals optimisation. Practical, step-by-step advice with real examples.', 
                'read_time' => '12 min', 'published_at' => '2026-03-10'
            ],
            [
                'type' => 'blog', 'slug' => 'webp-vs-jpg-vs-png', 'title' => 'WebP vs JPG vs PNG: Which Image Format Should You Use?', 'view' => 'blog.webp-vs-jpg-vs-png',
                'category' => 'Formats', 'listing_emoji' => '🖼️', 'excerpt' => 'A detailed comparison of the three most popular web image formats — with recommendations for every use case.',
                'read_time' => '9 min', 'published_at' => '2026-03-08'
            ],
            [
                'type' => 'blog', 'slug' => 'image-seo-best-practices', 'title' => 'Image SEO Best Practices: How to Rank Images in Google', 'view' => 'blog.image-seo-best-practices',
                'category' => 'SEO', 'listing_emoji' => '🔍', 'excerpt' => 'Learn how to optimise your images for search engines — from file names and alt text to lazy loading and structured data.',
                'read_time' => '10 min', 'published_at' => '2026-03-05'
            ],
            [
                'type' => 'blog', 'slug' => 'reduce-image-size-for-email', 'title' => 'How to Reduce Image Size for Email Attachments', 'view' => 'blog.reduce-image-size-for-email',
                'category' => 'Practical', 'listing_emoji' => '📧', 'excerpt' => 'Step-by-step guide to compressing photos for email — with specific settings for Gmail, Outlook, and other providers.',
                'read_time' => '6 min', 'published_at' => '2026-03-01'
            ],
            [
                'type' => 'blog', 'slug' => 'core-web-vitals-image-optimization', 'title' => 'Core Web Vitals: How Images Impact Your Google Rankings', 'view' => 'blog.core-web-vitals-image-optimization',
                'category' => 'Performance', 'listing_emoji' => '⚡', 'excerpt' => 'Understand LCP, CLS, and INP — and learn exactly how image optimisation can boost your PageSpeed scores.',
                'read_time' => '11 min', 'published_at' => '2026-02-25'
            ],
            [
                'type' => 'blog', 'slug' => 'batch-image-compression-workflow', 'title' => 'The Ultimate Batch Image Compression Workflow for Bloggers', 'view' => 'blog.batch-image-compression-workflow',
                'category' => 'Workflow', 'listing_emoji' => '📦', 'excerpt' => 'How to compress dozens of blog images at once, download as ZIP, and upload to WordPress in minutes.',
                'read_time' => '7 min', 'published_at' => '2026-02-20'
            ],
            [
                'type' => 'blog', 'slug' => 'best-image-formats-for-social-media', 'title' => 'Best Image Formats for Social Media in 2025 — Complete Size Guide', 'view' => 'blog.best-image-formats-for-social-media',
                'category' => 'Social Media', 'listing_emoji' => '📱', 'excerpt' => 'Exact image dimensions and recommended formats for Facebook, Instagram, Twitter/X, LinkedIn, and Pinterest.',
                'read_time' => '12 min', 'published_at' => '2025-03-15'
            ],
            [
                'type' => 'blog', 'slug' => 'how-to-add-watermark-to-photos', 'title' => 'How to Add a Watermark to Photos — Protect Your Images Online', 'view' => 'blog.how-to-add-watermark-to-photos',
                'category' => 'Protection', 'listing_emoji' => '🖊️', 'excerpt' => 'Step-by-step guide to watermarking your photos. Best practices for placement, opacity, and protection levels.',
                'read_time' => '9 min', 'published_at' => '2025-03-18'
            ],
            [
                'type' => 'blog', 'slug' => 'optimize-images-for-wordpress', 'title' => 'How to Optimise Images for WordPress — Speed Up Your Website', 'view' => 'blog.optimize-images-for-wordpress',
                'category' => 'WordPress', 'listing_emoji' => '🌐', 'excerpt' => 'Complete guide to WordPress image optimisation. Reduce load times, improve Core Web Vitals, and boost SEO.',
                'read_time' => '11 min', 'published_at' => '2025-03-20'
            ],
            [
                'type' => 'blog', 'slug' => 'convert-images-to-pdf-guide', 'title' => 'How to Convert Images to PDF — Complete Step-by-Step Guide', 'view' => 'blog.convert-images-to-pdf-guide',
                'category' => 'Conversion', 'listing_emoji' => '📄', 'excerpt' => 'Convert JPG, PNG, and WebP images to PDF documents. Merge multiple images with custom page settings.',
                'read_time' => '8 min', 'published_at' => '2025-03-22'
            ],

            ['type' => 'page', 'slug' => 'about', 'title' => 'About Us', 'view' => 'pages.about'],
            ['type' => 'page', 'slug' => 'contact', 'title' => 'Contact Us', 'view' => 'pages.contact'],
        ];

        foreach ($pages as $index => $page) {
            $viewPath = resource_path('views/' . str_replace('.', '/', $page['view']) . '.blade.php');
            $bodyContent = '';

            if (file_exists($viewPath)) {
                $content = file_get_contents($viewPath);
                
                // Extract everything inside the prose div to avoid duplicating the header/h1
                if (preg_match('/<div class="prose[^"]*">(.*?)<\/div>\s*<\/div>\s*<\/article>/s', $content, $matchProse)) {
                    $bodyContent = trim($matchProse[1]);
                } elseif (preg_match('/@section\(\'content\'\)(.*?)@endsection/s', $content, $matches)) {
                    $bodyContent = trim($matches[1]);
                } else {
                    $bodyContent = $content;
                }

                // Remove Blade comments {{-- ... --}} which would render literally otherwise
                $bodyContent = preg_replace('/\{\{--.*?--\}\}/s', '', $bodyContent);
            }

            Page::updateOrCreate(
                ['slug' => $page['slug']],
                [
                    'type' => $page['type'],
                    'title' => $page['title'],
                    'body' => $bodyContent,
                    'is_active' => true,
                    'sort_order' => $index,
                    'is_featured' => ($page['type'] === 'blog' && $index === 7) ? true : false,
                    'category' => $page['category'] ?? null,
                    'listing_emoji' => $page['listing_emoji'] ?? null,
                    'excerpt' => $page['excerpt'] ?? null,
                    'read_time' => $page['read_time'] ?? null,
                    'published_at' => $page['published_at'] ?? null,
                ]
            );
        }
    }
}
