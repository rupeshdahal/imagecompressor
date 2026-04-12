@extends('layouts.page')

@section('title', 'Free Image URL Compressor Online — Compress Images from Links | CompresslyPro')
@section('description', 'Compress images directly from a public URL online for free. Paste an image link, pick quality settings, and download a smaller file. No signup required.')
@section('canonical', route('tool.url'))
@section('og_type', 'website')
@section('og_title', 'Free URL Image Compressor — Compress Images from Direct Links')
@section('og_description', 'Paste an image URL and compress JPG, PNG, or WebP online for free. Fast processing, no signup, privacy-first.')

@section('breadcrumb')
    <li class="flex items-center gap-1.5">
        <svg class="w-3.5 h-3.5 text-gray-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
        <span class="text-gray-600 font-medium" itemprop="name">Compress from URL</span>
        <meta itemprop="position" content="2">
    </li>
@endsection

@section('head')
@verbatim
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "SoftwareApplication",
    "name": "CompresslyPro URL Image Compressor",
    "description": "Compress images directly from public URLs online for free.",
    "image": ["https://compresslypro.com/og-image.png"],
    "url": "https://compresslypro.com/compress-from-url",
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
        <div class="inline-flex items-center gap-2 bg-cyan-50 text-cyan-700 text-sm font-semibold px-4 py-1.5 rounded-full mb-4">
            🔗 Free · URL Input · No Signup
        </div>
        <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight leading-tight mb-4">
            Compress Images from URL <span class="gradient-text">Online Free</span>
        </h1>
        <p class="text-lg text-gray-500 max-w-2xl mx-auto leading-relaxed">
            Paste a direct image link and compress it instantly. Great for <strong class="text-gray-700">CMS workflows, remote assets, and quick optimization</strong> without downloading files first.
        </p>
    </div>

    <div class="bg-white rounded-3xl border-2 border-dashed border-cyan-300 p-10 text-center mb-14 hover:border-cyan-500 hover:shadow-lg transition-all">
        <div class="mx-auto w-20 h-20 bg-gradient-to-br from-cyan-500 to-cyan-700 rounded-3xl flex items-center justify-center mb-5 shadow-xl shadow-cyan-500/25">
            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13.828 10.172a4 4 0 015.656 5.656l-3 3a4 4 0 01-5.656-5.656m-1.172 1.172a4 4 0 01-5.656-5.656l3-3a4 4 0 015.656 5.656"/></svg>
        </div>
        <h2 class="text-xl font-bold mb-2">Ready to Compress a Remote Image?</h2>
        <p class="text-gray-500 mb-6 max-w-md mx-auto">Paste a direct image URL, choose quality, and download the optimized result.</p>
        <a href="/#tools" class="inline-flex items-center gap-2 bg-gradient-to-r from-cyan-600 to-cyan-700 text-white font-bold px-8 py-3.5 rounded-2xl shadow-lg shadow-cyan-500/25 hover:shadow-xl hover:from-cyan-500 hover:to-cyan-600 transition-all text-base">
            🔗 Open URL Compressor
        </a>
    </div>

    <div class="bg-white rounded-2xl border border-gray-200/60 shadow-sm p-8 sm:p-10 mb-10">
        <div class="prose max-w-none">
            <h2>How URL image compression works</h2>
            <ol>
                <li><strong>Copy the direct image URL.</strong> Use a link that points straight to a JPG, PNG, WebP, or GIF file.</li>
                <li><strong>Paste into the URL tool.</strong> The tool fetches the file and validates format and size.</li>
                <li><strong>Set quality and output preferences.</strong> Choose compression level based on your target use case.</li>
                <li><strong>Download optimized image.</strong> Save the compressed output and use it on your website, store, or app.</li>
            </ol>

            <h2>Best use cases</h2>
            <ul>
                <li><strong>Website migration.</strong> Optimize existing image URLs before moving content to a new stack.</li>
                <li><strong>Editorial workflows.</strong> Compress hero images from a headless CMS or DAM source.</li>
                <li><strong>Marketplace listings.</strong> Quickly reduce listing image size for faster page loads.</li>
                <li><strong>Bulk remote checks.</strong> Test a source image from URL before deciding on local upload workflows.</li>
            </ul>

            <h2>URL requirements</h2>
            <table>
                <thead><tr><th>Requirement</th><th>Details</th></tr></thead>
                <tbody>
                    <tr><td><strong>Direct file URL</strong></td><td>Must point to an image file, not an HTML page.</td></tr>
                    <tr><td><strong>Accessible over HTTP/HTTPS</strong></td><td>The source URL must be publicly reachable.</td></tr>
                    <tr><td><strong>Supported formats</strong></td><td>JPG/JPEG, PNG, WebP, GIF</td></tr>
                    <tr><td><strong>Reasonable file size</strong></td><td>Large files may take longer depending on source server speed.</td></tr>
                </tbody>
            </table>

            <h2>Frequently asked questions</h2>
            <h3>Can I use private or signed URLs?</h3>
            <p>Publicly reachable URLs work best. Private URLs may fail if they require authentication or expire quickly.</p>

            <h3>Does this change the original image at the source URL?</h3>
            <p>No. The original image remains unchanged. A new compressed copy is created for download.</p>

            <h3>Is this tool free?</h3>
            <p>Yes, this tool is free to use with no signup required.</p>
        </div>
    </div>

    <div class="mb-10">
        <h2 class="text-2xl font-extrabold mb-6">Related Tools</h2>
        <div class="grid sm:grid-cols-3 gap-4">
            <a href="{{ route('tool.compress') }}" class="bg-white rounded-2xl border border-gray-200/60 p-5 hover:shadow-lg transition-shadow group text-center">
                <div class="text-3xl mb-2">🗜️</div>
                <h3 class="font-bold text-sm mb-1 group-hover:text-brand-600 transition-colors">Image Compressor</h3>
                <p class="text-xs text-gray-500">Compress from local file upload</p>
            </a>
            <a href="{{ route('tool.batch') }}" class="bg-white rounded-2xl border border-gray-200/60 p-5 hover:shadow-lg transition-shadow group text-center">
                <div class="text-3xl mb-2">📦</div>
                <h3 class="font-bold text-sm mb-1 group-hover:text-brand-600 transition-colors">Batch Compressor</h3>
                <p class="text-xs text-gray-500">Compress multiple files at once</p>
            </a>
            <a href="{{ route('tool.convert') }}" class="bg-white rounded-2xl border border-gray-200/60 p-5 hover:shadow-lg transition-shadow group text-center">
                <div class="text-3xl mb-2">🔄</div>
                <h3 class="font-bold text-sm mb-1 group-hover:text-brand-600 transition-colors">Image Converter</h3>
                <p class="text-xs text-gray-500">Convert between JPG, PNG, WebP</p>
            </a>
        </div>
    </div>
</div>
@endsection
