@extends('layouts.page')

@section('title', 'Core Web Vitals & Image Optimisation — SEO Performance Guide | CompresslyPro')
@section('description', 'Learn how images impact Core Web Vitals (LCP, CLS, INP) and what to do about it. Practical guide to image optimisation for better Google rankings in 2026.')
@section('keywords', 'core web vitals images, LCP image optimization, improve LCP, cumulative layout shift images, image optimization Google ranking')
@section('canonical', url('/blog/core-web-vitals-image-optimization'))
@section('og_type', 'article')
@section('og_title', 'Core Web Vitals: How Images Impact Your Google Rankings')
@section('og_description', 'Understanding LCP, CLS, and INP — and exactly how image optimisation improves each metric for better search rankings.')

@section('breadcrumb')
    <li class="flex items-center gap-1.5">
        <svg class="w-3.5 h-3.5 text-gray-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
        <a href="/blog" itemprop="item" class="hover:text-brand-600 transition-colors font-medium"><span itemprop="name">Blog</span></a>
        <meta itemprop="position" content="2">
    </li>
    <li class="flex items-center gap-1.5">
        <svg class="w-3.5 h-3.5 text-gray-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
        <span class="text-gray-600 font-medium">Core Web Vitals & Images</span>
        <meta itemprop="position" content="3">
    </li>
@endsection

@section('head')
@verbatim
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "BlogPosting",
    "headline": "Core Web Vitals: How Images Impact Your Google Rankings",
    "description": "Understanding LCP, CLS, and INP — and exactly how image optimisation improves each metric for better search rankings.",
    "author": { "@type": "Organization", "name": "CompresslyPro", "url": "https://compresslypro.com" },
    "publisher": { "@type": "Organization", "name": "CompresslyPro", "logo": { "@type": "ImageObject", "url": "https://compresslypro.com/logo.png" } },
    "datePublished": "2026-03-05",
    "dateModified": "2026-04-15",
    "url": "https://compresslypro.com/blog/core-web-vitals-image-optimization",
    "image": "https://compresslypro.com/og-image.png",
    "mainEntityOfPage": { "@type": "WebPage", "@id": "https://compresslypro.com/blog/core-web-vitals-image-optimization" },
    "wordCount": 2200,
    "isPartOf": { "@type": "Blog", "name": "CompresslyPro Blog", "url": "https://compresslypro.com/blog" },
    "keywords": "Core Web Vitals, LCP, CLS, INP, image optimization, Google PageSpeed"
}
</script>
@endverbatim
@endsection

@section('content')
<article class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-16">

    <div class="mb-10">
        <div class="flex items-center gap-3 mb-4">
            <span class="inline-block bg-pink-100 text-pink-700 text-xs font-semibold px-3 py-1 rounded-full">Performance</span>
            <span class="inline-block bg-green-100 text-green-700 text-xs font-semibold px-3 py-1 rounded-full">SEO</span>
        </div>
        <h1 class="text-3xl sm:text-4xl font-extrabold mb-4 leading-tight">Core Web Vitals: How Images Impact Your Google Rankings</h1>
        <div class="flex items-center gap-4 text-sm text-gray-400 mb-6">
            <span>📅 March 5, 2026</span>
            <span>·</span>
            <span>📖 11 min read</span>
            <span>·</span>
            <span>By CompresslyPro Team</span>
        </div>
        <p class="text-lg text-gray-600 leading-relaxed border-l-4 border-pink-200 pl-4">
            Core Web Vitals (CWV) are Google's standardised metrics for measuring user experience. Images are the most common cause of poor CWV scores. This guide explains each metric, how images affect it, and exactly what to do to achieve "good" scores.
        </p>
    </div>

    <div class="bg-white rounded-2xl border border-gray-200/60 shadow-sm p-8 sm:p-10">
        <div class="prose max-w-none">

            <h2>What Are Core Web Vitals?</h2>
            <p>
                Core Web Vitals are three specific metrics that Google uses as part of its page experience ranking signal. Since their introduction as a ranking factor in June 2021 — and subsequent updates through 2024 and 2025 — they've become essential for SEO. The three metrics are:
            </p>
            <table>
                <thead>
                    <tr>
                        <th>Metric</th>
                        <th>What It Measures</th>
                        <th>"Good" Threshold</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><strong>LCP</strong> — Largest Contentful Paint</td>
                        <td>How quickly the largest visible element loads</td>
                        <td>≤ 2.5 seconds</td>
                    </tr>
                    <tr>
                        <td><strong>CLS</strong> — Cumulative Layout Shift</td>
                        <td>How much the page layout shifts during loading</td>
                        <td>≤ 0.1</td>
                    </tr>
                    <tr>
                        <td><strong>INP</strong> — Interaction to Next Paint</td>
                        <td>How quickly the page responds to user interactions</td>
                        <td>≤ 200 milliseconds</td>
                    </tr>
                </tbody>
            </table>
            <p>
                All three metrics are measured on real user data (Chrome User Experience Report) and reported in Google Search Console. Pages with "good" scores across all three metrics receive a ranking boost compared to pages with "poor" scores.
            </p>

            <h2>LCP: Largest Contentful Paint — The Image Metric</h2>
            <p>
                LCP measures the time from when a user navigates to a page until the largest content element in the viewport finishes rendering. In the vast majority of cases, <strong>the LCP element is an image</strong> — specifically a hero image, banner image, or large product photo.
            </p>
            <p>
                According to Google's data, images are the LCP element on approximately 72% of mobile pages and 83% of desktop pages. This makes image optimisation the single most impactful thing you can do to improve LCP.
            </p>

            <h3>Common Causes of Poor LCP</h3>
            <ol>
                <li><strong>Oversized images.</strong> Serving a 4000px-wide image when the viewport is 400px means the browser downloads 10× more data than needed.</li>
                <li><strong>Uncompressed images.</strong> A 3 MB JPEG hero image takes significantly longer to download than a 200 KB compressed WebP.</li>
                <li><strong>Wrong format.</strong> Using PNG for photographs can result in files 5–10× larger than the equivalent WebP or JPEG.</li>
                <li><strong>Lazy-loading the LCP image.</strong> If the hero image has <code>loading="lazy"</code>, the browser delays loading it until the viewport scrolls near it — defeating the purpose of a hero image.</li>
                <li><strong>No preloading or priority hints.</strong> Without <code>fetchpriority="high"</code> or a <code>&lt;link rel="preload"&gt;</code>, the browser may not prioritise the LCP image.</li>
                <li><strong>Render-blocking resources.</strong> Large CSS or JavaScript files that block rendering delay the entire page, including the LCP image.</li>
            </ol>

            <h3>How to Fix LCP</h3>
            <ul>
                <li><strong>Compress the LCP image.</strong> Use our <a href="/#compress">Image Compressor</a> to reduce the hero image to under 200 KB while maintaining visual quality. Quality 70–80% is ideal for hero images.</li>
                <li><strong>Use WebP format.</strong> Convert your hero image to WebP with our <a href="/#convert">Image Converter</a> for an additional 25–35% size reduction over JPEG.</li>
                <li><strong>Resize to appropriate dimensions.</strong> Serve the hero image at 2× the display width maximum. If the hero displays at 1200px, resize to 2400px wide.</li>
                <li><strong>Add <code>fetchpriority="high"</code></strong> to the LCP image tag. This tells the browser to prioritise downloading this image over other resources.</li>
                <li><strong>Do NOT lazy-load the LCP image.</strong> Remove <code>loading="lazy"</code> from your hero image. It should load eagerly.</li>
                <li><strong>Preload the LCP image</strong> in the <code>&lt;head&gt;</code>: <code>&lt;link rel="preload" href="hero.webp" as="image" fetchpriority="high"&gt;</code></li>
                <li><strong>Use responsive images</strong> with <code>srcset</code> to serve appropriately sized images for each device.</li>
            </ul>

            <h2>CLS: Cumulative Layout Shift — The Dimensions Metric</h2>
            <p>
                CLS measures how much the page's visible content shifts during loading. A common cause of layout shift is images loading without reserved space — when an image loads, it pushes content below it downward, creating a jarring experience.
            </p>
            <p>
                You've experienced this: you start reading an article, and suddenly the text jumps down because an ad or image loaded above it. That's layout shift, and Google penalises it.
            </p>

            <h3>Common Causes of Image-Related CLS</h3>
            <ol>
                <li><strong>Missing width and height attributes.</strong> Without explicit dimensions, the browser allocates zero space for the image until it loads.</li>
                <li><strong>CSS that overrides dimensions.</strong> If CSS sets <code>width: 100%</code> without a corresponding <code>aspect-ratio</code>, the browser still doesn't know the height until the image loads.</li>
                <li><strong>Dynamically inserted images.</strong> JavaScript that adds images to the page after initial render causes layout shifts.</li>
                <li><strong>Web fonts causing text reflow.</strong> While not directly an image issue, large font file downloads can cause text around images to reflow.</li>
            </ol>

            <h3>How to Fix Image-Related CLS</h3>
            <ul>
                <li><strong>Always include <code>width</code> and <code>height</code> attributes</strong> on every <code>&lt;img&gt;</code> tag. These don't need to be the exact pixel size — they just need to have the correct aspect ratio.</li>
                <li><strong>Use CSS <code>aspect-ratio</code></strong> for responsive images: <code>img { aspect-ratio: 16 / 9; width: 100%; height: auto; }</code></li>
                <li><strong>Reserve space with containers.</strong> Wrap images in a container with the correct padding-based aspect ratio or a fixed height.</li>
                <li><strong>Avoid inserting images above existing content</strong> after initial page load. If you must, use <code>content-visibility: auto</code> to contain the layout impact.</li>
            </ul>

            <h2>INP: Interaction to Next Paint — The Responsiveness Metric</h2>
            <p>
                INP replaced First Input Delay (FID) in March 2024 as the official responsiveness metric. It measures the time from when a user interacts with the page (click, tap, keypress) to when the browser renders the next visual update.
            </p>
            <p>
                While INP is primarily about JavaScript execution, images can indirectly impact INP:
            </p>
            <ul>
                <li><strong>Image decoding on the main thread.</strong> Very large images can block the main thread during decoding, delaying response to user interactions. Add <code>decoding="async"</code> to images to move decoding off the main thread.</li>
                <li><strong>JavaScript-heavy image processing.</strong> Client-side image manipulation (canvas operations, WebGL filters) can block the main thread. Use Web Workers for heavy image processing.</li>
                <li><strong>Third-party image scripts.</strong> Some image CDNs and lazy-loading libraries inject JavaScript that can block the main thread. Audit your image-related scripts with Chrome DevTools' Performance panel.</li>
            </ul>

            <h2>How to Measure Core Web Vitals</h2>
            <p>
                Use these tools to measure your site's CWV scores:
            </p>
            <ul>
                <li><strong>Google PageSpeed Insights</strong> (<a href="https://pagespeed.web.dev" rel="noopener">pagespeed.web.dev</a>) — Shows both lab data (simulated) and field data (real users). The field data section is what Google uses for ranking.</li>
                <li><strong>Google Search Console</strong> — The "Core Web Vitals" report shows which pages have "Good", "Needs Improvement", or "Poor" scores based on real user data.</li>
                <li><strong>Chrome DevTools Lighthouse</strong> — Built into Chrome, provides detailed lab measurements and specific recommendations.</li>
                <li><strong>Web Vitals extension</strong> — A Chrome extension that shows CWV scores in real-time as you browse your site.</li>
            </ul>

            <h2>Complete CWV Image Optimisation Checklist</h2>
            <ol>
                <li>✅ Identify your LCP element (usually a hero image) using PageSpeed Insights</li>
                <li>✅ Compress the LCP image to under 200 KB with our <a href="/#compress">compressor</a></li>
                <li>✅ Convert to WebP format with our <a href="/#convert">converter</a></li>
                <li>✅ Add <code>fetchpriority="high"</code> to the LCP image</li>
                <li>✅ Remove <code>loading="lazy"</code> from the LCP image</li>
                <li>✅ Preload the LCP image in <code>&lt;head&gt;</code></li>
                <li>✅ Add <code>width</code> and <code>height</code> to all <code>&lt;img&gt;</code> tags</li>
                <li>✅ Add <code>loading="lazy"</code> to all below-the-fold images</li>
                <li>✅ Add <code>decoding="async"</code> to non-critical images</li>
                <li>✅ Use <code>srcset</code> for responsive images</li>
                <li>✅ Resize images to display dimensions (2× for Retina)</li>
                <li>✅ Serve images through a CDN</li>
                <li>✅ Audit and minimise third-party image scripts</li>
                <li>✅ Measure with PageSpeed Insights after changes</li>
            </ol>

            <h2>The Business Impact of Good CWV Scores</h2>
            <p>
                Improving Core Web Vitals isn't just about SEO. Real-world case studies consistently show significant business impact:
            </p>
            <ul>
                <li><strong>Vodafone</strong> improved LCP by 31% and saw a 8% increase in sales.</li>
                <li><strong>NDTV</strong> reduced LCP by 55% and saw a 50% reduction in bounce rate.</li>
                <li><strong>Agrofy</strong> achieved 76% more organic traffic after reaching "good" CWV thresholds.</li>
            </ul>
            <p>
                The pattern is clear: faster pages with better CWV scores lead to more traffic, lower bounce rates, and higher conversions. And image optimisation is the fastest path to better CWV scores.
            </p>

            <h2>Start Improving Your CWV Scores</h2>
            <p>
                Begin with the highest-impact optimisation: compress and convert your hero image. Use our <a href="/#compress">Image Compressor</a> and <a href="/#convert">Image Converter</a> to get it under 200 KB in WebP format. Then work through the checklist above for all remaining images.
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
            <a href="/blog/image-seo-best-practices" class="bg-white rounded-2xl border border-gray-200/60 p-6 hover:shadow-lg transition-shadow group">
                <span class="inline-block bg-green-100 text-green-700 text-xs font-semibold px-2.5 py-1 rounded-full mb-3">SEO</span>
                <h3 class="font-bold mb-2 group-hover:text-brand-600 transition-colors">Image SEO Best Practices for Higher Rankings</h3>
                <p class="text-sm text-gray-500">Alt text, file names, structured data, and more.</p>
            </a>
        </div>
    </div>
</article>
@endsection
