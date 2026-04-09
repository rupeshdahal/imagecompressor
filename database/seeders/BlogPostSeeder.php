<?php

namespace Database\Seeders;

use App\Models\BlogPost;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class BlogPostSeeder extends Seeder
{
    /**
     * Seed blog posts from existing static Blade pages.
     */
    public function run(): void
    {
        $meta = [
            'how-to-compress-images-for-web' => [
                'category' => 'Compression',
                'read_time_minutes' => 12,
                'published_at' => '2026-03-10 09:00:00',
                'featured' => true,
                'excerpt' => 'Everything you need to know about compressing images for websites - from choosing the right format and quality settings to advanced Core Web Vitals optimisation.',
            ],
            'webp-vs-jpg-vs-png' => [
                'category' => 'Formats',
                'read_time_minutes' => 9,
                'published_at' => '2026-03-08 09:00:00',
                'excerpt' => 'A detailed comparison of the three most popular web image formats, with clear recommendations for each use case.',
            ],
            'image-seo-best-practices' => [
                'category' => 'SEO',
                'read_time_minutes' => 10,
                'published_at' => '2026-03-05 09:00:00',
                'excerpt' => 'Learn how to optimise your images for search engines, from file names and alt text to lazy loading and structured data.',
            ],
            'reduce-image-size-for-email' => [
                'category' => 'Practical',
                'read_time_minutes' => 6,
                'published_at' => '2026-03-01 09:00:00',
                'excerpt' => 'Step-by-step guide to compressing photos for email with practical settings for major email providers.',
            ],
            'core-web-vitals-image-optimization' => [
                'category' => 'Performance',
                'read_time_minutes' => 11,
                'published_at' => '2026-02-25 09:00:00',
                'excerpt' => 'Understand LCP, CLS, and INP and learn exactly how image optimisation can improve your PageSpeed scores.',
            ],
            'batch-image-compression-workflow' => [
                'category' => 'Workflow',
                'read_time_minutes' => 7,
                'published_at' => '2026-02-20 09:00:00',
                'excerpt' => 'How to compress dozens of blog images at once, export as ZIP, and publish faster with a repeatable workflow.',
            ],
            'best-image-formats-for-social-media' => [
                'category' => 'Social Media',
                'read_time_minutes' => 12,
                'published_at' => '2025-03-15 09:00:00',
                'excerpt' => 'Exact image dimensions and recommended formats for Facebook, Instagram, X, LinkedIn, and Pinterest.',
            ],
            'how-to-add-watermark-to-photos' => [
                'category' => 'Protection',
                'read_time_minutes' => 9,
                'published_at' => '2025-03-18 09:00:00',
                'excerpt' => 'Step-by-step watermarking guidance, including placement, opacity, and practical image protection tips.',
            ],
            'optimize-images-for-wordpress' => [
                'category' => 'WordPress',
                'read_time_minutes' => 11,
                'published_at' => '2025-03-20 09:00:00',
                'excerpt' => 'Complete WordPress image optimisation guide to improve load times, Core Web Vitals, and SEO.',
            ],
            'convert-images-to-pdf-guide' => [
                'category' => 'Conversion',
                'read_time_minutes' => 8,
                'published_at' => '2025-03-22 09:00:00',
                'excerpt' => 'Convert JPG, PNG, and WebP images to PDF and merge multiple images with custom page settings.',
            ],
        ];

        foreach (array_keys($meta) as $slug) {
            $path = resource_path("views/blog/{$slug}.blade.php");
            if (! File::exists($path)) {
                continue;
            }

            $raw = File::get($path);
            $title = $this->extractInlineSection($raw, 'title') ?: Str::headline($slug);
            $description = $this->extractInlineSection($raw, 'description');
            $ogTitle = $this->extractInlineSection($raw, 'og_title');
            $ogDescription = $this->extractInlineSection($raw, 'og_description');
            $content = $this->extractBlockSection($raw, 'content');
            $schemaJson = $this->extractBlockSection($raw, 'head');

            $content = preg_replace('/\{\{--[\s\S]*?--\}\}/', '', $content ?? '');
            $schemaJson = str_replace(['@verbatim', '@endverbatim'], '', $schemaJson ?? '');

            BlogPost::updateOrCreate(
                ['slug' => $slug],
                [
                    'title' => trim($title),
                    'slug' => $slug,
                    'excerpt' => $meta[$slug]['excerpt'] ?? $description,
                    'content' => trim($content),
                    'meta_title' => trim($title),
                    'meta_description' => $description,
                    'og_title' => $ogTitle,
                    'og_description' => $ogDescription,
                    'schema_json' => trim($schemaJson) ?: null,
                    'category' => $meta[$slug]['category'] ?? null,
                    'read_time_minutes' => $meta[$slug]['read_time_minutes'] ?? null,
                    'featured' => $meta[$slug]['featured'] ?? false,
                    'is_published' => true,
                    'published_at' => $meta[$slug]['published_at'] ?? now(),
                ]
            );
        }
    }

    private function extractInlineSection(string $raw, string $section): ?string
    {
        $pattern = "/@section\\('" . preg_quote($section, '/') . "',\\s*'((?:\\\\'|[^'])*)'\\)/s";

        if (! preg_match($pattern, $raw, $matches)) {
            return null;
        }

        return str_replace("\\'", "'", $matches[1]);
    }

    private function extractBlockSection(string $raw, string $section): ?string
    {
        $start = "@section('{$section}')";
        $startPos = strpos($raw, $start);

        if ($startPos === false) {
            return null;
        }

        $offset = $startPos + strlen($start);
        $endPos = strpos($raw, '@endsection', $offset);

        if ($endPos === false) {
            return null;
        }

        return trim(substr($raw, $offset, $endPos - $offset));
    }
}
