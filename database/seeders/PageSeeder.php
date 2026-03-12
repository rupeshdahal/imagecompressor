<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class PageSeeder extends Seeder
{
    public function run(): void
    {
        // ──────────────────────────────────────────────────────
        //  TOOL PAGES
        // ──────────────────────────────────────────────────────

        $tools = [
            [
                'slug'               => 'compress',
                'title'              => 'Free Image Compressor Online — Compress JPG, PNG, WebP up to 90% | CompresslyPro',
                'meta_description'   => 'Compress JPG, PNG, WebP and GIF images online for free. Reduce image file size up to 90% without visible quality loss. No signup, no watermarks. Before/after comparison slider included.',
                'og_title'           => 'Free Image Compressor — Reduce Image Size up to 90% Online',
                'og_description'     => 'Compress JPG, PNG, WebP images up to 90% smaller. Adjustable quality, before/after comparison, no signup required.',
                'canonical_path'     => '/tools/compress',
                'breadcrumb_label'   => 'Image Compressor',
                'hero_badge'         => '🗜️ Free · No Signup · Unlimited',
                'hero_badge_color'   => 'brand',
                'hero_title'         => 'Compress Images',
                'hero_title_gradient'=> 'Online Free',
                'hero_description'   => 'Reduce JPG, PNG, WebP and GIF file sizes <strong class="text-gray-700">up to 90% smaller</strong> without visible quality loss. Adjustable quality slider with real-time before/after comparison.',
                'cta_icon'           => '🗜️',
                'cta_title'          => 'Ready to Compress Your Images?',
                'cta_description'    => 'Drag & drop your image, or click the button below. Supports JPG, PNG, WebP, and GIF up to 20 MB.',
                'cta_button_text'    => 'Open Image Compressor',
                'cta_button_url'     => '/#compress',
                'cta_color'          => 'brand',
                'schema_markup'      => [
                    '@context' => 'https://schema.org', '@type' => 'SoftwareApplication',
                    'name' => 'CompresslyPro Image Compressor',
                    'description' => 'Free online image compressor that reduces JPG, PNG, WebP and GIF file sizes by up to 90% without losing quality.',
                    'url' => 'https://compresslypro.com/tools/compress',
                    'applicationCategory' => 'MultimediaApplication', 'operatingSystem' => 'All', 'isAccessibleForFree' => true,
                    'offers' => ['@type' => 'Offer', 'price' => '0', 'priceCurrency' => 'USD'],
                    'aggregateRating' => ['@type' => 'AggregateRating', 'ratingValue' => '4.8', 'ratingCount' => '3124', 'bestRating' => '5'],
                ],
                'related_tools' => [
                    ['slug' => 'batch-compress', 'emoji' => '📦', 'title' => 'Batch Compressor', 'description' => 'Compress up to 20 images at once'],
                    ['slug' => 'convert',        'emoji' => '🔄', 'title' => 'Image Converter',  'description' => 'Convert between JPG, PNG, WebP'],
                    ['slug' => 'resize',         'emoji' => '↔️', 'title' => 'Image Resizer',    'description' => 'Resize by pixels or percentage'],
                ],
                'related_posts' => [
                    ['slug' => 'how-to-compress-images-for-web', 'title' => 'Complete Guide to Image Compression for the Web', 'description' => 'Step-by-step guide covering formats, quality settings, and Core Web Vitals.'],
                    ['slug' => 'reduce-image-size-for-email',    'title' => 'How to Reduce Image Size for Email',              'description' => 'Size limits, compression settings, and newsletter best practices.'],
                ],
                'sort_order' => 1,
            ],
            [
                'slug'               => 'convert',
                'title'              => 'Free Image Converter Online — Convert JPG, PNG, WebP Instantly | CompresslyPro',
                'meta_description'   => 'Convert images between JPG, PNG and WebP formats online for free. High-quality format conversion with no file size limits. No signup required. Instant results.',
                'og_title'           => 'Free Image Converter — Convert JPG to PNG, PNG to WebP & More',
                'og_description'     => 'Convert between JPG, PNG and WebP formats instantly. Free online image converter with no signup required.',
                'canonical_path'     => '/tools/convert',
                'breadcrumb_label'   => 'Image Converter',
                'hero_badge'         => '🔄 Free · Instant · No Signup',
                'hero_badge_color'   => 'purple',
                'hero_title'         => 'Convert Images',
                'hero_title_gradient'=> 'Online Free',
                'hero_description'   => 'Convert between <strong class="text-gray-700">JPG, PNG, and WebP</strong> formats instantly. High-quality conversion with no file size limits and no registration required.',
                'cta_icon'           => '🔄',
                'cta_title'          => 'Ready to Convert Your Images?',
                'cta_description'    => 'Upload your image and choose the target format. Supports JPG, PNG, and WebP.',
                'cta_button_text'    => 'Open Image Converter',
                'cta_button_url'     => '/#convert',
                'cta_color'          => 'purple',
                'schema_markup'      => [
                    '@context' => 'https://schema.org', '@type' => 'SoftwareApplication',
                    'name' => 'CompresslyPro Image Converter',
                    'description' => 'Free online image converter. Convert between JPG, PNG and WebP formats instantly.',
                    'url' => 'https://compresslypro.com/tools/convert',
                    'applicationCategory' => 'MultimediaApplication', 'operatingSystem' => 'All', 'isAccessibleForFree' => true,
                    'offers' => ['@type' => 'Offer', 'price' => '0', 'priceCurrency' => 'USD'],
                ],
                'related_tools' => [
                    ['slug' => 'compress',  'emoji' => '🗜️', 'title' => 'Image Compressor', 'description' => 'Reduce image size up to 90%'],
                    ['slug' => 'resize',    'emoji' => '↔️', 'title' => 'Image Resizer',    'description' => 'Resize by pixels or percentage'],
                    ['slug' => 'watermark', 'emoji' => '🖊️', 'title' => 'Add Watermark',    'description' => 'Protect images with text watermarks'],
                ],
                'related_posts' => [
                    ['slug' => 'webp-vs-jpg-vs-png',              'title' => 'WebP vs JPG vs PNG: Which Format Should You Use?',   'description' => 'Detailed comparison with real-world file size data.'],
                    ['slug' => 'how-to-compress-images-for-web',  'title' => 'Complete Guide to Image Compression for the Web',    'description' => 'Everything about formats, quality settings, and optimisation.'],
                ],
                'sort_order' => 2,
            ],
            [
                'slug'               => 'resize',
                'title'              => 'Free Image Resizer Online — Resize JPG, PNG, WebP by Pixels or % | CompresslyPro',
                'meta_description'   => 'Resize images online for free. Change dimensions by exact pixels, percentage, or fit to preset sizes for social media. Supports JPG, PNG, and WebP. No signup required.',
                'og_title'           => 'Free Image Resizer — Resize by Pixels, Percentage, or Social Media Presets',
                'og_description'     => 'Resize JPG, PNG, WebP images by exact pixels or percentage. Free online tool with social media size presets.',
                'canonical_path'     => '/tools/resize',
                'breadcrumb_label'   => 'Image Resizer',
                'hero_badge'         => '↔️ Free · Precise · No Signup',
                'hero_badge_color'   => 'green',
                'hero_title'         => 'Resize Images',
                'hero_title_gradient'=> 'Online Free',
                'hero_description'   => 'Change image dimensions by <strong class="text-gray-700">exact pixels, percentage, or preset sizes</strong> for social media, email, and print. Maintain aspect ratio or crop to fit.',
                'cta_icon'           => '↔️',
                'cta_title'          => 'Ready to Resize Your Images?',
                'cta_description'    => 'Upload your image and set your target dimensions. Supports JPG, PNG, and WebP.',
                'cta_button_text'    => 'Open Image Resizer',
                'cta_button_url'     => '/#resize',
                'cta_color'          => 'green',
                'schema_markup'      => [
                    '@context' => 'https://schema.org', '@type' => 'SoftwareApplication',
                    'name' => 'CompresslyPro Image Resizer',
                    'description' => 'Free online image resizer. Resize by exact pixels, percentage, or social media presets.',
                    'url' => 'https://compresslypro.com/tools/resize',
                    'applicationCategory' => 'MultimediaApplication', 'operatingSystem' => 'All', 'isAccessibleForFree' => true,
                    'offers' => ['@type' => 'Offer', 'price' => '0', 'priceCurrency' => 'USD'],
                ],
                'related_tools' => [
                    ['slug' => 'compress',       'emoji' => '🗜️', 'title' => 'Image Compressor', 'description' => 'Compress after resizing for best results'],
                    ['slug' => 'convert',        'emoji' => '🔄', 'title' => 'Image Converter',  'description' => 'Convert between JPG, PNG, WebP'],
                    ['slug' => 'batch-compress', 'emoji' => '📦', 'title' => 'Batch Compressor',  'description' => 'Process multiple images at once'],
                ],
                'related_posts' => [
                    ['slug' => 'best-image-formats-for-social-media',   'title' => 'Best Image Formats for Social Media 2025',     'description' => 'Exact dimensions for every major platform.'],
                    ['slug' => 'core-web-vitals-image-optimization',    'title' => 'Core Web Vitals & Image Optimisation',         'description' => 'How image size impacts your Google rankings.'],
                ],
                'sort_order' => 3,
            ],
            [
                'slug'               => 'batch-compress',
                'title'              => 'Free Batch Image Compressor Online — Compress Multiple Images at Once | CompresslyPro',
                'meta_description'   => 'Compress up to 20 images at once with our free batch image compressor. Download all as a ZIP file. Supports JPG, PNG, WebP. No signup required.',
                'og_title'           => 'Free Batch Image Compressor — Compress 20 Images at Once',
                'og_description'     => 'Compress up to 20 images simultaneously. Download as ZIP. Free batch compressor with no signup required.',
                'canonical_path'     => '/tools/batch-compress',
                'breadcrumb_label'   => 'Batch Compressor',
                'hero_badge'         => '📦 Free · Up to 20 Images · ZIP Download',
                'hero_badge_color'   => 'blue',
                'hero_title'         => 'Batch Compress Images',
                'hero_title_gradient'=> 'Online Free',
                'hero_description'   => 'Compress <strong class="text-gray-700">up to 20 images at once</strong> and download them all as a single ZIP file. Same powerful compression as our single-image tool, but for bulk workflows.',
                'cta_icon'           => '📦',
                'cta_title'          => 'Ready to Batch Compress?',
                'cta_description'    => 'Upload up to 20 images, set quality, and download a ZIP with all compressed files.',
                'cta_button_text'    => 'Open Batch Compressor',
                'cta_button_url'     => '/#batch',
                'cta_color'          => 'blue',
                'schema_markup'      => [
                    '@context' => 'https://schema.org', '@type' => 'SoftwareApplication',
                    'name' => 'CompresslyPro Batch Image Compressor',
                    'description' => 'Compress up to 20 images at once and download as ZIP.',
                    'url' => 'https://compresslypro.com/tools/batch-compress',
                    'applicationCategory' => 'MultimediaApplication', 'operatingSystem' => 'All', 'isAccessibleForFree' => true,
                    'offers' => ['@type' => 'Offer', 'price' => '0', 'priceCurrency' => 'USD'],
                ],
                'related_tools' => [
                    ['slug' => 'compress', 'emoji' => '🗜️', 'title' => 'Image Compressor', 'description' => 'Compress one image with precision controls'],
                    ['slug' => 'convert',  'emoji' => '🔄', 'title' => 'Image Converter',  'description' => 'Convert between JPG, PNG, WebP'],
                    ['slug' => 'resize',   'emoji' => '↔️', 'title' => 'Image Resizer',    'description' => 'Resize by pixels or percentage'],
                ],
                'related_posts' => [
                    ['slug' => 'batch-image-compression-workflow', 'title' => 'The Ultimate Batch Compression Workflow', 'description' => 'How to compress dozens of images and upload to WordPress.'],
                    ['slug' => 'how-to-compress-images-for-web',  'title' => 'Complete Guide to Image Compression',     'description' => 'Everything about formats, quality, and best practices.'],
                ],
                'sort_order' => 4,
            ],
            [
                'slug'               => 'watermark',
                'title'              => 'Free Add Watermark to Image Online — Text Watermark Tool | CompresslyPro',
                'meta_description'   => 'Add custom text watermarks to images online for free. Choose position, opacity, font size, and rotation. Protect your photos from unauthorised use. No signup required.',
                'og_title'           => 'Free Image Watermark Tool — Add Text Watermarks to Photos Online',
                'og_description'     => 'Add custom text watermarks to your images. Set position, opacity, font size and rotation. Free, no signup.',
                'canonical_path'     => '/tools/watermark',
                'breadcrumb_label'   => 'Watermark Tool',
                'hero_badge'         => '🖊️ Free · Custom Text · No Signup',
                'hero_badge_color'   => 'pink',
                'hero_title'         => 'Add Watermark to Images',
                'hero_title_gradient'=> 'Online Free',
                'hero_description'   => 'Protect your photos with <strong class="text-gray-700">custom text watermarks</strong>. Choose position, opacity, font size, font family, and rotation. Single or tiled watermark placement.',
                'cta_icon'           => '🖊️',
                'cta_title'          => 'Ready to Add a Watermark?',
                'cta_description'    => 'Upload your image, type your watermark text, and customise placement.',
                'cta_button_text'    => 'Open Watermark Tool',
                'cta_button_url'     => '/#tools',
                'cta_color'          => 'pink',
                'schema_markup'      => [
                    '@context' => 'https://schema.org', '@type' => 'SoftwareApplication',
                    'name' => 'CompresslyPro Watermark Tool',
                    'description' => 'Add custom text watermarks to images online for free.',
                    'url' => 'https://compresslypro.com/tools/watermark',
                    'applicationCategory' => 'MultimediaApplication', 'operatingSystem' => 'All', 'isAccessibleForFree' => true,
                    'offers' => ['@type' => 'Offer', 'price' => '0', 'priceCurrency' => 'USD'],
                ],
                'related_tools' => [
                    ['slug' => 'compress',     'emoji' => '🗜️', 'title' => 'Image Compressor', 'description' => 'Reduce image size up to 90%'],
                    ['slug' => 'resize',       'emoji' => '↔️', 'title' => 'Image Resizer',    'description' => 'Resize by pixels or percentage'],
                    ['slug' => 'image-to-pdf', 'emoji' => '📄', 'title' => 'Image to PDF',     'description' => 'Convert images to PDF documents'],
                ],
                'related_posts' => [
                    ['slug' => 'how-to-add-watermark-to-photos', 'title' => 'How to Add a Watermark to Photos',  'description' => 'Best practices for watermark placement, opacity, and protection.'],
                    ['slug' => 'image-seo-best-practices',       'title' => 'Image SEO Best Practices',          'description' => 'How to optimise images for search engines.'],
                ],
                'sort_order' => 5,
            ],
            [
                'slug'               => 'image-to-pdf',
                'title'              => 'Free Image to PDF Converter Online — JPG PNG WebP to PDF | CompresslyPro',
                'meta_description'   => 'Convert JPG, PNG, and WebP images to PDF documents online for free. Merge multiple images into a single PDF with custom page size and orientation. No signup required.',
                'og_title'           => 'Free Image to PDF Converter — Merge Multiple Images into One PDF',
                'og_description'     => 'Convert JPG, PNG, WebP images to PDF. Merge multiple images into one document. Free online tool.',
                'canonical_path'     => '/tools/image-to-pdf',
                'breadcrumb_label'   => 'Image to PDF',
                'hero_badge'         => '📄 Free · Multi-Image · No Signup',
                'hero_badge_color'   => 'amber',
                'hero_title'         => 'Convert Images to PDF',
                'hero_title_gradient'=> 'Online Free',
                'hero_description'   => 'Turn <strong class="text-gray-700">JPG, PNG, and WebP images</strong> into professional PDF documents. Merge multiple images into a single PDF with custom page size, orientation, and margins.',
                'cta_icon'           => '📄',
                'cta_title'          => 'Ready to Create a PDF?',
                'cta_description'    => 'Upload your images, choose page settings, and merge into a PDF.',
                'cta_button_text'    => 'Open Image to PDF Tool',
                'cta_button_url'     => '/#tools',
                'cta_color'          => 'amber',
                'schema_markup'      => [
                    '@context' => 'https://schema.org', '@type' => 'SoftwareApplication',
                    'name' => 'CompresslyPro Image to PDF Converter',
                    'description' => 'Convert JPG, PNG, and WebP images to PDF documents online for free.',
                    'url' => 'https://compresslypro.com/tools/image-to-pdf',
                    'applicationCategory' => 'MultimediaApplication', 'operatingSystem' => 'All', 'isAccessibleForFree' => true,
                    'offers' => ['@type' => 'Offer', 'price' => '0', 'priceCurrency' => 'USD'],
                ],
                'related_tools' => [
                    ['slug' => 'pdf-to-image', 'emoji' => '🖼️', 'title' => 'PDF to Image',      'description' => 'Extract images from PDF files'],
                    ['slug' => 'compress',     'emoji' => '🗜️', 'title' => 'Image Compressor',  'description' => 'Compress before converting to PDF'],
                    ['slug' => 'convert',      'emoji' => '🔄', 'title' => 'Image Converter',   'description' => 'Convert between JPG, PNG, WebP'],
                ],
                'related_posts' => [
                    ['slug' => 'convert-images-to-pdf-guide',    'title' => 'How to Convert Images to PDF',   'description' => 'Complete step-by-step guide with page size tips.'],
                    ['slug' => 'how-to-compress-images-for-web', 'title' => 'Image Compression Guide',        'description' => 'Compress images before adding to PDF.'],
                ],
                'sort_order' => 6,
            ],
            [
                'slug'               => 'pdf-to-image',
                'title'              => 'Free PDF to Image Converter Online — PDF to JPG PNG WebP | CompresslyPro',
                'meta_description'   => 'Convert PDF pages to JPG, PNG, or WebP images online for free. Extract every page from your PDF as high-quality images. No signup or software installation required.',
                'og_title'           => 'Free PDF to Image Converter — Extract PDF Pages as JPG, PNG, WebP',
                'og_description'     => 'Convert PDF pages to high-quality JPG, PNG, or WebP images. Free online tool with no signup required.',
                'canonical_path'     => '/tools/pdf-to-image',
                'breadcrumb_label'   => 'PDF to Image',
                'hero_badge'         => '🖼️ Free · All Pages · No Signup',
                'hero_badge_color'   => 'red',
                'hero_title'         => 'Convert PDF to Images',
                'hero_title_gradient'=> 'Online Free',
                'hero_description'   => 'Extract every page from your PDF as <strong class="text-gray-700">high-quality JPG, PNG, or WebP images</strong>. Choose output format, DPI, and download all pages as individual images.',
                'cta_icon'           => '🖼️',
                'cta_title'          => 'Ready to Extract PDF Pages?',
                'cta_description'    => 'Upload your PDF and convert each page to high-quality images.',
                'cta_button_text'    => 'Open PDF to Image Tool',
                'cta_button_url'     => '/#tools',
                'cta_color'          => 'red',
                'schema_markup'      => [
                    '@context' => 'https://schema.org', '@type' => 'SoftwareApplication',
                    'name' => 'CompresslyPro PDF to Image Converter',
                    'description' => 'Convert PDF pages to JPG, PNG, or WebP images online for free.',
                    'url' => 'https://compresslypro.com/tools/pdf-to-image',
                    'applicationCategory' => 'MultimediaApplication', 'operatingSystem' => 'All', 'isAccessibleForFree' => true,
                    'offers' => ['@type' => 'Offer', 'price' => '0', 'priceCurrency' => 'USD'],
                ],
                'related_tools' => [
                    ['slug' => 'image-to-pdf', 'emoji' => '📄', 'title' => 'Image to PDF',      'description' => 'Convert images to PDF documents'],
                    ['slug' => 'convert',      'emoji' => '🔄', 'title' => 'Image Converter',   'description' => 'Convert between JPG, PNG, WebP'],
                    ['slug' => 'compress',     'emoji' => '🗜️', 'title' => 'Image Compressor',  'description' => 'Reduce image file size'],
                ],
                'related_posts' => [
                    ['slug' => 'convert-images-to-pdf-guide', 'title' => 'Convert Images to PDF Guide', 'description' => 'Complete guide to image-PDF conversions.'],
                    ['slug' => 'webp-vs-jpg-vs-png',          'title' => 'WebP vs JPG vs PNG',           'description' => 'Which output format to choose.'],
                ],
                'sort_order' => 7,
            ],
        ];

        foreach ($tools as $data) {
            $data['type'] = 'tool';
            $data['body'] = $this->extractProseBody(resource_path("views/tools/{$data['slug']}.blade.php"));
            Page::updateOrCreate(['slug' => $data['slug']], $data);
        }

        // ──────────────────────────────────────────────────────
        //  BLOG POSTS
        // ──────────────────────────────────────────────────────

        $blogs = [
            [
                'slug'             => 'how-to-compress-images-for-web',
                'title'            => 'How to Compress Images for the Web — Complete 2026 Guide | CompresslyPro',
                'meta_description' => 'Learn how to compress images for websites in 2026. Covers format selection, quality settings, Core Web Vitals, lazy loading, and step-by-step compression techniques for faster page loads.',
                'og_title'         => 'The Complete Guide to Image Compression for the Web (2026)',
                'og_description'   => 'Everything you need to know about compressing images for websites — formats, quality settings, Core Web Vitals, and practical step-by-step techniques.',
                'canonical_path'   => '/blog/how-to-compress-images-for-web',
                'breadcrumb_label' => 'Image Compression Guide',
                'hero_title'       => 'The Complete Guide to Image Compression for the Web in 2026',
                'hero_description' => 'Everything you need to know about compressing images for websites — from choosing the right format and quality settings to advanced techniques for Core Web Vitals optimisation. Practical, step-by-step advice with real examples.',
                'category'         => 'Compression, Web Performance',
                'category_color'   => 'brand',
                'published_at'     => '2026-03-10',
                'read_time'        => '12 min read',
                'is_featured'      => true,
                'excerpt'          => 'Everything you need to know about compressing images for websites — from choosing the right format and quality settings to advanced techniques.',
                'listing_emoji'    => '📚',
                'schema_markup'    => ['@context'=>'https://schema.org','@type'=>'Article','headline'=>'The Complete Guide to Image Compression for the Web in 2026','author'=>['@type'=>'Organization','name'=>'CompresslyPro'],'publisher'=>['@type'=>'Organization','name'=>'CompresslyPro','url'=>'https://compresslypro.com'],'datePublished'=>'2026-03-10','dateModified'=>'2026-03-12','url'=>'https://compresslypro.com/blog/how-to-compress-images-for-web'],
                'sort_order'       => 1,
            ],
            [
                'slug'             => 'webp-vs-jpg-vs-png',
                'title'            => 'WebP vs JPG vs PNG: Which Image Format Should You Use in 2026? | CompresslyPro',
                'meta_description' => 'Detailed comparison of WebP, JPG, and PNG image formats. Learn which format delivers the best quality-to-size ratio for your specific use case.',
                'og_title'         => 'WebP vs JPG vs PNG — The Definitive Image Format Comparison',
                'og_description'   => 'Which image format is best? We compare WebP, JPG, and PNG for web, email, and print use.',
                'canonical_path'   => '/blog/webp-vs-jpg-vs-png',
                'breadcrumb_label' => 'WebP vs JPG vs PNG',
                'hero_title'       => 'WebP vs JPG vs PNG: Which Image Format Should You Use?',
                'hero_description' => 'A detailed comparison of the three most popular web image formats — with recommendations for every use case.',
                'category'         => 'Formats',
                'category_color'   => 'purple',
                'published_at'     => '2026-03-08',
                'read_time'        => '9 min read',
                'excerpt'          => 'A detailed comparison of the three most popular web image formats — with recommendations for every use case.',
                'listing_emoji'    => '🖼️',
                'schema_markup'    => ['@context'=>'https://schema.org','@type'=>'Article','headline'=>'WebP vs JPG vs PNG: Which Image Format Should You Use?','author'=>['@type'=>'Organization','name'=>'CompresslyPro'],'publisher'=>['@type'=>'Organization','name'=>'CompresslyPro','url'=>'https://compresslypro.com'],'datePublished'=>'2026-03-08','url'=>'https://compresslypro.com/blog/webp-vs-jpg-vs-png'],
                'sort_order'       => 2,
            ],
            [
                'slug'             => 'image-seo-best-practices',
                'title'            => 'Image SEO Best Practices: How to Rank Images in Google | CompresslyPro',
                'meta_description' => 'Learn how to optimise your images for search engines — from file names and alt text to lazy loading and structured data.',
                'og_title'         => 'Image SEO Best Practices — Rank Your Images in Google',
                'og_description'   => 'Complete guide to image SEO: file names, alt text, lazy loading, structured data, and more.',
                'canonical_path'   => '/blog/image-seo-best-practices',
                'breadcrumb_label' => 'Image SEO Best Practices',
                'hero_title'       => 'Image SEO Best Practices: How to Rank Images in Google',
                'hero_description' => 'Learn how to optimise your images for search engines — from file names and alt text to lazy loading and structured data.',
                'category'         => 'SEO',
                'category_color'   => 'green',
                'published_at'     => '2026-03-05',
                'read_time'        => '10 min read',
                'excerpt'          => 'Learn how to optimise your images for search engines — from file names and alt text to lazy loading and structured data.',
                'listing_emoji'    => '🔍',
                'schema_markup'    => ['@context'=>'https://schema.org','@type'=>'Article','headline'=>'Image SEO Best Practices: How to Rank Images in Google','author'=>['@type'=>'Organization','name'=>'CompresslyPro'],'publisher'=>['@type'=>'Organization','name'=>'CompresslyPro','url'=>'https://compresslypro.com'],'datePublished'=>'2026-03-05','url'=>'https://compresslypro.com/blog/image-seo-best-practices'],
                'sort_order'       => 3,
            ],
            [
                'slug'             => 'reduce-image-size-for-email',
                'title'            => 'How to Reduce Image Size for Email Attachments | CompresslyPro',
                'meta_description' => 'Step-by-step guide to compressing photos for email — with specific settings for Gmail, Outlook, and other providers.',
                'og_title'         => 'Reduce Image Size for Email — Complete Guide',
                'og_description'   => 'Compress photos for email with specific settings for Gmail, Outlook, and more.',
                'canonical_path'   => '/blog/reduce-image-size-for-email',
                'breadcrumb_label' => 'Reduce Image Size for Email',
                'hero_title'       => 'How to Reduce Image Size for Email Attachments',
                'hero_description' => 'Step-by-step guide to compressing photos for email — with specific settings for Gmail, Outlook, and other providers.',
                'category'         => 'Practical',
                'category_color'   => 'orange',
                'published_at'     => '2026-03-01',
                'read_time'        => '6 min read',
                'excerpt'          => 'Step-by-step guide to compressing photos for email — with specific settings for Gmail, Outlook, and other providers.',
                'listing_emoji'    => '📧',
                'schema_markup'    => ['@context'=>'https://schema.org','@type'=>'Article','headline'=>'How to Reduce Image Size for Email Attachments','author'=>['@type'=>'Organization','name'=>'CompresslyPro'],'publisher'=>['@type'=>'Organization','name'=>'CompresslyPro','url'=>'https://compresslypro.com'],'datePublished'=>'2026-03-01','url'=>'https://compresslypro.com/blog/reduce-image-size-for-email'],
                'sort_order'       => 4,
            ],
            [
                'slug'             => 'core-web-vitals-image-optimization',
                'title'            => 'Core Web Vitals: How Images Impact Your Google Rankings | CompresslyPro',
                'meta_description' => 'Understand LCP, CLS, and INP — and learn exactly how image optimisation can boost your PageSpeed scores.',
                'og_title'         => 'Core Web Vitals & Image Optimisation',
                'og_description'   => 'How images impact LCP, CLS, INP and your Google rankings. Practical optimisation techniques.',
                'canonical_path'   => '/blog/core-web-vitals-image-optimization',
                'breadcrumb_label' => 'Core Web Vitals & Images',
                'hero_title'       => 'Core Web Vitals: How Images Impact Your Google Rankings',
                'hero_description' => 'Understand LCP, CLS, and INP — and learn exactly how image optimisation can boost your PageSpeed scores.',
                'category'         => 'Performance',
                'category_color'   => 'pink',
                'published_at'     => '2026-02-25',
                'read_time'        => '11 min read',
                'excerpt'          => 'Understand LCP, CLS, and INP — and learn exactly how image optimisation can boost your PageSpeed scores.',
                'listing_emoji'    => '⚡',
                'schema_markup'    => ['@context'=>'https://schema.org','@type'=>'Article','headline'=>'Core Web Vitals: How Images Impact Your Google Rankings','author'=>['@type'=>'Organization','name'=>'CompresslyPro'],'publisher'=>['@type'=>'Organization','name'=>'CompresslyPro','url'=>'https://compresslypro.com'],'datePublished'=>'2026-02-25','url'=>'https://compresslypro.com/blog/core-web-vitals-image-optimization'],
                'sort_order'       => 5,
            ],
            [
                'slug'             => 'batch-image-compression-workflow',
                'title'            => 'The Ultimate Batch Image Compression Workflow for Bloggers | CompresslyPro',
                'meta_description' => 'How to compress dozens of blog images at once, download as ZIP, and upload to WordPress in minutes.',
                'og_title'         => 'Batch Image Compression Workflow for Bloggers',
                'og_description'   => 'Compress dozens of images at once and upload to WordPress in minutes.',
                'canonical_path'   => '/blog/batch-image-compression-workflow',
                'breadcrumb_label' => 'Batch Compression Workflow',
                'hero_title'       => 'The Ultimate Batch Image Compression Workflow for Bloggers',
                'hero_description' => 'How to compress dozens of blog images at once, download as ZIP, and upload to WordPress in minutes.',
                'category'         => 'Workflow',
                'category_color'   => 'blue',
                'published_at'     => '2026-02-20',
                'read_time'        => '7 min read',
                'excerpt'          => 'How to compress dozens of blog images at once, download as ZIP, and upload to WordPress in minutes.',
                'listing_emoji'    => '📦',
                'schema_markup'    => ['@context'=>'https://schema.org','@type'=>'Article','headline'=>'The Ultimate Batch Image Compression Workflow for Bloggers','author'=>['@type'=>'Organization','name'=>'CompresslyPro'],'publisher'=>['@type'=>'Organization','name'=>'CompresslyPro','url'=>'https://compresslypro.com'],'datePublished'=>'2026-02-20','url'=>'https://compresslypro.com/blog/batch-image-compression-workflow'],
                'sort_order'       => 6,
            ],
            [
                'slug'             => 'best-image-formats-for-social-media',
                'title'            => 'Best Image Formats for Social Media in 2025 — Complete Size Guide | CompresslyPro',
                'meta_description' => 'Learn the best image formats and exact dimensions for Facebook, Instagram, Twitter/X, LinkedIn, and Pinterest in 2025.',
                'og_title'         => 'Best Image Formats for Social Media in 2025 — Complete Size Guide',
                'og_description'   => 'Exact image dimensions and formats for every major social media platform. Updated for 2025.',
                'canonical_path'   => '/blog/best-image-formats-for-social-media',
                'breadcrumb_label' => 'Social Media Image Formats',
                'hero_title'       => 'Best Image Formats for Social Media in 2025 — Complete Size Guide',
                'hero_description' => 'Every social media platform has different image size requirements. This guide covers exact sizes and recommended formats for every major platform.',
                'category'         => 'Social Media',
                'category_color'   => 'cyan',
                'published_at'     => '2025-03-15',
                'read_time'        => '12 min read',
                'excerpt'          => 'Exact image dimensions and recommended formats for Facebook, Instagram, Twitter/X, LinkedIn, and Pinterest.',
                'listing_emoji'    => '📱',
                'schema_markup'    => ['@context'=>'https://schema.org','@type'=>'Article','headline'=>'Best Image Formats for Social Media in 2025','author'=>['@type'=>'Organization','name'=>'CompresslyPro'],'publisher'=>['@type'=>'Organization','name'=>'CompresslyPro','url'=>'https://compresslypro.com'],'datePublished'=>'2025-03-15','url'=>'https://compresslypro.com/blog/best-image-formats-for-social-media'],
                'sort_order'       => 7,
            ],
            [
                'slug'             => 'how-to-add-watermark-to-photos',
                'title'            => 'How to Add a Watermark to Photos — Protect Your Images Online | CompresslyPro',
                'meta_description' => 'Learn how to add text watermarks to your photos to protect them from theft. Step-by-step guide with best practices.',
                'og_title'         => 'How to Add a Watermark to Photos — Protect Your Images Online',
                'og_description'   => 'Step-by-step guide to watermarking photos. Best practices for placement, opacity, and protection.',
                'canonical_path'   => '/blog/how-to-add-watermark-to-photos',
                'breadcrumb_label' => 'How to Add a Watermark',
                'hero_title'       => 'How to Add a Watermark to Photos — Protect Your Images Online',
                'hero_description' => 'Image theft is rampant on the internet. Adding a watermark is one of the most effective ways to protect your work and build brand recognition.',
                'category'         => 'Protection',
                'category_color'   => 'rose',
                'published_at'     => '2025-03-18',
                'read_time'        => '9 min read',
                'excerpt'          => 'Step-by-step guide to watermarking your photos. Best practices for placement, opacity, and protection levels.',
                'listing_emoji'    => '🖊️',
                'schema_markup'    => ['@context'=>'https://schema.org','@type'=>'Article','headline'=>'How to Add a Watermark to Photos','author'=>['@type'=>'Organization','name'=>'CompresslyPro'],'publisher'=>['@type'=>'Organization','name'=>'CompresslyPro','url'=>'https://compresslypro.com'],'datePublished'=>'2025-03-18','url'=>'https://compresslypro.com/blog/how-to-add-watermark-to-photos'],
                'sort_order'       => 8,
            ],
            [
                'slug'             => 'optimize-images-for-wordpress',
                'title'            => 'How to Optimise Images for WordPress — Speed Up Your Website | CompresslyPro',
                'meta_description' => 'Complete guide to optimising images for WordPress. Reduce page load times, improve Core Web Vitals, and boost SEO.',
                'og_title'         => 'How to Optimise Images for WordPress — Speed Up Your Website',
                'og_description'   => 'Reduce WordPress page load times by optimising images. Compress, resize, and convert to WebP.',
                'canonical_path'   => '/blog/optimize-images-for-wordpress',
                'breadcrumb_label' => 'Optimise Images for WordPress',
                'hero_title'       => 'How to Optimise Images for WordPress — Speed Up Your Website',
                'hero_description' => 'Images are typically the heaviest assets on a WordPress site. Properly optimised images can cut your page load time in half.',
                'category'         => 'WordPress',
                'category_color'   => 'indigo',
                'published_at'     => '2025-03-20',
                'read_time'        => '11 min read',
                'excerpt'          => 'Complete guide to WordPress image optimisation. Reduce load times, improve Core Web Vitals, and boost SEO.',
                'listing_emoji'    => '🌐',
                'schema_markup'    => ['@context'=>'https://schema.org','@type'=>'Article','headline'=>'How to Optimise Images for WordPress','author'=>['@type'=>'Organization','name'=>'CompresslyPro'],'publisher'=>['@type'=>'Organization','name'=>'CompresslyPro','url'=>'https://compresslypro.com'],'datePublished'=>'2025-03-20','url'=>'https://compresslypro.com/blog/optimize-images-for-wordpress'],
                'sort_order'       => 9,
            ],
            [
                'slug'             => 'convert-images-to-pdf-guide',
                'title'            => 'How to Convert Images to PDF — Complete Step-by-Step Guide | CompresslyPro',
                'meta_description' => 'Learn how to convert single or multiple images (JPG, PNG, WebP) to PDF documents. Choose page sizes, orientation, and merge multiple images.',
                'og_title'         => 'How to Convert Images to PDF — Complete Step-by-Step Guide',
                'og_description'   => 'Convert JPG, PNG, and WebP images to PDF documents. Merge multiple images into one PDF.',
                'canonical_path'   => '/blog/convert-images-to-pdf-guide',
                'breadcrumb_label' => 'Convert Images to PDF Guide',
                'hero_title'       => 'How to Convert Images to PDF — Complete Step-by-Step Guide',
                'hero_description' => 'Need to convert photos or screenshots into a PDF document? This guide covers everything from single images to multi-page document creation.',
                'category'         => 'Conversion',
                'category_color'   => 'amber',
                'published_at'     => '2025-03-22',
                'read_time'        => '8 min read',
                'excerpt'          => 'Convert JPG, PNG, and WebP images to PDF documents. Merge multiple images with custom page settings.',
                'listing_emoji'    => '📄',
                'schema_markup'    => ['@context'=>'https://schema.org','@type'=>'Article','headline'=>'How to Convert Images to PDF','author'=>['@type'=>'Organization','name'=>'CompresslyPro'],'publisher'=>['@type'=>'Organization','name'=>'CompresslyPro','url'=>'https://compresslypro.com'],'datePublished'=>'2025-03-22','url'=>'https://compresslypro.com/blog/convert-images-to-pdf-guide'],
                'sort_order'       => 10,
            ],
        ];

        foreach ($blogs as $data) {
            $data['type'] = 'blog';
            $data['body'] = $this->extractProseBody(resource_path("views/blog/{$data['slug']}.blade.php"));
            Page::updateOrCreate(['slug' => $data['slug']], $data);
        }

        // ──────────────────────────────────────────────────────
        //  STATIC PAGES (about, contact)
        // ──────────────────────────────────────────────────────

        $pages = [
            [
                'slug'               => 'about',
                'title'              => 'About Us — CompresslyPro | Free Online Image Compression & Editing Tools',
                'meta_description'   => 'Learn about CompresslyPro — who we are, our mission to make image optimisation accessible to everyone, and why millions of users trust our free online tools.',
                'og_title'           => 'About CompresslyPro — Our Mission & Story',
                'og_description'     => 'CompresslyPro provides 7 free online image tools used by millions. Learn about our mission, team, and commitment to privacy-first image processing.',
                'canonical_path'     => '/about',
                'breadcrumb_label'   => 'About Us',
                'hero_badge'         => 'About Us',
                'hero_badge_color'   => 'brand',
                'hero_title'         => 'About',
                'hero_title_gradient'=> 'CompresslyPro',
                'hero_description'   => 'We believe image optimisation should be free, fast, and private. That\'s why we built CompresslyPro — a suite of 7 professional-grade image tools that anyone can use without signing up.',
                'schema_markup'      => ['@context'=>'https://schema.org','@type'=>'AboutPage','name'=>'About CompresslyPro','description'=>'Learn about CompresslyPro\'s mission.','url'=>'https://compresslypro.com/about','mainEntity'=>['@type'=>'Organization','name'=>'CompresslyPro','url'=>'https://compresslypro.com','foundingDate'=>'2024','logo'=>'https://compresslypro.com/logo.png']],
                'sort_order'         => 1,
            ],
            [
                'slug'               => 'contact',
                'title'              => 'Contact Us — CompresslyPro | Get Help & Support',
                'meta_description'   => 'Contact the CompresslyPro team for support, feedback, or business enquiries. We respond to every message within 24 hours.',
                'og_title'           => 'Contact CompresslyPro — Support & Feedback',
                'og_description'     => 'Have a question about CompresslyPro? Contact our team for support, feature requests, or business enquiries.',
                'canonical_path'     => '/contact',
                'breadcrumb_label'   => 'Contact Us',
                'hero_badge'         => 'Get in Touch',
                'hero_badge_color'   => 'brand',
                'hero_title'         => 'Contact',
                'hero_title_gradient'=> 'Us',
                'hero_description'   => 'Have a question, feature request, or found a bug? We\'d love to hear from you. Our team reads and responds to every message.',
                'schema_markup'      => ['@context'=>'https://schema.org','@type'=>'ContactPage','name'=>'Contact CompresslyPro','url'=>'https://compresslypro.com/contact','mainEntity'=>['@type'=>'Organization','name'=>'CompresslyPro','url'=>'https://compresslypro.com','email'=>'support@compresslypro.com']],
                'sort_order'         => 2,
            ],
        ];

        foreach ($pages as $data) {
            $data['type'] = 'page';
            $data['body'] = $this->extractProseBody(resource_path("views/pages/{$data['slug']}.blade.php"));
            Page::updateOrCreate(['slug' => $data['slug']], $data);
        }

        $this->command->info('✅ Seeded ' . Page::count() . ' pages (tools, blog posts, pages).');
    }

    /**
     * Extract the prose body HTML from an existing Blade file.
     */
    private function extractProseBody(string $path): string
    {
        if (! File::exists($path)) {
            return '';
        }

        $content = File::get($path);

        // Try to grab <div class="prose max-w-none">…</div>
        if (preg_match('/<div class="prose max-w-none">(.*?)<\/div>\s*<\/div>/s', $content, $m)) {
            return trim($m[1]);
        }

        // Fallback: grab the @section('content') block
        if (preg_match("/@section\('content'\)\s*(.*?)\s*@endsection/s", $content, $m)) {
            $html = trim($m[1]);
            $html = preg_replace('/@(extends|section|endsection|verbatim|endverbatim)\b[^\n]*/', '', $html);
            return trim($html);
        }

        return '';
    }
}
