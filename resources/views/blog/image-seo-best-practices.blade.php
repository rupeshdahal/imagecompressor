@extends('layouts.page')

@section('title', 'Image SEO Best Practices — Rank Higher with Optimised Images | CompresslyPro')
@section('description', 'Learn image SEO best practices for 2026: alt text, file naming, structured data, lazy loading, compression, and sitemaps. Boost your search rankings with properly optimised images.')
@section('canonical', url('/blog/image-seo-best-practices'))
@section('og_type', 'article')
@section('og_title', 'Image SEO Best Practices: How to Rank Higher with Optimised Images')
@section('og_description', 'A comprehensive guide to image SEO covering alt text, file naming conventions, structured data, compression, and image sitemaps.')

@section('breadcrumb')
    <li class="flex items-center gap-1.5">
        <svg class="w-3.5 h-3.5 text-gray-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
        <a href="/blog" itemprop="item" class="hover:text-brand-600 transition-colors font-medium"><span itemprop="name">Blog</span></a>
        <meta itemprop="position" content="2">
    </li>
    <li class="flex items-center gap-1.5">
        <svg class="w-3.5 h-3.5 text-gray-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
        <span class="text-gray-600 font-medium">Image SEO Best Practices</span>
        <meta itemprop="position" content="3">
    </li>
@endsection

@section('head')
@verbatim
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "Article",
    "headline": "Image SEO Best Practices: How to Rank Higher with Optimised Images",
    "description": "A comprehensive guide to image SEO covering alt text, file naming conventions, structured data, compression, and image sitemaps.",
    "author": { "@type": "Organization", "name": "CompresslyPro" },
    "publisher": { "@type": "Organization", "name": "CompresslyPro", "logo": { "@type": "ImageObject", "url": "https://compresslypro.com/logo.png" } },
    "datePublished": "2026-02-25",
    "dateModified": "2026-03-08",
    "url": "https://compresslypro.com/blog/image-seo-best-practices",
    "image": "https://compresslypro.com/og-image.png",
    "mainEntityOfPage": "https://compresslypro.com/blog/image-seo-best-practices"
}
</script>
@endverbatim
@endsection

@section('content')
<article class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-16">

    <div class="mb-10">
        <div class="flex items-center gap-3 mb-4">
            <span class="inline-block bg-green-100 text-green-700 text-xs font-semibold px-3 py-1 rounded-full">SEO</span>
            <span class="inline-block bg-brand-100 text-brand-700 text-xs font-semibold px-3 py-1 rounded-full">Images</span>
        </div>
        <h1 class="text-3xl sm:text-4xl font-extrabold mb-4 leading-tight">Image SEO Best Practices: How to Rank Higher with Optimised Images</h1>
        <div class="flex items-center gap-4 text-sm text-gray-400 mb-6">
            <span>📅 February 25, 2026</span>
            <span>·</span>
            <span>📖 10 min read</span>
            <span>·</span>
            <span>By CompresslyPro Team</span>
        </div>
        <p class="text-lg text-gray-600 leading-relaxed border-l-4 border-green-200 pl-4">
            Google Images is the second largest search engine in the world. Properly optimised images can drive significant organic traffic to your website — and improve your overall search rankings. This guide covers every aspect of image SEO you need to know.
        </p>
    </div>

    <div class="bg-white rounded-2xl border border-gray-200/60 shadow-sm p-8 sm:p-10">
        <div class="prose max-w-none">

            <h2>Why Image SEO Matters</h2>
            <p>
                Images are more than decoration. They're a significant source of organic search traffic and a crucial signal for Google's ranking algorithms:
            </p>
            <ul>
                <li><strong>Google Images drives traffic.</strong> Google Images accounts for approximately 22% of all Google searches. If your images rank well, they can be a major traffic source.</li>
                <li><strong>Images support E-E-A-T.</strong> Google's Experience, Expertise, Authoritativeness, and Trustworthiness (E-E-A-T) guidelines value original, helpful content — including unique, relevant images.</li>
                <li><strong>Core Web Vitals are image-dependent.</strong> The Largest Contentful Paint (LCP) metric is often an image. Optimising images directly improves your CWV scores, which Google uses as a ranking signal.</li>
                <li><strong>Visual search is growing.</strong> Google Lens processes billions of queries per year. Properly tagged and optimised images are more likely to appear in visual search results.</li>
            </ul>

            <h2>1. Write Descriptive, Useful Alt Text</h2>
            <p>
                The <code>alt</code> attribute is the single most important image SEO element. It serves three purposes:
            </p>
            <ol>
                <li><strong>Accessibility:</strong> Screen readers read alt text aloud to visually impaired users.</li>
                <li><strong>Context for search engines:</strong> Google uses alt text to understand what an image depicts, since it cannot "see" images the way humans do.</li>
                <li><strong>Fallback display:</strong> If an image fails to load, the browser displays the alt text instead.</li>
            </ol>

            <h3>Alt text best practices</h3>
            <ul>
                <li><strong>Be descriptive and specific.</strong> Instead of <code>alt="image"</code> or <code>alt="photo"</code>, write <code>alt="Golden retriever puppy playing in autumn leaves in a park"</code>.</li>
                <li><strong>Include relevant keywords naturally.</strong> If the image is on a page about image compression, <code>alt="Before and after comparison showing 65% file size reduction with lossy compression"</code> is better than <code>alt="comparison"</code>.</li>
                <li><strong>Keep it under 125 characters.</strong> Most screen readers cut off alt text around 125 characters, so be concise but descriptive.</li>
                <li><strong>Don't start with "Image of" or "Picture of".</strong> Screen readers already announce it as an image. Get straight to the description.</li>
                <li><strong>Use empty alt for decorative images.</strong> If an image is purely decorative (background patterns, spacers), use <code>alt=""</code> to tell screen readers to skip it.</li>
            </ul>

            <h2>2. Use Descriptive File Names</h2>
            <p>
                Google reads file names as a signal for image content. Before uploading, rename your files from camera defaults to descriptive, keyword-rich names:
            </p>
            <table>
                <thead>
                    <tr>
                        <th>❌ Bad File Name</th>
                        <th>✅ Good File Name</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>IMG_20260215_143022.jpg</td>
                        <td>compressed-product-photo-before-after.jpg</td>
                    </tr>
                    <tr>
                        <td>screenshot-1.png</td>
                        <td>webp-conversion-settings-panel.png</td>
                    </tr>
                    <tr>
                        <td>DSC0001.jpeg</td>
                        <td>landscape-mountain-sunset-colorado.webp</td>
                    </tr>
                </tbody>
            </table>
            <p>
                <strong>Guidelines:</strong> Use hyphens to separate words (not underscores). Keep file names lowercase. Include the primary keyword for the image. Avoid keyword stuffing — keep it natural and accurate.
            </p>

            <h2>3. Optimise Image File Size</h2>
            <p>
                Page speed is a confirmed Google ranking factor. Large, uncompressed images are the number one cause of slow pages. Follow these rules:
            </p>
            <ul>
                <li><strong>Compress all images</strong> before uploading. Use our <a href="/#compress">Image Compressor</a> to reduce file sizes by 40–80% without visible quality loss.</li>
                <li><strong>Use WebP format</strong> for the best size-to-quality ratio. WebP images are 25–35% smaller than JPEG at equivalent visual quality. See our <a href="/blog/webp-vs-jpg-vs-png">format comparison guide</a>.</li>
                <li><strong>Resize to display dimensions.</strong> Don't serve a 4000px-wide image when it's displayed at 800px. Use our <a href="/#resize">Image Resizer</a> to match image dimensions to their display size (2× for Retina).</li>
                <li><strong>Target under 200 KB</strong> for most web images. Hero images can be up to 300 KB. Thumbnails should be under 50 KB.</li>
            </ul>

            <h2>4. Implement Responsive Images</h2>
            <p>
                Serving the same large image to both desktop and mobile users wastes bandwidth and hurts mobile rankings. Use the <code>srcset</code> attribute to provide multiple sizes:
            </p>
            <p>
                <code>&lt;img srcset="product-400.webp 400w, product-800.webp 800w, product-1200.webp 1200w" sizes="(max-width: 640px) 400px, (max-width: 1024px) 800px, 1200px" src="product-800.webp" alt="Product photo showing compression quality"&gt;</code>
            </p>
            <p>
                This tells the browser to download only the size needed for the current viewport, potentially saving 60–80% of bandwidth on mobile devices.
            </p>

            <h2>5. Use Structured Data for Images</h2>
            <p>
                Schema.org structured data helps Google understand the context and content of your images. Key schema types for image SEO:
            </p>
            <ul>
                <li><strong>ImageObject:</strong> Use this to provide detailed metadata about important images (name, description, content URL, dimensions, license).</li>
                <li><strong>Product images:</strong> If you're selling products, include image URLs in your Product schema. This enables rich results in Google Shopping.</li>
                <li><strong>Article images:</strong> Include an <code>image</code> property in your Article schema. Google uses this for rich snippets, Discover, and Top Stories.</li>
                <li><strong>HowTo images:</strong> If you have step-by-step tutorials, include images for each step in your HowTo schema.</li>
            </ul>

            <h2>6. Create an Image Sitemap</h2>
            <p>
                An image sitemap helps Google discover images that it might not find through normal crawling — especially images loaded via JavaScript, CSS, or lazy loading. You can either create a dedicated image sitemap or add image information to your existing sitemap:
            </p>
            <p>
                <code>&lt;url&gt;&lt;loc&gt;https://example.com/page&lt;/loc&gt;&lt;image:image&gt;&lt;image:loc&gt;https://example.com/images/photo.webp&lt;/image:loc&gt;&lt;image:title&gt;Descriptive title&lt;/image:title&gt;&lt;/image:image&gt;&lt;/url&gt;</code>
            </p>

            <h2>7. Add Proper Image Dimensions</h2>
            <p>
                Always include <code>width</code> and <code>height</code> attributes on your <code>&lt;img&gt;</code> tags. This prevents Cumulative Layout Shift (CLS) — a Core Web Vitals metric that measures visual stability. Without explicit dimensions, the browser doesn't know how much space to reserve, causing the page to "jump" when the image loads.
            </p>

            <h2>8. Use Lazy Loading Strategically</h2>
            <p>
                Add <code>loading="lazy"</code> to off-screen images so they load only when the user scrolls near them. This improves initial page load speed. However:
            </p>
            <ul>
                <li><strong>Never lazy-load the LCP image.</strong> Your hero image or first visible image should load eagerly with <code>fetchpriority="high"</code>.</li>
                <li><strong>Don't lazy-load above-the-fold images.</strong> Any image visible without scrolling should load immediately.</li>
            </ul>

            <h2>9. Optimise Image Captions and Surrounding Text</h2>
            <p>
                Google uses the text surrounding an image to better understand its content. Place images near relevant text that describes or references them. Use descriptive captions when appropriate — they increase user engagement and provide additional SEO context.
            </p>

            <h2>10. Use Original Images When Possible</h2>
            <p>
                Google's algorithms favour original images over stock photos. Original images support E-E-A-T signals and are more likely to rank in Google Images. When you must use stock photos, add significant value through editing, annotation, or context.
            </p>

            <h2>Image SEO Checklist</h2>
            <ol>
                <li>✅ Descriptive, keyword-rich alt text (under 125 characters)</li>
                <li>✅ Descriptive file names with hyphens (not underscores)</li>
                <li>✅ Compressed to under 200 KB (use our <a href="/#compress">compressor</a>)</li>
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
            <p>
                The best image SEO starts with properly compressed, correctly formatted images. Use our <a href="/">free image tools</a> to compress, convert, resize, and batch process your images — then apply the SEO best practices above to maximise your organic traffic.
            </p>
        </div>
    </div>

    <div class="mt-12">
        <h2 class="text-2xl font-extrabold mb-6">Related Articles</h2>
        <div class="grid sm:grid-cols-2 gap-5">
            <a href="/blog/how-to-compress-images-for-web" class="bg-white rounded-2xl border border-gray-200/60 p-6 hover:shadow-lg transition-shadow group">
                <span class="inline-block bg-brand-100 text-brand-700 text-xs font-semibold px-2.5 py-1 rounded-full mb-3">Compression</span>
                <h3 class="font-bold mb-2 group-hover:text-brand-600 transition-colors">How to Compress Images for the Web — Complete Guide</h3>
                <p class="text-sm text-gray-500">Step-by-step guide to optimising images for faster page loads.</p>
            </a>
            <a href="/blog/core-web-vitals-image-optimization" class="bg-white rounded-2xl border border-gray-200/60 p-6 hover:shadow-lg transition-shadow group">
                <span class="inline-block bg-pink-100 text-pink-700 text-xs font-semibold px-2.5 py-1 rounded-full mb-3">Performance</span>
                <h3 class="font-bold mb-2 group-hover:text-brand-600 transition-colors">Core Web Vitals: How Images Impact Your Rankings</h3>
                <p class="text-sm text-gray-500">Understand LCP, CLS, and INP — and how image optimisation helps.</p>
            </a>
        </div>
    </div>
</article>
@endsection
