<?php

namespace Database\Seeders;

use App\Models\BlogPost;
use Illuminate\Database\Seeder;

class BlogPostSeeder extends Seeder
{
    public function run(): void
    {
        $posts = $this->posts();

        foreach ($posts as $post) {
            $existing = BlogPost::where('slug', $post['slug'])->first();
            if ($existing) {
                $existing->fill($post)->save();
            } else {
                BlogPost::create($post);
            }
        }

        $this->command->info('Seeded ' . count($posts) . ' blog posts.');
    }

    private function posts(): array
    {
        return [

            // ── 1 ────────────────────────────────────────────────────────────
            [
                'title'            => 'The Complete Guide to Image Compression for the Web in 2026',
                'slug'             => 'how-to-compress-images-for-web',
                'excerpt'          => 'Images account for nearly 50% of the average web page\'s total weight. Compressing them properly is the single most impactful thing you can do to improve your website\'s speed, SEO rankings, and user experience.',
                'content'          => <<<'HTML'
<h2>Why Image Compression Matters in 2026</h2>
<p>According to the HTTP Archive, images represent roughly 42% of the average web page's total transfer size as of early 2026. For media-heavy sites — blogs, portfolios, e-commerce stores — that number can climb above 70%. This matters because:</p>
<ul>
    <li><strong>Page speed directly impacts SEO.</strong> Google has confirmed that page speed is a ranking factor, and Core Web Vitals (CWV) are a key part of the page experience signal. The Largest Contentful Paint (LCP) metric — which often measures an image — should be under 2.5 seconds for a "good" score.</li>
    <li><strong>Users abandon slow pages.</strong> Research from Google shows that as page load time increases from 1 to 3 seconds, the probability of bounce increases by 32%. At 5 seconds, it jumps to 90%.</li>
    <li><strong>Bandwidth costs money.</strong> If you're serving 100,000 page views per month with an average of 2MB of images per page, that's 200GB of image bandwidth. Compressing images by 60% saves 120GB — and often reduces hosting costs significantly.</li>
    <li><strong>Mobile users are the majority.</strong> Over 60% of web traffic comes from mobile devices, many on limited or metered data connections. Smaller images mean a better experience for everyone.</li>
</ul>

<h2>Step 1: Choose the Right Image Format</h2>
<p>Before you even think about compression quality, selecting the correct format can cut file size dramatically. Here's a practical decision tree:</p>
<table>
    <thead><tr><th>Image Type</th><th>Best Format</th><th>Why</th></tr></thead>
    <tbody>
        <tr><td>Photographs</td><td><strong>WebP</strong> (or JPEG fallback)</td><td>WebP is 25–35% smaller than JPEG at equivalent quality. All modern browsers support it.</td></tr>
        <tr><td>Screenshots &amp; UI graphics</td><td><strong>PNG</strong> (or WebP)</td><td>PNG preserves sharp edges and text. WebP with lossless compression is even smaller.</td></tr>
        <tr><td>Graphics with transparency</td><td><strong>PNG</strong> or <strong>WebP</strong></td><td>Both support alpha transparency. WebP files are typically 26% smaller than equivalent PNGs.</td></tr>
        <tr><td>Simple animations</td><td><strong>GIF</strong> or <strong>WebP animated</strong></td><td>Animated WebP can be significantly smaller than GIF while supporting more colours.</td></tr>
        <tr><td>Icons and logos</td><td><strong>SVG</strong></td><td>Vector format that scales to any size without quality loss.</td></tr>
    </tbody>
</table>
<blockquote><strong>Pro tip:</strong> If your audience uses modern browsers (2020+), default to WebP for everything. Use our <a href="/convert">Image Converter</a> to batch convert existing JPEG/PNG assets to WebP instantly.</blockquote>

<h2>Step 2: Resize Images to Display Dimensions</h2>
<p>This is the most commonly overlooked optimisation. Many websites serve a 4000×3000px photo from a camera and let CSS scale it down to 800×600px on screen. The browser still downloads all 12 million pixels — even though it only needs 480,000.</p>
<p><strong>Rule of thumb:</strong> resize images to no more than 2× their display dimensions (for Retina/HiDPI screens). If an image displays at 800px wide, resize it to 1600px wide maximum. This alone can reduce file size by 75% or more.</p>
<p>Use our <a href="/resize">Image Resizer</a> to quickly resize images by percentage, max width, max height, or exact pixel dimensions before compressing.</p>

<h2>Step 3: Choose the Right Compression Quality</h2>
<p>Quality settings represent a trade-off between file size and visual fidelity. Here are practical guidelines:</p>
<table>
    <thead><tr><th>Use Case</th><th>Recommended Quality</th><th>Typical Reduction</th></tr></thead>
    <tbody>
        <tr><td>Hero images / above the fold</td><td>70–80%</td><td>40–60%</td></tr>
        <tr><td>Blog post images</td><td>60–70%</td><td>55–70%</td></tr>
        <tr><td>Thumbnails &amp; cards</td><td>50–60%</td><td>65–80%</td></tr>
        <tr><td>Email attachments</td><td>50–60%</td><td>60–75%</td></tr>
        <tr><td>Maximum compression</td><td>30–40%</td><td>80–90%</td></tr>
        <tr><td>Print / archival</td><td>85–90%</td><td>20–35%</td></tr>
    </tbody>
</table>
<p>The sweet spot for most web images is <strong>60–70% quality</strong>. Our <a href="/compress">Image Compressor</a> includes a before/after comparison slider so you can verify quality before downloading.</p>

<h2>Step 4: Implement Lazy Loading</h2>
<p>Even after compressing all your images, you shouldn't load them all at once. Lazy loading defers the loading of off-screen images until the user scrolls near them.</p>
<p><code>&lt;img src="photo.webp" loading="lazy" alt="Description" width="800" height="600"&gt;</code></p>
<p><strong>Important:</strong> Do NOT lazy-load your LCP image (usually the hero image or first visible image). That image should load eagerly with <code>fetchpriority="high"</code> for the best CWV scores.</p>

<h2>Step 5: Serve Responsive Images</h2>
<p>Use the HTML <code>&lt;picture&gt;</code> element or <code>srcset</code> attribute to serve different image sizes to different screen sizes:</p>
<p><code>&lt;img srcset="photo-400.webp 400w, photo-800.webp 800w, photo-1200.webp 1200w" sizes="(max-width: 600px) 400px, (max-width: 1024px) 800px, 1200px" src="photo-800.webp" alt="Description"&gt;</code></p>

<h2>Step 6: Always Specify Width and Height</h2>
<p>Adding explicit <code>width</code> and <code>height</code> attributes to every <code>&lt;img&gt;</code> tag allows the browser to reserve space before the image loads. This prevents layout shifts (CLS — Cumulative Layout Shift), which is another Core Web Vitals metric.</p>

<h2>Step 7: Use a CDN for Image Delivery</h2>
<p>A Content Delivery Network (CDN) serves your images from edge servers geographically close to each visitor. Popular options include Cloudflare, AWS CloudFront, and Bunny CDN.</p>

<h2>Putting It All Together: A Practical Checklist</h2>
<ol>
    <li>✅ Resize images to display dimensions (2× for Retina)</li>
    <li>✅ Convert to WebP format where possible</li>
    <li>✅ Compress at 60–70% quality for web content</li>
    <li>✅ Use the before/after slider to verify quality</li>
    <li>✅ Add <code>loading="lazy"</code> to off-screen images</li>
    <li>✅ Add <code>fetchpriority="high"</code> to your LCP image</li>
    <li>✅ Always include <code>width</code> and <code>height</code> attributes</li>
    <li>✅ Use responsive images with <code>srcset</code></li>
    <li>✅ Add descriptive, keyword-rich <code>alt</code> text</li>
    <li>✅ Serve images through a CDN</li>
</ol>

<h2>Start Compressing Your Images Now</h2>
<p>Ready to put this guide into practice? Head to our <a href="/compress">Image Compressor</a> to compress individual images, or use the <a href="/batch-compress">Batch Compressor</a> to process up to 20 images at once. Both tools are completely free — no signup required.</p>
HTML,
                'meta_title'       => 'How to Compress Images for the Web — Complete 2026 Guide | CompresslyPro',
                'meta_description' => 'Learn how to compress images for websites in 2026. Covers format selection, quality settings, Core Web Vitals, lazy loading, and step-by-step compression techniques for faster page loads.',
                'meta_keywords'    => 'how to compress images for web, image compression guide, reduce image file size website, image optimization web performance, compress photos for website',
                'og_title'         => 'The Complete Guide to Image Compression for the Web (2026)',
                'og_description'   => 'Everything you need to know about compressing images for websites — formats, quality settings, Core Web Vitals, and practical step-by-step techniques.',
                'category'         => 'Compression',
                'tags'             => ['Compression', 'Web Performance', 'WebP'],
                'read_time'        => 12,
                'word_count'       => 2100,
                'schema_keywords'  => 'image compression, web performance, Core Web Vitals, WebP, image optimization',
                'date_published'   => '2026-03-10',
                'date_modified'    => '2026-04-15',
                'is_published'     => true,
                'is_featured'      => true,
                'sort_order'       => 1,
            ],

            // ── 2 ────────────────────────────────────────────────────────────
            [
                'title'            => 'WebP vs JPG vs PNG: Which Image Format Should You Use in 2026?',
                'slug'             => 'webp-vs-jpg-vs-png',
                'excerpt'          => 'Choosing the right image format can make the difference between a fast, visually sharp website and a sluggish one. This guide breaks down WebP, JPEG, and PNG with real-world data and practical advice.',
                'content'          => <<<'HTML'
<h2>Quick Comparison Table</h2>
<table>
    <thead><tr><th>Feature</th><th>JPEG / JPG</th><th>PNG</th><th>WebP</th></tr></thead>
    <tbody>
        <tr><td>Compression type</td><td>Lossy</td><td>Lossless</td><td>Both lossy &amp; lossless</td></tr>
        <tr><td>Transparency</td><td>❌ No</td><td>✅ Yes (alpha channel)</td><td>✅ Yes (alpha channel)</td></tr>
        <tr><td>Animation</td><td>❌ No</td><td>❌ No (APNG exists but rare)</td><td>✅ Yes</td></tr>
        <tr><td>Colour depth</td><td>24-bit (16.7M colours)</td><td>Up to 48-bit</td><td>24-bit (lossy), 32-bit (lossless)</td></tr>
        <tr><td>Browser support</td><td>Universal</td><td>Universal</td><td>97%+ (all modern browsers)</td></tr>
        <tr><td>Best for</td><td>Photos, hero images</td><td>Graphics, screenshots, transparency</td><td>Everything (best overall balance)</td></tr>
        <tr><td>Typical file size</td><td>Medium</td><td>Large</td><td>Smallest</td></tr>
    </tbody>
</table>

<h2>JPEG (JPG): The Photography Standard</h2>
<p>JPEG has been the web's default photograph format since the 1990s. It uses lossy compression, meaning it permanently discards some image data to achieve smaller file sizes.</p>
<h3>Strengths of JPEG</h3>
<ul>
    <li><strong>Universal compatibility.</strong> Every browser, device, email client, and image viewer supports JPEG.</li>
    <li><strong>Excellent for photographs.</strong> JPEG's compression algorithm is specifically designed for photographic content with smooth gradients.</li>
    <li><strong>Adjustable quality.</strong> You can fine-tune the quality/size trade-off from 1–100.</li>
    <li><strong>Progressive loading.</strong> Progressive JPEGs render a blurry version first, then sharpen as more data loads.</li>
</ul>
<h3>Weaknesses of JPEG</h3>
<ul>
    <li><strong>No transparency.</strong> JPEG does not support alpha channels.</li>
    <li><strong>Visible artifacts at high compression.</strong> Below 50% quality, JPEG shows noticeable blocking and banding artifacts.</li>
    <li><strong>Larger than WebP.</strong> At equivalent visual quality, JPEG files are typically 25–35% larger than WebP.</li>
    <li><strong>Quality degrades with re-saving.</strong> Each time a JPEG is opened and re-saved, quality degrades further (generation loss).</li>
</ul>

<h2>PNG: The Lossless Standard</h2>
<p>PNG uses lossless compression, meaning no image data is lost during compression. The file you get is pixel-perfect identical to the original.</p>
<h3>Strengths of PNG</h3>
<ul>
    <li><strong>Lossless quality.</strong> No compression artifacts whatsoever. Every pixel is preserved exactly as the original.</li>
    <li><strong>Full transparency support.</strong> PNG supports 256 levels of transparency per pixel (alpha channel).</li>
    <li><strong>Excellent for sharp-edged content.</strong> Screenshots, diagrams, text overlays, UI elements, and logos look crisp.</li>
    <li><strong>No generation loss.</strong> You can open, edit, and re-save a PNG any number of times without quality degradation.</li>
</ul>
<h3>Weaknesses of PNG</h3>
<ul>
    <li><strong>Large file sizes.</strong> A PNG photograph can easily be 5–10× larger than the equivalent JPEG or WebP.</li>
    <li><strong>No native animation.</strong> While APNG exists, browser support and tooling are limited.</li>
</ul>

<h2>WebP: The Modern All-Rounder</h2>
<p>WebP was developed by Google and released in 2010. It supports both lossy and lossless compression, transparency, and animation — combining the best features of JPEG, PNG, and GIF into a single format.</p>
<h3>Strengths of WebP</h3>
<ul>
    <li><strong>Smallest file sizes.</strong> Lossy WebP is 25–34% smaller than equivalent-quality JPEG. Lossless WebP is 26% smaller than PNG.</li>
    <li><strong>Transparency support.</strong> Lossy WebP with alpha is significantly smaller than PNG with alpha — often 3× smaller.</li>
    <li><strong>Animation support.</strong> Animated WebP files are smaller than animated GIFs while supporting true-colour.</li>
    <li><strong>Wide browser support.</strong> As of 2026, WebP is supported by Chrome, Firefox, Safari, Edge, Opera — covering over 97% of global users.</li>
</ul>
<h3>Weaknesses of WebP</h3>
<ul>
    <li><strong>Not universally supported outside browsers.</strong> Some older desktop applications may not open WebP files natively.</li>
    <li><strong>No CMYK support.</strong> WebP is RGB-only, so it's not suitable for print workflows.</li>
</ul>

<h2>Real-World File Size Comparison</h2>
<p>The same 1920×1280px photograph saved in each format at comparable visual quality:</p>
<table>
    <thead><tr><th>Format</th><th>Settings</th><th>File Size</th><th>Relative Size</th></tr></thead>
    <tbody>
        <tr><td>PNG (lossless)</td><td>Maximum compression</td><td>4.2 MB</td><td>100% (baseline)</td></tr>
        <tr><td>JPEG</td><td>Quality 80</td><td>312 KB</td><td>7.4%</td></tr>
        <tr><td>WebP (lossy)</td><td>Quality 80</td><td>214 KB</td><td>5.1%</td></tr>
        <tr><td>WebP (lossless)</td><td>Lossless</td><td>2.9 MB</td><td>69%</td></tr>
    </tbody>
</table>
<p>At quality 80, lossy WebP is 31% smaller than JPEG. Switching from JPEG to WebP saves approximately 4.9 MB of bandwidth per 50-image page load.</p>

<h2>When to Use Each Format — Practical Recommendations</h2>
<h3>Use WebP when…</h3>
<ul>
    <li>Your audience uses modern browsers (virtually everyone in 2026)</li>
    <li>You want the smallest possible file sizes</li>
    <li>You need transparency with photographic content</li>
    <li>You're optimising for Core Web Vitals and SEO</li>
</ul>
<h3>Use JPEG when…</h3>
<ul>
    <li>You're uploading to platforms that don't support WebP</li>
    <li>Broad legacy compatibility is critical</li>
</ul>
<h3>Use PNG when…</h3>
<ul>
    <li>You need pixel-perfect lossless quality (technical diagrams, screenshots for documentation)</li>
    <li>The image will be edited and re-saved multiple times</li>
    <li>You need transparency and can't use WebP for compatibility reasons</li>
</ul>

<h2>How to Convert Between Formats</h2>
<p>Use our free <a href="/convert">Image Converter</a> to convert between JPEG, PNG, WebP, and GIF instantly — right in your browser. No file size limits, no registration required. You can also <a href="/batch-compress">batch convert</a> up to 20 images at once.</p>

<h2>Bottom Line</h2>
<p>For the vast majority of websites in 2026, <strong>WebP should be your default format</strong>. It delivers the best balance of file size, quality, and feature support. Keep JPEG as a fallback for legacy compatibility, and reserve PNG for lossless graphics and transparency where WebP isn't an option.</p>
HTML,
                'meta_title'       => 'WebP vs JPG vs PNG — Format Comparison Guide 2026 | CompresslyPro',
                'meta_description' => 'Comprehensive comparison of WebP, JPG, and PNG image formats. Learn file size differences, quality trade-offs, browser support, transparency, and when to use each format.',
                'meta_keywords'    => 'webp vs jpg vs png, webp vs jpeg, image format comparison, best image format for web, png vs jpg, when to use webp',
                'og_title'         => 'WebP vs JPG vs PNG: Which Image Format Should You Use in 2026?',
                'og_description'   => 'Detailed comparison of WebP, JPEG, and PNG with real-world file size data, quality analysis, and practical recommendations.',
                'category'         => 'Formats',
                'tags'             => ['Formats', 'WebP', 'JPEG', 'PNG'],
                'read_time'        => 9,
                'word_count'       => 1850,
                'schema_keywords'  => 'WebP, JPEG, PNG, image format comparison, web performance',
                'date_published'   => '2026-02-20',
                'date_modified'    => '2026-04-15',
                'is_published'     => true,
                'is_featured'      => true,
                'sort_order'       => 2,
            ],

            // ── 3 ────────────────────────────────────────────────────────────
            [
                'title'            => 'Image SEO Best Practices: How to Rank Higher with Optimised Images',
                'slug'             => 'image-seo-best-practices',
                'excerpt'          => 'Google Images is the second largest search engine in the world. Properly optimised images can drive significant organic traffic to your website — and improve your overall search rankings.',
                'content'          => <<<'HTML'
<h2>Why Image SEO Matters</h2>
<p>Images are more than decoration. They're a significant source of organic search traffic and a crucial signal for Google's ranking algorithms:</p>
<ul>
    <li><strong>Google Images drives traffic.</strong> Google Images accounts for approximately 22% of all Google searches.</li>
    <li><strong>Images support E-E-A-T.</strong> Google's Experience, Expertise, Authoritativeness, and Trustworthiness guidelines value original, helpful content — including unique, relevant images.</li>
    <li><strong>Core Web Vitals are image-dependent.</strong> The Largest Contentful Paint (LCP) metric is often an image. Optimising images directly improves your CWV scores, which Google uses as a ranking signal.</li>
    <li><strong>Visual search is growing.</strong> Google Lens processes billions of queries per year. Properly tagged and optimised images are more likely to appear in visual search results.</li>
</ul>

<h2>1. Write Descriptive, Useful Alt Text</h2>
<p>The <code>alt</code> attribute is the single most important image SEO element. It serves three purposes:</p>
<ol>
    <li><strong>Accessibility:</strong> Screen readers read alt text aloud to visually impaired users.</li>
    <li><strong>Context for search engines:</strong> Google uses alt text to understand what an image depicts.</li>
    <li><strong>Fallback display:</strong> If an image fails to load, the browser displays the alt text instead.</li>
</ol>
<h3>Alt text best practices</h3>
<ul>
    <li><strong>Be descriptive and specific.</strong> Instead of <code>alt="image"</code>, write <code>alt="Golden retriever puppy playing in autumn leaves in a park"</code>.</li>
    <li><strong>Include relevant keywords naturally.</strong> Keep it under 125 characters.</li>
    <li><strong>Don't start with "Image of" or "Picture of".</strong> Screen readers already announce it as an image.</li>
    <li><strong>Use empty alt for decorative images.</strong> Use <code>alt=""</code> to tell screen readers to skip purely decorative images.</li>
</ul>

<h2>2. Use Descriptive File Names</h2>
<p>Google reads file names as a signal for image content. Before uploading, rename your files from camera defaults to descriptive, keyword-rich names:</p>
<table>
    <thead><tr><th>❌ Bad File Name</th><th>✅ Good File Name</th></tr></thead>
    <tbody>
        <tr><td>IMG_20260215_143022.jpg</td><td>compressed-product-photo-before-after.jpg</td></tr>
        <tr><td>screenshot-1.png</td><td>webp-conversion-settings-panel.png</td></tr>
        <tr><td>DSC0001.jpeg</td><td>landscape-mountain-sunset-colorado.webp</td></tr>
    </tbody>
</table>
<p><strong>Guidelines:</strong> Use hyphens to separate words (not underscores). Keep file names lowercase. Include the primary keyword. Avoid keyword stuffing.</p>

<h2>3. Optimise Image File Size</h2>
<p>Page speed is a confirmed Google ranking factor. Large, uncompressed images are the number one cause of slow pages. Follow these rules:</p>
<ul>
    <li><strong>Compress all images</strong> before uploading. Use our <a href="/compress">Image Compressor</a> to reduce file sizes by 40–80% without visible quality loss.</li>
    <li><strong>Use WebP format</strong> for the best size-to-quality ratio. WebP images are 25–35% smaller than JPEG.</li>
    <li><strong>Resize to display dimensions.</strong> Use our <a href="/resize">Image Resizer</a> to match image dimensions to their display size.</li>
    <li><strong>Target under 200 KB</strong> for most web images. Hero images can be up to 300 KB. Thumbnails should be under 50 KB.</li>
</ul>

<h2>4. Implement Responsive Images</h2>
<p>Serving the same large image to both desktop and mobile users wastes bandwidth and hurts mobile rankings. Use the <code>srcset</code> attribute:</p>
<p><code>&lt;img srcset="product-400.webp 400w, product-800.webp 800w, product-1200.webp 1200w" sizes="(max-width: 640px) 400px, (max-width: 1024px) 800px, 1200px" src="product-800.webp" alt="Product photo"&gt;</code></p>

<h2>5. Use Structured Data for Images</h2>
<p>Schema.org structured data helps Google understand the context and content of your images. Key schema types:</p>
<ul>
    <li><strong>ImageObject:</strong> Provide detailed metadata about important images.</li>
    <li><strong>Product images:</strong> Include image URLs in your Product schema for Google Shopping.</li>
    <li><strong>Article images:</strong> Include an <code>image</code> property in your Article schema.</li>
    <li><strong>HowTo images:</strong> Include images for each step in your HowTo schema.</li>
</ul>

<h2>6. Create an Image Sitemap</h2>
<p>An image sitemap helps Google discover images that it might not find through normal crawling — especially images loaded via JavaScript, CSS, or lazy loading:</p>
<p><code>&lt;url&gt;&lt;loc&gt;https://example.com/page&lt;/loc&gt;&lt;image:image&gt;&lt;image:loc&gt;https://example.com/images/photo.webp&lt;/image:loc&gt;&lt;image:title&gt;Descriptive title&lt;/image:title&gt;&lt;/image:image&gt;&lt;/url&gt;</code></p>

<h2>7. Add Proper Image Dimensions</h2>
<p>Always include <code>width</code> and <code>height</code> attributes on your <code>&lt;img&gt;</code> tags. This prevents Cumulative Layout Shift (CLS) — a Core Web Vitals metric that measures visual stability.</p>

<h2>8. Use Lazy Loading Strategically</h2>
<p>Add <code>loading="lazy"</code> to off-screen images so they load only when the user scrolls near them. However:</p>
<ul>
    <li><strong>Never lazy-load the LCP image.</strong> Your hero image should load eagerly with <code>fetchpriority="high"</code>.</li>
    <li><strong>Don't lazy-load above-the-fold images.</strong> Any image visible without scrolling should load immediately.</li>
</ul>

<h2>Image SEO Checklist</h2>
<ol>
    <li>✅ Descriptive, keyword-rich alt text (under 125 characters)</li>
    <li>✅ Descriptive file names with hyphens (not underscores)</li>
    <li>✅ Compressed to under 200 KB (use our <a href="/compress">compressor</a>)</li>
    <li>✅ WebP format for best performance</li>
    <li>✅ Resized to display dimensions (2× for Retina)</li>
    <li>✅ Responsive images with <code>srcset</code></li>
    <li>✅ Explicit width and height attributes</li>
    <li>✅ Lazy loading for off-screen images</li>
    <li>✅ Structured data (ImageObject or Article schema)</li>
    <li>✅ Image sitemap submitted to Google Search Console</li>
    <li>✅ Original images when possible</li>
    <li>✅ Descriptive captions and surrounding context</li>
</ol>

<h2>Start Optimising Your Images</h2>
<p>The best image SEO starts with properly compressed, correctly formatted images. Use our <a href="/">free image tools</a> to compress, convert, resize, and batch process your images — then apply the SEO best practices above to maximise your organic traffic.</p>
HTML,
                'meta_title'       => 'Image SEO Best Practices — Rank Higher with Optimised Images | CompresslyPro',
                'meta_description' => 'Learn image SEO best practices for 2026: alt text, file naming, structured data, lazy loading, compression, and sitemaps. Boost your search rankings with properly optimised images.',
                'meta_keywords'    => 'image SEO, image alt text, image file names SEO, optimize images for search, image sitemap, image structured data',
                'og_title'         => 'Image SEO Best Practices: How to Rank Higher with Optimised Images',
                'og_description'   => 'A comprehensive guide to image SEO covering alt text, file naming conventions, structured data, compression, and image sitemaps.',
                'category'         => 'SEO',
                'tags'             => ['SEO', 'Images', 'Web Performance'],
                'read_time'        => 10,
                'word_count'       => 1900,
                'schema_keywords'  => 'image SEO, alt text, image optimization, structured data, Core Web Vitals',
                'date_published'   => '2026-02-25',
                'date_modified'    => '2026-04-15',
                'is_published'     => true,
                'is_featured'      => false,
                'sort_order'       => 3,
            ],

            // ── 4 ────────────────────────────────────────────────────────────
            [
                'title'            => 'How to Reduce Image Size for Email Attachments and Newsletters',
                'slug'             => 'reduce-image-size-for-email',
                'excerpt'          => 'Sending large images by email is one of the most common everyday challenges. Attachment size limits, slow loading newsletters, and bounced emails are all caused by oversized images. Here\'s how to fix them.',
                'content'          => <<<'HTML'
<h2>Email Attachment Size Limits</h2>
<p>Every email provider has a maximum attachment size. Here are the current limits for major providers:</p>
<table>
    <thead><tr><th>Provider</th><th>Max Attachment Size</th><th>Notes</th></tr></thead>
    <tbody>
        <tr><td>Gmail</td><td>25 MB</td><td>Files over 25 MB are automatically uploaded to Google Drive and shared as a link.</td></tr>
        <tr><td>Outlook / Microsoft 365</td><td>20 MB (Outlook.com), 150 MB (M365)</td><td>Microsoft 365 admins can configure higher limits.</td></tr>
        <tr><td>Apple Mail / iCloud</td><td>20 MB</td><td>Mail Drop enables sharing files up to 5 GB via iCloud links.</td></tr>
        <tr><td>Yahoo Mail</td><td>25 MB</td><td>Similar to Gmail's limit.</td></tr>
        <tr><td>ProtonMail</td><td>25 MB</td><td>Encrypted attachments add slight overhead to file size.</td></tr>
    </tbody>
</table>
<p><strong>Important:</strong> Email encoding (Base64) increases file size by approximately 33%. A 20 MB attachment actually uses about 27 MB in the email. <strong>Plan for a practical limit of about 15–18 MB to be safe.</strong></p>

<h2>Step 1: Resize Your Images</h2>
<p>Modern smartphone cameras produce images that are 4000–8000 pixels wide. Nobody needs that resolution in an email. Resize images to appropriate dimensions first:</p>
<table>
    <thead><tr><th>Email Use Case</th><th>Recommended Max Width</th></tr></thead>
    <tbody>
        <tr><td>Email attachment (general)</td><td>1600 px</td></tr>
        <tr><td>Newsletter hero image</td><td>600 px</td></tr>
        <tr><td>Newsletter content images</td><td>560 px</td></tr>
        <tr><td>Product thumbnails in email</td><td>300 px</td></tr>
        <tr><td>Email signature logo</td><td>200 px</td></tr>
    </tbody>
</table>
<p>Use our <a href="/resize">Image Resizer</a> to resize images to specific dimensions or by percentage.</p>

<h2>Step 2: Choose the Right Format</h2>
<p>For email, format choice is more constrained because email clients have varying support:</p>
<ul>
    <li><strong>JPEG:</strong> Best for photographs in emails. Universal support across all email clients, including older versions of Outlook. Recommended for attachments and most newsletter images.</li>
    <li><strong>PNG:</strong> Use for graphics with text, logos, screenshots, or images needing transparency.</li>
    <li><strong>WebP:</strong> Supported in Gmail, Apple Mail, and most modern email clients. However, older Outlook desktop versions (2019 and earlier) may not display WebP.</li>
    <li><strong>GIF:</strong> For simple animations in newsletters. Keep GIF file sizes under 200 KB.</li>
</ul>
<p><strong>Recommendation:</strong> Default to JPEG for email. Use our <a href="/convert">Image Converter</a> to convert from PNG, WebP, or other formats to JPEG if needed.</p>

<h2>Step 3: Compress Your Images</h2>
<p>After resizing and choosing the right format, compress your images. For email purposes:</p>
<ul>
    <li><strong>Attachments (photos for colleagues, clients):</strong> 60–70% quality. A 3 MB phone photo typically compresses to 200–400 KB.</li>
    <li><strong>Newsletter images:</strong> 50–60% quality. Target under 100 KB per image.</li>
    <li><strong>Email signature logos:</strong> Compress heavily (40–50%) and keep under 20 KB.</li>
</ul>
<p>Use our <a href="/compress">Image Compressor</a> — adjust the quality slider, use the before/after comparison to verify quality, then download the compressed version.</p>

<h2>Step 4: Batch Process Multiple Images</h2>
<p>Sending multiple photos? Don't compress them one by one. Our <a href="/batch-compress">Batch Compressor</a> lets you process up to 20 images at once. Drop all your photos in, set the quality level, and download them all as a ZIP file.</p>

<h2>Newsletter-Specific Best Practices</h2>
<ul>
    <li><strong>Keep total email size under 100 KB.</strong> Many email clients clip emails larger than 102 KB (Gmail's limit).</li>
    <li><strong>Use web-hosted images.</strong> Host images on your server or CDN and reference them with <code>&lt;img&gt;</code> tags.</li>
    <li><strong>Provide alt text for every image.</strong> Many email clients block images by default — good alt text ensures your message is still understandable.</li>
    <li><strong>Design for 600px width.</strong> Most email clients render content at 600px wide.</li>
    <li><strong>Test across clients.</strong> Use tools like Litmus or Email on Acid to preview rendering.</li>
</ul>

<h2>Quick Reference: Image Sizes for Email</h2>
<table>
    <thead><tr><th>Image Type</th><th>Max Width</th><th>Quality</th><th>Target Size</th></tr></thead>
    <tbody>
        <tr><td>Attachment (casual)</td><td>1600 px</td><td>60–70%</td><td>200–500 KB</td></tr>
        <tr><td>Attachment (important)</td><td>2400 px</td><td>75–85%</td><td>400 KB–1 MB</td></tr>
        <tr><td>Newsletter hero</td><td>600 px</td><td>50–60%</td><td>50–100 KB</td></tr>
        <tr><td>Newsletter content</td><td>560 px</td><td>50–60%</td><td>30–80 KB</td></tr>
        <tr><td>Email signature</td><td>200 px</td><td>40–50%</td><td>5–20 KB</td></tr>
    </tbody>
</table>

<h2>Compress Your Images for Email Now</h2>
<p>Ready to shrink your images for email? Use our <a href="/compress">Image Compressor</a> for individual images or the <a href="/batch-compress">Batch Compressor</a> for multiple files. Both tools are free, work entirely in your browser, and require no registration.</p>
HTML,
                'meta_title'       => 'How to Reduce Image Size for Email — Practical Guide | CompresslyPro',
                'meta_description' => 'Learn how to reduce image file sizes for email attachments and newsletters. Covers size limits, compression techniques, format selection, and best practices for Outlook, Gmail, and Apple Mail.',
                'meta_keywords'    => 'reduce image size for email, compress photos for email, email image size limit, compress images gmail outlook, email attachment too large',
                'og_title'         => 'How to Reduce Image Size for Email Attachments and Newsletters',
                'og_description'   => 'Practical guide to compressing images for email — size limits, recommended dimensions, format tips, and step-by-step instructions.',
                'category'         => 'Email',
                'tags'             => ['Email', 'Compression'],
                'read_time'        => 6,
                'word_count'       => 1400,
                'schema_keywords'  => 'email attachment size, image compression, JPEG, newsletter images',
                'date_published'   => '2026-03-01',
                'date_modified'    => '2026-04-15',
                'is_published'     => true,
                'is_featured'      => false,
                'sort_order'       => 4,
            ],

            // ── 5 ────────────────────────────────────────────────────────────
            [
                'title'            => 'Core Web Vitals: How Images Impact Your Google Rankings',
                'slug'             => 'core-web-vitals-image-optimization',
                'excerpt'          => 'Learn how images impact Core Web Vitals (LCP, CLS, INP) and what to do about it. Practical guide to image optimisation for better Google rankings in 2026.',
                'content'          => <<<'HTML'
<h2>What Are Core Web Vitals?</h2>
<p>Core Web Vitals (CWV) are a set of real-world performance metrics that Google uses as a ranking signal. They measure three aspects of user experience:</p>
<ul>
    <li><strong>Largest Contentful Paint (LCP):</strong> How fast does the main content load? Target: under 2.5 seconds.</li>
    <li><strong>Cumulative Layout Shift (CLS):</strong> How stable is the page visually? Target: under 0.1.</li>
    <li><strong>Interaction to Next Paint (INP):</strong> How responsive is the page to user interactions? Target: under 200ms.</li>
</ul>
<p>Images affect all three metrics — which makes image optimisation one of the highest-leverage activities for improving your Search rankings.</p>

<h2>How Images Affect LCP</h2>
<p>LCP measures the time it takes for the largest visible element in the viewport to load. In the majority of pages, this element is an image — typically a hero image, product photo, or featured blog image.</p>
<h3>Common LCP Image Problems</h3>
<ul>
    <li><strong>Oversized images.</strong> Serving a 4 MB, 4000px-wide hero image when users see it at 1200px wide costs valuable seconds.</li>
    <li><strong>Wrong format.</strong> Using uncompressed PNG or large JPEG files when WebP would be 30% smaller.</li>
    <li><strong>Missing preload.</strong> The browser discovers the LCP image late in the page load sequence.</li>
    <li><strong>Lazy-loaded LCP image.</strong> Adding <code>loading="lazy"</code> to the LCP image delays it unnecessarily.</li>
    <li><strong>No CDN.</strong> Serving images from an origin server far from the user increases latency.</li>
</ul>
<h3>How to Fix LCP</h3>
<ul>
    <li>Compress your hero image to under 200 KB using our <a href="/compress">Image Compressor</a>.</li>
    <li>Convert to WebP for 25–35% better compression than JPEG.</li>
    <li>Add <code>fetchpriority="high"</code> to your LCP image to tell the browser to load it first.</li>
    <li>Add <code>&lt;link rel="preload" as="image" href="hero.webp"&gt;</code> in your <code>&lt;head&gt;</code>.</li>
    <li>Never add <code>loading="lazy"</code> to the LCP image.</li>
    <li>Resize the image to match its actual display dimensions (2× for Retina screens).</li>
</ul>

<h2>How Images Affect CLS</h2>
<p>CLS measures unexpected layout shifts — when elements on the page jump around as content loads. Images are a major cause of CLS when they load without reserved space.</p>
<h3>The Fix: Always Set Width and Height</h3>
<p>The root cause of image-induced CLS is almost always missing <code>width</code> and <code>height</code> attributes. When the browser loads an image without knowing its dimensions, it can't reserve space for it — so the page reflows when the image appears, shifting all the content below it.</p>
<p><code>&lt;img src="photo.webp" width="800" height="600" alt="Description" loading="lazy"&gt;</code></p>

<h2>How Images Affect INP</h2>
<p>INP measures how quickly the page responds to user interactions (clicks, taps, keypresses). Images affect INP indirectly through main thread blocking. Very large, unoptimised images can cause long tasks during decoding and painting, which compete with interaction handling on the main thread.</p>
<h3>How to Fix INP Image Issues</h3>
<ul>
    <li>Avoid extremely large images (over 4096×4096 pixels).</li>
    <li>Use appropriate image dimensions — don't decode a 10 MP image to display 200px wide.</li>
    <li>Use lazy loading for off-screen images to prevent unnecessary decode work.</li>
</ul>

<h2>Measuring Your Core Web Vitals</h2>
<p>You can check your CWV scores using these free tools:</p>
<ul>
    <li><strong>PageSpeed Insights:</strong> pagespeed.web.dev — shows real-world CWV data from Chrome users</li>
    <li><strong>Google Search Console:</strong> Core Web Vitals report — shows field data aggregated across all pages</li>
    <li><strong>Chrome DevTools:</strong> Lighthouse panel — run a local audit and see detailed LCP, CLS, INP breakdown</li>
    <li><strong>WebPageTest:</strong> webpagetest.org — advanced waterfall analysis showing exactly when each image loads</li>
</ul>

<h2>Core Web Vitals Image Checklist</h2>
<ol>
    <li>✅ LCP image compressed to under 200 KB (use our <a href="/compress">compressor</a>)</li>
    <li>✅ LCP image in WebP format</li>
    <li>✅ <code>fetchpriority="high"</code> on the LCP image</li>
    <li>✅ <code>&lt;link rel="preload"&gt;</code> for the LCP image in <code>&lt;head&gt;</code></li>
    <li>✅ No <code>loading="lazy"</code> on LCP or above-fold images</li>
    <li>✅ <code>width</code> and <code>height</code> attributes on all images</li>
    <li>✅ <code>loading="lazy"</code> on below-fold images</li>
    <li>✅ Images sized to display dimensions (2× for Retina)</li>
    <li>✅ Images served from a CDN</li>
</ol>

<h2>Start Improving Your Core Web Vitals Now</h2>
<p>The biggest wins come from compressing your LCP image and adding the correct loading attributes. Use our <a href="/compress">Image Compressor</a> and <a href="/convert">Image Converter</a> to optimise your images for better Core Web Vitals scores — and better Google rankings.</p>
HTML,
                'meta_title'       => 'Core Web Vitals & Image Optimisation — SEO Performance Guide | CompresslyPro',
                'meta_description' => 'Learn how images impact Core Web Vitals (LCP, CLS, INP) and what to do about it. Practical guide to image optimisation for better Google rankings in 2026.',
                'meta_keywords'    => 'core web vitals images, LCP image optimization, improve LCP, cumulative layout shift images, image optimization Google ranking',
                'og_title'         => 'Core Web Vitals: How Images Impact Your Google Rankings',
                'og_description'   => 'Understanding LCP, CLS, and INP — and exactly how image optimisation improves each metric for better search rankings.',
                'category'         => 'Performance',
                'tags'             => ['Performance', 'Core Web Vitals', 'SEO'],
                'read_time'        => 10,
                'word_count'       => 1950,
                'schema_keywords'  => 'Core Web Vitals, LCP, CLS, INP, image optimization, Google ranking',
                'date_published'   => '2026-03-15',
                'date_modified'    => '2026-04-15',
                'is_published'     => true,
                'is_featured'      => false,
                'sort_order'       => 5,
            ],

            // ── 6 ────────────────────────────────────────────────────────────
            [
                'title'            => 'How to Set Up a Batch Image Compression Workflow',
                'slug'             => 'batch-image-compression-workflow',
                'excerpt'          => 'Learn how to efficiently compress multiple images at once with a batch workflow. Covers batch tools, quality settings, naming conventions, and automation tips for designers and developers.',
                'content'          => <<<'HTML'
<h2>Why You Need a Batch Compression Workflow</h2>
<p>If you're manually compressing images one at a time, you're wasting hours every week. A batch workflow lets you process dozens or hundreds of images in a consistent, repeatable way — saving time and ensuring quality consistency across your project.</p>
<p>Common scenarios where batch compression is essential:</p>
<ul>
    <li>Preparing a product catalogue with 50–500 photos for an e-commerce store</li>
    <li>Optimising all images before uploading to a new WordPress site</li>
    <li>Compressing photos from a photoshoot before sending to a client</li>
    <li>Reducing social media post images for a month of scheduled content</li>
    <li>Optimising screenshots for a documentation or knowledge base</li>
</ul>

<h2>Step 1: Organise Your Source Files</h2>
<p>Before batch compressing, take 5 minutes to organise your source files. This prevents errors and makes QA much easier:</p>
<ul>
    <li><strong>Sort by type.</strong> Separate photographs (JPEG/WebP), graphics with transparency (PNG), and screenshots into separate folders. Each type may need different quality settings.</li>
    <li><strong>Check image dimensions.</strong> If any source images are unnecessarily large (e.g., 4000px+ wide), resize them first with our <a href="/resize">Image Resizer</a>.</li>
    <li><strong>Use descriptive file names.</strong> Now is the right time to rename files from camera defaults to descriptive names.</li>
</ul>

<h2>Step 2: Choose Your Quality Settings</h2>
<p>Different content types need different quality settings. Here's a decision framework for batch jobs:</p>
<table>
    <thead><tr><th>Image Type</th><th>Recommended Quality</th><th>Expected Reduction</th></tr></thead>
    <tbody>
        <tr><td>E-commerce product photos</td><td>70–75%</td><td>50–65%</td></tr>
        <tr><td>Blog post images</td><td>60–70%</td><td>55–70%</td></tr>
        <tr><td>Portfolio photos</td><td>75–80%</td><td>40–55%</td></tr>
        <tr><td>Social media images</td><td>60–65%</td><td>60–70%</td></tr>
        <tr><td>Email attachments</td><td>55–65%</td><td>65–75%</td></tr>
        <tr><td>Thumbnails / card images</td><td>50–60%</td><td>70–80%</td></tr>
    </tbody>
</table>
<p>For most use cases, starting with 65% quality is a sensible default. You sacrifice very little visual quality while achieving dramatic file size reductions.</p>

<h2>Step 3: Use Our Free Batch Compressor</h2>
<p>Our <a href="/batch-compress">Batch Image Compressor</a> is the fastest way to compress multiple images in a browser:</p>
<ol>
    <li>Navigate to the <a href="/batch-compress">Batch Compressor</a> tool</li>
    <li>Drop up to 20 images into the upload area (or click to select files)</li>
    <li>Set the quality level with the slider (or leave at the default 65%)</li>
    <li>Click "Compress All" and wait a few seconds</li>
    <li>Review the results — each file shows original size, compressed size, and % saving</li>
    <li>Click "Download All as ZIP" to get all compressed files in one download</li>
</ol>
<p>The tool processes all images simultaneously in parallel — so 20 images takes roughly the same time as 1 image.</p>

<h2>Step 4: Quality Check Your Results</h2>
<p>After batch compression, take a few minutes to spot-check the results:</p>
<ul>
    <li>Open 3–5 random images from the output and inspect them at 100% zoom</li>
    <li>Check images with fine detail (text, product labels, faces) most carefully</li>
    <li>Check images with large flat areas of colour (backgrounds, skies) for banding</li>
    <li>If any images look noticeably degraded, re-compress them individually at higher quality</li>
</ul>

<h2>Step 5: Establish a Naming Convention</h2>
<p>Consistent file naming helps with organisation, version control, and SEO. A good naming convention for compressed images:</p>
<ul>
    <li><code>product-name-colour-view-800w.webp</code></li>
    <li><code>blog-post-slug-hero.webp</code></li>
    <li><code>client-project-photoshoot-001.jpg</code></li>
</ul>

<h2>Batch Compression Best Practices</h2>
<ul>
    <li><strong>Always keep original files.</strong> Never overwrite originals with compressed versions. Keep a "source" folder and always compress to a separate "optimised" folder.</li>
    <li><strong>Compress before uploading, not after.</strong> If you've already uploaded large images in WordPress or Shopify, you'll need to replace them. It's much easier to compress before the first upload.</li>
    <li><strong>Set a consistent quality level per project.</strong> Using 70% quality for one batch of e-commerce photos and 55% for another creates inconsistent visual quality across your site.</li>
    <li><strong>Batch by use case, not by date.</strong> Group images by where they'll be used (hero images, product photos, blog thumbnails) rather than when they were taken.</li>
</ul>

<h2>Start Batch Compressing Now</h2>
<p>Ready to process your images? Head to our <a href="/batch-compress">Batch Image Compressor</a> — upload up to 20 images at once, set your quality level, and download all compressed files as a ZIP. It's completely free and requires no signup.</p>
HTML,
                'meta_title'       => 'How to Set Up a Batch Image Compression Workflow | CompresslyPro',
                'meta_description' => 'Learn how to efficiently compress multiple images at once with a batch workflow. Covers batch tools, quality settings, naming conventions, and automation tips for designers and developers.',
                'meta_keywords'    => 'batch image compression workflow, compress multiple images at once, bulk image optimizer, batch photo processing, image compression workflow designers',
                'og_title'         => 'Batch Image Compression: Streamline Your Workflow',
                'og_description'   => 'How to set up an efficient batch image compression workflow — process dozens of images consistently with our free browser-based batch tool.',
                'category'         => 'Workflow',
                'tags'             => ['Workflow', 'Compression', 'Batch'],
                'read_time'        => 8,
                'word_count'       => 1600,
                'schema_keywords'  => 'batch compression, bulk image optimization, workflow, image processing',
                'date_published'   => '2026-03-20',
                'date_modified'    => '2026-04-15',
                'is_published'     => true,
                'is_featured'      => false,
                'sort_order'       => 6,
            ],

            // ── 7 ────────────────────────────────────────────────────────────
            [
                'title'            => 'Best Image Formats for Social Media in 2026 — Complete Size Guide',
                'slug'             => 'best-image-formats-for-social-media',
                'excerpt'          => 'Learn the best image formats and exact dimensions for Facebook, Instagram, Twitter/X, LinkedIn, and Pinterest in 2026. Optimise your social media images for maximum engagement.',
                'content'          => <<<'HTML'
<h2>Why Image Format Matters for Social Media</h2>
<p>Social media platforms apply their own compression algorithms to every image you upload. If your source file is already large and unoptimised, the platform's aggressive re-compression can result in blurry, pixelated, or colour-washed images. By optimising your images before uploading, you retain control over quality.</p>

<h2>Universal Best Practices</h2>
<ul>
    <li><strong>Upload at the recommended resolution.</strong> Uploading at the exact pixel dimensions prevents the platform from scaling your image, which can introduce blur.</li>
    <li><strong>Use JPEG for photographs.</strong> Most social platforms apply additional JPEG compression on upload, so starting with high-quality JPEG (80–90%) gives the best result after re-compression.</li>
    <li><strong>Use PNG for graphics with text.</strong> Text and sharp edges compress poorly in JPEG. Upload logos, infographics, and text overlays as PNG to preserve crispness.</li>
    <li><strong>Colour profile: sRGB.</strong> Always convert images to sRGB before uploading. Adobe RGB and other wide-gamut profiles can look washed out on social media.</li>
</ul>

<h2>Facebook Image Sizes 2026</h2>
<table>
    <thead><tr><th>Image Type</th><th>Recommended Size</th><th>Format</th></tr></thead>
    <tbody>
        <tr><td>Profile photo</td><td>170 × 170 px</td><td>PNG (for logos), JPEG (for photos)</td></tr>
        <tr><td>Cover photo</td><td>820 × 312 px</td><td>JPEG or PNG</td></tr>
        <tr><td>Shared post image</td><td>1200 × 630 px</td><td>JPEG</td></tr>
        <tr><td>Story</td><td>1080 × 1920 px</td><td>JPEG</td></tr>
        <tr><td>Event cover photo</td><td>1920 × 1080 px</td><td>JPEG</td></tr>
        <tr><td>Marketplace listing photo</td><td>1200 × 1200 px</td><td>JPEG</td></tr>
    </tbody>
</table>

<h2>Instagram Image Sizes 2026</h2>
<table>
    <thead><tr><th>Image Type</th><th>Recommended Size</th><th>Format</th></tr></thead>
    <tbody>
        <tr><td>Square post</td><td>1080 × 1080 px</td><td>JPEG</td></tr>
        <tr><td>Portrait post</td><td>1080 × 1350 px</td><td>JPEG</td></tr>
        <tr><td>Landscape post</td><td>1080 × 566 px</td><td>JPEG</td></tr>
        <tr><td>Story / Reel cover</td><td>1080 × 1920 px</td><td>JPEG</td></tr>
        <tr><td>Profile photo</td><td>320 × 320 px (displayed 110px)</td><td>PNG</td></tr>
        <tr><td>Carousel image</td><td>1080 × 1080 px</td><td>JPEG</td></tr>
    </tbody>
</table>
<blockquote><strong>Instagram tip:</strong> Always upload your images at 1080px wide. Instagram compresses images below 1080px more aggressively. Use our <a href="/resize">Image Resizer</a> to set exact dimensions before uploading.</blockquote>

<h2>Twitter / X Image Sizes 2026</h2>
<table>
    <thead><tr><th>Image Type</th><th>Recommended Size</th><th>Format</th></tr></thead>
    <tbody>
        <tr><td>In-feed image (single)</td><td>1200 × 675 px</td><td>JPEG or PNG</td></tr>
        <tr><td>In-feed image (4-image grid)</td><td>1200 × 675 px each</td><td>JPEG</td></tr>
        <tr><td>Profile photo</td><td>400 × 400 px</td><td>PNG</td></tr>
        <tr><td>Header / banner</td><td>1500 × 500 px</td><td>JPEG or PNG</td></tr>
    </tbody>
</table>

<h2>LinkedIn Image Sizes 2026</h2>
<table>
    <thead><tr><th>Image Type</th><th>Recommended Size</th><th>Format</th></tr></thead>
    <tbody>
        <tr><td>Profile photo</td><td>400 × 400 px</td><td>PNG or JPEG</td></tr>
        <tr><td>Cover / banner</td><td>1584 × 396 px</td><td>PNG or JPEG</td></tr>
        <tr><td>Post image</td><td>1200 × 627 px</td><td>JPEG</td></tr>
        <tr><td>Company logo</td><td>300 × 300 px</td><td>PNG</td></tr>
        <tr><td>Article cover image</td><td>1920 × 1080 px</td><td>JPEG</td></tr>
    </tbody>
</table>

<h2>Pinterest Image Sizes 2026</h2>
<table>
    <thead><tr><th>Image Type</th><th>Recommended Size</th><th>Format</th></tr></thead>
    <tbody>
        <tr><td>Standard Pin</td><td>1000 × 1500 px (2:3 ratio)</td><td>JPEG or PNG</td></tr>
        <tr><td>Square Pin</td><td>1000 × 1000 px</td><td>JPEG or PNG</td></tr>
        <tr><td>Infographic Pin</td><td>1000 × 3000 px (tall)</td><td>PNG (for text sharpness)</td></tr>
        <tr><td>Story Pin cover</td><td>1080 × 1920 px</td><td>JPEG</td></tr>
        <tr><td>Profile photo</td><td>165 × 165 px</td><td>PNG</td></tr>
    </tbody>
</table>

<h2>Optimising Social Media Images with CompresslyPro</h2>
<p>Our free tools make social media image preparation simple:</p>
<ol>
    <li>Use the <a href="/resize">Image Resizer</a> to set exact pixel dimensions for each platform</li>
    <li>Use the <a href="/convert">Image Converter</a> to convert between JPEG, PNG, and WebP</li>
    <li>Use the <a href="/compress">Image Compressor</a> to optimise quality before uploading</li>
    <li>Use the <a href="/batch-compress">Batch Compressor</a> to prepare multiple images at once</li>
</ol>
<p>All tools are completely free, work in your browser, and require no signup or installation.</p>
HTML,
                'meta_title'       => 'Best Image Formats for Social Media in 2026 — Complete Size Guide | CompresslyPro',
                'meta_description' => 'Learn the best image formats and exact dimensions for Facebook, Instagram, Twitter/X, LinkedIn, and Pinterest in 2026. Optimise your social media images for maximum engagement.',
                'meta_keywords'    => 'social media image sizes, best image format social media, instagram image size, facebook image dimensions, twitter image size 2026',
                'og_title'         => 'Best Image Formats for Social Media in 2026 — Complete Size Guide',
                'og_description'   => 'Exact image dimensions and formats for every major social media platform. Updated for 2026.',
                'category'         => 'Social Media',
                'tags'             => ['Social Media', 'Formats', 'Instagram', 'Facebook'],
                'read_time'        => 6,
                'word_count'       => 1300,
                'schema_keywords'  => 'social media image sizes, Instagram, Facebook, Twitter, LinkedIn, Pinterest',
                'date_published'   => '2026-03-25',
                'date_modified'    => '2026-04-15',
                'is_published'     => true,
                'is_featured'      => false,
                'sort_order'       => 7,
            ],

            // ── 8 ────────────────────────────────────────────────────────────
            [
                'title'            => 'How to Add a Watermark to Photos — Protect Your Images Online',
                'slug'             => 'how-to-add-watermark-to-photos',
                'excerpt'          => 'Learn how to add text watermarks to your photos to protect them from theft. Step-by-step guide with best practices for watermark placement, opacity, and font settings.',
                'content'          => <<<'HTML'
<h2>Why Watermark Your Photos?</h2>
<p>Watermarking is the most practical way to protect your images from unauthorised use. When you share photos online — on social media, portfolios, client galleries, or stock sites — there's always a risk that someone will download and reuse them without attribution or permission. A watermark:</p>
<ul>
    <li><strong>Deters theft.</strong> Casual image thieves are unlikely to bother removing a well-placed watermark.</li>
    <li><strong>Provides credit.</strong> Even when an image is shared without your permission, the watermark keeps your name, website, or brand visible.</li>
    <li><strong>Builds brand recognition.</strong> Consistent watermarks on shared images act as free advertising.</li>
    <li><strong>Provides proof of ownership.</strong> In copyright disputes, a watermark is evidence that you're the original creator.</li>
</ul>

<h2>Best Watermark Position Strategies</h2>
<p>Where you place your watermark determines how effective it is. Here are the main strategies:</p>
<table>
    <thead><tr><th>Position</th><th>Best For</th><th>Pros</th><th>Cons</th></tr></thead>
    <tbody>
        <tr><td>Bottom right corner</td><td>Photography portfolios, social media</td><td>Doesn't interfere with subject; easy to design around</td><td>Easily cropped out</td></tr>
        <tr><td>Bottom centre</td><td>Landscape photography</td><td>Hard to crop; still unobtrusive</td><td>Can interfere with horizon lines</td></tr>
        <tr><td>Centre (diagonal)</td><td>Client proofs, stock photos</td><td>Very difficult to remove or crop</td><td>Interferes with viewing the image</td></tr>
        <tr><td>Tiled / repeating</td><td>Maximum protection</td><td>Virtually impossible to remove</td><td>Obstructs the entire image</td></tr>
    </tbody>
</table>
<p><strong>Recommendation:</strong> For sharing on social media or your portfolio, use bottom-right positioning with 30–50% opacity. For client proofs or preview images, use diagonal centre placement or tiling.</p>

<h2>Watermark Opacity Guidelines</h2>
<p>Opacity is the balance between protection and aesthetics:</p>
<ul>
    <li><strong>20–30% opacity:</strong> Very subtle. Viewer can barely notice it. Low protection — easily overlooked. Good for fine art where aesthetics matter most.</li>
    <li><strong>40–60% opacity:</strong> Visible but not distracting. The sweet spot for most use cases. Good balance of protection and visual quality.</li>
    <li><strong>70–90% opacity:</strong> Clearly visible. Strong deterrent. Use for client proofs where you want recipients to see the watermark before payment.</li>
    <li><strong>100% opacity:</strong> Completely opaque. Maximum visual impact but can obscure the image beneath.</li>
</ul>

<h2>How to Add a Watermark with CompresslyPro</h2>
<ol>
    <li>Go to the <a href="/watermark">Watermark Tool</a></li>
    <li>Upload your image (JPG, PNG, or WebP, up to 20 MB)</li>
    <li>Enter your watermark text (your name, website, company, or copyright notice)</li>
    <li>Choose your position from the 9-point grid (top-left, centre, bottom-right, etc.)</li>
    <li>Adjust opacity (we recommend 40–60% for most uses)</li>
    <li>Set font size (larger for high-resolution images)</li>
    <li>Set rotation angle (0° for horizontal, 45° for diagonal)</li>
    <li>Preview the result and click Download</li>
</ol>
<p>The entire process takes under 30 seconds. No signup, no watermark on your watermark, and the original image is never stored beyond 30 minutes.</p>

<h2>Watermark Text Content</h2>
<p>What should your watermark say? Here are the most effective options:</p>
<ul>
    <li><strong>Your name or brand:</strong> "© Jane Smith Photography" or "ACME Studio"</li>
    <li><strong>Your website:</strong> "@yourwebsite.com" — this works well for social media shares</li>
    <li><strong>Copyright notice:</strong> "© 2026 CompanyName — All Rights Reserved"</li>
    <li><strong>Social handle:</strong> "@username" — especially effective for Instagram-shared photos</li>
    <li><strong>PROOF / SAMPLE:</strong> For client proofs prior to payment</li>
</ul>

<h2>Tips for Effective Watermarks</h2>
<ul>
    <li><strong>Test before bulk watermarking.</strong> Apply your watermark to one image first and check how it looks at different viewing sizes.</li>
    <li><strong>Use a consistent style.</strong> Keep the same position, font, and opacity across all your images for brand consistency.</li>
    <li><strong>Consider the image content.</strong> A watermark in the bottom-right corner of an image with a plain sky will be much more visible than one over a dark, textured background. Adjust position accordingly.</li>
    <li><strong>Keep originals safe.</strong> Always watermark copies, never originals. Store originals in a separate, secure folder.</li>
</ul>

<h2>Protect Your Photos Now</h2>
<p>Ready to protect your images? Use our free <a href="/watermark">Watermark Tool</a> to add text watermarks to any image — set position, opacity, font size, and rotation. Completely free, no signup required, instant download.</p>
HTML,
                'meta_title'       => 'How to Add a Watermark to Photos — Protect Your Images Online | CompresslyPro',
                'meta_description' => 'Learn how to add text watermarks to your photos to protect them from theft. Step-by-step guide with best practices for watermark placement, opacity, and font settings.',
                'meta_keywords'    => 'how to add watermark to photo, watermark photos online free, protect photos watermark, watermark placement guide, photo watermark text',
                'og_title'         => 'How to Add a Watermark to Photos — Protect Your Images Online',
                'og_description'   => 'Step-by-step guide to watermarking photos. Best practices for placement, opacity, and protection.',
                'category'         => 'Watermark',
                'tags'             => ['Watermark', 'Photo Protection'],
                'read_time'        => 7,
                'word_count'       => 1350,
                'schema_keywords'  => 'watermark, photo protection, copyright, image protection',
                'date_published'   => '2026-03-28',
                'date_modified'    => '2026-04-15',
                'is_published'     => true,
                'is_featured'      => false,
                'sort_order'       => 8,
            ],

            // ── 9 ────────────────────────────────────────────────────────────
            [
                'title'            => 'How to Optimise Images for WordPress — Speed Up Your Website',
                'slug'             => 'optimize-images-for-wordpress',
                'excerpt'          => 'Complete guide to optimising images for WordPress. Reduce page load times, improve Core Web Vitals, and boost SEO with properly compressed and sized images.',
                'content'          => <<<'HTML'
<h2>Why Image Optimisation is Critical for WordPress</h2>
<p>Slow WordPress sites lose visitors, rankings, and revenue. Images are the biggest culprit — accounting for 60–80% of page weight on most WordPress sites. Unoptimised images cause:</p>
<ul>
    <li>Poor Largest Contentful Paint (LCP) scores — a Core Web Vitals metric that affects Google rankings</li>
    <li>High bounce rates — 53% of mobile users leave if a page takes over 3 seconds to load</li>
    <li>Unnecessary hosting bandwidth costs</li>
    <li>Poor user experience on mobile and slow connections</li>
</ul>

<h2>Step 1: Compress Images Before Uploading</h2>
<p>The most impactful thing you can do is compress images before they ever reach your WordPress media library. Once an oversized image is uploaded, WordPress scales it — but the original full-resolution file is still stored and served in some contexts.</p>
<p>Use our <a href="/compress">Image Compressor</a> to reduce image file sizes by 40–80% before uploading. For batches of images, use the <a href="/batch-compress">Batch Compressor</a> to process up to 20 images at once.</p>
<p><strong>Target file sizes for WordPress:</strong></p>
<ul>
    <li>Hero / full-width images: under 200 KB</li>
    <li>Blog post images: under 150 KB</li>
    <li>Thumbnails and sidebar images: under 50 KB</li>
    <li>Product photos (WooCommerce): under 200 KB</li>
</ul>

<h2>Step 2: Use WebP Format in WordPress</h2>
<p>WebP images are 25–35% smaller than JPEG at equivalent quality. WordPress has supported WebP uploads natively since version 5.8 (2021). To use WebP in WordPress:</p>
<ul>
    <li>Convert your images to WebP using our <a href="/convert">Image Converter</a> before uploading</li>
    <li>Or use a plugin like ShortPixel, Imagify, or WebP Express to auto-convert on upload</li>
    <li>Ensure your server sends the correct MIME type (<code>image/webp</code>) for .webp files</li>
</ul>
<p>All modern browsers (Chrome, Firefox, Safari, Edge) support WebP, covering 97%+ of your visitors.</p>

<h2>Step 3: Set Correct Image Dimensions in WordPress</h2>
<p>WordPress automatically generates multiple image sizes (thumbnail, medium, large, full) on upload. You can configure these in Settings → Media. As a baseline:</p>
<ul>
    <li><strong>Thumbnail size:</strong> 150 × 150 px (used in widgets and admin)</li>
    <li><strong>Medium size:</strong> max 300px wide (used in search results and some themes)</li>
    <li><strong>Large size:</strong> max 1024px wide (used in single post views)</li>
    <li><strong>Content width:</strong> Set your theme's content area width and upload images no wider than 2× this value</li>
</ul>
<p>Resize source images to their maximum display width (2× for Retina) using our <a href="/resize">Image Resizer</a> before uploading to avoid WordPress storing a huge original.</p>

<h2>Step 4: Use Lazy Loading</h2>
<p>Since WordPress 5.5, images automatically get <code>loading="lazy"</code> added. This is good for below-fold images. However:</p>
<ul>
    <li>Make sure your hero or first visible image does NOT have <code>loading="lazy"</code> — it should load eagerly</li>
    <li>Add <code>fetchpriority="high"</code> to your LCP image (often the hero image) in your theme template</li>
</ul>

<h2>Step 5: Always Set Width and Height on Images</h2>
<p>WordPress automatically adds width and height attributes to images inserted via the Gutenberg editor. If you're using a page builder (Elementor, Divi, etc.), ensure each image block has explicit dimensions set — this prevents Cumulative Layout Shift (CLS), which affects your Core Web Vitals score.</p>

<h2>Step 6: Add Descriptive Alt Text in WordPress</h2>
<p>Every image uploaded to WordPress can have alt text set in the Media Library. Never leave alt text blank (unless the image is purely decorative). Good alt text:</p>
<ul>
    <li>Describes the image accurately</li>
    <li>Includes the relevant keyword naturally</li>
    <li>Is under 125 characters</li>
    <li>Doesn't start with "image of" or "photo of"</li>
</ul>

<h2>WordPress Image Optimisation Checklist</h2>
<ol>
    <li>✅ Compress images before uploading (use our <a href="/compress">compressor</a>)</li>
    <li>✅ Upload in WebP format where possible</li>
    <li>✅ Resize images to max content width (2× for Retina)</li>
    <li>✅ Configure WordPress media sizes in Settings → Media</li>
    <li>✅ Ensure hero/LCP image loads eagerly (no lazy loading)</li>
    <li>✅ All images have width and height attributes</li>
    <li>✅ All images have descriptive, keyword-rich alt text</li>
    <li>✅ Serve images from a CDN (Cloudflare, BunnyCDN)</li>
    <li>✅ Check Core Web Vitals in Search Console</li>
</ol>

<h2>Start Optimising Your WordPress Images</h2>
<p>Begin with the highest-impact change: compress and resize your images before uploading. Use our <a href="/compress">Image Compressor</a> for individual photos and the <a href="/batch-compress">Batch Compressor</a> for your full image library. Both tools are completely free with no signup required.</p>
HTML,
                'meta_title'       => 'How to Optimise Images for WordPress — Speed Up Your Website | CompresslyPro',
                'meta_description' => 'Complete guide to optimising images for WordPress. Reduce page load times, improve Core Web Vitals, and boost SEO with properly compressed and sized images.',
                'meta_keywords'    => 'optimize images wordpress, wordpress image compression, wordpress image optimization, webp wordpress, wordpress page speed images',
                'og_title'         => 'How to Optimise Images for WordPress — Speed Up Your Website',
                'og_description'   => 'Reduce WordPress page load times by optimising images. Compress, resize, and convert to WebP for faster performance.',
                'category'         => 'WordPress',
                'tags'             => ['WordPress', 'Performance', 'Compression'],
                'read_time'        => 8,
                'word_count'       => 1500,
                'schema_keywords'  => 'WordPress images, image optimization, web performance, WebP, Core Web Vitals',
                'date_published'   => '2026-04-01',
                'date_modified'    => '2026-04-15',
                'is_published'     => true,
                'is_featured'      => false,
                'sort_order'       => 9,
            ],

            // ── 10 ───────────────────────────────────────────────────────────
            [
                'title'            => 'How to Convert Images to PDF — Complete Step-by-Step Guide',
                'slug'             => 'convert-images-to-pdf-guide',
                'excerpt'          => 'Learn how to convert single or multiple images (JPG, PNG, WebP) to PDF documents. Choose page sizes, orientation, and merge multiple images into one professional PDF.',
                'content'          => <<<'HTML'
<h2>When to Convert Images to PDF</h2>
<p>Converting images to PDF is useful in many scenarios:</p>
<ul>
    <li><strong>Professional documents.</strong> PDF is the universal standard for sharing documents that should look the same on any device.</li>
    <li><strong>Client deliverables.</strong> Sending a portfolio, proposal, or report as a PDF looks more professional than sending loose image files.</li>
    <li><strong>Archiving photos.</strong> PDF files can be compressed, password-protected, and are more portable than folders of loose images.</li>
    <li><strong>Printing.</strong> PDF is the preferred format for print shops and professional printing services.</li>
    <li><strong>Email attachments.</strong> A single PDF is easier to manage than 10 separate image files.</li>
    <li><strong>Form submissions.</strong> Many organisations require documents in PDF format for compliance reasons.</li>
</ul>

<h2>Understanding PDF Page Size Options</h2>
<p>When converting images to PDF, you'll need to choose a page size. The most common options:</p>
<table>
    <thead><tr><th>Page Size</th><th>Dimensions</th><th>Common Use</th></tr></thead>
    <tbody>
        <tr><td>A4</td><td>210 × 297 mm (8.27 × 11.69 in)</td><td>Standard in Europe, Asia, most of the world</td></tr>
        <tr><td>Letter</td><td>215.9 × 279.4 mm (8.5 × 11 in)</td><td>Standard in North America</td></tr>
        <tr><td>A3</td><td>297 × 420 mm (11.69 × 16.54 in)</td><td>Large format, presentations, posters</td></tr>
        <tr><td>Legal</td><td>215.9 × 355.6 mm (8.5 × 14 in)</td><td>Legal documents in North America</td></tr>
    </tbody>
</table>
<p>For most purposes, A4 (if outside North America) or Letter (in the US/Canada) is the right choice. If you're unsure, use A4 — it's the international standard.</p>

<h2>Step-by-Step: Convert an Image to PDF with CompresslyPro</h2>
<ol>
    <li>Go to the <a href="/image-to-pdf">Image to PDF Converter</a></li>
    <li>Click "Select Images" or drag and drop your JPG, PNG, or WebP files into the tool</li>
    <li>Reorder the images if you're converting multiple (drag to rearrange)</li>
    <li>Choose your page size (A4, A3, Letter, or Legal)</li>
    <li>Choose orientation: Portrait (tall) or Landscape (wide)</li>
    <li>Click "Convert to PDF"</li>
    <li>Download your PDF file</li>
</ol>
<p>The conversion happens entirely in your browser — no files are uploaded to a cloud server to be stored indefinitely. Your images are automatically deleted within 30 minutes of processing.</p>

<h2>Merging Multiple Images into One PDF</h2>
<p>One of the most useful features of our tool is the ability to merge multiple images into a single PDF document, with each image on a separate page. This is perfect for:</p>
<ul>
    <li>Creating a photo album or portfolio PDF</li>
    <li>Combining receipts or invoices for expense reports</li>
    <li>Packaging multiple screenshots or diagrams into a report</li>
    <li>Creating a multi-page brochure from individual design files</li>
</ul>
<p>Simply upload multiple images and they'll each become a page in the resulting PDF, in the order you specify.</p>

<h2>Image Preparation Tips for Better PDF Quality</h2>
<p>A few steps before converting will ensure your PDF looks professional:</p>
<ul>
    <li><strong>Use high-resolution source images.</strong> For print-quality PDFs, use images at 300 DPI. For digital-only PDFs, 150 DPI is sufficient. Our tool accepts images up to 20 MB.</li>
    <li><strong>Match aspect ratio to page size.</strong> If you're converting a landscape photo to A4, use landscape orientation in the PDF tool.</li>
    <li><strong>Compress for digital viewing.</strong> If the PDF is for screen viewing only (email, website), compress your images first using our <a href="/compress">Image Compressor</a> to reduce the final PDF file size.</li>
    <li><strong>Use PNG for graphics with text.</strong> If your images contain diagrams, annotations, or text overlays, use PNG source files to preserve sharpness in the PDF.</li>
</ul>

<h2>Portrait vs Landscape PDF Orientation</h2>
<p>Choose your orientation based on your image's natural dimensions:</p>
<ul>
    <li><strong>Portrait orientation:</strong> Use for images taller than they are wide (standard document format, mobile photos, infographics)</li>
    <li><strong>Landscape orientation:</strong> Use for images wider than they are tall (widescreen photos, horizontal charts, panoramas, camera landscape shots)</li>
</ul>

<h2>Convert Your Images to PDF Now</h2>
<p>Ready to convert your images to PDF? Our free <a href="/image-to-pdf">Image to PDF Converter</a> supports JPG, PNG, and WebP files — up to 20 MB each. Merge multiple images, choose page size and orientation, and download your PDF instantly. No signup, no watermarks, completely free.</p>
HTML,
                'meta_title'       => 'How to Convert Images to PDF — Complete Step-by-Step Guide | CompresslyPro',
                'meta_description' => 'Learn how to convert single or multiple images (JPG, PNG, WebP) to PDF documents. Choose page sizes, orientation, and merge multiple images into one professional PDF.',
                'meta_keywords'    => 'convert images to pdf, jpg to pdf guide, png to pdf, merge images pdf, image to pdf online free, photos to pdf document',
                'og_title'         => 'How to Convert Images to PDF — Complete Step-by-Step Guide',
                'og_description'   => 'Convert JPG, PNG, and WebP images to PDF documents. Merge multiple images into one PDF with custom page settings.',
                'category'         => 'PDF',
                'tags'             => ['PDF', 'Conversion'],
                'read_time'        => 6,
                'word_count'       => 1250,
                'schema_keywords'  => 'image to PDF, JPG to PDF, merge images PDF, PDF conversion',
                'date_published'   => '2026-04-05',
                'date_modified'    => '2026-04-15',
                'is_published'     => true,
                'is_featured'      => false,
                'sort_order'       => 10,
            ],
        ];
    }
}
