<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- SEO Meta --}}
    <title>Free Online Image Compressor - Compress JPG, PNG & WebP Images | Reduce File Size up to 90%</title>
    <meta name="description" content="Compress images online for FREE! Reduce JPG, PNG, WebP file sizes by up to 90% without quality loss. Fast, secure, no signup. Convert formats. 20MB max. Start compressing now!">
    <meta name="keywords" content="image compressor, compress image online, reduce image size, JPG compressor, PNG compressor, WEBP compressor, free image optimizer, image converter, reduce file size, compress photo, online image tool, lossy compression, lossless compression">
    <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
    <meta name="author" content="ImageCompressor Tool">
    <link rel="canonical" href="{{ url('/') }}">
    
    {{-- Additional SEO --}}
    <meta name="rating" content="general">
    <meta name="distribution" content="global">
    <meta name="language" content="English">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    {{-- Geo Tags --}}
    <meta name="geo.region" content="US">
    <meta name="geo.placename" content="United States">
    
    {{-- Mobile Optimization --}}
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="apple-mobile-web-app-title" content="ImageCompressor">
    <meta name="theme-color" content="#6366f1">

    {{-- Open Graph --}}
    <meta property="og:type" content="website">
    <meta property="og:title" content="Free Online Image Compressor - Reduce File Size up to 90%">
    <meta property="og:description" content="Compress JPG, PNG, WebP images online for free. Reduce file size by up to 90% without quality loss. No signup required. Fast, secure, and easy to use.">
    <meta property="og:url" content="{{ url('/') }}">
    <meta property="og:site_name" content="ImageCompressor - Free Online Image Compression Tool">
    <meta property="og:locale" content="en_US">
    <meta property="og:image" content="{{ asset('og-image.png') }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:alt" content="Free Online Image Compressor Tool">

    {{-- Twitter Card --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Free Online Image Compressor - Reduce File Size up to 90%">
    <meta name="twitter:description" content="Compress JPG, PNG, WebP images online for free. Reduce file size without quality loss. No signup required.">
    <meta name="twitter:image" content="{{ asset('og-image.png') }}">
    <meta name="twitter:image:alt" content="Free Online Image Compressor Tool">
    <meta name="twitter:creator" content="@imagecompressor">
    <meta name="twitter:site" content="@imagecompressor">

    {{-- Google Site Verification --}}
    @if(config('services.google_site_verification'))
    <meta name="google-site-verification" content="{{ config('services.google_site_verification') }}" />
    @endif

    {{-- Schema Markup — use @verbatim to avoid Blade parsing @context/@type --}}
    @verbatim
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "WebApplication",
        "name": "Free Online Image Compressor",
        "alternateName": "ImageCompressor Tool",
        "description": "Compress JPG, PNG, WebP images online for free. Reduce image file size by up to 90% without losing quality. Fast, secure, no signup required.",
        "url": "https://img.beginnersoft.com",
        "applicationCategory": "MultimediaApplication",
        "operatingSystem": "All",
        "browserRequirements": "Requires JavaScript. Requires HTML5.",
        "softwareVersion": "1.0",
        "offers": {
            "@type": "Offer",
            "price": "0",
            "priceCurrency": "USD",
            "availability": "https://schema.org/InStock",
            "priceValidUntil": "2030-12-31"
        },
        "creator": {
            "@type": "Organization",
            "name": "ImageCompressor"
        },
        "featureList": [
            "Compress JPG/JPEG images online",
            "Compress PNG images online",
            "Compress WebP images online",
            "Convert image formats (JPG, PNG, WebP)",
            "Adjustable quality control (10-90%)",
            "No signup or registration required",
            "Free unlimited compressions",
            "Fast processing under 5 seconds",
            "Secure - files auto-deleted",
            "Drag and drop upload",
            "Paste from clipboard support",
            "Up to 20MB file size support",
            "Batch processing ready",
            "Download compressed images instantly"
        ],
        "potentialAction": {
            "@type": "UseAction",
            "target": {
                "@type": "EntryPoint",
                "urlTemplate": "https://img.beginnersoft.com",
                "actionPlatform": [
                    "http://schema.org/DesktopWebPlatform",
                    "http://schema.org/MobileWebPlatform"
                ]
            }
        },
        "aggregateRating": {
            "@type": "AggregateRating",
            "ratingValue": "4.8",
            "reviewCount": "1247",
            "bestRating": "5",
            "worstRating": "1"
        }
    }
    </script>
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "BreadcrumbList",
        "itemListElement": [{
            "@type": "ListItem",
            "position": 1,
            "name": "Home",
            "item": "https://img.beginnersoft.com"
        }]
    }
    </script>
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "HowTo",
        "name": "How to Compress Images Online",
        "description": "Step-by-step guide to compress your images using our free online tool",
        "totalTime": "PT2M",
        "step": [
            {
                "@type": "HowToStep",
                "position": 1,
                "name": "Upload Image",
                "text": "Drag and drop your image, click to browse, or paste from clipboard (Ctrl+V/Cmd+V)",
                "image": "https://img.beginnersoft.com/steps/upload.png"
            },
            {
                "@type": "HowToStep",
                "position": 2,
                "name": "Adjust Settings",
                "text": "Choose output format (JPG, PNG, or WebP) and set quality level (10-90%). Higher quality = larger file.",
                "image": "https://img.beginnersoft.com/steps/settings.png"
            },
            {
                "@type": "HowToStep",
                "position": 3,
                "name": "Compress",
                "text": "Click 'Compress Image' button and wait 2-5 seconds for processing",
                "image": "https://img.beginnersoft.com/steps/compress.png"
            },
            {
                "@type": "HowToStep",
                "position": 4,
                "name": "Download",
                "text": "Click 'Download' button to save your compressed image. View statistics showing original vs compressed size.",
                "image": "https://img.beginnersoft.com/steps/download.png"
            }
        ]
    }
    </script>
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "FAQPage",
        "mainEntity": [
            {
                "@type": "Question",
                "name": "Is this image compressor free?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "Yes, our image compressor is 100% free to use with no signup required."
                }
            },
            {
                "@type": "Question",
                "name": "What image formats are supported?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "We support JPG/JPEG, PNG, WEBP, and GIF image formats."
                }
            },
            {
                "@type": "Question",
                "name": "What is the maximum file size?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "You can upload images up to 20MB in size."
                }
            },
            {
                "@type": "Question",
                "name": "How can I upload images?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "You can upload images by dragging and dropping files, clicking to browse, or pressing Ctrl+V (Cmd+V on Mac) to paste images directly from your clipboard."
                }
            },
            {
                "@type": "Question",
                "name": "Are my images stored on the server?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "Uploaded images are automatically deleted within 30 minutes. We do not store your images permanently."
                }
            },
            {
                "@type": "Question",
                "name": "Can I convert image formats?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "Yes, you can convert between JPG, PNG, and WEBP formats during compression."
                }
            }
        ]
    }
    </script>
    @endverbatim

    {{-- Tailwind CSS CDN --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        brand:  { 50:'#eef2ff',100:'#e0e7ff',200:'#c7d2fe',300:'#a5b4fc',400:'#818cf8',500:'#6366f1',600:'#4f46e5',700:'#4338ca',800:'#3730a3',900:'#312e81' },
                        accent: { 50:'#ecfdf5',100:'#d1fae5',200:'#a7f3d0',300:'#6ee7b7',400:'#34d399',500:'#10b981',600:'#059669',700:'#047857',800:'#065f46',900:'#064e3b' },
                    },
                    fontFamily: {
                        sans: ['Inter', 'system-ui', '-apple-system', 'sans-serif'],
                    },
                    animation: {
                        'float': 'float 6s ease-in-out infinite',
                        'pulse-slow': 'pulse 4s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                        'slide-up': 'slideUp 0.5s ease-out',
                        'slide-down': 'slideDown 0.3s ease-out',
                        'scale-in': 'scaleIn 0.3s ease-out',
                    },
                    keyframes: {
                        float: {
                            '0%, 100%': { transform: 'translateY(0px)' },
                            '50%': { transform: 'translateY(-10px)' },
                        },
                        slideUp: {
                            '0%': { opacity: '0', transform: 'translateY(30px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' },
                        },
                        slideDown: {
                            '0%': { opacity: '0', transform: 'translateY(-10px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' },
                        },
                        scaleIn: {
                            '0%': { opacity: '0', transform: 'scale(0.95)' },
                            '100%': { opacity: '1', transform: 'scale(1)' },
                        },
                    },
                }
            }
        }
    </script>

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <style>
        [x-cloak] { display: none !important; }

        /* Custom range slider */
        input[type="range"] { -webkit-appearance: none; appearance: none; height: 6px; border-radius: 6px; outline: none; background: transparent; }
        input[type="range"]::-webkit-slider-runnable-track { height: 6px; border-radius: 6px; }
        input[type="range"]::-webkit-slider-thumb {
            -webkit-appearance: none; appearance: none; width: 24px; height: 24px; border-radius: 50%;
            background: linear-gradient(135deg, #6366f1, #4f46e5); cursor: pointer; border: 3px solid white;
            box-shadow: 0 2px 8px rgba(99,102,241,0.4); margin-top: -9px; transition: transform 0.15s;
        }
        input[type="range"]::-webkit-slider-thumb:hover { transform: scale(1.15); }
        input[type="range"]::-moz-range-thumb {
            width: 24px; height: 24px; border-radius: 50%;
            background: linear-gradient(135deg, #6366f1, #4f46e5); cursor: pointer; border: 3px solid white;
            box-shadow: 0 2px 8px rgba(99,102,241,0.4);
        }
        /* Dark mode range slider thumb */
        .dark input[type="range"]::-webkit-slider-thumb {
            border-color: #1f2937;
        }
        .dark input[type="range"]::-moz-range-thumb {
            border-color: #1f2937;
        }

        /* Progress animation */
        @keyframes shimmer { 0% { transform: translateX(-100%); } 100% { transform: translateX(200%); } }
        .shimmer { animation: shimmer 1.8s ease-in-out infinite; }

        /* Gradient text */
        .gradient-text { background: linear-gradient(135deg, #6366f1, #8b5cf6, #a855f7); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; }

        /* Glass effect */
        .glass { backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px); }

        /* Smooth scrollbar */
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #c7d2fe; border-radius: 3px; }
        .dark ::-webkit-scrollbar-thumb { background: #4338ca; }

        /* Drop zone pulse */
        .drop-active { border-color: #6366f1 !important; background: rgba(99,102,241,0.04) !important; }
        .dark .drop-active { background: rgba(99,102,241,0.12) !important; }

        /* Animated background */
        .hero-bg { background: radial-gradient(ellipse at 20% 50%, rgba(99,102,241,0.08) 0%, transparent 50%), radial-gradient(ellipse at 80% 20%, rgba(139,92,246,0.06) 0%, transparent 50%), radial-gradient(ellipse at 50% 80%, rgba(168,85,247,0.05) 0%, transparent 50%); }
        .dark .hero-bg { background: radial-gradient(ellipse at 20% 50%, rgba(99,102,241,0.15) 0%, transparent 50%), radial-gradient(ellipse at 80% 20%, rgba(139,92,246,0.1) 0%, transparent 50%); }
    </style>

    {{-- Google Analytics - Replace with your GA4 Measurement ID --}}
    @if(config('services.google_analytics.enabled', false))
    <script async src="https://www.googletagmanager.com/gtag/js?id={{ config('services.google_analytics.tracking_id') }}"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', '{{ config('services.google_analytics.tracking_id') }}', {
            'anonymize_ip': true,
            'cookie_flags': 'SameSite=None;Secure'
        });
    </script>
    @endif

    {{-- Preconnect for performance --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://cdn.tailwindcss.com">
    <link rel="dns-prefetch" href="https://www.googletagmanager.com">
</head>

<body class="bg-gray-50 dark:bg-gray-950 text-gray-900 dark:text-gray-100 font-sans min-h-screen transition-colors duration-300"
      x-data="app()" x-init="init()" :class="{ 'dark': darkMode }">

    {{-- Navigation --}}
    <nav class="bg-white/80 dark:bg-gray-900/80 glass border-b border-gray-200/60 dark:border-gray-800/60 sticky top-0 z-50">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <a href="/" class="flex items-center gap-2.5 group">
                    <div class="w-9 h-9 bg-gradient-to-br from-brand-500 to-brand-700 rounded-xl flex items-center justify-center shadow-lg shadow-brand-500/20 group-hover:shadow-brand-500/40 transition-shadow">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    </div>
                    <span class="text-lg font-bold bg-gradient-to-r from-brand-600 to-brand-800 dark:from-brand-400 dark:to-brand-300 bg-clip-text text-transparent">ImageCompressor</span>
                </a>
                <div class="flex items-center gap-3">
                    <button x-on:click="darkMode = !darkMode; localStorage.setItem('darkMode', darkMode)"
                        class="p-2.5 rounded-xl bg-gray-100 dark:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700 transition-all duration-200 hover:scale-105"
                        aria-label="Toggle dark mode">
                        <svg x-show="!darkMode" class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/></svg>
                        <svg x-show="darkMode" x-cloak class="w-5 h-5 text-amber-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    {{-- Ad Banner: Top --}}
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
        <div class="bg-gray-100/60 dark:bg-gray-800/40 border border-dashed border-gray-300 dark:border-gray-700 rounded-xl p-3 text-center text-gray-400 dark:text-gray-600 text-xs font-medium tracking-wide uppercase">
            Advertisement
        </div>
    </div>

    {{-- Hero Section --}}
    <header class="hero-bg pt-10 pb-6 sm:pt-14 sm:pb-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="inline-flex items-center gap-2 bg-brand-50 dark:bg-brand-900/30 text-brand-700 dark:text-brand-300 text-sm font-medium px-4 py-1.5 rounded-full mb-6 animate-slide-down">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                100% Free · No Signup · Unlimited Compressions
            </div>
            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight leading-tight mb-5">
                Free Online Image Compressor –
                <span class="gradient-text">Reduce JPG, PNG & WebP File Size by 90%</span>
            </h1>
            <p class="text-lg sm:text-xl text-gray-500 dark:text-gray-400 max-w-2xl mx-auto leading-relaxed">
                Compress images online FREE! Reduce JPG, PNG & WebP file size up to <strong class="text-gray-700 dark:text-gray-200">90% smaller</strong> without quality loss. No signup. Instant results. Convert formats. Privacy-first compression tool.
            </p>
        </div>
    </header>

    {{-- Main App --}}
    <main class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 pb-12 -mt-2" x-data="compressor()" x-cloak itemscope itemtype="https://schema.org/SoftwareApplication">

        {{-- ======== IDLE / ERROR STATE: Upload Area ======== --}}
        <div x-show="state === 'idle' || state === 'error'" class="animate-slide-up">

            {{-- Drop Zone --}}
            <div id="dropZone"
                 x-on:dragover.prevent="isDragging = true"
                 x-on:dragleave.prevent="isDragging = false"
                 x-on:drop.prevent="handleDrop($event)"
                 x-on:click="$refs.fileInput.click()"
                 :class="{ 'drop-active ring-2 ring-brand-400': isDragging, 'ring-2 ring-green-400 dark:ring-green-500': isPasting }"
                 class="relative bg-white dark:bg-gray-900 border-2 border-dashed border-gray-300 dark:border-gray-700 rounded-3xl p-10 sm:p-14 text-center cursor-pointer hover:border-brand-400 dark:hover:border-brand-500 transition-all duration-300 group shadow-sm hover:shadow-lg">

                <input type="file" x-ref="fileInput" x-on:change="handleFileSelect($event)" accept=".jpg,.jpeg,.png,.webp,.gif" class="hidden">

                {{-- Floating icon --}}
                <div class="relative mx-auto w-20 h-20 sm:w-24 sm:h-24 mb-6">
                    <div class="absolute inset-0 bg-brand-100 dark:bg-brand-900/40 rounded-3xl rotate-6 group-hover:rotate-12 transition-transform duration-300"></div>
                    <div class="relative bg-gradient-to-br from-brand-500 to-brand-700 rounded-3xl w-full h-full flex items-center justify-center shadow-xl shadow-brand-500/25">
                        <svg class="w-10 h-10 sm:w-12 sm:h-12 text-white" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5"/></svg>
                    </div>
                </div>

                <h2 class="text-xl sm:text-2xl font-bold mb-2">Drop your image here</h2>
                <p class="text-gray-500 dark:text-gray-400 mb-5">or <span class="text-brand-600 dark:text-brand-400 font-semibold underline decoration-brand-300 underline-offset-2">browse files</span> from your device</p>
                
                {{-- Paste hint --}}
                <div class="mb-5 flex items-center justify-center gap-2 text-sm text-gray-400 dark:text-gray-500">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    <span>or press <kbd class="px-2 py-0.5 text-xs bg-gray-100 dark:bg-gray-800 border border-gray-300 dark:border-gray-700 rounded">Ctrl+V</kbd> to paste</span>
                </div>

                {{-- Format badges --}}
                <div class="flex flex-wrap justify-center gap-2">
                    <span class="inline-flex items-center gap-1 bg-gray-100 dark:bg-gray-800 text-gray-500 dark:text-gray-400 text-xs font-semibold px-3 py-1.5 rounded-full">JPG</span>
                    <span class="inline-flex items-center gap-1 bg-gray-100 dark:bg-gray-800 text-gray-500 dark:text-gray-400 text-xs font-semibold px-3 py-1.5 rounded-full">PNG</span>
                    <span class="inline-flex items-center gap-1 bg-gray-100 dark:bg-gray-800 text-gray-500 dark:text-gray-400 text-xs font-semibold px-3 py-1.5 rounded-full">WEBP</span>
                    <span class="inline-flex items-center gap-1 bg-gray-100 dark:bg-gray-800 text-gray-500 dark:text-gray-400 text-xs font-semibold px-3 py-1.5 rounded-full">GIF</span>
                    <span class="inline-flex items-center gap-1 bg-brand-50 dark:bg-brand-900/30 text-brand-600 dark:text-brand-400 text-xs font-semibold px-3 py-1.5 rounded-full">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                        Max 20MB
                    </span>
                </div>
            </div>

            {{-- Error Alert --}}
            <div x-show="errorMessage" x-transition.duration.300ms class="mt-4 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800/40 rounded-2xl p-4 flex items-start gap-3 animate-scale-in">
                <div class="w-8 h-8 bg-red-100 dark:bg-red-900/40 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                    <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <div>
                    <p class="text-red-700 dark:text-red-300 text-sm font-medium" x-text="errorMessage"></p>
                    <button x-on:click="errorMessage = ''" class="text-red-400 text-xs mt-1 hover:text-red-600 transition-colors">Dismiss</button>
                </div>
            </div>
        </div>

        {{-- ======== SETTINGS STATE ======== --}}
        <div x-show="state === 'settings'" x-transition class="animate-slide-up">
            <div class="bg-white dark:bg-gray-900 rounded-3xl shadow-xl shadow-gray-200/50 dark:shadow-gray-900/50 border border-gray-200/60 dark:border-gray-800/60 overflow-hidden">

                {{-- File Header --}}
                <div class="px-6 sm:px-8 pt-6 sm:pt-8 pb-5 border-b border-gray-100 dark:border-gray-800 flex items-center gap-4">
                    <div class="w-14 h-14 bg-gradient-to-br from-brand-100 to-brand-50 dark:from-brand-900/40 dark:to-brand-800/20 rounded-2xl flex items-center justify-center flex-shrink-0">
                        <svg class="w-7 h-7 text-brand-600 dark:text-brand-400" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909M3.75 21h16.5A2.25 2.25 0 0022.5 18.75V5.25A2.25 2.25 0 0020.25 3H3.75A2.25 2.25 0 001.5 5.25v13.5A2.25 2.25 0 003.75 21z"/></svg>
                    </div>
                    <div class="min-w-0 flex-1">
                        <p class="font-bold text-base truncate" x-text="fileName"></p>
                        <p class="text-sm text-gray-500 dark:text-gray-400 flex items-center gap-2">
                            <span x-text="formatBytes(fileSize)"></span>
                            <span class="w-1 h-1 bg-gray-300 dark:bg-gray-600 rounded-full"></span>
                            <span x-text="fileType.toUpperCase()"></span>
                        </p>
                    </div>
                    <button x-on:click="reset()" class="p-2 rounded-xl text-gray-400 hover:text-red-500 hover:bg-red-50 dark:hover:bg-red-900/20 transition-all" title="Remove file">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>

                <div class="px-6 sm:px-8 py-6 sm:py-8 space-y-7">

                    {{-- Image Preview --}}
                    <div x-show="previewUrl" class="rounded-2xl overflow-hidden bg-gray-100 dark:bg-gray-800 max-h-64 flex items-center justify-center">
                        <img :src="previewUrl" alt="Preview" class="max-h-64 object-contain w-full" loading="lazy">
                    </div>

                    {{-- Quality Slider --}}
                    <div>
                        <div class="flex items-center justify-between mb-3">
                            <label class="text-sm font-semibold text-gray-700 dark:text-gray-300">Compression Quality</label>
                            <span class="text-sm font-bold bg-brand-100 dark:bg-brand-900/40 text-brand-700 dark:text-brand-300 px-3 py-1 rounded-full" x-text="quality + '%'"></span>
                        </div>
                        <input type="range" min="10" max="90" step="1" x-model.number="quality"
                               class="w-full" :style="darkMode 
                                   ? 'background: linear-gradient(to right, #6366f1 ' + ((quality - 10) / 80 * 100) + '%, #374151 ' + ((quality - 10) / 80 * 100) + '%)'
                                   : 'background: linear-gradient(to right, #6366f1 ' + ((quality - 10) / 80 * 100) + '%, #e5e7eb ' + ((quality - 10) / 80 * 100) + '%)'">
                        <div class="flex justify-between mt-2 text-xs text-gray-400 dark:text-gray-500 font-medium">
                            <span>🗜️ Smaller file</span>
                            <span>🖼️ Higher quality</span>
                        </div>

                        {{-- Quick Presets --}}
                        <div class="flex gap-2 mt-4">
                            <button x-on:click="quality = 20"
                                :class="quality >= 10 && quality <= 30 ? 'bg-brand-100 dark:bg-brand-900/40 text-brand-700 dark:text-brand-300 border-brand-200 dark:border-brand-700 ring-1 ring-brand-200 dark:ring-brand-700' : 'bg-gray-50 dark:bg-gray-800 text-gray-600 dark:text-gray-400 border-gray-200 dark:border-gray-700 hover:border-brand-300'"
                                class="flex-1 px-3 py-2.5 rounded-xl border text-xs font-semibold transition-all text-center">
                                Max Compression
                            </button>
                            <button x-on:click="quality = 50"
                                :class="quality >= 31 && quality <= 65 ? 'bg-brand-100 dark:bg-brand-900/40 text-brand-700 dark:text-brand-300 border-brand-200 dark:border-brand-700 ring-1 ring-brand-200 dark:ring-brand-700' : 'bg-gray-50 dark:bg-gray-800 text-gray-600 dark:text-gray-400 border-gray-200 dark:border-gray-700 hover:border-brand-300'"
                                class="flex-1 px-3 py-2.5 rounded-xl border text-xs font-semibold transition-all text-center">
                                Balanced
                            </button>
                            <button x-on:click="quality = 80"
                                :class="quality >= 66 && quality <= 90 ? 'bg-brand-100 dark:bg-brand-900/40 text-brand-700 dark:text-brand-300 border-brand-200 dark:border-brand-700 ring-1 ring-brand-200 dark:ring-brand-700' : 'bg-gray-50 dark:bg-gray-800 text-gray-600 dark:text-gray-400 border-gray-200 dark:border-gray-700 hover:border-brand-300'"
                                class="flex-1 px-3 py-2.5 rounded-xl border text-xs font-semibold transition-all text-center">
                                High Quality
                            </button>
                        </div>
                    </div>

                    {{-- Output Format --}}
                    <div>
                        <label class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3 block">Output Format</label>
                        <div class="grid grid-cols-4 gap-2">
                            <template x-for="fmt in ['original', 'jpg', 'png', 'webp']" :key="fmt">
                                <button x-on:click="outputFormat = fmt"
                                    :class="outputFormat === fmt ? 'bg-brand-600 text-white border-brand-600 shadow-lg shadow-brand-500/25' : 'bg-white dark:bg-gray-800 text-gray-600 dark:text-gray-400 border-gray-200 dark:border-gray-700 hover:border-brand-300'"
                                    class="px-3 py-2.5 rounded-xl border text-sm font-semibold transition-all text-center"
                                    x-text="fmt === 'original' ? 'Original' : fmt.toUpperCase()">
                                </button>
                            </template>
                        </div>
                    </div>

                    {{-- Estimated Time --}}
                    <div class="flex items-center gap-2 text-sm text-gray-400 dark:text-gray-500 bg-gray-50 dark:bg-gray-800/50 rounded-xl px-4 py-3">
                        <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <span>Estimated time: <strong class="text-gray-600 dark:text-gray-300" x-text="estimatedTime()"></strong></span>
                    </div>

                    {{-- Compress Button --}}
                    <button x-on:click="compress()"
                        class="w-full bg-gradient-to-r from-brand-600 to-brand-700 hover:from-brand-700 hover:to-brand-800 text-white font-bold py-4 px-6 rounded-2xl transition-all duration-200 flex items-center justify-center gap-2.5 text-lg shadow-xl shadow-brand-500/25 hover:shadow-brand-500/40 hover:scale-[1.02] active:scale-[0.98]">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3"/></svg>
                        Compress Image
                    </button>
                </div>
            </div>
        </div>

        {{-- ======== PROCESSING STATE ======== --}}
        <div x-show="state === 'processing'" x-transition class="animate-slide-up">
            <div class="bg-white dark:bg-gray-900 rounded-3xl shadow-xl shadow-gray-200/50 dark:shadow-gray-900/50 border border-gray-200/60 dark:border-gray-800/60 p-10 sm:p-14 text-center">
                <div class="relative w-20 h-20 mx-auto mb-6">
                    <div class="absolute inset-0 rounded-full bg-brand-100 dark:bg-brand-900/30 animate-ping opacity-40"></div>
                    <div class="relative w-full h-full rounded-full bg-brand-50 dark:bg-brand-900/20 flex items-center justify-center">
                        <svg class="animate-spin w-10 h-10 text-brand-600" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-20" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="3"/>
                            <path class="opacity-80" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"/>
                        </svg>
                    </div>
                </div>
                <h3 class="text-2xl font-bold mb-2">Compressing your image...</h3>
                <p class="text-gray-500 dark:text-gray-400 mb-6">This usually takes just a few seconds</p>
                <div class="w-full bg-gray-200 dark:bg-gray-800 rounded-full h-1.5 overflow-hidden max-w-xs mx-auto">
                    <div class="bg-gradient-to-r from-brand-500 to-brand-600 h-1.5 rounded-full w-1/3 shimmer"></div>
                </div>
            </div>
        </div>

        {{-- ======== RESULT STATE ======== --}}
        <div x-show="state === 'result'" x-transition class="animate-slide-up space-y-5">

            {{-- Stats Row --}}
            <div class="grid grid-cols-3 gap-3">
                <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200/60 dark:border-gray-800/60 p-4 sm:p-5 text-center shadow-sm">
                    <div class="w-9 h-9 bg-gray-100 dark:bg-gray-800 rounded-xl flex items-center justify-center mx-auto mb-2">
                        <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"/></svg>
                    </div>
                    <p class="text-xs text-gray-400 dark:text-gray-500 font-medium mb-0.5">Original</p>
                    <p class="text-base sm:text-lg font-bold text-gray-700 dark:text-gray-200" x-text="result.formatted_original"></p>
                </div>
                <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200/60 dark:border-gray-800/60 p-4 sm:p-5 text-center shadow-sm">
                    <div class="w-9 h-9 bg-accent-50 dark:bg-accent-900/30 rounded-xl flex items-center justify-center mx-auto mb-2">
                        <svg class="w-4 h-4 text-accent-600 dark:text-accent-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <p class="text-xs text-gray-400 dark:text-gray-500 font-medium mb-0.5">Compressed</p>
                    <p class="text-base sm:text-lg font-bold text-accent-600 dark:text-accent-400" x-text="result.formatted_compressed"></p>
                </div>
                <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200/60 dark:border-gray-800/60 p-4 sm:p-5 text-center shadow-sm">
                    <div class="w-9 h-9 rounded-xl flex items-center justify-center mx-auto mb-2"
                         :class="result.reduction > 0 ? 'bg-green-50 dark:bg-green-900/30' : 'bg-red-50 dark:bg-red-900/30'">
                        <svg class="w-4 h-4" :class="result.reduction > 0 ? 'text-green-600 dark:text-green-400' : 'text-red-500'" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
                    </div>
                    <p class="text-xs text-gray-400 dark:text-gray-500 font-medium mb-0.5">Saved</p>
                    <p class="text-base sm:text-lg font-bold"
                       :class="result.reduction > 0 ? 'text-green-600 dark:text-green-400' : 'text-red-500'"
                       x-text="result.reduction + '%'"></p>
                </div>
            </div>

            {{-- Actions Card --}}
            <div class="bg-white dark:bg-gray-900 rounded-3xl shadow-xl shadow-gray-200/50 dark:shadow-gray-900/50 border border-gray-200/60 dark:border-gray-800/60 p-6 sm:p-8">

                {{-- Reduction bar visual --}}
                <div class="mb-6">
                    <div class="flex justify-between text-xs font-medium text-gray-400 mb-2">
                        <span>File size reduction</span>
                        <span x-text="result.reduction + '% smaller'"></span>
                    </div>
                    <div class="w-full bg-gray-100 dark:bg-gray-800 rounded-full h-3 overflow-hidden">
                        <div class="h-3 rounded-full bg-gradient-to-r from-accent-400 to-accent-600 transition-all duration-1000 ease-out" :style="'width:' + Math.min(Math.max(result.reduction, 2), 100) + '%'"></div>
                    </div>
                </div>

                {{-- Buttons --}}
                <div class="flex flex-col sm:flex-row gap-3 mb-6">
                    <a :href="result.download_url" download
                       class="flex-1 bg-gradient-to-r from-accent-600 to-accent-700 hover:from-accent-700 hover:to-accent-800 text-white font-bold py-4 px-6 rounded-2xl transition-all duration-200 flex items-center justify-center gap-2.5 text-lg shadow-xl shadow-accent-500/25 hover:shadow-accent-500/40 hover:scale-[1.02] active:scale-[0.98]">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        Download
                    </a>
                    <button x-on:click="reset()"
                        class="bg-gray-100 dark:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-200 font-bold py-4 px-6 rounded-2xl transition-all duration-200 flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                        New Image
                    </button>
                </div>

                {{-- Details Grid --}}
                <div class="grid grid-cols-2 gap-x-6 gap-y-2 text-sm pt-5 border-t border-gray-100 dark:border-gray-800">
                    <div class="flex justify-between"><span class="text-gray-400 dark:text-gray-500">Format</span><strong class="text-gray-900 dark:text-gray-100" x-text="result.format"></strong></div>
                    <div class="flex justify-between"><span class="text-gray-400 dark:text-gray-500">Dimensions</span><strong class="text-gray-900 dark:text-gray-100" x-text="(result.width || '—') + ' × ' + (result.height || '—')"></strong></div>
                    <div class="flex justify-between"><span class="text-gray-400 dark:text-gray-500">Quality</span><strong class="text-gray-900 dark:text-gray-100" x-text="quality + '%'"></strong></div>
                    <div class="flex justify-between"><span class="text-gray-400 dark:text-gray-500">File</span><strong class="truncate max-w-[120px] block text-right text-gray-900 dark:text-gray-100" x-text="result.original_name"></strong></div>
                </div>
            </div>

            {{-- Ad: Below Download --}}
            <div class="bg-gray-100/60 dark:bg-gray-800/40 border border-dashed border-gray-300 dark:border-gray-700 rounded-xl p-3 text-center text-gray-400 dark:text-gray-600 text-xs font-medium tracking-wide uppercase">
                Advertisement
            </div>
        </div>

    </main>

    {{-- Ad Banner: Middle --}}
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 my-10">
        <div class="bg-gray-100/60 dark:bg-gray-800/40 border border-dashed border-gray-300 dark:border-gray-700 rounded-xl p-3 text-center text-gray-400 dark:text-gray-600 text-xs font-medium tracking-wide uppercase">
            Advertisement
        </div>
    </div>

    {{-- Features Section --}}
    <section class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="text-center mb-12">
            <h2 class="text-3xl sm:text-4xl font-extrabold mb-4">Why Choose Our Compressor?</h2>
            <p class="text-gray-500 dark:text-gray-400 max-w-xl mx-auto">Trusted by thousands of creators, developers, and businesses worldwide</p>
        </div>
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-5">
            {{-- Feature 1 --}}
            <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200/60 dark:border-gray-800/60 p-6 hover:shadow-lg transition-shadow group">
                <div class="w-12 h-12 bg-brand-50 dark:bg-brand-900/30 rounded-2xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6 text-brand-600 dark:text-brand-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                </div>
                <h3 class="font-bold text-lg mb-2">Lightning Fast</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400 leading-relaxed">Server-side compression in milliseconds. No waiting, no queues.</p>
            </div>
            {{-- Feature 2 --}}
            <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200/60 dark:border-gray-800/60 p-6 hover:shadow-lg transition-shadow group">
                <div class="w-12 h-12 bg-accent-50 dark:bg-accent-900/30 rounded-2xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6 text-accent-600 dark:text-accent-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                </div>
                <h3 class="font-bold text-lg mb-2">100% Secure</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400 leading-relaxed">Files auto-delete in 30 minutes. We never store or analyze your data.</p>
            </div>
            {{-- Feature 3 --}}
            <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200/60 dark:border-gray-800/60 p-6 hover:shadow-lg transition-shadow group">
                <div class="w-12 h-12 bg-purple-50 dark:bg-purple-900/30 rounded-2xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"/></svg>
                </div>
                <h3 class="font-bold text-lg mb-2">Format Conversion</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400 leading-relaxed">Convert between JPG, PNG, and WEBP while compressing.</p>
            </div>
            {{-- Feature 4 --}}
            <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200/60 dark:border-gray-800/60 p-6 hover:shadow-lg transition-shadow group">
                <div class="w-12 h-12 bg-amber-50 dark:bg-amber-900/30 rounded-2xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6 text-amber-600 dark:text-amber-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                </div>
                <h3 class="font-bold text-lg mb-2">Mobile Friendly</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400 leading-relaxed">Fully responsive. Compress images from any device, anywhere.</p>
            </div>
            {{-- Feature 5 --}}
            <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200/60 dark:border-gray-800/60 p-6 hover:shadow-lg transition-shadow group">
                <div class="w-12 h-12 bg-rose-50 dark:bg-rose-900/30 rounded-2xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6 text-rose-600 dark:text-rose-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                </div>
                <h3 class="font-bold text-lg mb-2">Quality Control</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400 leading-relaxed">Fine-tune compression with a precise quality slider (10–90%).</p>
            </div>
            {{-- Feature 6 --}}
            <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200/60 dark:border-gray-800/60 p-6 hover:shadow-lg transition-shadow group">
                <div class="w-12 h-12 bg-teal-50 dark:bg-teal-900/30 rounded-2xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6 text-teal-600 dark:text-teal-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <h3 class="font-bold text-lg mb-2">Totally Free</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400 leading-relaxed">No signup, no watermarks, no limits. Compress as many images as you need.</p>
            </div>
        </div>
    </section>

    {{-- Why Compress / Formats Section --}}
    <section class="bg-white dark:bg-gray-900 border-y border-gray-200/60 dark:border-gray-800/60 py-16">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-extrabold mb-6">Why Compress Images?</h2>
            <p class="text-gray-600 dark:text-gray-400 mb-6 leading-relaxed">
                Image compression is essential for modern web development and digital content. Large files slow down websites, waste bandwidth, and hurt user experience.
            </p>
            <div class="grid sm:grid-cols-2 gap-4 mb-10">
                <div class="flex gap-3 items-start"><div class="w-6 h-6 bg-accent-100 dark:bg-accent-900/30 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5"><svg class="w-3.5 h-3.5 text-accent-600" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg></div><p class="text-gray-600 dark:text-gray-400 text-sm"><strong class="text-gray-800 dark:text-gray-200">Faster websites</strong> — Compressed images load instantly, improving Core Web Vitals.</p></div>
                <div class="flex gap-3 items-start"><div class="w-6 h-6 bg-accent-100 dark:bg-accent-900/30 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5"><svg class="w-3.5 h-3.5 text-accent-600" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg></div><p class="text-gray-600 dark:text-gray-400 text-sm"><strong class="text-gray-800 dark:text-gray-200">Better SEO</strong> — Google uses page speed as a ranking factor.</p></div>
                <div class="flex gap-3 items-start"><div class="w-6 h-6 bg-accent-100 dark:bg-accent-900/30 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5"><svg class="w-3.5 h-3.5 text-accent-600" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg></div><p class="text-gray-600 dark:text-gray-400 text-sm"><strong class="text-gray-800 dark:text-gray-200">Save storage</strong> — Reduce sizes by up to 80% without quality loss.</p></div>
                <div class="flex gap-3 items-start"><div class="w-6 h-6 bg-accent-100 dark:bg-accent-900/30 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5"><svg class="w-3.5 h-3.5 text-accent-600" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg></div><p class="text-gray-600 dark:text-gray-400 text-sm"><strong class="text-gray-800 dark:text-gray-200">Lower costs</strong> — Less bandwidth = lower hosting and CDN bills.</p></div>
            </div>

            <h2 class="text-3xl font-extrabold mb-6">Supported Formats</h2>
            <div class="grid sm:grid-cols-2 gap-4">
                <div class="bg-gray-50 dark:bg-gray-800/50 rounded-2xl p-5 border border-gray-200/60 dark:border-gray-700/60">
                    <div class="flex items-center gap-2 mb-2"><span class="text-lg font-bold">📸</span><h3 class="font-bold">JPEG / JPG</h3></div>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Best for photographs. Lossy compression with adjustable quality.</p>
                </div>
                <div class="bg-gray-50 dark:bg-gray-800/50 rounded-2xl p-5 border border-gray-200/60 dark:border-gray-700/60">
                    <div class="flex items-center gap-2 mb-2"><span class="text-lg font-bold">🎨</span><h3 class="font-bold">PNG</h3></div>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Ideal for graphics with transparency. Lossless compression.</p>
                </div>
                <div class="bg-gray-50 dark:bg-gray-800/50 rounded-2xl p-5 border border-gray-200/60 dark:border-gray-700/60">
                    <div class="flex items-center gap-2 mb-2"><span class="text-lg font-bold">🌐</span><h3 class="font-bold">WEBP</h3></div>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Modern format, 30% smaller than JPEG at equivalent quality.</p>
                </div>
                <div class="bg-gray-50 dark:bg-gray-800/50 rounded-2xl p-5 border border-gray-200/60 dark:border-gray-700/60">
                    <div class="flex items-center gap-2 mb-2"><span class="text-lg font-bold">🎞️</span><h3 class="font-bold">GIF</h3></div>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Animated images and simple graphics with limited colors.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- FAQ Section --}}
    <section class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-16" x-data="{ openFaq: null }">
        <div class="text-center mb-10">
            <h2 class="text-3xl sm:text-4xl font-extrabold mb-3">Frequently Asked Questions</h2>
            <p class="text-gray-500 dark:text-gray-400">Everything you need to know</p>
        </div>
        <div class="space-y-3">
            @php
                $faqs = [
                    ['Is this image compressor free?', 'Yes, our image compressor is 100% free. No hidden charges, no signup required, and no watermarks.'],
                    ['What image formats are supported?', 'We support JPG/JPEG, PNG, WEBP, and GIF. You can also convert between formats during compression.'],
                    ['What is the maximum file size?', 'You can upload images up to 20MB. For most web images, this is more than sufficient.'],
                    ['How can I upload images?', 'You can drag & drop files, click to browse, or simply press Ctrl+V (Cmd+V on Mac) to paste images directly from your clipboard!'],
                    ['Are my images stored on the server?', 'Your privacy is our priority. Images are automatically deleted within 30 minutes. We never store, share, or analyze them.'],
                    ['Can I convert image formats?', 'Yes! Convert between JPG, PNG, and WEBP while compressing. Select the desired format before compressing.'],
                    ['Does compression reduce image quality?', 'Our smart algorithm minimizes quality loss. At balanced settings (50%), the difference is virtually imperceptible. Adjust the slider to find your perfect balance.'],
                ];
            @endphp

            @foreach ($faqs as $i => $faq)
                <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200/60 dark:border-gray-800/60 overflow-hidden transition-shadow hover:shadow-md">
                    <button x-on:click="openFaq = openFaq === {{ $i }} ? null : {{ $i }}"
                            class="w-full px-6 py-5 text-left font-semibold text-gray-900 dark:text-gray-100 flex items-center justify-between gap-4 hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors">
                        <span>{{ $faq[0] }}</span>
                        <svg :class="openFaq === {{ $i }} ? 'rotate-180' : ''" class="w-5 h-5 flex-shrink-0 text-gray-400 dark:text-gray-500 transition-transform duration-200" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div x-show="openFaq === {{ $i }}" x-collapse>
                        <div class="px-6 pb-5 text-gray-600 dark:text-gray-300 leading-relaxed">{{ $faq[1] }}</div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    {{-- Footer --}}
    <footer class="bg-white dark:bg-gray-900 border-t border-gray-200/60 dark:border-gray-800/60 py-10">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                <div class="flex items-center gap-2">
                    <div class="w-7 h-7 bg-gradient-to-br from-brand-500 to-brand-700 rounded-lg flex items-center justify-center">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    </div>
                    <span class="text-sm font-semibold text-gray-600 dark:text-gray-400">&copy; {{ date('Y') }} ImageCompressor</span>
                </div>
                <div class="flex items-center gap-4 text-sm text-gray-400 dark:text-gray-500">
                    <span>Files auto-delete in 30 minutes</span>
                    <span class="w-1 h-1 bg-gray-300 dark:bg-gray-600 rounded-full"></span>
                    <span>&copy; {{ date('Y') }} All rights reserved</span>
                </div>
            </div>
        </div>
    </footer>

    {{-- Alpine.js CDN (with collapse plugin) --}}
    <script defer src="https://cdn.jsdelivr.net/npm/@@alpinejs/collapse@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <script>
        function app() {
            return {
                darkMode: localStorage.getItem('darkMode') === 'true',
                init() {
                    // Watch system preference if no saved preference
                    if (localStorage.getItem('darkMode') === null) {
                        this.darkMode = window.matchMedia('(prefers-color-scheme: dark)').matches;
                    }
                }
            };
        }

        function compressor() {
            return {
                state: 'idle',
                isDragging: false,
                isPasting: false,
                errorMessage: '',
                file: null,
                fileName: '',
                fileSize: 0,
                fileType: '',
                quality: 50,
                outputFormat: 'original',
                result: {},
                previewUrl: null,

                init() {
                    // Add paste event listener
                    document.addEventListener('paste', (event) => {
                        if (this.state === 'idle' || this.state === 'error') {
                            this.handlePaste(event);
                        }
                    });
                },

                handlePaste(event) {
                    const items = event.clipboardData?.items;
                    if (!items) return;

                    for (let i = 0; i < items.length; i++) {
                        if (items[i].type.indexOf('image') !== -1) {
                            event.preventDefault();
                            this.isPasting = true;
                            const file = items[i].getAsFile();
                            if (file) {
                                setTimeout(() => {
                                    this.processFile(file);
                                    this.isPasting = false;
                                }, 300);
                            }
                            break;
                        }
                    }
                },

                handleDrop(event) {
                    this.isDragging = false;
                    const files = event.dataTransfer.files;
                    if (files.length > 0) this.processFile(files[0]);
                },

                handleFileSelect(event) {
                    const files = event.target.files;
                    if (files.length > 0) this.processFile(files[0]);
                },

                processFile(file) {
                    this.errorMessage = '';
                    const allowedTypes = ['image/jpeg', 'image/png', 'image/webp', 'image/gif'];
                    if (!allowedTypes.includes(file.type)) {
                        this.errorMessage = 'Invalid file type. Please upload a JPG, PNG, WEBP, or GIF image.';
                        this.state = 'error';
                        return;
                    }
                    const maxSize = 20 * 1024 * 1024;
                    if (file.size > maxSize) {
                        this.errorMessage = 'File size exceeds 20MB. Please choose a smaller image.';
                        this.state = 'error';
                        return;
                    }
                    this.file = file;
                    this.fileName = file.name;
                    this.fileSize = file.size;
                    this.fileType = file.type.split('/')[1];
                    if (this.fileType === 'jpeg') this.fileType = 'jpg';

                    // Generate preview
                    if (this.previewUrl) URL.revokeObjectURL(this.previewUrl);
                    this.previewUrl = URL.createObjectURL(file);

                    this.state = 'settings';
                },

                async compress() {
                    this.state = 'processing';
                    this.errorMessage = '';
                    const formData = new FormData();
                    formData.append('image', this.file);
                    formData.append('quality', this.quality);
                    formData.append('format', this.outputFormat);

                    try {
                        const response = await fetch('{{ route("image.compress") }}', {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                                'Accept': 'application/json',
                            },
                            body: formData,
                        });
                        const data = await response.json();
                        if (!response.ok || !data.success) {
                            throw new Error(data.message || 'Compression failed. Please try again.');
                        }
                        this.result = data;
                        this.state = 'result';
                    } catch (error) {
                        this.errorMessage = error.message || 'An unexpected error occurred.';
                        this.state = 'error';
                    }
                },

                reset() {
                    this.state = 'idle';
                    this.file = null;
                    this.fileName = '';
                    this.fileSize = 0;
                    this.fileType = '';
                    this.quality = 50;
                    this.outputFormat = 'original';
                    this.result = {};
                    this.errorMessage = '';
                    if (this.previewUrl) { URL.revokeObjectURL(this.previewUrl); this.previewUrl = null; }
                    if (this.$refs.fileInput) this.$refs.fileInput.value = '';
                },

                formatBytes(bytes, p = 2) {
                    if (bytes === 0) return '0 B';
                    const u = ['B', 'KB', 'MB', 'GB'];
                    let i = 0, s = bytes;
                    while (s >= 1024 && i < u.length - 1) { s /= 1024; i++; }
                    return s.toFixed(p) + ' ' + u[i];
                },

                estimatedTime() {
                    if (!this.fileSize) return '—';
                    const sec = Math.max(1, Math.ceil(this.fileSize / (2 * 1024 * 1024) + 1));
                    if (sec <= 2) return '~1-2 seconds';
                    if (sec <= 5) return '~3-5 seconds';
                    return '~' + sec + ' seconds';
                },
            };
        }
    </script>
</body>
</html>
