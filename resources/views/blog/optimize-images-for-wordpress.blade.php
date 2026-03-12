@extends('layouts.page')

@section('title', 'How to Optimise Images for WordPress — Speed Up Your Website | CompresslyPro')
@section('description', 'Complete guide to optimising images for WordPress. Reduce page load times, improve Core Web Vitals, and boost SEO with properly compressed and sized images.')
@section('canonical', url('/blog/optimize-images-for-wordpress'))
@section('og_type', 'article')
@section('og_title', 'How to Optimise Images for WordPress — Speed Up Your Website')
@section('og_description', 'Reduce WordPress page load times by optimising images. Compress, resize, and convert to WebP for faster performance.')

@section('breadcrumb')
    <li class="flex items-center gap-1.5">
        <svg class="w-3.5 h-3.5 text-gray-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
        <a href="/blog" itemprop="item" class="hover:text-brand-600 transition-colors font-medium"><span itemprop="name">Blog</span></a>
        <meta itemprop="position" content="2">
    </li>
    <li class="flex items-center gap-1.5">
        <svg class="w-3.5 h-3.5 text-gray-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
        <span class="text-gray-600 font-medium" itemprop="name">Optimise Images for WordPress</span>
        <meta itemprop="position" content="3">
    </li>
@endsection

@section('head')
@verbatim
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "Article",
    "headline": "How to Optimise Images for WordPress — Speed Up Your Website",
    "description": "Complete guide to optimising images for WordPress to reduce page load times and improve SEO.",
    "url": "https://compresslypro.com/blog/optimize-images-for-wordpress",
    "datePublished": "2025-03-20",
    "dateModified": "2025-03-20",
    "author": { "@type": "Organization", "name": "CompresslyPro" },
    "publisher": { "@type": "Organization", "name": "CompresslyPro", "url": "https://compresslypro.com" }
}
</script>
@endverbatim
@endsection

@section('content')
<article class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <header class="mb-10">
        <div class="flex items-center gap-3 text-sm text-gray-500 mb-4">
            <time datetime="2025-03-20">March 20, 2025</time>
            <span class="w-1 h-1 bg-gray-300 rounded-full"></span>
            <span>11 min read</span>
        </div>
        <h1 class="text-3xl sm:text-4xl font-extrabold tracking-tight mb-4">How to Optimise Images for WordPress — Speed Up Your Website</h1>
        <p class="text-lg text-gray-500 leading-relaxed">Images are typically the heaviest assets on a WordPress site, accounting for 40–60% of total page weight. Properly optimised images can cut your page load time in half and dramatically improve your Core Web Vitals scores. Here's how to do it right.</p>
    </header>

    <div class="bg-white rounded-2xl border border-gray-200/60 shadow-sm p-8 sm:p-10">
        <div class="prose max-w-none">

            <h2>Why WordPress Image Optimisation Matters</h2>
            <p>WordPress powers over 40% of all websites on the internet. Yet many WordPress sites suffer from slow load times because of unoptimised images. Here's what's at stake:</p>
            <ul>
                <li><strong>SEO rankings.</strong> Google uses page speed as a ranking factor. Core Web Vitals (LCP, CLS, INP) are directly affected by image sizes.</li>
                <li><strong>User experience.</strong> 53% of mobile visitors leave a page that takes longer than 3 seconds to load.</li>
                <li><strong>Conversion rates.</strong> Every 1-second improvement in page load time can increase conversions by up to 7%.</li>
                <li><strong>Hosting costs.</strong> Smaller images use less bandwidth, reducing hosting bills for high-traffic sites.</li>
            </ul>

            <h2>Step 1: Resize Images Before Uploading</h2>
            <p>One of the most common mistakes is uploading images straight from a camera or phone. A typical DSLR photo is 6000×4000 pixels (24 megapixels), while most WordPress themes display images at 1200px wide or less. That means 80% of the pixel data is wasted.</p>
            <p><strong>Rule of thumb:</strong> Resize images to 2× the display size for retina screens. If your content area is 800px wide, resize images to 1600px wide maximum.</p>
            <p>Use our free <a href="/tools/resize">Image Resizer</a> to resize images to the exact dimensions you need.</p>

            <h2>Step 2: Compress Images</h2>
            <p>After resizing, compress your images to reduce file size without visible quality loss. For web use:</p>
            <table>
                <thead><tr><th>Image Type</th><th>Recommended Quality</th><th>Target File Size</th></tr></thead>
                <tbody>
                    <tr><td>Hero / Banner Images</td><td>80–85%</td><td>100–200 KB</td></tr>
                    <tr><td>Blog Post Images</td><td>75–80%</td><td>50–150 KB</td></tr>
                    <tr><td>Thumbnails</td><td>70–75%</td><td>10–30 KB</td></tr>
                    <tr><td>Background Images</td><td>60–70%</td><td>50–100 KB</td></tr>
                </tbody>
            </table>
            <p>Use our <a href="/tools/compress">Image Compressor</a> to achieve these targets. Most images can be reduced 60–80% without visible quality loss.</p>

            <h2>Step 3: Convert to WebP Format</h2>
            <p>WebP delivers 25–35% smaller files than JPG at the same visual quality. WordPress has supported WebP natively since version 5.8 (2021). Modern browsers (Chrome, Firefox, Safari, Edge) all support WebP.</p>
            <p>Use our <a href="/tools/convert">Image Converter</a> to convert JPG and PNG images to WebP format before uploading.</p>

            <h2>Step 4: Use Proper WordPress Image Settings</h2>
            <ul>
                <li><strong>Set maximum upload dimensions.</strong> In Settings → Media, configure the "Large" size to match your theme's content width (typically 1200px).</li>
                <li><strong>Let WordPress generate thumbnails.</strong> WordPress automatically creates multiple sizes (thumbnail, medium, large). Don't fight this system — it ensures the right size is served for each context.</li>
                <li><strong>Add alt text to every image.</strong> Besides accessibility, alt text is a significant SEO signal. Describe the image content naturally.</li>
                <li><strong>Use descriptive file names.</strong> Rename "IMG_4532.jpg" to "chocolate-cake-recipe.jpg" before uploading. Search engines use file names as a relevance signal.</li>
            </ul>

            <h2>Step 5: Implement Lazy Loading</h2>
            <p>WordPress adds <code>loading="lazy"</code> to images by default since version 5.5. This means images below the fold aren't loaded until the user scrolls near them, dramatically improving initial page load time.</p>
            <p><strong>Important:</strong> Make sure your above-the-fold hero image does NOT have lazy loading. WordPress 5.9+ handles this automatically for the first image in content, but verify in your theme.</p>

            <h2>WordPress Image Optimisation Checklist</h2>
            <ol>
                <li>☐ Resize images to 2× display size maximum (e.g., 1600px for 800px display)</li>
                <li>☐ Compress all images to 70–85% quality</li>
                <li>☐ Convert to WebP where possible</li>
                <li>☐ Add descriptive alt text to every image</li>
                <li>☐ Use descriptive, hyphenated file names</li>
                <li>☐ Verify lazy loading is working (images below the fold)</li>
                <li>☐ Ensure hero/above-the-fold images load immediately (no lazy loading)</li>
                <li>☐ Set proper width and height attributes to prevent layout shift (CLS)</li>
                <li>☐ Test with Google PageSpeed Insights after uploading</li>
                <li>☐ Consider using a CDN for image delivery on high-traffic sites</li>
            </ol>

            <h2>Recommended Image Sizes for Common WordPress Elements</h2>
            <table>
                <thead><tr><th>Element</th><th>Width (px)</th><th>Format</th><th>Max File Size</th></tr></thead>
                <tbody>
                    <tr><td>Featured Image / Blog Header</td><td>1200–1600</td><td>WebP or JPG</td><td>150 KB</td></tr>
                    <tr><td>In-Content Images</td><td>800–1200</td><td>WebP or JPG</td><td>100 KB</td></tr>
                    <tr><td>Sidebar Images / Widgets</td><td>300–400</td><td>WebP or JPG</td><td>30 KB</td></tr>
                    <tr><td>Logo</td><td>200–400</td><td>SVG or PNG</td><td>20 KB</td></tr>
                    <tr><td>Favicon</td><td>512 (source)</td><td>PNG</td><td>10 KB</td></tr>
                    <tr><td>WooCommerce Product</td><td>800–1000</td><td>WebP or JPG</td><td>80 KB</td></tr>
                </tbody>
            </table>

            <h2>Common Mistakes That Slow Down WordPress</h2>
            <ul>
                <li><strong>Uploading full-resolution camera images</strong> (4000×3000+ pixels). Always resize first.</li>
                <li><strong>Using PNG for photographs.</strong> PNG is lossless and creates huge files for photos. Use JPG or WebP instead.</li>
                <li><strong>Not specifying width/height attributes.</strong> This causes layout shift (CLS), hurting your Core Web Vitals score.</li>
                <li><strong>Using too many images per page.</strong> Each HTTP request adds overhead. Be intentional about which images truly add value.</li>
                <li><strong>Ignoring mobile.</strong> Serve appropriately sized images for mobile screens using WordPress's <code>srcset</code> attribute (automatic with properly uploaded images).</li>
            </ul>

            <h2>Before and After: Typical Results</h2>
            <p>Here's what you can typically achieve by following this guide:</p>
            <table>
                <thead><tr><th>Metric</th><th>Before</th><th>After</th></tr></thead>
                <tbody>
                    <tr><td>Average image file size</td><td>800 KB – 3 MB</td><td>50–150 KB</td></tr>
                    <tr><td>Total page weight</td><td>5–10 MB</td><td>1–2 MB</td></tr>
                    <tr><td>Page load time</td><td>4–8 seconds</td><td>1–3 seconds</td></tr>
                    <tr><td>LCP (Largest Contentful Paint)</td><td>4+ seconds</td><td>Under 2.5 seconds</td></tr>
                    <tr><td>PageSpeed Insights score</td><td>30–50</td><td>80–95+</td></tr>
                </tbody>
            </table>
        </div>
    </div>
</article>
@endsection
