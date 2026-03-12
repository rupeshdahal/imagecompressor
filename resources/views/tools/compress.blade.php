@extends('layouts.page')

@section('title', 'Free Image Compressor Online — Compress JPG, PNG, WebP up to 90% | CompresslyPro')
@section('description', 'Compress JPG, PNG, WebP and GIF images online for free. Reduce image file size up to 90% without visible quality loss. No signup, no watermarks. Before/after comparison slider included.')
@section('canonical', url('/tools/compress'))
@section('og_type', 'website')
@section('og_title', 'Free Image Compressor — Reduce Image Size up to 90% Online')
@section('og_description', 'Compress JPG, PNG, WebP images up to 90% smaller. Adjustable quality, before/after comparison, no signup required.')

@section('breadcrumb')
    <li class="flex items-center gap-1.5">
        <svg class="w-3.5 h-3.5 text-gray-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
        <span class="text-gray-600 font-medium" itemprop="name">Image Compressor</span>
        <meta itemprop="position" content="2">
    </li>
@endsection

@section('head')
@verbatim
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "SoftwareApplication",
    "name": "CompresslyPro Image Compressor",
    "description": "Free online image compressor that reduces JPG, PNG, WebP and GIF file sizes by up to 90% without losing quality.",
    "url": "https://compresslypro.com/tools/compress",
    "applicationCategory": "MultimediaApplication",
    "operatingSystem": "All",
    "isAccessibleForFree": true,
    "offers": { "@type": "Offer", "price": "0", "priceCurrency": "USD" },
    "aggregateRating": { "@type": "AggregateRating", "ratingValue": "4.8", "ratingCount": "3124", "bestRating": "5" }
}
</script>
@endverbatim
@endsection

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

    {{-- Hero --}}
    <div class="text-center mb-10">
        <div class="inline-flex items-center gap-2 bg-brand-50 text-brand-700 text-sm font-semibold px-4 py-1.5 rounded-full mb-4">
            🗜️ Free · No Signup · Unlimited
        </div>
        <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight leading-tight mb-4">
            Compress Images <span class="gradient-text">Online Free</span>
        </h1>
        <p class="text-lg text-gray-500 max-w-2xl mx-auto leading-relaxed">
            Reduce JPG, PNG, WebP and GIF file sizes <strong class="text-gray-700">up to 90% smaller</strong> without visible quality loss. Adjustable quality slider with real-time before/after comparison.
        </p>
    </div>

    {{-- CTA to use the tool --}}
    <div class="bg-white rounded-3xl border-2 border-dashed border-brand-300 p-10 text-center mb-14 hover:border-brand-500 hover:shadow-lg transition-all">
        <div class="mx-auto w-20 h-20 bg-gradient-to-br from-brand-500 to-brand-700 rounded-3xl flex items-center justify-center mb-5 shadow-xl shadow-brand-500/25">
            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5"/></svg>
        </div>
        <h2 class="text-xl font-bold mb-2">Ready to Compress Your Images?</h2>
        <p class="text-gray-500 mb-6 max-w-md mx-auto">Drag & drop your image, or click the button below. Supports JPG, PNG, WebP, and GIF up to 20 MB.</p>
        <a href="/#compress" class="inline-flex items-center gap-2 bg-gradient-to-r from-brand-600 to-brand-700 text-white font-bold px-8 py-3.5 rounded-2xl shadow-lg shadow-brand-500/25 hover:shadow-xl hover:from-brand-500 hover:to-brand-600 transition-all text-base">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
            Open Image Compressor
        </a>
    </div>

    {{-- SEO Content --}}
    <div class="bg-white rounded-2xl border border-gray-200/60 shadow-sm p-8 sm:p-10 mb-10">
        <div class="prose max-w-none">
            <h2>How to Compress Images Online</h2>
            <p>Compressing images with CompresslyPro takes seconds. Follow these three simple steps:</p>
            <ol>
                <li><strong>Upload your image.</strong> Drag and drop a JPG, PNG, WebP, or GIF file (up to 20 MB) into the compressor — or click to browse your files. You can also paste an image directly from your clipboard.</li>
                <li><strong>Adjust the quality slider.</strong> Set the compression level from 10% (maximum compression) to 90% (maximum quality). The default of 50% works well for most images — reducing file size by 60–80% with virtually no visible quality loss.</li>
                <li><strong>Download your compressed image.</strong> Preview the before/after comparison using the built-in slider. When you're satisfied, click Download to save the compressed file. You can also copy the compressed image to your clipboard.</li>
            </ol>

            <h2>Why Compress Images?</h2>
            <p>Image compression is essential for web performance, email attachments, and storage efficiency:</p>
            <ul>
                <li><strong>Faster websites.</strong> Images account for 42% of the average web page's weight. Compressing them improves load times, Core Web Vitals scores, and Google search rankings.</li>
                <li><strong>Smaller email attachments.</strong> Most email providers limit attachments to 20–25 MB. Compressing photos from 3–5 MB to under 500 KB means you can attach many more images.</li>
                <li><strong>Save storage space.</strong> Whether you're storing images on your phone, cloud drive, or server, compressed images use significantly less space.</li>
                <li><strong>Better user experience.</strong> Faster-loading images mean visitors see your content sooner and are less likely to leave your site.</li>
            </ul>

            <h2>Supported Image Formats</h2>
            <table>
                <thead>
                    <tr><th>Format</th><th>Input</th><th>Typical Reduction</th></tr>
                </thead>
                <tbody>
                    <tr><td>JPEG / JPG</td><td>✅ Supported</td><td>50–80%</td></tr>
                    <tr><td>PNG</td><td>✅ Supported</td><td>40–70%</td></tr>
                    <tr><td>WebP</td><td>✅ Supported</td><td>30–60%</td></tr>
                    <tr><td>GIF</td><td>✅ Supported</td><td>20–50%</td></tr>
                </tbody>
            </table>

            <h2>Quality Settings Guide</h2>
            <p>Choosing the right compression quality depends on your use case:</p>
            <ul>
                <li><strong>80–90%:</strong> Archival quality. Minimal compression but nearly lossless results. Best for print or professional photography.</li>
                <li><strong>60–70%:</strong> Web hero images. Excellent quality with significant file size reduction. Ideal for above-the-fold content.</li>
                <li><strong>40–50%:</strong> General web use. The sweet spot for most images — 60–80% smaller with imperceptible quality loss.</li>
                <li><strong>20–30%:</strong> Maximum compression. Visible artifacts may appear but file sizes are extremely small. Useful for thumbnails or low-bandwidth scenarios.</li>
            </ul>

            <h2>Privacy & Security</h2>
            <p>Your privacy matters. All uploaded files are processed on our secure servers and <strong>automatically deleted within 30 minutes</strong>. We never store, share, analyse, or sell your images. The entire compression process is encrypted via HTTPS.</p>

            <h2>Frequently Asked Questions</h2>
            <h3>Is the image compressor really free?</h3>
            <p>Yes, 100% free with no limits. No signup, no watermarks, no hidden fees. Compress as many images as you want.</p>

            <h3>What's the maximum file size?</h3>
            <p>You can upload images up to 20 MB each. For larger files, we use chunked uploading to ensure reliable transfers even on slower connections.</p>

            <h3>Can I compress images to a specific file size?</h3>
            <p>While you can't set an exact target file size, adjusting the quality slider gives you precise control. Quality 40–50% typically produces 100–300 KB files for standard photos. The result shows the exact compressed size before downloading.</p>

            <h3>Does compression remove EXIF metadata?</h3>
            <p>Yes, the compression process strips EXIF metadata (camera info, GPS coordinates, timestamps) from your images, which also contributes to smaller file sizes and better privacy.</p>
        </div>
    </div>

    {{-- Related Tools --}}
    <div class="mb-10">
        <h2 class="text-2xl font-extrabold mb-6">Related Tools</h2>
        <div class="grid sm:grid-cols-3 gap-4">
            <a href="/tools/batch-compress" class="bg-white rounded-2xl border border-gray-200/60 p-5 hover:shadow-lg transition-shadow group text-center">
                <div class="text-3xl mb-2">📦</div>
                <h3 class="font-bold text-sm mb-1 group-hover:text-brand-600 transition-colors">Batch Compressor</h3>
                <p class="text-xs text-gray-500">Compress up to 20 images at once</p>
            </a>
            <a href="/tools/convert" class="bg-white rounded-2xl border border-gray-200/60 p-5 hover:shadow-lg transition-shadow group text-center">
                <div class="text-3xl mb-2">🔄</div>
                <h3 class="font-bold text-sm mb-1 group-hover:text-brand-600 transition-colors">Image Converter</h3>
                <p class="text-xs text-gray-500">Convert between JPG, PNG, WebP</p>
            </a>
            <a href="/tools/resize" class="bg-white rounded-2xl border border-gray-200/60 p-5 hover:shadow-lg transition-shadow group text-center">
                <div class="text-3xl mb-2">↔️</div>
                <h3 class="font-bold text-sm mb-1 group-hover:text-brand-600 transition-colors">Image Resizer</h3>
                <p class="text-xs text-gray-500">Resize by pixels or percentage</p>
            </a>
        </div>
    </div>

    {{-- Related Blog --}}
    <div>
        <h2 class="text-2xl font-extrabold mb-6">Learn More</h2>
        <div class="grid sm:grid-cols-2 gap-4">
            <a href="/blog/how-to-compress-images-for-web" class="bg-white rounded-2xl border border-gray-200/60 p-5 hover:shadow-lg transition-shadow group">
                <h3 class="font-bold text-sm mb-1 group-hover:text-brand-600 transition-colors">Complete Guide to Image Compression for the Web</h3>
                <p class="text-xs text-gray-500">Step-by-step guide covering formats, quality settings, and Core Web Vitals.</p>
            </a>
            <a href="/blog/reduce-image-size-for-email" class="bg-white rounded-2xl border border-gray-200/60 p-5 hover:shadow-lg transition-shadow group">
                <h3 class="font-bold text-sm mb-1 group-hover:text-brand-600 transition-colors">How to Reduce Image Size for Email</h3>
                <p class="text-xs text-gray-500">Size limits, compression settings, and newsletter best practices.</p>
            </a>
        </div>
    </div>
</div>
@endsection
