@extends('layouts.page')

@section('title', 'How to Convert Images to PDF — Complete Step-by-Step Guide | CompresslyPro')
@section('description', 'Learn how to convert single or multiple images (JPG, PNG, WebP) to PDF documents. Choose page sizes, orientation, and merge multiple images into one professional PDF.')
@section('canonical', url('/blog/convert-images-to-pdf-guide'))
@section('og_type', 'article')
@section('og_title', 'How to Convert Images to PDF — Complete Step-by-Step Guide')
@section('og_description', 'Convert JPG, PNG, and WebP images to PDF documents. Merge multiple images into one PDF with custom page settings.')

@section('breadcrumb')
    <li class="flex items-center gap-1.5">
        <svg class="w-3.5 h-3.5 text-gray-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
        <a href="/blog" itemprop="item" class="hover:text-brand-600 transition-colors font-medium"><span itemprop="name">Blog</span></a>
        <meta itemprop="position" content="2">
    </li>
    <li class="flex items-center gap-1.5">
        <svg class="w-3.5 h-3.5 text-gray-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
        <span class="text-gray-600 font-medium" itemprop="name">Convert Images to PDF Guide</span>
        <meta itemprop="position" content="3">
    </li>
@endsection

@section('head')
@verbatim
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "Article",
    "headline": "How to Convert Images to PDF — Complete Step-by-Step Guide",
    "description": "Learn how to convert single or multiple images to PDF documents with custom settings.",
    "url": "https://compresslypro.com/blog/convert-images-to-pdf-guide",
    "datePublished": "2025-03-22",
    "dateModified": "2025-03-22",
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
            <time datetime="2025-03-22">March 22, 2025</time>
            <span class="w-1 h-1 bg-gray-300 rounded-full"></span>
            <span>8 min read</span>
        </div>
        <h1 class="text-3xl sm:text-4xl font-extrabold tracking-tight mb-4">How to Convert Images to PDF — Complete Step-by-Step Guide</h1>
        <p class="text-lg text-gray-500 leading-relaxed">Need to convert photos or screenshots into a PDF document? Whether you're compiling scanned pages, creating a photo album, or preparing documents for email, converting images to PDF is straightforward. This guide walks you through every method and best practice.</p>
    </header>

    <div class="bg-white rounded-2xl border border-gray-200/60 shadow-sm p-8 sm:p-10">
        <div class="prose max-w-none">

            <h2>Why Convert Images to PDF?</h2>
            <p>PDF (Portable Document Format) is the universal standard for sharing documents. Converting images to PDF gives you several advantages:</p>
            <ul>
                <li><strong>Universal compatibility.</strong> PDFs can be opened on virtually any device without special software.</li>
                <li><strong>Professional presentation.</strong> A single PDF is more polished than a folder of loose images.</li>
                <li><strong>Easy sharing.</strong> Email one PDF instead of multiple image attachments.</li>
                <li><strong>Print-ready.</strong> PDFs maintain exact dimensions and layout for consistent printing.</li>
                <li><strong>Organised documents.</strong> Merge scanned pages, receipts, or forms into one organised file.</li>
            </ul>

            <h2>Method 1: Using CompresslyPro's Image to PDF Tool</h2>
            <p>The easiest way to convert images to PDF online:</p>
            <ol>
                <li><strong>Open the <a href="{{ route('tool.img2pdf') }}">Image to PDF Converter</a>.</strong></li>
                <li><strong>Upload your images.</strong> Select one or more JPG, PNG, or WebP files. You can upload multiple files at once.</li>
                <li><strong>Arrange the page order.</strong> Drag and drop to rearrange images in the order you want them to appear in the PDF.</li>
                <li><strong>Choose page settings:</strong>
                    <ul>
                        <li><strong>Page size:</strong> A4, Letter, A3, or Legal</li>
                        <li><strong>Orientation:</strong> Portrait or Landscape</li>
                        <li><strong>Margin:</strong> Adjust spacing around images</li>
                    </ul>
                </li>
                <li><strong>Click "Convert to PDF"</strong> and download your document.</li>
            </ol>
            <p>Everything happens in your browser — your images never leave your device.</p>

            <h2>Choosing the Right Page Size</h2>
            <table>
                <thead><tr><th>Page Size</th><th>Dimensions</th><th>Best For</th></tr></thead>
                <tbody>
                    <tr><td><strong>A4</strong></td><td>210 × 297 mm (8.3 × 11.7 in)</td><td>Standard documents, international standard</td></tr>
                    <tr><td><strong>Letter</strong></td><td>216 × 279 mm (8.5 × 11 in)</td><td>US/Canada standard documents</td></tr>
                    <tr><td><strong>A3</strong></td><td>297 × 420 mm (11.7 × 16.5 in)</td><td>Large images, posters, presentations</td></tr>
                    <tr><td><strong>Legal</strong></td><td>216 × 356 mm (8.5 × 14 in)</td><td>Legal documents, contracts</td></tr>
                </tbody>
            </table>

            <h2>Portrait vs Landscape Orientation</h2>
            <ul>
                <li><strong>Portrait (vertical):</strong> Best for documents, scanned pages, and portrait-oriented photos.</li>
                <li><strong>Landscape (horizontal):</strong> Best for panoramic photos, presentations, and landscape-oriented images.</li>
            </ul>
            <p><strong>Tip:</strong> Choose the orientation that matches the majority of your images. If you have a mix, portrait is usually the safer default since most documents are portrait-oriented.</p>

            <h2>Common Use Cases</h2>

            <h3>1. Compiling Scanned Documents</h3>
            <p>If you've scanned multiple pages using your phone camera, convert them all to a single PDF for easy sharing and filing. This is perfect for receipts, contracts, medical records, and academic papers.</p>

            <h3>2. Creating Photo Albums</h3>
            <p>Merge vacation photos, wedding photos, or event photos into a single PDF album. The recipient can scroll through all images in one document without needing to open individual files.</p>

            <h3>3. Building a Portfolio</h3>
            <p>Designers, photographers, and artists can compile their best work into a PDF portfolio. Choose A3 size for maximum image impact, or A4 for standard presentation.</p>

            <h3>4. Preparing Email Attachments</h3>
            <p>Instead of attaching 10 separate images to an email, convert them to one PDF. It's more professional, easier to manage, and less likely to trigger email size limits (since PDFs are often smaller than the combined image files).</p>

            <h3>5. Archiving Images</h3>
            <p>Organise related images into themed PDFs for long-term storage. For example, all product photos for a specific category, or all screenshots from a particular project.</p>

            <h2>Optimisation Tips for Best Results</h2>
            <ol>
                <li><strong><a href="{{ route('tool.compress') }}">Compress images first</a></strong> to keep the PDF file size manageable. Aim for 100–200KB per image.</li>
                <li><strong><a href="{{ route('tool.resize') }}">Resize images</a></strong> to match the PDF page size. For A4 at 150 DPI, the ideal image width is about 1240px.</li>
                <li><strong>Use consistent dimensions.</strong> Images of similar sizes create a more professional-looking PDF.</li>
                <li><strong>Name your files in order.</strong> If uploading many images, name them 01-xxx.jpg, 02-xxx.jpg, etc., to maintain the correct order.</li>
            </ol>

            <h2>Image to PDF vs PDF to Image</h2>
            <table>
                <thead><tr><th>Direction</th><th>Tool</th><th>Use Case</th></tr></thead>
                <tbody>
                    <tr><td>Image → PDF</td><td><a href="{{ route('tool.img2pdf') }}">Image to PDF Converter</a></td><td>Merge images into a document</td></tr>
                    <tr><td>PDF → Image</td><td><a href="{{ route('tool.pdf2img') }}">PDF to Image Converter</a></td><td>Extract pages as individual images</td></tr>
                </tbody>
            </table>

            <h2>Frequently Asked Questions</h2>
            <h3>Will the image quality be reduced when converting to PDF?</h3>
            <p>No. Our tool embeds images at their original quality into the PDF. The images are not re-compressed during conversion.</p>

            <h3>Can I convert HEIC (iPhone) images to PDF?</h3>
            <p>HEIC is not directly supported. First <a href="{{ route('tool.convert') }}">convert your HEIC images to JPG</a>, then use the Image to PDF tool to create your document.</p>

            <h3>Is there a limit on the number of images?</h3>
            <p>Since all processing happens in your browser, there's no server-side limit. Practical limits depend on your device's memory — most devices handle 50+ images easily.</p>

            <h3>Can I add text or captions to the PDF?</h3>
            <p>Our tool focuses on image-to-PDF conversion. For adding text, consider adding text as a <a href="{{ route('tool.watermark') }}">watermark</a> on each image before converting, or use a PDF editor after conversion.</p>
        </div>
    </div>
</article>
@endsection
