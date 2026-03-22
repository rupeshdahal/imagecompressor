@extends('layouts.page')

@section('title', 'Free Batch Image Compressor — Compress Up to 20 Images at Once | CompresslyPro')
@section('description', 'Compress multiple images at once with our free batch compressor. Upload up to 20 JPG, PNG, or WebP files, compress them all simultaneously, and download as a ZIP file.')
@section('canonical', url('/tools/batch-compress'))
@section('og_type', 'website')
@section('og_title', 'Free Batch Image Compressor — Compress 20 Images at Once')
@section('og_description', 'Upload up to 20 images, compress them all in parallel, and download a ZIP file. Free, no signup.')

@section('breadcrumb')
    <li class="flex items-center gap-1.5">
        <svg class="w-3.5 h-3.5 text-gray-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
        <span class="text-gray-600 font-medium" itemprop="name">Batch Image Compressor</span>
        <meta itemprop="position" content="2">
    </li>
@endsection

@section('head')
@verbatim
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "SoftwareApplication",
    "name": "CompresslyPro Batch Image Compressor",
    "description": "Compress up to 20 images simultaneously and download all results as a single ZIP file.",
    "image": ["https://compresslypro.com/og-image.png"],
    "url": "https://compresslypro.com/tools/batch-compress",
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
        <div class="inline-flex items-center gap-2 bg-blue-50 text-blue-700 text-sm font-semibold px-4 py-1.5 rounded-full mb-4">
            📦 Up to 20 Images · ZIP Download · Free
        </div>
        <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight leading-tight mb-4">
            Batch Compress Images <span class="gradient-text">Online Free</span>
        </h1>
        <p class="text-lg text-gray-500 max-w-2xl mx-auto leading-relaxed">
            Upload <strong class="text-gray-700">up to 20 images at once</strong>, compress them all in parallel, and download everything as a single ZIP file. No signup required.
        </p>
    </div>

    <div class="bg-white rounded-3xl border-2 border-dashed border-blue-300 p-10 text-center mb-14 hover:border-blue-500 hover:shadow-lg transition-all">
        <div class="mx-auto w-20 h-20 bg-gradient-to-br from-blue-500 to-blue-700 rounded-3xl flex items-center justify-center mb-5 shadow-xl shadow-blue-500/25">
            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 9.776c.112-.017.227-.026.344-.026h15.812c.117 0 .232.009.344.026m-16.5 0a2.25 2.25 0 00-1.883 2.542l.857 6a2.25 2.25 0 002.227 1.932H19.05a2.25 2.25 0 002.227-1.932l.857-6a2.25 2.25 0 00-1.883-2.542m-16.5 0V6A2.25 2.25 0 016 3.75h3.879a1.5 1.5 0 011.06.44l2.122 2.12a1.5 1.5 0 001.06.44H18A2.25 2.25 0 0120.25 9v.776"/></svg>
        </div>
        <h2 class="text-xl font-bold mb-2">Ready to Batch Compress?</h2>
        <p class="text-gray-500 mb-6 max-w-md mx-auto">Select up to 20 JPG, PNG, or WebP images. All are compressed simultaneously.</p>
        <a href="/#batch" class="inline-flex items-center gap-2 bg-gradient-to-r from-blue-600 to-blue-700 text-white font-bold px-8 py-3.5 rounded-2xl shadow-lg shadow-blue-500/25 hover:shadow-xl hover:from-blue-500 hover:to-blue-600 transition-all text-base">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 9.776c.112-.017.227-.026.344-.026h15.812c.117 0 .232.009.344.026m-16.5 0a2.25 2.25 0 00-1.883 2.542l.857 6a2.25 2.25 0 002.227 1.932H19.05a2.25 2.25 0 002.227-1.932l.857-6a2.25 2.25 0 00-1.883-2.542m-16.5 0V6A2.25 2.25 0 016 3.75h3.879a1.5 1.5 0 011.06.44l2.122 2.12a1.5 1.5 0 001.06.44H18A2.25 2.25 0 0120.25 9v.776"/></svg>
            Open Batch Compressor
        </a>
    </div>

    <div class="bg-white rounded-2xl border border-gray-200/60 shadow-sm p-8 sm:p-10 mb-10">
        <div class="prose max-w-none">
            <h2>How Batch Compression Works</h2>
            <ol>
                <li><strong>Select multiple images.</strong> Drag and drop up to 20 JPG, PNG, or WebP files into the batch compressor, or click to browse and select multiple files at once.</li>
                <li><strong>Set compression quality.</strong> Adjust the quality slider to your preferred level. The same quality setting applies to all images in the batch for consistency.</li>
                <li><strong>Compress and download.</strong> Click "Compress All" to process every image simultaneously. Download individual results or get everything as a single ZIP archive.</li>
            </ol>

            <h2>Why Use Batch Compression?</h2>
            <ul>
                <li><strong>Save time.</strong> Process 20 images in the time it takes to compress one. Ideal for e-commerce product catalogues, blog images, and portfolios.</li>
                <li><strong>Consistent quality.</strong> Every image gets the same compression settings, ensuring a uniform look across your entire image set.</li>
                <li><strong>ZIP download.</strong> Get all compressed images in a single ZIP file — no need to download them one by one.</li>
                <li><strong>Parallel processing.</strong> All images are compressed simultaneously on our servers for maximum speed.</li>
            </ul>

            <h2>Use Cases</h2>
            <table>
                <thead><tr><th>Scenario</th><th>Typical Batch Size</th><th>Recommended Quality</th></tr></thead>
                <tbody>
                    <tr><td>E-commerce product photos</td><td>10–20 images</td><td>65–75%</td></tr>
                    <tr><td>Blog post images</td><td>5–15 images</td><td>55–65%</td></tr>
                    <tr><td>Client photo delivery</td><td>20 images per batch</td><td>70–80%</td></tr>
                    <tr><td>Website migration</td><td>20 images per batch</td><td>60–70%</td></tr>
                    <tr><td>Social media content</td><td>5–10 images</td><td>60–70%</td></tr>
                </tbody>
            </table>

            <h2>Frequently Asked Questions</h2>
            <h3>What's the maximum number of images per batch?</h3>
            <p>You can process up to 20 images per batch. For larger sets, simply run multiple batches.</p>

            <h3>What's the maximum file size per image?</h3>
            <p>Each individual image can be up to 20 MB. Large files use chunked uploading for reliable transfers.</p>

            <h3>Can I set different quality levels for different images?</h3>
            <p>The batch compressor applies the same quality to all images. If you need different settings for specific images, use the <a href="/tools/compress">single Image Compressor</a> for those files.</p>
        </div>
    </div>

    <div class="mb-10">
        <h2 class="text-2xl font-extrabold mb-6">Related Tools</h2>
        <div class="grid sm:grid-cols-3 gap-4">
            <a href="/tools/compress" class="bg-white rounded-2xl border border-gray-200/60 p-5 hover:shadow-lg transition-shadow group text-center">
                <div class="text-3xl mb-2">🗜️</div>
                <h3 class="font-bold text-sm mb-1 group-hover:text-brand-600 transition-colors">Image Compressor</h3>
                <p class="text-xs text-gray-500">Compress individual images</p>
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
</div>
@endsection
