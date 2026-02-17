<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Free Online Image Tools - Compress &amp; Watermark Images | ImageCompressor</title>
    <meta name="description" content="Free online image tools. Compress JPG, PNG, WEBP images by up to 80%. Add custom watermarks. No signup required.">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="{{ url('/') }}">
    <meta property="og:title" content="Free Online Image Tools - Compress &amp; Watermark">
    <meta property="og:description" content="Compress images instantly with adjustable quality. Add custom text watermarks. Supports JPG, PNG, WEBP, GIF.">
    <meta property="og:url" content="{{ url('/') }}">
    <meta property="og:type" content="website">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwindcss.config = {
            theme: {
                extend: {
                    colors: {
                        primary: { 50:'#eff6ff',100:'#dbeafe',200:'#bfdbfe',300:'#93c5fd',400:'#60a5fa',500:'#3b82f6',600:'#2563eb',700:'#1d4ed8',800:'#1e40af',900:'#1e3a8a' }
                    }
                }
            }
        }
    </script>
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/collapse@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>[x-cloak] { display: none !important; }</style>
</head>
<body class="bg-gray-50 text-gray-800 min-h-screen flex flex-col">
    <header class="bg-white border-b border-gray-200 sticky top-0 z-50">
        <div class="max-w-6xl mx-auto px-4 py-3 flex items-center justify-between">
            <a href="/" class="flex items-center gap-2">
                <div class="w-9 h-9 bg-gradient-to-br from-primary-500 to-primary-700 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                </div>
                <span class="text-xl font-bold text-gray-900">Image<span class="text-primary-600">Compressor</span></span>
            </a>
            <nav class="hidden sm:flex items-center gap-6 text-sm font-medium">
                <a href="{{ route('compressor') }}" class="text-gray-600 hover:text-primary-600 transition">Compressor</a>
                <a href="{{ route('watermark') }}" class="text-gray-600 hover:text-primary-600 transition">Watermark</a>
                <a href="#features" class="text-gray-600 hover:text-primary-600 transition">Features</a>
                <a href="#faq" class="text-gray-600 hover:text-primary-600 transition">FAQ</a>
            </nav>
        </div>
    </header>

    <main class="flex-1">
        <section class="bg-gradient-to-b from-white to-gray-50 py-16 sm:py-24">
            <div class="max-w-6xl mx-auto px-4 text-center">
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-gray-900 mb-4 leading-tight">
                    Free Online <span class="text-primary-600">Image Tools</span>
                </h1>
                <p class="text-lg sm:text-xl text-gray-500 max-w-2xl mx-auto mb-10">
                    Compress images by up to 80% or add custom watermarks. Fast, free, and secure. No signup required.
                </p>
                <div class="grid sm:grid-cols-2 gap-6 max-w-3xl mx-auto">
                    <a href="{{ route('compressor') }}" class="group bg-white rounded-2xl border-2 border-gray-200 hover:border-primary-400 p-8 text-left transition-all hover:shadow-lg hover:shadow-primary-100">
                        <div class="w-14 h-14 bg-primary-100 rounded-xl flex items-center justify-center mb-5 group-hover:bg-primary-200 transition">
                            <svg class="w-7 h-7 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/></svg>
                        </div>
                        <h2 class="text-xl font-bold text-gray-900 mb-2 group-hover:text-primary-700 transition">Image Compressor</h2>
                        <p class="text-gray-500 text-sm mb-4">Reduce file size by up to 80% without losing quality. Supports JPG, PNG, WEBP, GIF.</p>
                        <div class="flex flex-wrap gap-2 mb-4">
                            <span class="px-2.5 py-1 bg-gray-100 text-gray-600 text-xs font-medium rounded-full">JPG</span>
                            <span class="px-2.5 py-1 bg-gray-100 text-gray-600 text-xs font-medium rounded-full">PNG</span>
                            <span class="px-2.5 py-1 bg-gray-100 text-gray-600 text-xs font-medium rounded-full">WEBP</span>
                            <span class="px-2.5 py-1 bg-gray-100 text-gray-600 text-xs font-medium rounded-full">GIF</span>
                        </div>
                        <span class="inline-flex items-center gap-1.5 text-primary-600 font-semibold text-sm group-hover:gap-2.5 transition-all">
                            Start Compressing
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                        </span>
                    </a>
                    <a href="{{ route('watermark') }}" class="group bg-white rounded-2xl border-2 border-gray-200 hover:border-purple-400 p-8 text-left transition-all hover:shadow-lg hover:shadow-purple-100">
                        <div class="w-14 h-14 bg-purple-100 rounded-xl flex items-center justify-center mb-5 group-hover:bg-purple-200 transition">
                            <svg class="w-7 h-7 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                        </div>
                        <h2 class="text-xl font-bold text-gray-900 mb-2 group-hover:text-purple-700 transition">Image Watermark</h2>
                        <p class="text-gray-500 text-sm mb-4">Add custom text watermarks with adjustable position, opacity, and color.</p>
                        <div class="flex flex-wrap gap-2 mb-4">
                            <span class="px-2.5 py-1 bg-gray-100 text-gray-600 text-xs font-medium rounded-full">Custom Text</span>
                            <span class="px-2.5 py-1 bg-gray-100 text-gray-600 text-xs font-medium rounded-full">5 Positions</span>
                            <span class="px-2.5 py-1 bg-gray-100 text-gray-600 text-xs font-medium rounded-full">Adjustable</span>
                        </div>
                        <span class="inline-flex items-center gap-1.5 text-purple-600 font-semibold text-sm group-hover:gap-2.5 transition-all">
                            Add Watermark
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                        </span>
                    </a>
                </div>
            </div>
        </section>

        <div class="max-w-6xl mx-auto px-4 my-8">
            <div class="bg-white rounded-xl border border-gray-200 p-4 text-center">
                <p class="text-xs text-gray-400">Advertisement</p>
                <div class="h-24 bg-gray-100 rounded-lg mt-2 flex items-center justify-center"><p class="text-sm text-gray-400">Ad Space</p></div>
            </div>
        </div>

        <section id="features" class="max-w-6xl mx-auto px-4 mb-16">
            <h2 class="text-2xl sm:text-3xl font-bold text-center text-gray-900 mb-8">Why Choose ImageCompressor?</h2>
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-5">
                <div class="bg-white rounded-xl border border-gray-200 p-6">
                    <div class="w-11 h-11 bg-blue-100 rounded-lg flex items-center justify-center mb-3"><svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg></div>
                    <h3 class="font-semibold text-gray-900 mb-1">Lightning Fast</h3>
                    <p class="text-sm text-gray-500">Compress images in seconds with optimized server-side processing.</p>
                </div>
                <div class="bg-white rounded-xl border border-gray-200 p-6">
                    <div class="w-11 h-11 bg-green-100 rounded-lg flex items-center justify-center mb-3"><svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg></div>
                    <h3 class="font-semibold text-gray-900 mb-1">Secure &amp; Private</h3>
                    <p class="text-sm text-gray-500">Files are automatically deleted after processing. Nothing is stored.</p>
                </div>
                <div class="bg-white rounded-xl border border-gray-200 p-6">
                    <div class="w-11 h-11 bg-purple-100 rounded-lg flex items-center justify-center mb-3"><svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg></div>
                    <h3 class="font-semibold text-gray-900 mb-1">Multiple Formats</h3>
                    <p class="text-sm text-gray-500">JPG, PNG, WEBP, GIF. Convert between formats easily.</p>
                </div>
                <div class="bg-white rounded-xl border border-gray-200 p-6">
                    <div class="w-11 h-11 bg-amber-100 rounded-lg flex items-center justify-center mb-3"><svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg></div>
                    <h3 class="font-semibold text-gray-900 mb-1">Watermark Tool</h3>
                    <p class="text-sm text-gray-500">Add custom text watermarks with 5 positions, adjustable opacity and color.</p>
                </div>
                <div class="bg-white rounded-xl border border-gray-200 p-6">
                    <div class="w-11 h-11 bg-rose-100 rounded-lg flex items-center justify-center mb-3"><svg class="w-5 h-5 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10"/></svg></div>
                    <h3 class="font-semibold text-gray-900 mb-1">Up to 20MB</h3>
                    <p class="text-sm text-gray-500">Upload large images up to 20MB. No registration required.</p>
                </div>
                <div class="bg-white rounded-xl border border-gray-200 p-6">
                    <div class="w-11 h-11 bg-cyan-100 rounded-lg flex items-center justify-center mb-3"><svg class="w-5 h-5 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg></div>
                    <h3 class="font-semibold text-gray-900 mb-1">Drag, Drop &amp; Paste</h3>
                    <p class="text-sm text-gray-500">Paste from clipboard or drag and drop files directly.</p>
                </div>
            </div>
        </section>

        <section class="max-w-6xl mx-auto px-4 mb-16">
            <h2 class="text-2xl sm:text-3xl font-bold text-center text-gray-900 mb-8">Supported Formats</h2>
            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-4">
                <div class="bg-white rounded-xl border border-gray-200 p-5 text-center"><div class="text-3xl font-bold text-primary-600 mb-1">JPG</div><p class="text-sm text-gray-500">Best for photos. Lossy compression.</p></div>
                <div class="bg-white rounded-xl border border-gray-200 p-5 text-center"><div class="text-3xl font-bold text-green-600 mb-1">PNG</div><p class="text-sm text-gray-500">Best for graphics. Color optimization.</p></div>
                <div class="bg-white rounded-xl border border-gray-200 p-5 text-center"><div class="text-3xl font-bold text-purple-600 mb-1">WEBP</div><p class="text-sm text-gray-500">Modern format. Superior compression.</p></div>
                <div class="bg-white rounded-xl border border-gray-200 p-5 text-center"><div class="text-3xl font-bold text-amber-600 mb-1">GIF</div><p class="text-sm text-gray-500">Animated images. Transparency support.</p></div>
            </div>
        </section>

        <section id="faq" class="max-w-6xl mx-auto px-4 mb-16">
            <h2 class="text-2xl sm:text-3xl font-bold text-center text-gray-900 mb-8">Frequently Asked Questions</h2>
            <div class="space-y-3 max-w-3xl mx-auto">
                <div class="bg-white rounded-xl border border-gray-200 overflow-hidden" x-data="{ open: false }">
                    <button @click="open = !open" class="w-full flex items-center justify-between p-4 text-left hover:bg-gray-50 transition"><span class="font-medium text-gray-900 text-sm">Is this tool free?</span><svg class="w-4 h-4 text-gray-400 shrink-0 ml-2 transition-transform" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg></button>
                    <div x-show="open" x-collapse><p class="px-4 pb-4 text-sm text-gray-500">Yes! All tools are completely free with no registration required.</p></div>
                </div>
                <div class="bg-white rounded-xl border border-gray-200 overflow-hidden" x-data="{ open: false }">
                    <button @click="open = !open" class="w-full flex items-center justify-between p-4 text-left hover:bg-gray-50 transition"><span class="font-medium text-gray-900 text-sm">What file formats are supported?</span><svg class="w-4 h-4 text-gray-400 shrink-0 ml-2 transition-transform" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg></button>
                    <div x-show="open" x-collapse><p class="px-4 pb-4 text-sm text-gray-500">We support JPG, PNG, WEBP, and GIF. You can also convert between formats.</p></div>
                </div>
                <div class="bg-white rounded-xl border border-gray-200 overflow-hidden" x-data="{ open: false }">
                    <button @click="open = !open" class="w-full flex items-center justify-between p-4 text-left hover:bg-gray-50 transition"><span class="font-medium text-gray-900 text-sm">What is the maximum file size?</span><svg class="w-4 h-4 text-gray-400 shrink-0 ml-2 transition-transform" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg></button>
                    <div x-show="open" x-collapse><p class="px-4 pb-4 text-sm text-gray-500">You can upload images up to 20MB in size.</p></div>
                </div>
                <div class="bg-white rounded-xl border border-gray-200 overflow-hidden" x-data="{ open: false }">
                    <button @click="open = !open" class="w-full flex items-center justify-between p-4 text-left hover:bg-gray-50 transition"><span class="font-medium text-gray-900 text-sm">Are my images stored on the server?</span><svg class="w-4 h-4 text-gray-400 shrink-0 ml-2 transition-transform" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg></button>
                    <div x-show="open" x-collapse><p class="px-4 pb-4 text-sm text-gray-500">No. Images are automatically deleted after processing. We do not store your files.</p></div>
                </div>
                <div class="bg-white rounded-xl border border-gray-200 overflow-hidden" x-data="{ open: false }">
                    <button @click="open = !open" class="w-full flex items-center justify-between p-4 text-left hover:bg-gray-50 transition"><span class="font-medium text-gray-900 text-sm">What is the difference between the Compressor and Watermark tools?</span><svg class="w-4 h-4 text-gray-400 shrink-0 ml-2 transition-transform" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg></button>
                    <div x-show="open" x-collapse><p class="px-4 pb-4 text-sm text-gray-500">The Compressor reduces file size with adjustable quality and format conversion. The Watermark tool adds custom text overlays to protect your images, with full control over position, opacity, and color.</p></div>
                </div>
                <div class="bg-white rounded-xl border border-gray-200 overflow-hidden" x-data="{ open: false }">
                    <button @click="open = !open" class="w-full flex items-center justify-between p-4 text-left hover:bg-gray-50 transition"><span class="font-medium text-gray-900 text-sm">Will PNG files be smaller after compression?</span><svg class="w-4 h-4 text-gray-400 shrink-0 ml-2 transition-transform" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg></button>
                    <div x-show="open" x-collapse><p class="px-4 pb-4 text-sm text-gray-500">Yes! We use color palette optimization. Output is guaranteed to never be larger than the original.</p></div>
                </div>
            </div>
        </section>
    </main>

    <footer class="bg-white border-t border-gray-200 py-6">
        <div class="max-w-6xl mx-auto px-4 flex flex-col sm:flex-row items-center justify-between gap-4">
            <p class="text-sm text-gray-500">&copy; {{ date('Y') }} ImageCompressor. All rights reserved.</p>
            <div class="flex items-center gap-6 text-sm text-gray-400">
                <a href="{{ route('compressor') }}" class="hover:text-gray-600 transition">Compressor</a>
                <a href="{{ route('watermark') }}" class="hover:text-gray-600 transition">Watermark</a>
            </div>
        </div>
    </footer>
</body>
</html>
