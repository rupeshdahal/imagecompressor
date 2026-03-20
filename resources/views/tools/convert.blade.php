@extends('layouts.page')

@section('title', 'Free Image Converter Online — Convert JPG, PNG, WebP Instantly | CompresslyPro')
@section('description', 'Convert images between JPG, PNG and WebP formats online for free. High-quality format conversion with no file size limits. No signup required. Instant results.')
@section('canonical', url('/tools/convert'))
@section('og_type', 'website')
@section('og_title', 'Free Image Converter — Convert JPG to PNG, PNG to WebP & More')
@section('og_description', 'Convert between JPG, PNG and WebP formats instantly. Free online image converter with no signup required.')

@section('breadcrumb')
    <li class="flex items-center gap-1.5">
        <svg class="w-3.5 h-3.5 text-gray-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
        <span class="text-gray-600 font-medium" itemprop="name">Image Converter</span>
        <meta itemprop="position" content="2">
    </li>
@endsection

@section('head')
@verbatim
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "SoftwareApplication",
    "name": "CompresslyPro Image Converter",
    "description": "Free online image converter. Convert between JPG, PNG and WebP formats instantly.",
    "image": ["https://compresslypro.com/og-image.png"],
    "url": "https://compresslypro.com/tools/convert",
    "applicationCategory": "MultimediaApplication",
    "operatingSystem": "All",
    "isAccessibleForFree": true,
    "offers": {
        "@type": "Offer",
        "price": "0",
        "priceCurrency": "USD",
        "availability": "https://schema.org/InStock",
        "priceValidUntil": "2030-12-31",
        "hasMerchantReturnPolicy": {
            "@type": "MerchantReturnPolicy",
            "applicableCountry": "US",
            "returnPolicyCategory": "https://schema.org/MerchantReturnNotPermitted"
        },
        "shippingDetails": {
            "@type": "OfferShippingDetails",
            "shippingDestination": {
                "@type": "DefinedRegion",
                "addressCountry": "US"
            },
            "shippingRate": {
                "@type": "MonetaryAmount",
                "value": "0",
                "currency": "USD"
            }
        }
    }
}
</script>
@endverbatim
@endsection

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

    <div class="text-center mb-10">
        <div class="inline-flex items-center gap-2 bg-purple-50 text-purple-700 text-sm font-semibold px-4 py-1.5 rounded-full mb-4">
            🔄 Free · Instant · No Signup
        </div>
        <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight leading-tight mb-4">
            Convert Images <span class="gradient-text">Online Free</span>
        </h1>
        <p class="text-lg text-gray-500 max-w-2xl mx-auto leading-relaxed">
            Convert between <strong class="text-gray-700">JPG, PNG, and WebP</strong> formats instantly. High-quality conversion with no file size limits and no registration required.
        </p>
    </div>

    <div class="bg-white rounded-3xl border-2 border-dashed border-purple-300 p-10 text-center mb-14 hover:border-purple-500 hover:shadow-lg transition-all">
        <div class="mx-auto w-20 h-20 bg-gradient-to-br from-purple-500 to-purple-700 rounded-3xl flex items-center justify-center mb-5 shadow-xl shadow-purple-500/25">
            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M7.5 21L3 16.5m0 0L7.5 12M3 16.5h13.5m0-13.5L21 7.5m0 0L16.5 12M21 7.5H7.5"/></svg>
        </div>
        <h2 class="text-xl font-bold mb-2">Ready to Convert Your Images?</h2>
        <p class="text-gray-500 mb-6 max-w-md mx-auto">Upload your image and choose the target format. Supports JPG, PNG, and WebP.</p>
        <a href="/#convert" class="inline-flex items-center gap-2 bg-gradient-to-r from-purple-600 to-purple-700 text-white font-bold px-8 py-3.5 rounded-2xl shadow-lg shadow-purple-500/25 hover:shadow-xl hover:from-purple-500 hover:to-purple-600 transition-all text-base">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M7.5 21L3 16.5m0 0L7.5 12M3 16.5h13.5m0-13.5L21 7.5m0 0L16.5 12M21 7.5H7.5"/></svg>
            Open Image Converter
        </a>
    </div>

    <div class="bg-white rounded-2xl border border-gray-200/60 shadow-sm p-8 sm:p-10 mb-10">
        <div class="prose max-w-none">
            <h2>How to Convert Image Formats Online</h2>
            <ol>
                <li><strong>Upload your image.</strong> Drag and drop a JPG, PNG, or WebP file into the converter, or click to browse your files.</li>
                <li><strong>Choose the output format.</strong> Select your target format — JPG, PNG, or WebP. The converter automatically handles the conversion with optimal settings.</li>
                <li><strong>Download the converted image.</strong> Click Download to save your newly converted file. The original image remains unchanged.</li>
            </ol>

            <h2>Supported Conversions</h2>
            <table>
                <thead><tr><th>From</th><th>To</th><th>Best For</th></tr></thead>
                <tbody>
                    <tr><td>JPG → PNG</td><td>✅</td><td>When you need transparency support or lossless quality</td></tr>
                    <tr><td>JPG → WebP</td><td>✅</td><td>25–35% smaller files for web use — best for performance</td></tr>
                    <tr><td>PNG → JPG</td><td>✅</td><td>Significantly smaller files when transparency isn't needed</td></tr>
                    <tr><td>PNG → WebP</td><td>✅</td><td>Up to 26% smaller than PNG with lossless quality</td></tr>
                    <tr><td>WebP → JPG</td><td>✅</td><td>Broad compatibility with older software and email clients</td></tr>
                    <tr><td>WebP → PNG</td><td>✅</td><td>Lossless format for editing workflows</td></tr>
                </tbody>
            </table>

            <h2>When to Use Each Format</h2>
            <h3>JPG (JPEG)</h3>
            <p>Best for photographs and complex images with smooth colour transitions. Universal compatibility across all browsers, email clients, and devices. Uses lossy compression — smaller files but some quality loss on each save.</p>

            <h3>PNG</h3>
            <p>Best for screenshots, graphics, logos, and any image requiring transparency. Lossless compression preserves every pixel perfectly. Files are larger than JPG or WebP for photographic content.</p>

            <h3>WebP</h3>
            <p>The modern web standard. Supports both lossy and lossless compression, transparency, and animation. 25–35% smaller than JPG and 26% smaller than PNG at equivalent quality. Supported by 97%+ of browsers.</p>

            <h2>Why Convert to WebP?</h2>
            <p>WebP is the optimal format for web images in 2026. Switching from JPG/PNG to WebP typically provides:</p>
            <ul>
                <li><strong>25–35% smaller files</strong> compared to JPEG at equivalent visual quality</li>
                <li><strong>26% smaller files</strong> compared to PNG for lossless images</li>
                <li><strong>Better Core Web Vitals</strong> — smaller images mean faster Largest Contentful Paint (LCP)</li>
                <li><strong>Transparency support</strong> — unlike JPEG, WebP handles alpha channels</li>
            </ul>

            <h2>Frequently Asked Questions</h2>
            <h3>Does converting formats lose quality?</h3>
            <p>Converting to a lossless format (PNG, lossless WebP) preserves all quality. Converting to a lossy format (JPG, lossy WebP) may introduce minor compression artifacts, but our converter uses optimal settings to minimise any quality impact.</p>

            <h3>Can I convert multiple images at once?</h3>
            <p>The converter processes one image at a time. For batch operations, use our <a href="/tools/batch-compress">Batch Compressor</a> which can handle up to 20 images simultaneously.</p>

            <h3>Is the conversion done on my device?</h3>
            <p>The conversion is processed on our secure servers for the best quality results. All files are automatically deleted within 30 minutes.</p>
        </div>
    </div>

    <div class="mb-10">
        <h2 class="text-2xl font-extrabold mb-6">Related Tools</h2>
        <div class="grid sm:grid-cols-3 gap-4">
            <a href="/tools/compress" class="bg-white rounded-2xl border border-gray-200/60 p-5 hover:shadow-lg transition-shadow group text-center">
                <div class="text-3xl mb-2">🗜️</div>
                <h3 class="font-bold text-sm mb-1 group-hover:text-brand-600 transition-colors">Image Compressor</h3>
                <p class="text-xs text-gray-500">Reduce image size up to 90%</p>
            </a>
            <a href="/tools/resize" class="bg-white rounded-2xl border border-gray-200/60 p-5 hover:shadow-lg transition-shadow group text-center">
                <div class="text-3xl mb-2">↔️</div>
                <h3 class="font-bold text-sm mb-1 group-hover:text-brand-600 transition-colors">Image Resizer</h3>
                <p class="text-xs text-gray-500">Resize by pixels or percentage</p>
            </a>
            <a href="/tools/watermark" class="bg-white rounded-2xl border border-gray-200/60 p-5 hover:shadow-lg transition-shadow group text-center">
                <div class="text-3xl mb-2">🖊️</div>
                <h3 class="font-bold text-sm mb-1 group-hover:text-brand-600 transition-colors">Add Watermark</h3>
                <p class="text-xs text-gray-500">Protect images with text watermarks</p>
            </a>
        </div>
    </div>

    <div>
        <h2 class="text-2xl font-extrabold mb-6">Learn More</h2>
        <div class="grid sm:grid-cols-2 gap-4">
            <a href="/blog/webp-vs-jpg-vs-png" class="bg-white rounded-2xl border border-gray-200/60 p-5 hover:shadow-lg transition-shadow group">
                <h3 class="font-bold text-sm mb-1 group-hover:text-brand-600 transition-colors">WebP vs JPG vs PNG: Which Format Should You Use?</h3>
                <p class="text-xs text-gray-500">Detailed comparison with real-world file size data.</p>
            </a>
            <a href="/blog/how-to-compress-images-for-web" class="bg-white rounded-2xl border border-gray-200/60 p-5 hover:shadow-lg transition-shadow group">
                <h3 class="font-bold text-sm mb-1 group-hover:text-brand-600 transition-colors">Complete Guide to Image Compression for the Web</h3>
                <p class="text-xs text-gray-500">Everything about formats, quality settings, and optimisation.</p>
            </a>
        </div>
    </div>
</div>
@endsection
