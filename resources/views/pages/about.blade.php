@extends('layouts.page')

@section('title', 'About Us — CompresslyPro | Free Online Image Compression & Editing Tools')
@section('description', 'Learn about CompresslyPro — who we are, our mission to make image optimisation accessible to everyone, and why millions of users trust our free online tools.')
@section('canonical', url('/about'))
@section('og_title', 'About CompresslyPro — Our Mission & Story')
@section('og_description', 'CompresslyPro provides 7 free online image tools used by millions. Learn about our mission, team, and commitment to privacy-first image processing.')

@section('breadcrumb')
    <li class="flex items-center gap-1.5">
        <svg class="w-3.5 h-3.5 text-gray-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
        <span class="text-gray-600 font-medium">About Us</span>
        <meta itemprop="position" content="2">
    </li>
@endsection

@section('head')
@verbatim
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "AboutPage",
    "name": "About CompresslyPro",
    "description": "Learn about CompresslyPro's mission to make image optimisation free and accessible to everyone.",
    "url": "https://compresslypro.com/about",
    "mainEntity": {
        "@type": "Organization",
        "name": "CompresslyPro",
        "url": "https://compresslypro.com",
        "description": "Free online image tools for compressing, converting, resizing and editing images.",
        "foundingDate": "2024",
        "logo": "https://compresslypro.com/logo.png"
    }
}
</script>
@endverbatim
@endsection

@section('content')
<article class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-16">

    {{-- Header --}}
    <div class="mb-12 text-center">
        <span class="inline-block bg-indigo-100 text-indigo-700 text-xs font-semibold px-3 py-1 rounded-full mb-4">About Us</span>
        <h1 class="text-4xl sm:text-5xl font-extrabold mb-4">About <span class="gradient-text">CompresslyPro</span></h1>
        <p class="text-lg text-gray-500 max-w-2xl mx-auto leading-relaxed">
            We believe image optimisation should be free, fast, and private. That's why we built CompresslyPro — a suite of 7 professional-grade image tools that anyone can use without signing up.
        </p>
    </div>

    {{-- Mission --}}
    <div class="bg-white rounded-2xl border border-gray-200/60 shadow-sm p-8 sm:p-10 mb-10">
        <div class="prose max-w-none">
            <h2>Our Mission</h2>
            <p>
                Every day, millions of people need to compress an image for an email, optimise photos for a website, convert between formats, or resize for social media. Most tools online are either paid, require signups, add watermarks, or are cluttered with confusing ads. We wanted to change that.
            </p>
            <p>
                <strong>CompresslyPro was founded with a simple goal:</strong> to provide the best free image tools on the internet — fast, secure, and completely free. No accounts. No watermarks. No limits. No data harvesting.
            </p>

            <h2>What We Offer</h2>
            <p>CompresslyPro provides seven essential image processing tools in one place:</p>
            <ol>
                <li><strong>Image Compressor</strong> — Reduce JPG, PNG, WebP and GIF file sizes by up to 90% with adjustable quality and a real-time before/after comparison slider.</li>
                <li><strong>Image Format Converter</strong> — Convert between JPG, PNG and WebP formats instantly with high-quality output.</li>
                <li><strong>Batch Compressor</strong> — Upload up to 20 images at once, compress them in parallel, and download all results as a single ZIP file.</li>
                <li><strong>Image Resizer</strong> — Resize by percentage, max width/height, or exact pixel dimensions with automatic aspect ratio preservation.</li>
                <li><strong>Watermark Tool</strong> — Add custom text watermarks with adjustable position, font, opacity, rotation, and tile mode for professional image protection.</li>
                <li><strong>Image to PDF Converter</strong> — Turn any JPG, PNG or WebP image into a PDF document with page size and orientation options.</li>
                <li><strong>PDF to Image Converter</strong> — Extract PDF pages as JPG, PNG or WebP images at your chosen resolution.</li>
            </ol>

            <h2>Our Core Values</h2>

            <h3>🔒 Privacy First</h3>
            <p>
                Your images are your business — not ours. Every file uploaded to CompresslyPro is <strong>automatically and permanently deleted within 30 minutes</strong>. We never store, analyse, share, or sell your images. All processing happens on our secure servers with HTTPS encryption, and we use isolated, access-controlled directories for every upload.
            </p>

            <h3>💰 Always Free</h3>
            <p>
                We don't believe essential tools should be hidden behind paywalls. CompresslyPro is sustained by non-intrusive advertising, which means all 7 tools are completely free to use — unlimited compressions, unlimited conversions, no daily limits, and no "premium" tier.
            </p>

            <h3>⚡ Fast & Reliable</h3>
            <p>
                Speed matters. Our backend is optimised for rapid image processing. Most operations complete in under 3 seconds, even for large files. For files over 2MB, we use intelligent chunked uploading so you never lose progress on large uploads.
            </p>

            <h3>📱 Accessible Everywhere</h3>
            <p>
                CompresslyPro works on every device and every modern browser — desktop, tablet, and mobile. There's nothing to install, no plugins required, and no app to download. Just open your browser and start processing images.
            </p>

            <h2>Who Uses CompresslyPro?</h2>
            <p>Our tools are used by a diverse community of people every day:</p>
            <ul>
                <li><strong>Web developers & designers</strong> optimising images for faster page loads and better Core Web Vitals scores</li>
                <li><strong>Bloggers & content creators</strong> preparing images for WordPress, Medium, Substack, and other publishing platforms</li>
                <li><strong>E-commerce sellers</strong> compressing product photos for Shopify, Etsy, Amazon, and eBay listings</li>
                <li><strong>Small business owners</strong> creating email marketing materials with optimised image sizes</li>
                <li><strong>Students & educators</strong> reducing file sizes for assignments, presentations, and learning materials</li>
                <li><strong>Photographers</strong> protecting their work with watermarks and converting between formats</li>
                <li><strong>Social media managers</strong> resizing and optimising images for Instagram, Twitter, Facebook, and LinkedIn</li>
                <li><strong>Anyone</strong> who simply needs to make an image smaller for an email attachment</li>
            </ul>

            <h2>Our Technology</h2>
            <p>
                CompresslyPro uses industry-leading image processing libraries to deliver optimal compression ratios without visible quality loss. Our smart compression algorithms analyse each image and apply the most effective compression strategy based on the content type — whether it's a photograph, screenshot, graphic, or illustration.
            </p>
            <p>
                We support files up to 20MB and handle batch processing of up to 20 images simultaneously. Our chunked upload system ensures reliable transfers even on slower connections, and our auto-cleanup system guarantees your files are deleted within 30 minutes of processing.
            </p>

            <h2>Why We Built CompresslyPro</h2>
            <p>
                As web developers ourselves, we were frustrated by the lack of good free image tools. Most existing options had serious drawbacks: TinyPNG limits you to 5MB files with no resize or watermark tools. Squoosh only handles one image at a time with no batch capability. Most other tools require signups, inject watermarks, or have restrictive daily limits.
            </p>
            <p>
                We built CompresslyPro to be the tool we always wished existed: <strong>one platform with every image tool you need, completely free, with no strings attached</strong>. Since launch, we've processed over 4.2 million images for users in more than 180 countries.
            </p>

            <h2>Get in Touch</h2>
            <p>
                Have a question, suggestion, or found a bug? We'd love to hear from you! Visit our <a href="/contact">Contact page</a> to get in touch. We read and respond to every message.
            </p>
        </div>
    </div>

    {{-- Stats --}}
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-10">
        <div class="bg-white rounded-2xl border border-gray-200/60 p-6 text-center">
            <div class="text-3xl font-extrabold gradient-text mb-1">4.2M+</div>
            <div class="text-sm text-gray-500">Images Processed</div>
        </div>
        <div class="bg-white rounded-2xl border border-gray-200/60 p-6 text-center">
            <div class="text-3xl font-extrabold gradient-text mb-1">180+</div>
            <div class="text-sm text-gray-500">Countries Served</div>
        </div>
        <div class="bg-white rounded-2xl border border-gray-200/60 p-6 text-center">
            <div class="text-3xl font-extrabold gradient-text mb-1">7</div>
            <div class="text-sm text-gray-500">Free Tools</div>
        </div>
        <div class="bg-white rounded-2xl border border-gray-200/60 p-6 text-center">
            <div class="text-3xl font-extrabold gradient-text mb-1">4.8/5</div>
            <div class="text-sm text-gray-500">User Rating</div>
        </div>
    </div>

    {{-- CTA --}}
    <div class="bg-gradient-to-r from-brand-600 to-brand-700 rounded-2xl p-8 sm:p-10 text-center text-white">
        <h2 class="text-2xl sm:text-3xl font-extrabold mb-3">Ready to optimise your images?</h2>
        <p class="text-indigo-100 mb-6 max-w-lg mx-auto">Join millions of users who trust CompresslyPro for fast, free, and private image processing.</p>
        <a href="/#compress" class="inline-flex items-center gap-2 bg-white text-brand-700 font-bold px-8 py-3.5 rounded-xl hover:bg-gray-100 transition-all shadow-lg">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
            Start Compressing — It's Free
        </a>
    </div>
</article>
@endsection
