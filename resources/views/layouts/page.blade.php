<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="google-adsense-account" content="ca-pub-6697940390340424">
    @if(config('services.google_site_verification'))
    <meta name="google-site-verification" content="{{ config('services.google_site_verification') }}">
    @endif
    @if(config('services.bing_site_verification'))
    <meta name="msvalidate.01" content="{{ config('services.bing_site_verification') }}">
    @endif
    @if(config('services.yandex_site_verification'))
    <meta name="yandex-verification" content="{{ config('services.yandex_site_verification') }}">
    @endif
    @if(config('services.baidu_site_verification'))
    <meta name="baidu-site-verification" content="{{ config('services.baidu_site_verification') }}">
    @endif

    {{-- Favicon --}}
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32.png') }}">
    <link rel="icon" type="image/png" sizes="48x48" href="{{ asset('favicon-48.png') }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('icon-192.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
    <link rel="manifest" href="{{ asset('manifest.json') }}">

    {{-- SEO Meta --}}
    @php($canonicalUrl = trim($__env->yieldContent('canonical', url()->current())))
    <title>@yield('title', 'CompresslyPro — Free Online Image Tools')</title>
    <meta name="description" content="@yield('description', 'Free online image tools: compress, convert, resize images. No signup required.')">
    <meta name="robots" content="index, follow">
    <meta name="author" content="CompresslyPro">
    <link rel="canonical" href="{{ $canonicalUrl }}">

    {{-- Open Graph --}}
    <meta property="og:type" content="@yield('og_type', 'website')">
    <meta property="og:title" content="@yield('og_title', 'CompresslyPro — Free Online Image Tools')">
    <meta property="og:description" content="@yield('og_description', 'Compress, convert, resize images online free. No signup required.')">
    <meta property="og:url" content="{{ $canonicalUrl }}">
    <meta property="og:site_name" content="CompresslyPro">
    <meta property="og:image" content="{{ asset('og-image.png') }}">

    {{-- Twitter Card --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('og_title', 'CompresslyPro — Free Online Image Tools')">
    <meta name="twitter:description" content="@yield('og_description', 'Compress, convert, resize images online free.')">
    <meta name="twitter:image" content="{{ asset('og-image.png') }}">

    {{-- Mobile --}}
    <meta name="theme-color" content="#6366f1">
    <meta name="mobile-web-app-capable" content="yes">

    {{-- Tailwind CSS CDN --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand:  { 50:'#eef2ff',100:'#e0e7ff',200:'#c7d2fe',300:'#a5b4fc',400:'#818cf8',500:'#6366f1',600:'#4f46e5',700:'#4338ca',800:'#3730a3',900:'#312e81' },
                        accent: { 50:'#ecfdf5',100:'#d1fae5',200:'#a7f3d0',300:'#6ee7b7',400:'#34d399',500:'#10b981',600:'#059669',700:'#047857',800:'#065f46',900:'#064e3b' },
                    },
                    fontFamily: { sans: ['Inter', 'system-ui', '-apple-system', 'sans-serif'] },
                }
            }
        }
    </script>

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Inter', system-ui, sans-serif; }
        .gradient-text { background: linear-gradient(135deg, #6366f1, #8b5cf6, #a855f7); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; }
        .prose h2 { font-size: 1.35rem; font-weight: 700; margin-top: 2rem; margin-bottom: 0.75rem; color: #111827; }
        .prose h3 { font-size: 1.15rem; font-weight: 600; margin-top: 1.5rem; margin-bottom: 0.5rem; color: #1f2937; }
        .prose p, .prose li { color: #4b5563; line-height: 1.8; margin-bottom: 0.75rem; }
        .prose ul, .prose ol { padding-left: 1.5rem; margin-bottom: 1rem; }
        .prose ul { list-style: disc; }
        .prose ol { list-style: decimal; }
        .prose a { color: #6366f1; text-decoration: underline; }
        .prose strong { color: #1f2937; }
        .prose blockquote { border-left: 4px solid #c7d2fe; padding-left: 1rem; margin: 1.5rem 0; font-style: italic; color: #6b7280; }
        .prose table { width: 100%; border-collapse: collapse; margin: 1.5rem 0; }
        .prose th, .prose td { padding: 0.75rem 1rem; border: 1px solid #e5e7eb; text-align: left; }
        .prose th { background: #f9fafb; font-weight: 600; color: #111827; }
    </style>

    @yield('head')

    {{-- AdSense --}}
    @if(app()->isProduction())
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-6697940390340424" crossorigin="anonymous"></script>
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    @endif
</head>

<body class="bg-gray-50 text-gray-900 font-sans min-h-screen flex flex-col">

    {{-- Navigation --}}
    <nav class="bg-gradient-to-r from-gray-900 via-indigo-950 to-gray-900 border-b border-indigo-800/40 sticky top-0 z-50 shadow-lg">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <a href="/" class="flex items-center gap-2.5 group flex-shrink-0">
                    <img src="{{ asset('logo.png') }}" alt="CompresslyPro" class="h-10 sm:h-12 w-auto transition-all flex-shrink-0">
                    <div class="flex flex-col leading-tight">
                        <span class="text-white font-bold text-base sm:text-lg tracking-tight group-hover:text-indigo-200 transition-colors">CompresslyPro</span>
                        <span class="text-indigo-300/70 text-[10px] sm:text-xs font-medium hidden sm:block tracking-wide">Free Image Tools</span>
                    </div>
                </a>
                <nav aria-label="Main navigation" class="hidden md:flex items-center gap-1">
                    <a href="/compress" class="text-indigo-200/70 hover:text-white text-xs font-medium px-3 py-2 rounded-lg hover:bg-white/10 transition-all">Compress</a>
                    <a href="/convert" class="text-indigo-200/70 hover:text-white text-xs font-medium px-3 py-2 rounded-lg hover:bg-white/10 transition-all">Convert</a>
                    <a href="/resize" class="text-indigo-200/70 hover:text-white text-xs font-medium px-3 py-2 rounded-lg hover:bg-white/10 transition-all">Resize</a>
                    <a href="/batch-compress" class="text-indigo-200/70 hover:text-white text-xs font-medium px-3 py-2 rounded-lg hover:bg-white/10 transition-all">Batch</a>
                    <a href="/blog" class="text-indigo-200/70 hover:text-white text-xs font-medium px-3 py-2 rounded-lg hover:bg-white/10 transition-all">Blog</a>
                    <a href="/about" class="text-indigo-200/70 hover:text-white text-xs font-medium px-3 py-2 rounded-lg hover:bg-white/10 transition-all">About</a>
                </nav>
                <a href="/#compress" class="hidden sm:flex items-center gap-1.5 bg-brand-600 hover:bg-brand-500 text-white text-xs font-bold px-4 py-2 rounded-xl transition-all shadow-lg shadow-brand-900/40">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                    Start Free
                </a>
            </div>
        </div>
    </nav>

    {{-- Breadcrumb --}}
    @hasSection('breadcrumb')
    <nav aria-label="Breadcrumb" class="max-w-5xl mx-auto w-full px-4 sm:px-6 lg:px-8 pt-5 pb-2">
        <ol class="flex items-center gap-1.5 text-sm text-gray-400" itemscope itemtype="https://schema.org/BreadcrumbList">
            <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                <a href="/" itemprop="item" class="hover:text-brand-600 transition-colors font-medium">
                    <span itemprop="name">Home</span>
                </a>
                <meta itemprop="position" content="1">
            </li>
            @yield('breadcrumb')
        </ol>
    </nav>
    @endif

    {{-- Main Content --}}
    <main class="flex-1">
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="bg-gradient-to-r from-gray-900 via-indigo-950 to-gray-900 border-t border-indigo-800/40 pt-14 pb-6">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-8 pb-10 border-b border-indigo-800/40">
                {{-- Brand --}}
                <div class="lg:col-span-1">
                    <a href="/" class="flex items-center gap-2.5 mb-3">
                        <img src="{{ asset('logo.png') }}" alt="CompresslyPro logo" class="h-9 w-auto flex-shrink-0">
                        <div class="flex flex-col leading-tight">
                            <span class="text-white font-bold text-sm tracking-tight">CompresslyPro</span>
                            <span class="text-indigo-300/70 text-[10px] font-medium">Free Image Tools</span>
                        </div>
                    </a>
                    <p class="text-indigo-300/60 text-xs leading-relaxed max-w-xs mb-4">
                        Free online image tools: compress, convert, resize, watermark, batch compress, image-to-PDF and PDF-to-image. No signup, no watermarks, privacy-first.
                    </p>
                    <div class="flex items-center gap-1.5">
                        <div class="flex items-center gap-0.5">
                            @for($i=0;$i<5;$i++)<svg class="w-3.5 h-3.5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>@endfor
                        </div>
                        <span class="text-xs text-indigo-300/70">4.8/5 · 4,200+ reviews</span>
                    </div>
                </div>

                {{-- Tools --}}
                <div>
                    <h3 class="text-white font-semibold text-xs mb-3 uppercase tracking-wider">Image Tools</h3>
                    <nav aria-label="Tool links" class="space-y-2">
                        <a href="/compress" class="block text-indigo-300/70 hover:text-white text-sm transition-colors">Image Compressor</a>
                        <a href="/batch-compress" class="block text-indigo-300/70 hover:text-white text-sm transition-colors">Batch Compressor</a>
                        <a href="/convert" class="block text-indigo-300/70 hover:text-white text-sm transition-colors">Image Converter</a>
                        <a href="/resize" class="block text-indigo-300/70 hover:text-white text-sm transition-colors">Image Resizer</a>
                        <a href="/watermark" class="block text-indigo-300/70 hover:text-white text-sm transition-colors">Watermark Tool</a>
                        <a href="/image-to-pdf" class="block text-indigo-300/70 hover:text-white text-sm transition-colors">Image to PDF</a>
                        <a href="/pdf-to-image" class="block text-indigo-300/70 hover:text-white text-sm transition-colors">PDF to Image</a>
                    </nav>
                </div>

                {{-- Resources --}}
                <div>
                    <h3 class="text-white font-semibold text-xs mb-3 uppercase tracking-wider">Resources</h3>
                    <nav aria-label="Resource links" class="space-y-2">
                        <a href="/blog" class="block text-indigo-300/70 hover:text-white text-sm transition-colors">Blog & Guides</a>
                        <a href="/blog/how-to-compress-images-for-web" class="block text-indigo-300/70 hover:text-white text-sm transition-colors">Image Compression Guide</a>
                        <a href="/blog/webp-vs-jpg-vs-png" class="block text-indigo-300/70 hover:text-white text-sm transition-colors">WebP vs JPG vs PNG</a>
                        <a href="/blog/image-seo-best-practices" class="block text-indigo-300/70 hover:text-white text-sm transition-colors">Image SEO Tips</a>
                    </nav>
                </div>

                {{-- Company --}}
                <div>
                    <h3 class="text-white font-semibold text-xs mb-3 uppercase tracking-wider">Company</h3>
                    <nav aria-label="Company links" class="space-y-2">
                        <a href="/about" class="block text-indigo-300/70 hover:text-white text-sm transition-colors">About Us</a>
                        <a href="/contact" class="block text-indigo-300/70 hover:text-white text-sm transition-colors">Contact Us</a>
                        <a href="/privacy-policy" class="block text-indigo-300/70 hover:text-white text-sm transition-colors">Privacy Policy</a>
                        <a href="/terms" class="block text-indigo-300/70 hover:text-white text-sm transition-colors">Terms of Service</a>
                        <a href="/sitemap" class="block text-indigo-300/70 hover:text-white text-sm transition-colors">Sitemap</a>
                        <a href="/sitemap.xml" class="block text-indigo-300/70 hover:text-white text-sm transition-colors">XML Sitemap</a>
                    </nav>
                    <div class="mt-4 space-y-1.5 text-xs text-indigo-300/50">
                        <div class="flex items-center gap-2">
                            <svg class="w-3.5 h-3.5 text-accent-400 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                            <span>Files auto-delete in 30 min</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <svg class="w-3.5 h-3.5 text-accent-400 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                            <span>100% secure & private</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="pt-6 flex flex-col sm:flex-row items-center justify-between gap-3 text-xs text-indigo-300/50">
                <span>&copy; {{ date('Y') }} CompresslyPro. All rights reserved.</span>
                <div class="flex items-center gap-3 flex-wrap justify-center">
                    <a href="/privacy-policy" class="hover:text-white transition-colors">Privacy</a>
                    <span class="w-1 h-1 bg-indigo-600 rounded-full"></span>
                    <a href="/terms" class="hover:text-white transition-colors">Terms</a>
                    <span class="w-1 h-1 bg-indigo-600 rounded-full"></span>
                    <a href="/contact" class="hover:text-white transition-colors">Contact</a>
                    <span class="w-1 h-1 bg-indigo-600 rounded-full"></span>
                    <a href="/about" class="hover:text-white transition-colors">About</a>
                    <span class="w-1 h-1 bg-indigo-600 rounded-full"></span>
                    <a href="/sitemap" class="hover:text-white transition-colors">Sitemap</a>
                    <span class="w-1 h-1 bg-indigo-600 rounded-full"></span>
                    <a href="/sitemap.xml" class="hover:text-white transition-colors">XML Sitemap</a>
                </div>
            </div>
        </div>
    </footer>

</body>
</html>
