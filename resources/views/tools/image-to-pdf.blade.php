@extends('layouts.page')

@section('title', 'Free Image to PDF Converter Online — JPG PNG WebP to PDF | CompresslyPro')
@section('description', 'Convert JPG, PNG, and WebP images to PDF documents online for free. Merge multiple images into a single PDF with custom page size and orientation. No signup required.')
@section('canonical', url('/tools/image-to-pdf'))
@section('og_type', 'website')
@section('og_title', 'Free Image to PDF Converter — Merge Multiple Images into One PDF')
@section('og_description', 'Convert JPG, PNG, WebP images to PDF. Merge multiple images into one document. Choose page size, orientation, and margins. Free online tool.')

@section('breadcrumb')
    <li class="flex items-center gap-1.5">
        <svg class="w-3.5 h-3.5 text-gray-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
        <span class="text-gray-600 font-medium" itemprop="name">Image to PDF</span>
        <meta itemprop="position" content="2">
    </li>
@endsection

@section('head')
@verbatim
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "SoftwareApplication",
    "name": "CompresslyPro Image to PDF Converter",
    "description": "Convert JPG, PNG, and WebP images to PDF documents online for free.",
    "image": ["https://compresslypro.com/og-image.png"],
    "url": "https://compresslypro.com/tools/image-to-pdf",
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
        <div class="inline-flex items-center gap-2 bg-amber-50 text-amber-700 text-sm font-semibold px-4 py-1.5 rounded-full mb-4">
            📄 Free · Multi-Image · No Signup
        </div>
        <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight leading-tight mb-4">
            Convert Images to PDF <span class="gradient-text">Online Free</span>
        </h1>
        <p class="text-lg text-gray-500 max-w-2xl mx-auto leading-relaxed">
            Turn <strong class="text-gray-700">JPG, PNG, and WebP images</strong> into professional PDF documents. Merge multiple images into a single PDF with custom page size, orientation, and margins.
        </p>
    </div>

    <div class="bg-white rounded-3xl border-2 border-dashed border-amber-300 p-10 text-center mb-14 hover:border-amber-500 hover:shadow-lg transition-all">
        <div class="mx-auto w-20 h-20 bg-gradient-to-br from-amber-500 to-amber-700 rounded-3xl flex items-center justify-center mb-5 shadow-xl shadow-amber-500/25">
            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/></svg>
        </div>
        <h2 class="text-xl font-bold mb-2">Ready to Create a PDF?</h2>
        <p class="text-gray-500 mb-6 max-w-md mx-auto">Upload your images, choose page settings, and merge into a PDF.</p>
        <a href="/#tools" class="inline-flex items-center gap-2 bg-gradient-to-r from-amber-600 to-amber-700 text-white font-bold px-8 py-3.5 rounded-2xl shadow-lg shadow-amber-500/25 hover:shadow-xl hover:from-amber-500 hover:to-amber-600 transition-all text-base">
            📄 Open Image to PDF Tool
        </a>
    </div>

    <div class="bg-white rounded-2xl border border-gray-200/60 shadow-sm p-8 sm:p-10 mb-10">
        <div class="prose max-w-none">
            <h2>How to Convert Images to PDF</h2>
            <ol>
                <li><strong>Upload images.</strong> Drag and drop or select one or more JPG, PNG, or WebP files.</li>
                <li><strong>Arrange order.</strong> Reorder images as needed — they will appear in the PDF in the order shown.</li>
                <li><strong>Choose page settings.</strong> Select page size (A4, Letter, A3, Legal), orientation (Portrait or Landscape), and margin.</li>
                <li><strong>Convert &amp; download.</strong> Click "Convert to PDF" and download your merged PDF document.</li>
            </ol>

            <h2>Supported Image Formats</h2>
            <table>
                <thead><tr><th>Format</th><th>Extension</th><th>Best For</th></tr></thead>
                <tbody>
                    <tr><td><strong>JPEG</strong></td><td>.jpg, .jpeg</td><td>Photographs, scanned documents</td></tr>
                    <tr><td><strong>PNG</strong></td><td>.png</td><td>Screenshots, graphics with transparency</td></tr>
                    <tr><td><strong>WebP</strong></td><td>.webp</td><td>Modern web images, smaller file sizes</td></tr>
                </tbody>
            </table>

            <h2>Page Size Options</h2>
            <table>
                <thead><tr><th>Size</th><th>Dimensions (mm)</th><th>Common Use</th></tr></thead>
                <tbody>
                    <tr><td><strong>A4</strong></td><td>210 × 297</td><td>Standard documents worldwide</td></tr>
                    <tr><td><strong>Letter</strong></td><td>216 × 279</td><td>Standard in North America</td></tr>
                    <tr><td><strong>A3</strong></td><td>297 × 420</td><td>Posters, presentations</td></tr>
                    <tr><td><strong>Legal</strong></td><td>216 × 356</td><td>Legal contracts, forms</td></tr>
                </tbody>
            </table>

            <h2>Common Use Cases</h2>
            <ul>
                <li><strong>Create photo books.</strong> Merge vacation photos into a single PDF to share or print.</li>
                <li><strong>Compile scanned documents.</strong> Turn scanned pages into one organised PDF file for easy sharing and archiving.</li>
                <li><strong>Build portfolios.</strong> Combine design work or photographs into a professional PDF portfolio.</li>
                <li><strong>Email attachments.</strong> Instead of attaching multiple images, send one PDF — it's more professional and easier to manage.</li>
                <li><strong>Print preparation.</strong> Arrange images on standard paper sizes for consistent printing.</li>
            </ul>

            <h2>Frequently Asked Questions</h2>
            <h3>How many images can I convert at once?</h3>
            <p>You can upload multiple images at once. All images are processed locally in your browser, so there's no server upload limit.</p>

            <h3>Will the image quality be reduced?</h3>
            <p>No. Images are embedded into the PDF at their original quality. The tool doesn't re-compress your images.</p>

            <h3>Can I choose the page orientation?</h3>
            <p>Yes. You can choose Portrait (tall) or Landscape (wide) orientation. Choose the orientation that best matches your image aspect ratios.</p>

            <h3>Is this tool free to use?</h3>
            <p>Yes, completely free with no signup, no usage limits, and no watermarks on your PDFs.</p>
        </div>
    </div>

    <div class="mb-10">
        <h2 class="text-2xl font-extrabold mb-6">Related Tools</h2>
        <div class="grid sm:grid-cols-3 gap-4">
            <a href="/tools/pdf-to-image" class="bg-white rounded-2xl border border-gray-200/60 p-5 hover:shadow-lg transition-shadow group text-center">
                <div class="text-3xl mb-2">🖼️</div>
                <h3 class="font-bold text-sm mb-1 group-hover:text-brand-600 transition-colors">PDF to Image</h3>
                <p class="text-xs text-gray-500">Extract images from PDF files</p>
            </a>
            <a href="/tools/compress" class="bg-white rounded-2xl border border-gray-200/60 p-5 hover:shadow-lg transition-shadow group text-center">
                <div class="text-3xl mb-2">🗜️</div>
                <h3 class="font-bold text-sm mb-1 group-hover:text-brand-600 transition-colors">Image Compressor</h3>
                <p class="text-xs text-gray-500">Compress before converting to PDF</p>
            </a>
            <a href="/tools/convert" class="bg-white rounded-2xl border border-gray-200/60 p-5 hover:shadow-lg transition-shadow group text-center">
                <div class="text-3xl mb-2">🔄</div>
                <h3 class="font-bold text-sm mb-1 group-hover:text-brand-600 transition-colors">Image Converter</h3>
                <p class="text-xs text-gray-500">Convert between JPG, PNG, WebP</p>
            </a>
        </div>
    </div>
</div>
@endsection
