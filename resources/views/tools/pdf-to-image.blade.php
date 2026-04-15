@extends('layouts.page')

@section('title', 'PDF to Image Converter Free Online — PDF to JPG PNG WebP | CompresslyPro')
@section('description', 'Free PDF to image converter online. Convert PDF pages to JPG, PNG, or WebP images in seconds. Extract PDF pages as high-quality images. No signup, no software required.')
@section('keywords', 'pdf to jpg, pdf to image, convert pdf to jpg, pdf to png, pdf to image online free, convert pdf pages to images, extract images from pdf, pdf to jpeg, pdf to jpg converter free, pdf to jpg online free, pdf to image converter, convert pdf to image online')
@section('canonical', route('tool.pdf2img'))
@section('og_type', 'website')
@section('og_title', 'Free PDF to Image Converter — Extract PDF Pages as JPG, PNG, WebP')
@section('og_description', 'Convert PDF pages to high-quality JPG, PNG, or WebP images. Free online tool with no signup required.')

@section('breadcrumb')
    <li class="flex items-center gap-1.5">
        <svg class="w-3.5 h-3.5 text-gray-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
        <span class="text-gray-600 font-medium" itemprop="name">PDF to Image</span>
        <meta itemprop="position" content="2">
    </li>
@endsection

@section('head')
@verbatim
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@graph": [
        {
            "@type": "SoftwareApplication",
            "name": "CompresslyPro PDF to Image Converter",
            "description": "Convert PDF pages to JPG, PNG, or WebP images online for free.",
            "image": "https://compresslypro.com/og-image.png",
            "url": "https://compresslypro.com/pdf-to-image",
            "applicationCategory": "MultimediaApplication",
            "operatingSystem": "All",
            "isAccessibleForFree": true,
            "offers": {
                "@type": "Offer",
                "price": "0",
                "priceCurrency": "USD",
                "availability": "https://schema.org/InStock",
                "priceValidUntil": "2030-12-31"
            },
            "aggregateRating": {
                "@type": "AggregateRating",
                "ratingValue": "4.7",
                "reviewCount": "836",
                "bestRating": "5",
                "worstRating": "1"
            }
        },
        {
            "@type": "HowTo",
            "name": "How to Convert PDF to Images Online",
            "description": "Extract every PDF page as a high-quality JPG, PNG, or WebP image.",
            "totalTime": "PT2M",
            "tool": { "@type": "HowToTool", "name": "CompresslyPro PDF to Image Converter" },
            "step": [
                {
                    "@type": "HowToStep",
                    "position": 1,
                    "name": "Upload your PDF",
                    "text": "Drag and drop or select a PDF file from your device."
                },
                {
                    "@type": "HowToStep",
                    "position": 2,
                    "name": "Choose output format",
                    "text": "Select JPG, PNG, or WebP as the output image format."
                },
                {
                    "@type": "HowToStep",
                    "position": 3,
                    "name": "Set quality or DPI",
                    "text": "Adjust the output quality or resolution to balance file size and image clarity."
                },
                {
                    "@type": "HowToStep",
                    "position": 4,
                    "name": "Convert and download",
                    "text": "Click Convert and download individual page images or all pages at once."
                }
            ]
        },
        {
            "@type": "FAQPage",
            "mainEntity": [
                {
                    "@type": "Question",
                    "name": "Can I convert multi-page PDFs?",
                    "acceptedAnswer": {
                        "@type": "Answer",
                        "text": "Yes. Every page in your PDF will be converted to a separate image file. You can download them all individually."
                    }
                },
                {
                    "@type": "Question",
                    "name": "Is there a file size limit for PDF to image conversion?",
                    "acceptedAnswer": {
                        "@type": "Answer",
                        "text": "Since all processing happens in your browser, there is no server-side file size limit. Performance depends on your device capabilities."
                    }
                },
                {
                    "@type": "Question",
                    "name": "What about password-protected PDFs?",
                    "acceptedAnswer": {
                        "@type": "Answer",
                        "text": "Password-protected or encrypted PDFs cannot be processed. You will need to remove the password first using a PDF editor."
                    }
                },
                {
                    "@type": "Question",
                    "name": "Will my PDF data be uploaded to a server?",
                    "acceptedAnswer": {
                        "@type": "Answer",
                        "text": "No. All processing happens 100% locally in your browser. Your files never leave your device, ensuring complete privacy."
                    }
                }
            ]
        },
        {
            "@type": "BreadcrumbList",
            "itemListElement": [
                { "@type": "ListItem", "position": 1, "name": "Home", "item": "https://compresslypro.com" },
                { "@type": "ListItem", "position": 2, "name": "PDF to Image", "item": "https://compresslypro.com/pdf-to-image" }
            ]
        }
    ]
}
</script>
@endverbatim
@endsection

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

    <div class="text-center mb-10">
        <div class="inline-flex items-center gap-2 bg-red-50 text-red-700 text-sm font-semibold px-4 py-1.5 rounded-full mb-4">
            🖼️ Free · All Pages · No Signup
        </div>
        <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight leading-tight mb-4">
            Convert PDF to Images <span class="gradient-text">Online Free</span>
        </h1>
        <p class="text-lg text-gray-500 max-w-2xl mx-auto leading-relaxed">
            Extract every page from your PDF as <strong class="text-gray-700">high-quality JPG, PNG, or WebP images</strong>. Choose output format, DPI, and download all pages as individual images.
        </p>
    </div>

    <div class="bg-white rounded-3xl border-2 border-dashed border-red-300 p-10 text-center mb-14 hover:border-red-500 hover:shadow-lg transition-all">
        <div class="mx-auto w-20 h-20 bg-gradient-to-br from-red-500 to-red-700 rounded-3xl flex items-center justify-center mb-5 shadow-xl shadow-red-500/25">
            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909M3.75 21h16.5A2.25 2.25 0 0022.5 18.75V5.25A2.25 2.25 0 0020.25 3H3.75A2.25 2.25 0 001.5 5.25v13.5A2.25 2.25 0 003.75 21z"/></svg>
        </div>
        <h2 class="text-xl font-bold mb-2">Ready to Extract PDF Pages?</h2>
        <p class="text-gray-500 mb-6 max-w-md mx-auto">Upload your PDF and convert each page to high-quality images.</p>
        <a href="/#tools" class="inline-flex items-center gap-2 bg-gradient-to-r from-red-600 to-red-700 text-white font-bold px-8 py-3.5 rounded-2xl shadow-lg shadow-red-500/25 hover:shadow-xl hover:from-red-500 hover:to-red-600 transition-all text-base">
            🖼️ Open PDF to Image Tool
        </a>
    </div>

    <div class="bg-white rounded-2xl border border-gray-200/60 shadow-sm p-8 sm:p-10 mb-10">
        <div class="prose max-w-none">
            <h2>How to Convert PDF to Images</h2>
            <ol>
                <li><strong>Upload your PDF.</strong> Drag and drop or select a PDF file from your device.</li>
                <li><strong>Choose output format.</strong> Select JPG, PNG, or WebP as the output image format.</li>
                <li><strong>Set quality / DPI.</strong> Adjust the output quality or resolution to balance file size and image clarity.</li>
                <li><strong>Convert and download.</strong> Click "Convert" and download individual page images or all pages at once.</li>
            </ol>

            <h2>Output Format Comparison</h2>
            <table>
                <thead><tr><th>Format</th><th>Best For</th><th>Transparency</th><th>File Size</th></tr></thead>
                <tbody>
                    <tr><td><strong>JPG</strong></td><td>Sharing, social media, email</td><td>No</td><td>Small</td></tr>
                    <tr><td><strong>PNG</strong></td><td>Presentations, editing, archiving</td><td>Yes</td><td>Medium-Large</td></tr>
                    <tr><td><strong>WebP</strong></td><td>Web use, best compression</td><td>Yes</td><td>Smallest</td></tr>
                </tbody>
            </table>

            <h2>Common Use Cases</h2>
            <ul>
                <li><strong>Extract slides.</strong> Convert presentation PDFs to images for use in social media posts or blog articles.</li>
                <li><strong>Create thumbnails.</strong> Turn the first page of a document into a preview thumbnail for your website.</li>
                <li><strong>Share specific pages.</strong> Extract one page from a multi-page PDF to share without sending the entire document.</li>
                <li><strong>Edit PDF content.</strong> Convert pages to images so you can annotate or edit them in any image editor.</li>
                <li><strong>Archival purposes.</strong> Convert older PDFs to lossless PNG images for long-term storage.</li>
                <li><strong>Social media posts.</strong> Turn PDF infographics or reports into shareable image formats.</li>
            </ul>

            <h2>DPI &amp; Quality Guide</h2>
            <table>
                <thead><tr><th>DPI</th><th>Quality</th><th>Recommended For</th></tr></thead>
                <tbody>
                    <tr><td><strong>72 DPI</strong></td><td>Screen/Low</td><td>Quick previews, thumbnails</td></tr>
                    <tr><td><strong>150 DPI</strong></td><td>Medium</td><td>Web use, email, presentations</td></tr>
                    <tr><td><strong>300 DPI</strong></td><td>High</td><td>Print quality, archival</td></tr>
                </tbody>
            </table>

            <h2>Frequently Asked Questions</h2>
            <h3>Can I convert multi-page PDFs?</h3>
            <p>Yes. Every page in your PDF will be converted to a separate image file. You can download them all individually.</p>

            <h3>Is there a file size limit?</h3>
            <p>Since all processing happens in your browser, there's no server-side file size limit. Performance depends on your device's capabilities — most modern devices handle PDFs up to 50+ pages easily.</p>

            <h3>What about password-protected PDFs?</h3>
            <p>Password-protected or encrypted PDFs cannot be processed. You'll need to remove the password first using a PDF editor.</p>

            <h3>Will my PDF data be uploaded to a server?</h3>
            <p>No. All processing happens 100% locally in your browser. Your files never leave your device, ensuring complete privacy.</p>
        </div>
    </div>

    <div class="mb-10">
        <h2 class="text-2xl font-extrabold mb-6">Related Tools</h2>
        <div class="grid sm:grid-cols-3 gap-4">
            <a href="{{ route('tool.img2pdf') }}" class="bg-white rounded-2xl border border-gray-200/60 p-5 hover:shadow-lg transition-shadow group text-center">
                <div class="text-3xl mb-2">📄</div>
                <h3 class="font-bold text-sm mb-1 group-hover:text-brand-600 transition-colors">Image to PDF</h3>
                <p class="text-xs text-gray-500">Convert images to PDF documents</p>
            </a>
            <a href="{{ route('tool.convert') }}" class="bg-white rounded-2xl border border-gray-200/60 p-5 hover:shadow-lg transition-shadow group text-center">
                <div class="text-3xl mb-2">🔄</div>
                <h3 class="font-bold text-sm mb-1 group-hover:text-brand-600 transition-colors">Image Converter</h3>
                <p class="text-xs text-gray-500">Convert between JPG, PNG, WebP</p>
            </a>
            <a href="{{ route('tool.compress') }}" class="bg-white rounded-2xl border border-gray-200/60 p-5 hover:shadow-lg transition-shadow group text-center">
                <div class="text-3xl mb-2">🗜️</div>
                <h3 class="font-bold text-sm mb-1 group-hover:text-brand-600 transition-colors">Image Compressor</h3>
                <p class="text-xs text-gray-500">Reduce image file size</p>
            </a>
        </div>
    </div>
</div>
@endsection
