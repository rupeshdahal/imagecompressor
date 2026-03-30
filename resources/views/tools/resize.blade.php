@extends('layouts.page')

@section('title', 'Free Image Resizer Online — Resize JPG, PNG, WebP by Pixels or Percentage | CompresslyPro')
@section('description', 'Resize images online for free. Set exact pixel dimensions, resize by percentage, or define max width/height. Aspect ratio preserved automatically. Supports JPG, PNG, WebP.')
@section('canonical', url('/resize'))
@section('og_type', 'website')
@section('og_title', 'Free Image Resizer — Resize Images by Pixels, Percentage, or Max Dimensions')
@section('og_description', 'Resize JPG, PNG, WebP images online. Exact pixels, percentage, max width/height. Free, no signup.')

@section('breadcrumb')
    <li class="flex items-center gap-1.5">
        <svg class="w-3.5 h-3.5 text-gray-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
        <span class="text-gray-600 font-medium" itemprop="name">Image Resizer</span>
        <meta itemprop="position" content="2">
    </li>
@endsection

@section('head')
@verbatim
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "SoftwareApplication",
    "name": "CompresslyPro Image Resizer",
    "description": "Free online image resizer. Resize by exact pixels, percentage, or maximum dimensions.",
    "image": ["https://compresslypro.com/og-image.png"],
    "url": "https://compresslypro.com/resize",
    "applicationCategory": "MultimediaApplication",
    "operatingSystem": "All",
    "isAccessibleForFree": true,
    "offers": {
        "@type": "Offer",
        "price": "0",
        "priceCurrency": "USD",
        "availability": "https://schema.org/InStock",
        "priceValidUntil": "2030-12-31"
    }
}
</script>
@endverbatim
@endsection

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

    <div class="text-center mb-10">
        <div class="inline-flex items-center gap-2 bg-orange-50 text-orange-700 text-sm font-semibold px-4 py-1.5 rounded-full mb-4">
            ↔️ Free · Instant · Aspect Ratio Preserved
        </div>
        <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight leading-tight mb-4">
            Resize Images <span class="gradient-text">Online Free</span>
        </h1>
        <p class="text-lg text-gray-500 max-w-2xl mx-auto leading-relaxed">
            Resize JPG, PNG, and WebP images by <strong class="text-gray-700">exact pixels, percentage, max width, or max height</strong>. Aspect ratio preserved automatically. No signup required.
        </p>
    </div>

    <div class="bg-white rounded-3xl border-2 border-dashed border-orange-300 p-10 text-center mb-14 hover:border-orange-500 hover:shadow-lg transition-all">
        <div class="mx-auto w-20 h-20 bg-gradient-to-br from-orange-500 to-orange-700 rounded-3xl flex items-center justify-center mb-5 shadow-xl shadow-orange-500/25">
            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3.75v4.5m0-4.5h4.5m-4.5 0L9 9M3.75 20.25v-4.5m0 4.5h4.5m-4.5 0L9 15M20.25 3.75h-4.5m4.5 0v4.5m0-4.5L15 9m5.25 11.25h-4.5m4.5 0v-4.5m0 4.5L15 15"/></svg>
        </div>
        <h2 class="text-xl font-bold mb-2">Ready to Resize Your Images?</h2>
        <p class="text-gray-500 mb-6 max-w-md mx-auto">Upload your image and set your desired dimensions. Original file is not modified.</p>
        <a href="/#resize" class="inline-flex items-center gap-2 bg-gradient-to-r from-orange-600 to-orange-700 text-white font-bold px-8 py-3.5 rounded-2xl shadow-lg shadow-orange-500/25 hover:shadow-xl hover:from-orange-500 hover:to-orange-600 transition-all text-base">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3.75v4.5m0-4.5h4.5m-4.5 0L9 9M3.75 20.25v-4.5m0 4.5h4.5m-4.5 0L9 15M20.25 3.75h-4.5m4.5 0v4.5m0-4.5L15 9m5.25 11.25h-4.5m4.5 0v-4.5m0 4.5L15 15"/></svg>
            Open Image Resizer
        </a>
    </div>

    <div class="bg-white rounded-2xl border border-gray-200/60 shadow-sm p-8 sm:p-10 mb-10">
        <div class="prose max-w-none">
            <h2>How to Resize Images Online</h2>
            <ol>
                <li><strong>Upload your image.</strong> Drag and drop or click to select a JPG, PNG, or WebP file up to 20 MB.</li>
                <li><strong>Choose resize method.</strong> Select from four options: resize by percentage, set a max width, set a max height, or enter exact pixel dimensions.</li>
                <li><strong>Download the resized image.</strong> Click Resize, then download your new image. The original remains unchanged.</li>
            </ol>

            <h2>Resize Methods Explained</h2>
            <table>
                <thead><tr><th>Method</th><th>How It Works</th><th>Best For</th></tr></thead>
                <tbody>
                    <tr><td><strong>By Percentage</strong></td><td>Scale the image to a % of its original size (e.g., 50% = half size)</td><td>Quick proportional scaling</td></tr>
                    <tr><td><strong>Max Width</strong></td><td>Set a maximum width in pixels. Height scales proportionally.</td><td>Fitting images into web layouts</td></tr>
                    <tr><td><strong>Max Height</strong></td><td>Set a maximum height in pixels. Width scales proportionally.</td><td>Email signatures, thumbnails</td></tr>
                    <tr><td><strong>Exact Dimensions</strong></td><td>Set both width and height in pixels.</td><td>Social media images, specific requirements</td></tr>
                </tbody>
            </table>

            <h2>Common Image Sizes for Social Media</h2>
            <table>
                <thead><tr><th>Platform</th><th>Image Type</th><th>Recommended Size</th></tr></thead>
                <tbody>
                    <tr><td>Instagram</td><td>Square post</td><td>1080 × 1080 px</td></tr>
                    <tr><td>Instagram</td><td>Story / Reel</td><td>1080 × 1920 px</td></tr>
                    <tr><td>Facebook</td><td>Post image</td><td>1200 × 630 px</td></tr>
                    <tr><td>Twitter / X</td><td>Post image</td><td>1200 × 675 px</td></tr>
                    <tr><td>LinkedIn</td><td>Post image</td><td>1200 × 627 px</td></tr>
                    <tr><td>YouTube</td><td>Thumbnail</td><td>1280 × 720 px</td></tr>
                    <tr><td>Pinterest</td><td>Pin</td><td>1000 × 1500 px</td></tr>
                </tbody>
            </table>

            <h2>Why Resize Before Uploading?</h2>
            <ul>
                <li><strong>Faster page loads.</strong> A 4000px photo displayed at 800px wastes bandwidth. Resizing first can reduce file size by 75%+ before any compression.</li>
                <li><strong>Better Core Web Vitals.</strong> Properly sized images improve Largest Contentful Paint (LCP) scores, which affects Google rankings.</li>
                <li><strong>Smaller email attachments.</strong> Resize photos to 1600px wide before emailing — plenty of detail at a fraction of the file size.</li>
                <li><strong>Social media compliance.</strong> Each platform has ideal image dimensions. Uploading the right size ensures your images display perfectly.</li>
            </ul>

            <h2>Frequently Asked Questions</h2>
            <h3>Does resizing reduce quality?</h3>
            <p>Downscaling (making smaller) generally maintains excellent quality. Upscaling (making larger) can introduce blurriness since the tool must generate new pixels. For best results, avoid enlarging images beyond their original dimensions.</p>

            <h3>Is the aspect ratio preserved?</h3>
            <p>Yes, by default. When you set a max width or max height, the other dimension adjusts proportionally. When using exact dimensions, both values are applied as specified.</p>
        </div>
    </div>

    <div class="mb-10">
        <h2 class="text-2xl font-extrabold mb-6">Related Tools</h2>
        <div class="grid sm:grid-cols-3 gap-4">
            <a href="/compress" class="bg-white rounded-2xl border border-gray-200/60 p-5 hover:shadow-lg transition-shadow group text-center">
                <div class="text-3xl mb-2">🗜️</div>
                <h3 class="font-bold text-sm mb-1 group-hover:text-brand-600 transition-colors">Image Compressor</h3>
                <p class="text-xs text-gray-500">Reduce image size up to 90%</p>
            </a>
            <a href="/convert" class="bg-white rounded-2xl border border-gray-200/60 p-5 hover:shadow-lg transition-shadow group text-center">
                <div class="text-3xl mb-2">🔄</div>
                <h3 class="font-bold text-sm mb-1 group-hover:text-brand-600 transition-colors">Image Converter</h3>
                <p class="text-xs text-gray-500">Convert between JPG, PNG, WebP</p>
            </a>
            <a href="/batch-compress" class="bg-white rounded-2xl border border-gray-200/60 p-5 hover:shadow-lg transition-shadow group text-center">
                <div class="text-3xl mb-2">📦</div>
                <h3 class="font-bold text-sm mb-1 group-hover:text-brand-600 transition-colors">Batch Compressor</h3>
                <p class="text-xs text-gray-500">Compress up to 20 images at once</p>
            </a>
        </div>
    </div>
</div>
@endsection
