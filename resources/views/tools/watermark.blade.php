@extends('layouts.page')

@section('title', 'Free Add Watermark to Image Online — Text Watermark Tool | CompresslyPro')
@section('description', 'Add custom text watermarks to images online for free. Choose position, opacity, font size, and rotation. Protect your photos from unauthorised use. No signup required.')
@section('canonical', url('/tools/watermark'))
@section('og_type', 'website')
@section('og_title', 'Free Image Watermark Tool — Add Text Watermarks to Photos Online')
@section('og_description', 'Add custom text watermarks to your images. Set position, opacity, font size and rotation. Free, no signup.')

@section('breadcrumb')
    <li class="flex items-center gap-1.5">
        <svg class="w-3.5 h-3.5 text-gray-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
        <span class="text-gray-600 font-medium" itemprop="name">Watermark Tool</span>
        <meta itemprop="position" content="2">
    </li>
@endsection

@section('head')
@verbatim
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "SoftwareApplication",
    "name": "CompresslyPro Watermark Tool",
    "description": "Add custom text watermarks to images online for free.",
    "url": "https://compresslypro.com/tools/watermark",
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
        <div class="inline-flex items-center gap-2 bg-pink-50 text-pink-700 text-sm font-semibold px-4 py-1.5 rounded-full mb-4">
            🖊️ Free · Custom Text · No Signup
        </div>
        <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight leading-tight mb-4">
            Add Watermark to Images <span class="gradient-text">Online Free</span>
        </h1>
        <p class="text-lg text-gray-500 max-w-2xl mx-auto leading-relaxed">
            Protect your photos with <strong class="text-gray-700">custom text watermarks</strong>. Choose position, opacity, font size, font family, and rotation. Single or tiled watermark placement.
        </p>
    </div>

    <div class="bg-white rounded-3xl border-2 border-dashed border-pink-300 p-10 text-center mb-14 hover:border-pink-500 hover:shadow-lg transition-all">
        <div class="mx-auto w-20 h-20 bg-gradient-to-br from-pink-500 to-pink-700 rounded-3xl flex items-center justify-center mb-5 shadow-xl shadow-pink-500/25">
            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"/></svg>
        </div>
        <h2 class="text-xl font-bold mb-2">Ready to Add a Watermark?</h2>
        <p class="text-gray-500 mb-6 max-w-md mx-auto">Upload your image, type your watermark text, and customise placement.</p>
        <a href="/#tools" class="inline-flex items-center gap-2 bg-gradient-to-r from-pink-600 to-pink-700 text-white font-bold px-8 py-3.5 rounded-2xl shadow-lg shadow-pink-500/25 hover:shadow-xl hover:from-pink-500 hover:to-pink-600 transition-all text-base">
            🖊️ Open Watermark Tool
        </a>
    </div>

    <div class="bg-white rounded-2xl border border-gray-200/60 shadow-sm p-8 sm:p-10 mb-10">
        <div class="prose max-w-none">
            <h2>How to Add a Watermark to Your Image</h2>
            <ol>
                <li><strong>Upload your image.</strong> Drag and drop a JPG, PNG, or WebP file into the watermark tool.</li>
                <li><strong>Enter watermark text.</strong> Type your desired watermark — your name, brand, copyright notice, or any custom text.</li>
                <li><strong>Customise settings.</strong> Choose position (center, top-left, top-right, bottom-left, bottom-right), opacity (10–100%), font size, font family, and rotation angle.</li>
                <li><strong>Download.</strong> Click Apply Watermark, then download the protected image.</li>
            </ol>

            <h2>Watermark Options</h2>
            <table>
                <thead><tr><th>Setting</th><th>Options</th><th>Recommendation</th></tr></thead>
                <tbody>
                    <tr><td><strong>Position</strong></td><td>Center, Top-Left, Top-Right, Bottom-Left, Bottom-Right, Tile</td><td>Center or Bottom-Right for copyright. Tile for maximum protection.</td></tr>
                    <tr><td><strong>Opacity</strong></td><td>10–100%</td><td>30–50% for subtle branding. 60–80% for strong protection.</td></tr>
                    <tr><td><strong>Font Size</strong></td><td>Adjustable in pixels</td><td>Match to image size. Larger images need larger fonts.</td></tr>
                    <tr><td><strong>Rotation</strong></td><td>0–360 degrees</td><td>-30° to -45° for diagonal watermarks (harder to remove).</td></tr>
                </tbody>
            </table>

            <h2>Why Watermark Your Images?</h2>
            <ul>
                <li><strong>Protect intellectual property.</strong> Watermarks deter unauthorised use of your photographs and designs.</li>
                <li><strong>Build brand recognition.</strong> A subtle watermark with your logo or name helps viewers identify your work across the web.</li>
                <li><strong>Prove ownership.</strong> In copyright disputes, watermarked originals help establish that you are the creator.</li>
                <li><strong>Prevent image theft.</strong> Tiled watermarks are especially effective because they cover the entire image, making removal extremely difficult.</li>
            </ul>

            <h2>Watermark Best Practices</h2>
            <ul>
                <li><strong>Keep it subtle for portfolios.</strong> Use 30–40% opacity so the watermark is visible but doesn't distract from the image quality.</li>
                <li><strong>Use tile mode for proofs.</strong> When sending client proofs, use tiled watermarks that cover the entire image to prevent unauthorised use before payment.</li>
                <li><strong>Include your brand name or URL.</strong> A web address watermark doubles as marketing when images are shared.</li>
                <li><strong>Consider placement carefully.</strong> Bottom-right is conventional and less intrusive. Centre is harder to crop out.</li>
            </ul>

            <h2>Frequently Asked Questions</h2>
            <h3>Can I add a logo watermark?</h3>
            <p>Currently, the tool supports text-based watermarks only. You can enter your brand name, copyright notice, or website URL as the watermark text.</p>

            <h3>Does the watermark modify my original image?</h3>
            <p>No. The tool creates a new copy with the watermark applied. Your original image remains untouched.</p>
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
            <a href="/tools/image-to-pdf" class="bg-white rounded-2xl border border-gray-200/60 p-5 hover:shadow-lg transition-shadow group text-center">
                <div class="text-3xl mb-2">📄</div>
                <h3 class="font-bold text-sm mb-1 group-hover:text-brand-600 transition-colors">Image to PDF</h3>
                <p class="text-xs text-gray-500">Convert images to PDF documents</p>
            </a>
        </div>
    </div>
</div>
@endsection
