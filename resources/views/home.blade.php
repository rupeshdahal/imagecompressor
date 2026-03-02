<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Favicon --}}
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32.png') }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('logo.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('logo.png') }}">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
    <link rel="manifest" href="{{ asset('manifest.json') }}">

    {{-- SEO Meta --}}
    <title>Free Online Image Compressor - Compress JPG, PNG & WebP Images | Reduce File Size up to 90%</title>
    <meta name="description" content="Compress images online for FREE! Reduce JPG, PNG, WebP file sizes by up to 90% without quality loss. Fast, secure, no signup. Convert formats. 20MB max. Start compressing now!">
    <meta name="keywords" content="image compressor, compress image online, reduce image size, JPG compressor, PNG compressor, WEBP compressor, free image optimizer, image converter, reduce file size, compress photo, online image tool, lossy compression, lossless compression">
    <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
    <meta name="author" content="CompresslyPro">
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
    <meta name="apple-mobile-web-app-title" content="CompresslyPro">
    <meta name="theme-color" content="#6366f1">

    {{-- Open Graph --}}
    <meta property="og:type" content="website">
    <meta property="og:title" content="Free Online Image Compressor - Reduce File Size up to 90%">
    <meta property="og:description" content="Compress JPG, PNG, WebP images online for free. Reduce file size by up to 90% without quality loss. No signup required. Fast, secure, and easy to use.">
    <meta property="og:url" content="{{ url('/') }}">
    <meta property="og:site_name" content="CompresslyPro - Free Online Image Compression Tool">
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
    <meta name="twitter:creator" content="@compresslypro">
    <meta name="twitter:site" content="@compresslypro">

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
        "alternateName": "CompresslyPro",
        "description": "Compress JPG, PNG, WebP images online for free. Reduce image file size by up to 90% without losing quality. Fast, secure, no signup required.",
        "url": "https://compresslypro.com",
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
            "name": "CompresslyPro"
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
                "urlTemplate": "https://compresslypro.com",
                "actionPlatform": [
                    "https://schema.org/DesktopWebPlatform",
                    "https://schema.org/MobileWebPlatform"
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
            "item": "https://compresslypro.com"
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
                "image": "https://compresslypro.com/og-image.png"
            },
            {
                "@type": "HowToStep",
                "position": 2,
                "name": "Adjust Settings",
                "text": "Choose output format (JPG, PNG, or WebP) and set quality level (10-90%). Higher quality = larger file.",
                "image": "https://compresslypro.com/og-image.png"
            },
            {
                "@type": "HowToStep",
                "position": 3,
                "name": "Compress",
                "text": "Click 'Compress Image' button and wait 2-5 seconds for processing",
                "image": "https://compresslypro.com/og-image.png"
            },
            {
                "@type": "HowToStep",
                "position": 4,
                "name": "Download",
                "text": "Click 'Download' button to save your compressed image. View statistics showing original vs compressed size.",
                "image": "https://compresslypro.com/og-image.png"
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
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Organization",
        "name": "CompresslyPro",
        "url": "https://compresslypro.com",
        "logo": "https://compresslypro.com/logo.png",
        "description": "Free online image compression and conversion tool. Compress JPG, PNG, WebP, GIF images up to 90% smaller.",
        "sameAs": []
    }
    </script>
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "WebSite",
        "name": "CompresslyPro",
        "url": "https://compresslypro.com",
        "description": "Free online image compressor and converter. Compress JPG, PNG, WebP up to 90% smaller.",
        "potentialAction": {
            "@type": "SearchAction",
            "target": "https://compresslypro.com/?q={search_term_string}",
            "query-input": "required name=search_term_string"
        }
    }
    </script>
    @endverbatim

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
        /* Dark mode range slider thumb - removed */

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

        /* Drop zone pulse */
        .drop-active { border-color: #6366f1 !important; background: rgba(99,102,241,0.04) !important; }

        /* Animated background */
        .hero-bg { background: radial-gradient(ellipse at 20% 50%, rgba(99,102,241,0.08) 0%, transparent 50%), radial-gradient(ellipse at 80% 20%, rgba(139,92,246,0.06) 0%, transparent 50%), radial-gradient(ellipse at 50% 80%, rgba(168,85,247,0.05) 0%, transparent 50%); }
    </style>

    {{-- Google Analytics --}}
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

    {{-- AdSense: only load in production to avoid Lighthouse mixed-content warnings on dev --}}
    @if(app()->isProduction())
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-6697940390340424"
     crossorigin="anonymous"></script>

    {{-- Force all sub-resources to HTTPS (prevents mixed-content Lighthouse warnings) --}}
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">

    {{-- Preconnect / dns-prefetch hints (production only) --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="dns-prefetch" href="https://www.googletagmanager.com">
    <link rel="dns-prefetch" href="https://pagead2.googlesyndication.com">
    @endif
</head>

<body class="bg-gray-50 text-gray-900 font-sans min-h-screen">

    {{-- Navigation --}}
    <nav class="bg-gradient-to-r from-gray-900 via-indigo-950 to-gray-900 border-b border-indigo-800/40 sticky top-0 z-50 shadow-lg">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <a href="/" class="flex items-center gap-2.5 group">
                    <img src="{{ asset('logo.png') }}" alt="CompresslyPro" class="h-10 sm:h-12 w-auto transition-all flex-shrink-0">
                    <div class="flex flex-col leading-tight">
                        <span class="text-white font-bold text-base sm:text-lg tracking-tight group-hover:text-indigo-200 transition-colors">CompresslyPro</span>
                        <span class="text-indigo-300/70 text-[10px] sm:text-xs font-medium hidden sm:block tracking-wide">Free Image Compressor</span>
                    </div>
                </a>
            </div>
        </div>
    </nav>

    {{-- Ad Banner: Top --}}
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
        <div class="bg-gray-100/60 border border-dashed border-gray-300 rounded-xl p-3 text-center text-gray-400 text-xs font-medium tracking-wide uppercase">
            Advertisement
        </div>
    </div>

    {{-- Hero Section --}}
    <header class="hero-bg pt-10 pb-6 sm:pt-14 sm:pb-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="inline-flex items-center gap-2 bg-brand-50 text-brand-700 text-sm font-medium px-4 py-1.5 rounded-full mb-6 animate-slide-down">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                100% Free · No Signup · Compress & Convert
            </div>
            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight leading-tight mb-5">
                Free Online Image
                <span class="gradient-text">Compressor & Converter</span>
            </h1>
            <p class="text-lg sm:text-xl text-gray-500 max-w-2xl mx-auto leading-relaxed">
                Compress JPG, PNG & WebP images up to <strong class="text-gray-700">90% smaller</strong> — or convert between formats instantly. No signup. Privacy-first.
            </p>
        </div>
    </header>

    {{-- ============================================================ --}}
    {{-- TOOL TABS: Compress / Convert / Batch / Resize / PDF        --}}
    {{-- ============================================================ --}}
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 -mt-2 pb-12" x-data="toolTabs()">

        {{-- Tab Switcher --}}
        <div class="flex gap-1 bg-gray-100 rounded-2xl p-1 mb-6 shadow-sm overflow-x-auto">
            <button x-on:click="activeTab = 'compress'"
                :class="activeTab === 'compress'
                    ? 'bg-white text-brand-700 shadow-sm font-bold'
                    : 'text-gray-500 hover:text-gray-700 font-semibold'"
                class="flex-1 flex items-center justify-center gap-1.5 py-2.5 px-3 rounded-xl text-xs sm:text-sm transition-all duration-200 whitespace-nowrap min-w-0">
                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3"/>
                </svg>
                <span class="truncate">Compress</span>
            </button>
            <button x-on:click="activeTab = 'convert'"
                :class="activeTab === 'convert'
                    ? 'bg-white text-purple-700 shadow-sm font-bold'
                    : 'text-gray-500 hover:text-gray-700 font-semibold'"
                class="flex-1 flex items-center justify-center gap-1.5 py-2.5 px-3 rounded-xl text-xs sm:text-sm transition-all duration-200 whitespace-nowrap min-w-0">
                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 21L3 16.5m0 0L7.5 12M3 16.5h13.5m0-13.5L21 7.5m0 0L16.5 12M21 7.5H7.5"/>
                </svg>
                <span class="truncate">Convert</span>
            </button>
            <button x-on:click="activeTab = 'batch'"
                :class="activeTab === 'batch'
                    ? 'bg-white text-blue-700 shadow-sm font-bold'
                    : 'text-gray-500 hover:text-gray-700 font-semibold'"
                class="flex-1 flex items-center justify-center gap-1.5 py-2.5 px-3 rounded-xl text-xs sm:text-sm transition-all duration-200 whitespace-nowrap min-w-0">
                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 9.776c.112-.017.227-.026.344-.026h15.812c.117 0 .232.009.344.026m-16.5 0a2.25 2.25 0 00-1.883 2.542l.857 6a2.25 2.25 0 002.227 1.932H19.05a2.25 2.25 0 002.227-1.932l.857-6a2.25 2.25 0 00-1.883-2.542m-16.5 0V6A2.25 2.25 0 016 3.75h3.879a1.5 1.5 0 011.06.44l2.122 2.12a1.5 1.5 0 001.06.44H18A2.25 2.25 0 0120.25 9v.776"/>
                </svg>
                <span class="truncate">Batch</span>
            </button>
            <button x-on:click="activeTab = 'resize'"
                :class="activeTab === 'resize'
                    ? 'bg-white text-orange-700 shadow-sm font-bold'
                    : 'text-gray-500 hover:text-gray-700 font-semibold'"
                class="flex-1 flex items-center justify-center gap-1.5 py-2.5 px-3 rounded-xl text-xs sm:text-sm transition-all duration-200 whitespace-nowrap min-w-0">
                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3.75v4.5m0-4.5h4.5m-4.5 0L9 9M3.75 20.25v-4.5m0 4.5h4.5m-4.5 0L9 15M20.25 3.75h-4.5m4.5 0v4.5m0-4.5L15 9m5.25 11.25h-4.5m4.5 0v-4.5m0 4.5L15 15"/>
                </svg>
                <span class="truncate">Resize</span>
            </button>
            <button x-on:click="activeTab = 'tools'"
                :class="activeTab === 'tools'
                    ? 'bg-white text-teal-700 shadow-sm font-bold'
                    : 'text-gray-500 hover:text-gray-700 font-semibold'"
                class="flex-1 flex items-center justify-center gap-1.5 py-2.5 px-3 rounded-xl text-xs sm:text-sm transition-all duration-200 whitespace-nowrap min-w-0">
                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M11.42 15.17L17.25 21A2.652 2.652 0 0021 17.25l-5.877-5.877M11.42 15.17l2.496-3.03c.317-.384.74-.626 1.208-.766M11.42 15.17l-4.655 5.653a2.548 2.548 0 11-3.586-3.586l6.837-5.63m5.108-.233c.55-.164 1.163-.188 1.743-.14a4.5 4.5 0 004.486-6.336l-3.276 3.277a3.004 3.004 0 01-2.25-2.25l3.276-3.276a4.5 4.5 0 00-6.336 4.486c.091 1.076-.071 2.264-.904 2.95l-.102.085m-1.745 1.437L5.909 7.5H4.5L2.25 3.75l1.5-1.5L7.5 4.5v1.409l4.26 4.26m-1.745 1.437l1.745-1.437m6.615 8.206L15.75 15.75M4.867 19.125h.008v.008h-.008v-.008z"/>
                </svg>
                <span class="truncate">More Tools</span>
            </button>
        </div>

        {{-- ======================== COMPRESS TAB ======================== --}}
        <div x-show="activeTab === 'compress'" x-transition.opacity.duration.200ms
             x-data="compressor()" x-init="initComp()" itemscope itemtype="https://schema.org/SoftwareApplication">

            {{-- IDLE / ERROR --}}
            <div x-show="state === 'idle' || state === 'error'" class="animate-slide-up">
                <div id="dropZone"
                     x-on:dragover.prevent="isDragging = true"
                     x-on:dragleave.prevent="isDragging = false"
                     x-on:drop.prevent="handleDrop($event)"
                     x-on:click="$refs.fileInputC.click()"
                     :class="{ 'drop-active ring-2 ring-brand-400': isDragging, 'ring-2 ring-green-400': isPasting }"
                     class="relative bg-white border-2 border-dashed border-gray-300 rounded-3xl p-10 sm:p-14 text-center cursor-pointer transition-all duration-300 group shadow-sm hover:shadow-lg hover:border-brand-400">
                    <input type="file" x-ref="fileInputC" x-on:change="handleFileSelect($event)" accept=".jpg,.jpeg,.png,.webp,.gif" class="hidden">
                    <div class="relative mx-auto w-20 h-20 sm:w-24 sm:h-24 mb-6">
                        <div class="absolute inset-0 bg-brand-100 rounded-3xl rotate-6 group-hover:rotate-12 transition-transform duration-300"></div>
                        <div class="relative bg-gradient-to-br from-brand-500 to-brand-700 rounded-3xl w-full h-full flex items-center justify-center shadow-xl shadow-brand-500/25">
                            <svg class="w-10 h-10 sm:w-12 sm:h-12 text-white" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5"/></svg>
                        </div>
                    </div>
                    <h2 class="text-xl sm:text-2xl font-bold mb-2">Drop your image here</h2>
                    <p class="text-gray-500 mb-5">or <span class="text-brand-600 font-semibold underline decoration-brand-300 underline-offset-2">browse files</span> from your device</p>
                    <div class="mb-5 flex items-center justify-center gap-2 text-sm text-gray-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        <span>or press <kbd class="px-2 py-0.5 text-xs bg-gray-100 border border-gray-300 rounded">Ctrl+V</kbd> to paste</span>
                    </div>
                    <div class="flex flex-wrap justify-center gap-2">
                        <span class="inline-flex items-center gap-1 bg-gray-100 text-gray-500 text-xs font-semibold px-3 py-1.5 rounded-full">JPG</span>
                        <span class="inline-flex items-center gap-1 bg-gray-100 text-gray-500 text-xs font-semibold px-3 py-1.5 rounded-full">PNG</span>
                        <span class="inline-flex items-center gap-1 bg-gray-100 text-gray-500 text-xs font-semibold px-3 py-1.5 rounded-full">WEBP</span>
                        <span class="inline-flex items-center gap-1 bg-gray-100 text-gray-500 text-xs font-semibold px-3 py-1.5 rounded-full">GIF</span>
                        <span class="inline-flex items-center gap-1 bg-brand-50 text-brand-600 text-xs font-semibold px-3 py-1.5 rounded-full">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                            Max 20MB
                        </span>
                    </div>
                </div>
                <div x-show="errorMessage" x-transition.duration.300ms class="mt-4 bg-red-50 border border-red-200 rounded-2xl p-4 flex items-start gap-3">
                    <div class="w-8 h-8 bg-red-100 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                        <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div>
                        <p class="text-red-700 text-sm font-medium" x-text="errorMessage"></p>
                        <button x-on:click="errorMessage = ''" class="text-red-400 text-xs mt-1 hover:text-red-600 transition-colors">Dismiss</button>
                    </div>
                </div>
            </div>

            {{-- SETTINGS --}}
            <div x-show="state === 'settings'" x-transition class="animate-slide-up">
                <div class="bg-white rounded-3xl shadow-xl shadow-gray-200/50 border border-gray-200/60 overflow-hidden">
                    <div class="px-6 sm:px-8 pt-6 sm:pt-8 pb-5 border-b border-gray-100 flex items-center gap-4">
                        <div class="w-14 h-14 bg-gradient-to-br from-brand-100 to-brand-50 rounded-2xl flex items-center justify-center flex-shrink-0">
                            <svg class="w-7 h-7 text-brand-600" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909M3.75 21h16.5A2.25 2.25 0 0022.5 18.75V5.25A2.25 2.25 0 0020.25 3H3.75A2.25 2.25 0 001.5 5.25v13.5A2.25 2.25 0 003.75 21z"/></svg>
                        </div>
                        <div class="min-w-0 flex-1">
                            <p class="font-bold text-base truncate" x-text="fileName"></p>
                            <p class="text-sm text-gray-500 flex items-center gap-2">
                                <span x-text="formatBytes(fileSize)"></span>
                                <span class="w-1 h-1 bg-gray-300 rounded-full"></span>
                                <span x-text="fileType.toUpperCase()"></span>
                            </p>
                        </div>
                        <button x-on:click="reset()" class="p-2 rounded-xl text-gray-400 hover:text-red-500 hover:bg-red-50 transition-all" title="Remove file">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                        </button>
                    </div>
                    <div class="px-6 sm:px-8 py-6 sm:py-8 space-y-7">
                        <div x-show="previewUrl" class="rounded-2xl overflow-hidden bg-gray-100 max-h-64 flex items-center justify-center">
                            <img :src="previewUrl" alt="Preview" class="max-h-64 object-contain w-full" loading="lazy">
                        </div>
                        {{-- Quality Slider --}}
                        <div>
                            <div class="flex items-center justify-between mb-3">
                                <label class="text-sm font-semibold text-gray-700">Compression Quality</label>
                                <span class="text-sm font-bold bg-brand-100 text-brand-700 px-3 py-1 rounded-full" x-text="quality + '%'"></span>
                            </div>
                            <input type="range" min="10" max="90" step="1" x-model.number="quality"
                                   class="w-full" :style="'background: linear-gradient(to right, #6366f1 ' + ((quality-10)/80*100) + '%, #e5e7eb ' + ((quality-10)/80*100) + '%)'">
                            <div class="flex justify-between mt-2 text-xs text-gray-400 font-medium">
                                <span>🗜️ Smaller file</span>
                                <span>🖼️ Higher quality</span>
                            </div>
                            <div class="flex gap-2 mt-4">
                                <button x-on:click="quality = 20" :class="quality >= 10 && quality <= 30 ? 'bg-brand-100 text-brand-700 border-brand-200 ring-1 ring-brand-200' : 'bg-gray-50 text-gray-600 border-gray-200 hover:border-brand-300'" class="flex-1 px-3 py-2.5 rounded-xl border text-xs font-semibold transition-all text-center">Max Compression</button>
                                <button x-on:click="quality = 50" :class="quality >= 31 && quality <= 65 ? 'bg-brand-100 text-brand-700 border-brand-200 ring-1 ring-brand-200' : 'bg-gray-50 text-gray-600 border-gray-200 hover:border-brand-300'" class="flex-1 px-3 py-2.5 rounded-xl border text-xs font-semibold transition-all text-center">Balanced</button>
                                <button x-on:click="quality = 80" :class="quality >= 66 && quality <= 90 ? 'bg-brand-100 text-brand-700 border-brand-200 ring-1 ring-brand-200' : 'bg-gray-50 text-gray-600 border-gray-200 hover:border-brand-300'" class="flex-1 px-3 py-2.5 rounded-xl border text-xs font-semibold transition-all text-center">High Quality</button>
                            </div>
                        </div>
                        <div class="flex items-center gap-2 text-sm text-gray-400 bg-gray-50 rounded-xl px-4 py-3">
                            <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            <span>Estimated time: <strong class="text-gray-600" x-text="estimatedTime()"></strong></span>
                        </div>
                        <button x-on:click="compress()"
                            class="w-full bg-gradient-to-r from-brand-600 to-brand-700 hover:from-brand-700 hover:to-brand-800 text-white font-bold py-4 px-6 rounded-2xl transition-all duration-200 flex items-center justify-center gap-2.5 text-lg shadow-xl shadow-brand-500/25 hover:scale-[1.02] active:scale-[0.98]">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3"/></svg>
                            Compress Image
                        </button>
                    </div>
                </div>
            </div>

            {{-- PROCESSING --}}
            <div x-show="state === 'processing'" x-transition class="animate-slide-up">
                <div class="bg-white rounded-3xl shadow-xl shadow-gray-200/50 border border-gray-200/60 p-10 sm:p-14 text-center">
                    <div class="relative w-20 h-20 mx-auto mb-6">
                        <div class="absolute inset-0 rounded-full bg-brand-100 animate-ping opacity-40"></div>
                        <div class="relative w-full h-full rounded-full bg-brand-50 flex items-center justify-center">
                            <svg class="animate-spin w-10 h-10 text-brand-600" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-20" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="3"/>
                                <path class="opacity-80" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"/>
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-2xl font-bold mb-2">Compressing your image...</h3>
                    <p class="text-gray-500 mb-4" x-text="uploadProgress > 0 && uploadProgress < 100 ? 'Uploading... ' + uploadProgress + '%' : 'Processing…'"></p>
                    <div class="w-full bg-gray-200 rounded-full h-2 overflow-hidden max-w-xs mx-auto">
                        <div class="bg-gradient-to-r from-brand-500 to-brand-600 h-2 rounded-full transition-all duration-300"
                             :class="uploadProgress === 0 || uploadProgress === 100 ? 'shimmer' : ''"
                             :style="'width:' + (uploadProgress > 0 ? uploadProgress : 33) + '%'"></div>
                    </div>
                </div>
            </div>

            {{-- RESULT --}}
            <div x-show="state === 'result'" x-transition class="animate-slide-up space-y-5">
                {{-- Stats row --}}
                <div class="grid grid-cols-3 gap-3">
                    <div class="bg-white rounded-2xl border border-gray-200/60 p-4 sm:p-5 text-center shadow-sm">
                        <div class="w-9 h-9 bg-gray-100 rounded-xl flex items-center justify-center mx-auto mb-2">
                            <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"/></svg>
                        </div>
                        <p class="text-xs text-gray-400 font-medium mb-0.5">Original</p>
                        <p class="text-base sm:text-lg font-bold text-gray-700" x-text="result.formatted_original"></p>
                    </div>
                    <div class="bg-white rounded-2xl border border-gray-200/60 p-4 sm:p-5 text-center shadow-sm">
                        <div class="w-9 h-9 bg-accent-50 rounded-xl flex items-center justify-center mx-auto mb-2">
                            <svg class="w-4 h-4 text-accent-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <p class="text-xs text-gray-400 font-medium mb-0.5">Compressed</p>
                        <p class="text-base sm:text-lg font-bold text-accent-600" x-text="result.formatted_compressed"></p>
                    </div>
                    <div class="bg-white rounded-2xl border border-gray-200/60 p-4 sm:p-5 text-center shadow-sm">
                        <div class="w-9 h-9 rounded-xl flex items-center justify-center mx-auto mb-2" :class="result.reduction > 0 ? 'bg-green-50' : 'bg-red-50'">
                            <svg class="w-4 h-4" :class="result.reduction > 0 ? 'text-green-600' : 'text-red-500'" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
                        </div>
                        <p class="text-xs text-gray-400 font-medium mb-0.5">Saved</p>
                        <p class="text-base sm:text-lg font-bold" :class="result.reduction > 0 ? 'text-green-600' : 'text-red-500'" x-text="result.reduction + '%'"></p>
                    </div>
                </div>

                {{-- ── Before / After Slider ────────────────────────────── --}}
                <div x-show="previewUrl && result.download_url"
                     x-data="{ sliderPos: 50, dragging: false }"
                     class="relative rounded-2xl overflow-hidden bg-gray-200 select-none touch-none"
                     style="height:260px;"
                     x-on:mousedown="dragging = true"
                     x-on:mouseup.window="dragging = false"
                     x-on:mousemove="if(dragging){ let r=$el.getBoundingClientRect(); sliderPos = Math.min(Math.max((($event.clientX - r.left)/r.width)*100, 2), 98) }"
                     x-on:touchmove.prevent="let r=$el.getBoundingClientRect(); sliderPos = Math.min(Math.max((($event.touches[0].clientX - r.left)/r.width)*100, 2), 98)">

                    {{-- Original image (full width, behind) --}}
                    <img :src="previewUrl"
                         class="absolute inset-0 w-full h-full object-contain pointer-events-none"
                         alt="Original image">

                    {{-- Compressed image (clipped to left side) --}}
                    <div class="absolute inset-0 overflow-hidden pointer-events-none"
                         :style="'width:' + sliderPos + '%'">
                        <img :src="result.download_url + '?t=' + Date.now()"
                             class="absolute inset-0 w-full h-full object-contain"
                             alt="Compressed image"
                             x-ref="compressedImg"
                             :style="'min-width:' + (100 / (sliderPos/100)) + '%'"
                             style="object-position: left center;">
                    </div>

                    {{-- Divider line --}}
                    <div class="absolute top-0 bottom-0 w-px bg-white shadow-[0_0_6px_rgba(0,0,0,0.4)] z-10 pointer-events-none"
                         :style="'left:' + sliderPos + '%'"></div>

                    {{-- Drag handle --}}
                    <div class="absolute top-1/2 -translate-y-1/2 -translate-x-1/2 z-20 cursor-ew-resize"
                         :style="'left:' + sliderPos + '%'"
                         x-on:mousedown.stop="dragging = true">
                        <div class="w-9 h-9 bg-white rounded-full shadow-xl flex items-center justify-center border-2 border-white/80">
                            <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8 9l-3 3 3 3M16 9l3 3-3 3"/>
                            </svg>
                        </div>
                    </div>

                    {{-- Labels --}}
                    <span class="absolute bottom-2 right-3 bg-black/50 text-white text-[10px] font-bold px-2 py-0.5 rounded pointer-events-none"
                          x-show="sliderPos < 90">Original</span>
                    <span class="absolute bottom-2 left-3 bg-brand-600/80 text-white text-[10px] font-bold px-2 py-0.5 rounded pointer-events-none"
                          x-show="sliderPos > 10">Compressed</span>

                    {{-- Instruction hint --}}
                    <div class="absolute top-2 left-1/2 -translate-x-1/2 bg-black/40 text-white text-[10px] font-medium px-3 py-1 rounded-full pointer-events-none whitespace-nowrap"
                         x-show="sliderPos === 50">
                        ← Drag to compare →
                    </div>
                </div>

                {{-- ── Main result card ─────────────────────────────────── --}}
                <div class="bg-white rounded-3xl shadow-xl shadow-gray-200/50 border border-gray-200/60 p-6 sm:p-8">
                    <div class="mb-6">
                        <div class="flex justify-between text-xs font-medium text-gray-400 mb-2">
                            <span>File size reduction</span>
                            <span x-text="result.reduction + '% smaller'"></span>
                        </div>
                        <div class="w-full bg-gray-100 rounded-full h-3 overflow-hidden">
                            <div class="h-3 rounded-full bg-gradient-to-r from-accent-400 to-accent-600 transition-all duration-1000 ease-out" :style="'width:' + Math.min(Math.max(result.reduction, 2), 100) + '%'"></div>
                        </div>
                    </div>

                    {{-- Action buttons --}}
                    <div class="flex flex-col sm:flex-row gap-3 mb-6">
                        <a :href="result.download_url" download
                           class="flex-1 bg-gradient-to-r from-accent-600 to-accent-700 hover:from-accent-700 hover:to-accent-800 text-white font-bold py-4 px-6 rounded-2xl transition-all duration-200 flex items-center justify-center gap-2.5 text-base shadow-xl shadow-accent-500/25 hover:scale-[1.02] active:scale-[0.98]">
                            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            Download
                        </a>

                        {{-- Copy to Clipboard --}}
                        <button x-on:click="copyToClipboard()"
                                :disabled="copying"
                                :class="copied ? 'bg-green-100 text-green-700 border-green-200' : 'bg-gray-100 hover:bg-gray-200 text-gray-700'"
                                class="sm:w-auto px-5 py-4 rounded-2xl border border-transparent font-bold transition-all duration-200 flex items-center justify-center gap-2 text-sm active:scale-[0.97]"
                                title="Copy compressed image to clipboard">
                            <svg x-show="!copied" class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                            <svg x-show="copied" class="w-5 h-5 flex-shrink-0 text-green-600" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                            <span x-text="copied ? 'Copied!' : (copying ? '…' : 'Copy')"></span>
                        </button>

                        <button x-on:click="reset()" class="bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold py-4 px-5 rounded-2xl transition-all duration-200 flex items-center justify-center gap-2 text-sm">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                            New
                        </button>
                    </div>

                    {{-- Clipboard unsupported notice --}}
                    <div x-show="clipboardError" x-transition.duration.300ms
                         class="mb-4 bg-amber-50 border border-amber-200 rounded-xl px-4 py-2.5 text-xs text-amber-700 flex items-center gap-2">
                        <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <span>Clipboard API not supported in this browser. Please use the Download button instead.</span>
                    </div>

                    <div class="grid grid-cols-2 gap-x-6 gap-y-2 text-sm pt-5 border-t border-gray-100">
                        <div class="flex justify-between"><span class="text-gray-400">Format</span><strong class="text-gray-900" x-text="result.format"></strong></div>
                        <div class="flex justify-between"><span class="text-gray-400">Dimensions</span><strong class="text-gray-900" x-text="(result.width || '—') + ' × ' + (result.height || '—')"></strong></div>
                        <div class="flex justify-between"><span class="text-gray-400">Quality</span><strong class="text-gray-900" x-text="quality + '%'"></strong></div>
                        <div class="flex justify-between"><span class="text-gray-400">File</span><strong class="truncate max-w-[120px] block text-right text-gray-900" x-text="result.original_name"></strong></div>
                    </div>
                </div>
                <div class="bg-gray-100/60 border border-dashed border-gray-300 rounded-xl p-3 text-center text-gray-400 text-xs font-medium tracking-wide uppercase">Advertisement</div>
            </div>
        </div>{{-- end compress tab --}}

        {{-- ======================== CONVERT TAB ======================== --}}
        <div x-show="activeTab === 'convert'" x-transition.opacity.duration.200ms
             x-data="converter()" x-init="initConv()">

            {{-- IDLE / ERROR --}}
            <div x-show="cstate === 'idle' || cstate === 'error'" class="animate-slide-up">
                <div x-on:dragover.prevent="cisDragging = true"
                     x-on:dragleave.prevent="cisDragging = false"
                     x-on:drop.prevent="cHandleDrop($event)"
                     x-on:click="$refs.fileInputV.click()"
                     :class="{ 'drop-active ring-2 ring-purple-400': cisDragging }"
                     class="relative bg-white border-2 border-dashed border-gray-300 rounded-3xl p-10 sm:p-14 text-center cursor-pointer transition-all duration-300 group shadow-sm hover:shadow-lg hover:border-purple-400">
                    <input type="file" x-ref="fileInputV" x-on:change="cHandleFileSelect($event)" accept=".jpg,.jpeg,.png,.webp,.gif" class="hidden">
                    <div class="relative mx-auto w-20 h-20 sm:w-24 sm:h-24 mb-6">
                        <div class="absolute inset-0 bg-purple-100 rounded-3xl rotate-6 group-hover:rotate-12 transition-transform duration-300"></div>
                        <div class="relative bg-gradient-to-br from-purple-500 to-purple-700 rounded-3xl w-full h-full flex items-center justify-center shadow-xl shadow-purple-500/25">
                            <svg class="w-10 h-10 sm:w-12 sm:h-12 text-white" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 21L3 16.5m0 0L7.5 12M3 16.5h13.5m0-13.5L21 7.5m0 0L16.5 12M21 7.5H7.5"/>
                            </svg>
                        </div>
                    </div>
                    <h2 class="text-xl sm:text-2xl font-bold mb-2">Drop your image to convert</h2>
                    <p class="text-gray-500 mb-5">or <span class="text-purple-600 font-semibold underline decoration-purple-300 underline-offset-2">browse files</span> from your device</p>
                    <div class="mb-5 flex items-center justify-center gap-2 text-sm text-gray-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        <span>or press <kbd class="px-2 py-0.5 text-xs bg-gray-100 border border-gray-300 rounded">Ctrl+V</kbd> to paste</span>
                    </div>
                    <div class="flex flex-wrap justify-center gap-2">
                        <span class="inline-flex items-center gap-1 bg-gray-100 text-gray-500 text-xs font-semibold px-3 py-1.5 rounded-full">JPG</span>
                        <span class="inline-flex items-center gap-1 bg-gray-100 text-gray-500 text-xs font-semibold px-3 py-1.5 rounded-full">PNG</span>
                        <span class="inline-flex items-center gap-1 bg-gray-100 text-gray-500 text-xs font-semibold px-3 py-1.5 rounded-full">WEBP</span>
                        <span class="inline-flex items-center gap-1 bg-gray-100 text-gray-500 text-xs font-semibold px-3 py-1.5 rounded-full">GIF</span>
                        <span class="inline-flex items-center gap-1 bg-purple-50 text-purple-600 text-xs font-semibold px-3 py-1.5 rounded-full">Max 20MB</span>
                    </div>
                </div>
                <div x-show="cerrorMessage" x-transition.duration.300ms class="mt-4 bg-red-50 border border-red-200 rounded-2xl p-4 flex items-start gap-3">
                    <div class="w-8 h-8 bg-red-100 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                        <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div>
                        <p class="text-red-700 text-sm font-medium" x-text="cerrorMessage"></p>
                        <button x-on:click="cerrorMessage = ''" class="text-red-400 text-xs mt-1 hover:text-red-600 transition-colors">Dismiss</button>
                    </div>
                </div>
            </div>

            {{-- SETTINGS --}}
            <div x-show="cstate === 'settings'" x-transition class="animate-slide-up">
                <div class="bg-white rounded-3xl shadow-xl shadow-gray-200/50 border border-gray-200/60 overflow-hidden">
                    <div class="px-6 sm:px-8 pt-6 sm:pt-8 pb-5 border-b border-gray-100 flex items-center gap-4">
                        <div class="w-14 h-14 bg-gradient-to-br from-purple-100 to-purple-50 rounded-2xl flex items-center justify-center flex-shrink-0">
                            <svg class="w-7 h-7 text-purple-600" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909M3.75 21h16.5A2.25 2.25 0 0022.5 18.75V5.25A2.25 2.25 0 0020.25 3H3.75A2.25 2.25 0 001.5 5.25v13.5A2.25 2.25 0 003.75 21z"/></svg>
                        </div>
                        <div class="min-w-0 flex-1">
                            <p class="font-bold text-base truncate" x-text="cfileName"></p>
                            <p class="text-sm text-gray-500 flex items-center gap-2">
                                <span x-text="cformatBytes(cfileSize)"></span>
                                <span class="w-1 h-1 bg-gray-300 rounded-full"></span>
                                <span x-text="cfileType.toUpperCase()"></span>
                            </p>
                        </div>
                        <button x-on:click="creset()" class="p-2 rounded-xl text-gray-400 hover:text-red-500 hover:bg-red-50 transition-all" title="Remove file">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                        </button>
                    </div>
                    <div class="px-6 sm:px-8 py-6 sm:py-8 space-y-7">
                        <div x-show="cpreviewUrl" class="rounded-2xl overflow-hidden bg-gray-100 max-h-64 flex items-center justify-center">
                            <img :src="cpreviewUrl" alt="Preview" class="max-h-64 object-contain w-full" loading="lazy">
                        </div>

                        {{-- Format Picker with arrow --}}
                        <div>
                            <label class="text-sm font-semibold text-gray-700 mb-4 block">Convert To Format</label>

                            {{-- From / To visual --}}
                            <div class="flex items-center gap-3 mb-5 bg-gray-50 rounded-2xl p-4 border border-gray-200">
                                <div class="flex-1 text-center">
                                    <p class="text-xs text-gray-400 font-medium mb-1">From</p>
                                    <span class="inline-block bg-gray-200 text-gray-700 font-bold text-sm px-4 py-2 rounded-xl uppercase" x-text="cfileType || '?'"></span>
                                </div>
                                <div class="flex-shrink-0">
                                    <svg class="w-7 h-7 text-purple-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 21L3 16.5m0 0L7.5 12M3 16.5h13.5m0-13.5L21 7.5m0 0L16.5 12M21 7.5H7.5"/>
                                    </svg>
                                </div>
                                <div class="flex-1 text-center">
                                    <p class="text-xs text-gray-400 font-medium mb-1">To</p>
                                    <span class="inline-block bg-purple-600 text-white font-bold text-sm px-4 py-2 rounded-xl uppercase" x-text="ctargetFormat || 'Select'"></span>
                                </div>
                            </div>

                            {{-- Format buttons --}}
                            <div class="grid grid-cols-3 gap-3">
                                <template x-for="fmt in ['jpg', 'png', 'webp']" :key="fmt">
                                    <button x-on:click="ctargetFormat = fmt"
                                        :class="ctargetFormat === fmt
                                            ? 'bg-purple-600 text-white border-purple-600 shadow-lg shadow-purple-500/25 scale-105'
                                            : 'bg-white text-gray-600 border-gray-200 hover:border-purple-300'"
                                        class="px-4 py-4 rounded-2xl border text-sm font-bold transition-all duration-150 text-center">
                                        <div class="text-lg mb-1" x-text="fmt === 'jpg' ? '📸' : fmt === 'png' ? '🎨' : '🌐'"></div>
                                        <div x-text="fmt.toUpperCase()"></div>
                                        <div class="text-xs mt-0.5 opacity-70" x-text="fmt === 'jpg' ? 'Smallest size' : fmt === 'png' ? 'Lossless' : 'Modern web'"></div>
                                    </button>
                                </template>
                            </div>
                        </div>

                        {{-- Info note --}}
                        <div class="flex items-start gap-3 bg-purple-50 border border-purple-100 rounded-xl px-4 py-3 text-sm text-purple-700">
                            <svg class="w-4 h-4 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            <span>Images are converted at high quality (90%). Use the <strong>Compress</strong> tab to reduce file size.</span>
                        </div>

                        <button x-on:click="cconvert()" :disabled="!ctargetFormat"
                            :class="ctargetFormat ? 'opacity-100 hover:scale-[1.02] active:scale-[0.98]' : 'opacity-50 cursor-not-allowed'"
                            class="w-full bg-gradient-to-r from-purple-600 to-purple-700 hover:from-purple-700 hover:to-purple-800 text-white font-bold py-4 px-6 rounded-2xl transition-all duration-200 flex items-center justify-center gap-2.5 text-lg shadow-xl shadow-purple-500/25">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M7.5 21L3 16.5m0 0L7.5 12M3 16.5h13.5m0-13.5L21 7.5m0 0L16.5 12M21 7.5H7.5"/></svg>
                            Convert to <span class="uppercase ml-1" x-text="ctargetFormat || '...'"></span>
                        </button>
                    </div>
                </div>
            </div>

            {{-- PROCESSING --}}
            <div x-show="cstate === 'processing'" x-transition class="animate-slide-up">
                <div class="bg-white rounded-3xl shadow-xl shadow-gray-200/50 border border-gray-200/60 p-10 sm:p-14 text-center">
                    <div class="relative w-20 h-20 mx-auto mb-6">
                        <div class="absolute inset-0 rounded-full bg-purple-100 animate-ping opacity-40"></div>
                        <div class="relative w-full h-full rounded-full bg-purple-50 flex items-center justify-center">
                            <svg class="animate-spin w-10 h-10 text-purple-600" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-20" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="3"/>
                                <path class="opacity-80" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"/>
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-2xl font-bold mb-2">Converting your image...</h3>
                    <p class="text-gray-500 mb-4" x-text="cuploadProgress > 0 && cuploadProgress < 100 ? 'Uploading... ' + cuploadProgress + '%' : 'Processing…'"></p>
                    <div class="w-full bg-gray-200 rounded-full h-2 overflow-hidden max-w-xs mx-auto">
                        <div class="bg-gradient-to-r from-purple-500 to-purple-600 h-2 rounded-full transition-all duration-300"
                             :class="cuploadProgress === 0 || cuploadProgress === 100 ? 'shimmer' : ''"
                             :style="'width:' + (cuploadProgress > 0 ? cuploadProgress : 33) + '%'"></div>
                    </div>
                </div>
            </div>

            {{-- RESULT --}}
            <div x-show="cstate === 'result'" x-transition class="animate-slide-up space-y-5">
                <div class="grid grid-cols-3 gap-3">
                    <div class="bg-white rounded-2xl border border-gray-200/60 p-4 sm:p-5 text-center shadow-sm">
                        <div class="w-9 h-9 bg-gray-100 rounded-xl flex items-center justify-center mx-auto mb-2">
                            <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"/></svg>
                        </div>
                        <p class="text-xs text-gray-400 font-medium mb-0.5">Original</p>
                        <p class="text-base sm:text-lg font-bold text-gray-700" x-text="cresult.formatted_original"></p>
                    </div>
                    <div class="bg-white rounded-2xl border border-gray-200/60 p-4 sm:p-5 text-center shadow-sm">
                        <div class="w-9 h-9 bg-purple-50 rounded-xl flex items-center justify-center mx-auto mb-2">
                            <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <p class="text-xs text-gray-400 font-medium mb-0.5">Converted</p>
                        <p class="text-base sm:text-lg font-bold text-purple-600" x-text="cresult.formatted_converted"></p>
                    </div>
                    <div class="bg-white rounded-2xl border border-gray-200/60 p-4 sm:p-5 text-center shadow-sm">
                        <div class="w-9 h-9 bg-purple-50 rounded-xl flex items-center justify-center mx-auto mb-2">
                            <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M7.5 21L3 16.5m0 0L7.5 12M3 16.5h13.5m0-13.5L21 7.5"/></svg>
                        </div>
                        <p class="text-xs text-gray-400 font-medium mb-0.5">Format</p>
                        <p class="text-base sm:text-lg font-bold text-purple-600 uppercase" x-text="cresult.format"></p>
                    </div>
                </div>
                <div class="bg-white rounded-3xl shadow-xl shadow-gray-200/50 border border-gray-200/60 p-6 sm:p-8">
                    <div class="flex flex-col sm:flex-row gap-3 mb-6">
                        <a :href="cresult.download_url" download
                           class="flex-1 bg-gradient-to-r from-purple-600 to-purple-700 hover:from-purple-700 hover:to-purple-800 text-white font-bold py-4 px-6 rounded-2xl transition-all duration-200 flex items-center justify-center gap-2.5 text-lg shadow-xl shadow-purple-500/25 hover:scale-[1.02] active:scale-[0.98]">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            Download Converted
                        </a>
                        <button x-on:click="creset()" class="bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold py-4 px-6 rounded-2xl transition-all duration-200 flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                            New Image
                        </button>
                    </div>
                    <div class="grid grid-cols-2 gap-x-6 gap-y-2 text-sm pt-5 border-t border-gray-100">
                        <div class="flex justify-between"><span class="text-gray-400">Output Format</span><strong class="text-gray-900 uppercase" x-text="cresult.format"></strong></div>
                        <div class="flex justify-between"><span class="text-gray-400">Dimensions</span><strong class="text-gray-900" x-text="(cresult.width || '—') + ' × ' + (cresult.height || '—')"></strong></div>
                        <div class="flex justify-between"><span class="text-gray-400">Original Size</span><strong class="text-gray-900" x-text="cresult.formatted_original"></strong></div>
                        <div class="flex justify-between"><span class="text-gray-400">File</span><strong class="truncate max-w-[120px] block text-right text-gray-900" x-text="cresult.original_name"></strong></div>
                    </div>
                </div>
                <div class="bg-gray-100/60 border border-dashed border-gray-300 rounded-xl p-3 text-center text-gray-400 text-xs font-medium tracking-wide uppercase">Advertisement</div>
            </div>
        </div>{{-- end convert tab --}}

        {{-- ======================== BATCH TAB ======================== --}}
        <div x-show="activeTab === 'batch'" x-transition.opacity.duration.200ms
             x-data="batchCompressor()" x-init="initBatch()">

            {{-- IDLE --}}
            <div x-show="bstate === 'idle' || bstate === 'error'" class="animate-slide-up">
                <div x-on:dragover.prevent="bisDragging = true"
                     x-on:dragleave.prevent="bisDragging = false"
                     x-on:drop.prevent="bHandleDrop($event)"
                     x-on:click="$refs.batchFileInput.click()"
                     :class="{ 'drop-active ring-2 ring-blue-400': bisDragging }"
                     class="relative bg-white border-2 border-dashed border-gray-300 rounded-3xl p-10 sm:p-14 text-center cursor-pointer transition-all duration-300 group shadow-sm hover:shadow-lg hover:border-blue-400">
                    <input type="file" x-ref="batchFileInput" multiple accept=".jpg,.jpeg,.png,.webp,.gif" x-on:change="bHandleFileSelect($event)" class="hidden">
                    <div class="relative mx-auto w-20 h-20 sm:w-24 sm:h-24 mb-6">
                        <div class="absolute inset-0 bg-blue-100 rounded-3xl rotate-6 group-hover:rotate-12 transition-transform duration-300"></div>
                        <div class="relative bg-gradient-to-br from-blue-500 to-blue-700 rounded-3xl w-full h-full flex items-center justify-center shadow-xl shadow-blue-500/25">
                            <svg class="w-10 h-10 sm:w-12 sm:h-12 text-white" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 9.776c.112-.017.227-.026.344-.026h15.812c.117 0 .232.009.344.026m-16.5 0a2.25 2.25 0 00-1.883 2.542l.857 6a2.25 2.25 0 002.227 1.932H19.05a2.25 2.25 0 002.227-1.932l.857-6a2.25 2.25 0 00-1.883-2.542m-16.5 0V6A2.25 2.25 0 016 3.75h3.879a1.5 1.5 0 011.06.44l2.122 2.12a1.5 1.5 0 001.06.44H18A2.25 2.25 0 0120.25 9v.776"/></svg>
                        </div>
                    </div>
                    <h2 class="text-xl sm:text-2xl font-bold mb-2">Batch compress up to 20 images</h2>
                    <p class="text-gray-500 mb-5">Drop multiple files or <span class="text-blue-600 font-semibold underline decoration-blue-300 underline-offset-2">browse files</span></p>
                    <div class="flex flex-wrap justify-center gap-2">
                        <span class="inline-flex items-center gap-1 bg-gray-100 text-gray-500 text-xs font-semibold px-3 py-1.5 rounded-full">JPG</span>
                        <span class="inline-flex items-center gap-1 bg-gray-100 text-gray-500 text-xs font-semibold px-3 py-1.5 rounded-full">PNG</span>
                        <span class="inline-flex items-center gap-1 bg-gray-100 text-gray-500 text-xs font-semibold px-3 py-1.5 rounded-full">WEBP</span>
                        <span class="inline-flex items-center gap-1 bg-blue-50 text-blue-600 text-xs font-semibold px-3 py-1.5 rounded-full">Max 20 files · 20MB each</span>
                    </div>
                </div>
                <div x-show="berrorMessage" x-transition.duration.300ms class="mt-4 bg-red-50 border border-red-200 rounded-2xl p-4 flex items-start gap-3">
                    <svg class="w-5 h-5 text-red-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <p class="text-red-700 text-sm font-medium" x-text="berrorMessage"></p>
                </div>
            </div>

            {{-- SETTINGS --}}
            <div x-show="bstate === 'settings'" x-transition class="animate-slide-up">
                <div class="bg-white rounded-3xl shadow-xl shadow-gray-200/50 border border-gray-200/60 overflow-hidden">
                    <div class="px-6 sm:px-8 pt-6 sm:pt-8 pb-5 border-b border-gray-100 flex items-center justify-between">
                        <div>
                            <p class="font-bold text-base text-gray-900" x-text="bfiles.length + ' image' + (bfiles.length === 1 ? '' : 's') + ' selected'"></p>
                            <p class="text-sm text-gray-500">Total: <span x-text="bFormatBytes(bTotalSize)"></span></p>
                        </div>
                        <button x-on:click="bReset()" class="p-2 rounded-xl text-gray-400 hover:text-red-500 hover:bg-red-50 transition-all" title="Clear all">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                        </button>
                    </div>
                    {{-- File list --}}
                    <div class="max-h-48 overflow-y-auto divide-y divide-gray-100">
                        <template x-for="(f, i) in bfiles" :key="i">
                            <div class="px-6 py-3 flex items-center gap-3 hover:bg-gray-50">
                                <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909M3.75 21h16.5A2.25 2.25 0 0022.5 18.75V5.25A2.25 2.25 0 0020.25 3H3.75A2.25 2.25 0 001.5 5.25v13.5A2.25 2.25 0 003.75 21z"/></svg>
                                </div>
                                <span class="text-sm text-gray-700 truncate flex-1" x-text="f.name"></span>
                                <span class="text-xs text-gray-400 flex-shrink-0" x-text="bFormatBytes(f.size)"></span>
                            </div>
                        </template>
                    </div>
                    <div class="px-6 sm:px-8 py-6 space-y-5">
                        {{-- Quality Slider --}}
                        <div>
                            <div class="flex items-center justify-between mb-3">
                                <label class="text-sm font-semibold text-gray-700">Compression Quality</label>
                                <span class="text-sm font-bold bg-blue-100 text-blue-700 px-3 py-1 rounded-full" x-text="bquality + '%'"></span>
                            </div>
                            <input type="range" min="10" max="90" step="1" x-model.number="bquality"
                                   class="w-full" :style="'background: linear-gradient(to right, #3b82f6 ' + ((bquality-10)/80*100) + '%, #e5e7eb ' + ((bquality-10)/80*100) + '%)'">
                            <div class="flex gap-2 mt-3">
                                <button x-on:click="bquality = 20" :class="bquality <= 30 ? 'bg-blue-100 text-blue-700 border-blue-200' : 'bg-gray-50 text-gray-600 border-gray-200'" class="flex-1 px-3 py-2 rounded-xl border text-xs font-semibold transition-all">Max Compress</button>
                                <button x-on:click="bquality = 50" :class="bquality > 30 && bquality <= 65 ? 'bg-blue-100 text-blue-700 border-blue-200' : 'bg-gray-50 text-gray-600 border-gray-200'" class="flex-1 px-3 py-2 rounded-xl border text-xs font-semibold transition-all">Balanced</button>
                                <button x-on:click="bquality = 80" :class="bquality > 65 ? 'bg-blue-100 text-blue-700 border-blue-200' : 'bg-gray-50 text-gray-600 border-gray-200'" class="flex-1 px-3 py-2 rounded-xl border text-xs font-semibold transition-all">High Quality</button>
                            </div>
                        </div>
                        <button x-on:click="bCompress()"
                            class="w-full bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-bold py-4 px-6 rounded-2xl transition-all flex items-center justify-center gap-2.5 text-lg shadow-xl shadow-blue-500/25 hover:scale-[1.02] active:scale-[0.98]">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 9.776c.112-.017.227-.026.344-.026h15.812c.117 0 .232.009.344.026m-16.5 0a2.25 2.25 0 00-1.883 2.542l.857 6a2.25 2.25 0 002.227 1.932H19.05a2.25 2.25 0 002.227-1.932l.857-6a2.25 2.25 0 00-1.883-2.542m-16.5 0V6A2.25 2.25 0 016 3.75h3.879a1.5 1.5 0 011.06.44l2.122 2.12a1.5 1.5 0 001.06.44H18A2.25 2.25 0 0120.25 9v.776"/></svg>
                            Compress All Images
                        </button>
                    </div>
                </div>
            </div>

            {{-- PROCESSING --}}
            <div x-show="bstate === 'processing'" x-transition class="animate-slide-up">
                <div class="bg-white rounded-3xl shadow-xl border border-gray-200/60 p-10 text-center">
                    <div class="relative w-20 h-20 mx-auto mb-6">
                        <div class="absolute inset-0 rounded-full bg-blue-100 animate-ping opacity-40"></div>
                        <div class="relative w-full h-full rounded-full bg-blue-50 flex items-center justify-center">
                            <svg class="animate-spin w-10 h-10 text-blue-600" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-20" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="3"/>
                                <path class="opacity-80" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"/>
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-2xl font-bold mb-2">Compressing batch...</h3>
                    <p class="text-gray-500">Processing <span x-text="bfiles.length"></span> images</p>
                </div>
            </div>

            {{-- RESULTS --}}
            <div x-show="bstate === 'result'" x-transition class="animate-slide-up space-y-4">
                {{-- Summary --}}
                <div class="grid grid-cols-3 gap-3">
                    <div class="bg-white rounded-2xl border border-gray-200/60 p-4 text-center shadow-sm">
                        <p class="text-xs text-gray-400 mb-1">Processed</p>
                        <p class="text-xl font-bold text-blue-600" x-text="bresults.succeeded + '/' + bresults.total"></p>
                    </div>
                    <div class="bg-white rounded-2xl border border-gray-200/60 p-4 text-center shadow-sm">
                        <p class="text-xs text-gray-400 mb-1">Total Saved</p>
                        <p class="text-xl font-bold text-green-600" x-text="bFormatBytes(bTotalSaved)"></p>
                    </div>
                    <div class="bg-white rounded-2xl border border-gray-200/60 p-4 text-center shadow-sm">
                        <p class="text-xs text-gray-400 mb-1">Avg Reduction</p>
                        <p class="text-xl font-bold text-amber-600" x-text="bAvgReduction + '%'"></p>
                    </div>
                </div>

                {{-- File list --}}
                <div class="bg-white rounded-2xl border border-gray-200/60 overflow-hidden shadow-sm">
                    <div class="px-5 py-3 border-b border-gray-100 flex items-center justify-between">
                        <h3 class="font-bold text-gray-900 text-sm">Results</h3>
                        <div class="flex gap-2">
                            <button x-on:click="bDownloadZip()" x-show="bresults.filenames && bresults.filenames.length > 0"
                                class="flex items-center gap-2 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold rounded-xl transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                Download ZIP
                            </button>
                            <button x-on:click="bReset()" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-semibold rounded-xl transition-all">New Batch</button>
                        </div>
                    </div>
                    <div class="divide-y divide-gray-100 max-h-72 overflow-y-auto">
                        <template x-for="r in (bresults.results || [])" :key="r.original_name">
                            <div class="px-5 py-3 flex items-center gap-3">
                                <div :class="r.success ? 'bg-green-100 text-green-600' : 'bg-red-100 text-red-500'" class="w-7 h-7 rounded-full flex items-center justify-center flex-shrink-0">
                                    <svg x-show="r.success" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                    <svg x-show="!r.success" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                                </div>
                                <span class="text-sm text-gray-700 truncate flex-1" x-text="r.original_name"></span>
                                <template x-if="r.success">
                                    <div class="flex items-center gap-2 flex-shrink-0">
                                        <span class="text-xs text-green-600 font-semibold" x-text="'-' + r.reduction + '%'"></span>
                                        <a :href="r.download_url" download class="px-2 py-1 bg-blue-50 hover:bg-blue-100 text-blue-600 text-xs font-semibold rounded-lg transition-all">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 10v6m0 0l-3-3m3 3l3-3"/></svg>
                                        </a>
                                    </div>
                                </template>
                                <template x-if="!r.success">
                                    <span class="text-xs text-red-500 flex-shrink-0" x-text="r.message || 'Failed'"></span>
                                </template>
                            </div>
                        </template>
                    </div>
                </div>
            </div>
        </div>{{-- end batch tab --}}

        {{-- ======================== RESIZE TAB ======================== --}}
        <div x-show="activeTab === 'resize'" x-transition.opacity.duration.200ms
             x-data="resizer()" x-init="initResize()">

            {{-- IDLE --}}
            <div x-show="rstate === 'idle' || rstate === 'error'" class="animate-slide-up">
                <div x-on:dragover.prevent="risDragging = true"
                     x-on:dragleave.prevent="risDragging = false"
                     x-on:drop.prevent="rHandleDrop($event)"
                     x-on:click="$refs.resizeFileInput.click()"
                     :class="{ 'drop-active ring-2 ring-orange-400': risDragging }"
                     class="relative bg-white border-2 border-dashed border-gray-300 rounded-3xl p-10 sm:p-14 text-center cursor-pointer transition-all duration-300 group shadow-sm hover:shadow-lg hover:border-orange-400">
                    <input type="file" x-ref="resizeFileInput" accept=".jpg,.jpeg,.png,.webp,.gif" x-on:change="rHandleFileSelect($event)" class="hidden">
                    <div class="relative mx-auto w-20 h-20 sm:w-24 sm:h-24 mb-6">
                        <div class="absolute inset-0 bg-orange-100 rounded-3xl rotate-6 group-hover:rotate-12 transition-transform duration-300"></div>
                        <div class="relative bg-gradient-to-br from-orange-500 to-orange-700 rounded-3xl w-full h-full flex items-center justify-center shadow-xl shadow-orange-500/25">
                            <svg class="w-10 h-10 sm:w-12 sm:h-12 text-white" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3.75v4.5m0-4.5h4.5m-4.5 0L9 9M3.75 20.25v-4.5m0 4.5h4.5m-4.5 0L9 15M20.25 3.75h-4.5m4.5 0v4.5m0-4.5L15 9m5.25 11.25h-4.5m4.5 0v-4.5m0 4.5L15 15"/></svg>
                        </div>
                    </div>
                    <h2 class="text-xl sm:text-2xl font-bold mb-2">Resize your image</h2>
                    <p class="text-gray-500 mb-5">or <span class="text-orange-600 font-semibold underline decoration-orange-300 underline-offset-2">browse files</span></p>
                    <div class="flex flex-wrap justify-center gap-2">
                        <span class="inline-flex items-center bg-orange-50 text-orange-600 text-xs font-semibold px-3 py-1.5 rounded-full">Exact size · Percentage · Fit width/height</span>
                    </div>
                </div>
                <div x-show="rerrorMessage" x-transition.duration.300ms class="mt-4 bg-red-50 border border-red-200 rounded-2xl p-4 flex items-start gap-3">
                    <svg class="w-5 h-5 text-red-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <p class="text-red-700 text-sm font-medium" x-text="rerrorMessage"></p>
                </div>
            </div>

            {{-- SETTINGS --}}
            <div x-show="rstate === 'settings'" x-transition class="animate-slide-up">
                <div class="bg-white rounded-3xl shadow-xl shadow-gray-200/50 border border-gray-200/60 overflow-hidden">
                    <div class="px-6 sm:px-8 pt-6 pb-5 border-b border-gray-100 flex items-center gap-4">
                        <div class="w-14 h-14 bg-orange-100 rounded-2xl flex items-center justify-center flex-shrink-0">
                            <svg class="w-7 h-7 text-orange-600" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909M3.75 21h16.5A2.25 2.25 0 0022.5 18.75V5.25A2.25 2.25 0 0020.25 3H3.75A2.25 2.25 0 001.5 5.25v13.5A2.25 2.25 0 003.75 21z"/></svg>
                        </div>
                        <div class="min-w-0 flex-1">
                            <p class="font-bold text-base truncate" x-text="rfileName"></p>
                            <p class="text-sm text-gray-500">
                                <span x-text="rformatBytes(rfileSize)"></span>
                                <span x-show="rorigW && rorigH"> · <span x-text="rorigW + '×' + rorigH + ' px'"></span></span>
                            </p>
                        </div>
                        <button x-on:click="rReset()" class="p-2 rounded-xl text-gray-400 hover:text-red-500 hover:bg-red-50 transition-all">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                        </button>
                    </div>
                    <div class="px-6 sm:px-8 py-6 space-y-5">
                        {{-- Preview --}}
                        <div x-show="rpreviewUrl" class="rounded-2xl overflow-hidden bg-gray-100 max-h-48 flex items-center justify-center">
                            <img :src="rpreviewUrl" class="max-h-48 object-contain w-full" loading="lazy">
                        </div>

                        {{-- Mode selection --}}
                        <div>
                            <label class="text-sm font-semibold text-gray-700 mb-3 block">Resize Mode</label>
                            <div class="grid grid-cols-2 sm:grid-cols-4 gap-2">
                                <template x-for="m in [{v:'percentage',l:'Percentage'},{v:'max_width',l:'Max Width'},{v:'max_height',l:'Max Height'},{v:'exact',l:'Exact Size'}]" :key="m.v">
                                    <button x-on:click="rmode = m.v"
                                        :class="rmode === m.v ? 'bg-orange-600 text-white border-orange-600 shadow-md' : 'bg-white text-gray-600 border-gray-200 hover:border-orange-300'"
                                        class="px-3 py-3 rounded-xl border text-xs font-bold transition-all text-center" x-text="m.l">
                                    </button>
                                </template>
                            </div>
                        </div>

                        {{-- Percentage mode --}}
                        <div x-show="rmode === 'percentage'" class="space-y-3">
                            <div class="flex items-center justify-between">
                                <label class="text-sm font-semibold text-gray-700">Scale</label>
                                <span class="text-sm font-bold bg-orange-100 text-orange-700 px-3 py-1 rounded-full" x-text="rpercentage + '%'"></span>
                            </div>
                            <input type="range" min="10" max="200" step="5" x-model.number="rpercentage"
                                class="w-full" :style="'background: linear-gradient(to right, #f97316 ' + ((rpercentage-10)/190*100) + '%, #e5e7eb ' + ((rpercentage-10)/190*100) + '%)'">
                            <div class="flex gap-2 mt-2">
                                <button x-on:click="rpercentage=25" :class="rpercentage===25?'bg-orange-100 text-orange-700 border-orange-200':'bg-gray-50 text-gray-600 border-gray-200'" class="flex-1 px-3 py-2 rounded-xl border text-xs font-semibold">25%</button>
                                <button x-on:click="rpercentage=50" :class="rpercentage===50?'bg-orange-100 text-orange-700 border-orange-200':'bg-gray-50 text-gray-600 border-gray-200'" class="flex-1 px-3 py-2 rounded-xl border text-xs font-semibold">50%</button>
                                <button x-on:click="rpercentage=75" :class="rpercentage===75?'bg-orange-100 text-orange-700 border-orange-200':'bg-gray-50 text-gray-600 border-gray-200'" class="flex-1 px-3 py-2 rounded-xl border text-xs font-semibold">75%</button>
                                <button x-on:click="rpercentage=150" :class="rpercentage===150?'bg-orange-100 text-orange-700 border-orange-200':'bg-gray-50 text-gray-600 border-gray-200'" class="flex-1 px-3 py-2 rounded-xl border text-xs font-semibold">150%</button>
                            </div>
                            <div x-show="rorigW && rorigH" class="text-xs text-gray-400 text-center">
                                Output: <span x-text="Math.round(rorigW * rpercentage / 100) + ' × ' + Math.round(rorigH * rpercentage / 100) + ' px'"></span>
                            </div>
                        </div>

                        {{-- Max width mode --}}
                        <div x-show="rmode === 'max_width'" class="space-y-3">
                            <label class="text-sm font-semibold text-gray-700 block">Maximum Width (px)</label>
                            <div class="flex items-center gap-3">
                                <input type="number" x-model.number="rwidth" min="1" max="8000"
                                    class="flex-1 border border-gray-300 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-orange-400 focus:border-transparent outline-none" placeholder="e.g. 1920">
                                <span class="text-sm text-gray-400">px</span>
                            </div>
                            <div class="flex gap-2">
                                <button x-on:click="rwidth=320" :class="rwidth===320?'bg-orange-100 text-orange-700 border-orange-200':'bg-gray-50 text-gray-600 border-gray-200'" class="flex-1 px-3 py-2 rounded-xl border text-xs font-semibold">320</button>
                                <button x-on:click="rwidth=640" :class="rwidth===640?'bg-orange-100 text-orange-700 border-orange-200':'bg-gray-50 text-gray-600 border-gray-200'" class="flex-1 px-3 py-2 rounded-xl border text-xs font-semibold">640</button>
                                <button x-on:click="rwidth=1280" :class="rwidth===1280?'bg-orange-100 text-orange-700 border-orange-200':'bg-gray-50 text-gray-600 border-gray-200'" class="flex-1 px-3 py-2 rounded-xl border text-xs font-semibold">1280</button>
                                <button x-on:click="rwidth=1920" :class="rwidth===1920?'bg-orange-100 text-orange-700 border-orange-200':'bg-gray-50 text-gray-600 border-gray-200'" class="flex-1 px-3 py-2 rounded-xl border text-xs font-semibold">1920</button>
                            </div>
                        </div>

                        {{-- Max height mode --}}
                        <div x-show="rmode === 'max_height'" class="space-y-3">
                            <label class="text-sm font-semibold text-gray-700 block">Maximum Height (px)</label>
                            <div class="flex items-center gap-3">
                                <input type="number" x-model.number="rheight" min="1" max="8000"
                                    class="flex-1 border border-gray-300 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-orange-400 focus:border-transparent outline-none" placeholder="e.g. 1080">
                                <span class="text-sm text-gray-400">px</span>
                            </div>
                            <div class="flex gap-2">
                                <button x-on:click="rheight=480" :class="rheight===480?'bg-orange-100 text-orange-700 border-orange-200':'bg-gray-50 text-gray-600 border-gray-200'" class="flex-1 px-3 py-2 rounded-xl border text-xs font-semibold">480</button>
                                <button x-on:click="rheight=720" :class="rheight===720?'bg-orange-100 text-orange-700 border-orange-200':'bg-gray-50 text-gray-600 border-gray-200'" class="flex-1 px-3 py-2 rounded-xl border text-xs font-semibold">720</button>
                                <button x-on:click="rheight=1080" :class="rheight===1080?'bg-orange-100 text-orange-700 border-orange-200':'bg-gray-50 text-gray-600 border-gray-200'" class="flex-1 px-3 py-2 rounded-xl border text-xs font-semibold">1080</button>
                                <button x-on:click="rheight=2160" :class="rheight===2160?'bg-orange-100 text-orange-700 border-orange-200':'bg-gray-50 text-gray-600 border-gray-200'" class="flex-1 px-3 py-2 rounded-xl border text-xs font-semibold">2160</button>
                            </div>
                        </div>

                        {{-- Exact mode --}}
                        <div x-show="rmode === 'exact'" class="space-y-3">
                            <label class="text-sm font-semibold text-gray-700 block">Exact Dimensions</label>
                            <div class="flex items-center gap-3">
                                <input type="number" x-model.number="rwidth" min="1" max="8000"
                                    class="flex-1 border border-gray-300 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-orange-400 focus:border-transparent outline-none" placeholder="Width">
                                <span class="text-gray-400 text-sm font-bold">×</span>
                                <input type="number" x-model.number="rheight" min="1" max="8000"
                                    class="flex-1 border border-gray-300 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-orange-400 focus:border-transparent outline-none" placeholder="Height">
                                <span class="text-sm text-gray-400">px</span>
                            </div>
                        </div>

                        <button x-on:click="rResize()"
                            class="w-full bg-gradient-to-r from-orange-600 to-orange-700 hover:from-orange-700 hover:to-orange-800 text-white font-bold py-4 px-6 rounded-2xl transition-all flex items-center justify-center gap-2.5 text-lg shadow-xl shadow-orange-500/25 hover:scale-[1.02] active:scale-[0.98]">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3.75v4.5m0-4.5h4.5m-4.5 0L9 9M3.75 20.25v-4.5m0 4.5h4.5m-4.5 0L9 15M20.25 3.75h-4.5m4.5 0v4.5m0-4.5L15 9m5.25 11.25h-4.5m4.5 0v-4.5m0 4.5L15 15"/></svg>
                            Resize Image
                        </button>
                    </div>
                </div>
            </div>

            {{-- PROCESSING --}}
            <div x-show="rstate === 'processing'" x-transition class="animate-slide-up">
                <div class="bg-white rounded-3xl shadow-xl border border-gray-200/60 p-10 text-center">
                    <div class="relative w-20 h-20 mx-auto mb-6">
                        <div class="absolute inset-0 rounded-full bg-orange-100 animate-ping opacity-40"></div>
                        <div class="relative w-full h-full rounded-full bg-orange-50 flex items-center justify-center">
                            <svg class="animate-spin w-10 h-10 text-orange-600" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-20" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="3"/>
                                <path class="opacity-80" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"/>
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-2xl font-bold mb-2">Resizing your image...</h3>
                </div>
            </div>

            {{-- RESULT --}}
            <div x-show="rstate === 'result'" x-transition class="animate-slide-up space-y-5">
                <div class="grid grid-cols-3 gap-3">
                    <div class="bg-white rounded-2xl border border-gray-200/60 p-4 text-center shadow-sm">
                        <p class="text-xs text-gray-400 mb-1">Original</p>
                        <p class="text-lg font-bold text-gray-700" x-text="rresult.formatted_original"></p>
                    </div>
                    <div class="bg-white rounded-2xl border border-gray-200/60 p-4 text-center shadow-sm">
                        <p class="text-xs text-gray-400 mb-1">Resized</p>
                        <p class="text-lg font-bold text-orange-600" x-text="rresult.formatted_resized"></p>
                    </div>
                    <div class="bg-white rounded-2xl border border-gray-200/60 p-4 text-center shadow-sm">
                        <p class="text-xs text-gray-400 mb-1">Dimensions</p>
                        <p class="text-sm font-bold text-gray-700" x-text="(rresult.width || '—') + '×' + (rresult.height || '—')"></p>
                    </div>
                </div>
                <div class="bg-white rounded-3xl shadow-xl border border-gray-200/60 p-6">
                    <div class="flex flex-col sm:flex-row gap-3">
                        <a :href="rresult.download_url" download
                           class="flex-1 bg-gradient-to-r from-orange-600 to-orange-700 hover:from-orange-700 hover:to-orange-800 text-white font-bold py-4 px-6 rounded-2xl flex items-center justify-center gap-2.5 text-lg shadow-xl shadow-orange-500/25 hover:scale-[1.02]">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            Download Resized
                        </a>
                        <button x-on:click="rReset()" class="bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold py-4 px-5 rounded-2xl flex items-center justify-center gap-2 text-sm">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                            New Image
                        </button>
                    </div>
                </div>
            </div>
        </div>{{-- end resize tab --}}

        {{-- ======================== MORE TOOLS TAB ======================== --}}
        <div x-show="activeTab === 'tools'" x-transition.opacity.duration.200ms>
            <div class="grid sm:grid-cols-2 gap-4">

                {{-- Watermark Tool --}}
                <div x-data="watermarkTool()" x-init="initWatermark()" class="bg-white rounded-2xl border border-gray-200/60 overflow-hidden shadow-sm">
                    <div class="px-5 py-4 border-b border-gray-100 flex items-center gap-3">
                        <div class="w-10 h-10 bg-pink-100 rounded-xl flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-pink-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"/></svg>
                        </div>
                        <div>
                            <h3 class="font-bold text-gray-900 text-sm">Add Watermark</h3>
                            <p class="text-xs text-gray-500">Text watermark overlay</p>
                        </div>
                    </div>
                    <div class="p-5 space-y-4">
                        <div x-show="wstate === 'idle' || wstate === 'error'">
                            <div x-on:click="$refs.wFileInput.click()" class="border-2 border-dashed border-gray-200 rounded-2xl p-6 text-center cursor-pointer hover:border-pink-400 hover:bg-pink-50 transition-all">
                                <input type="file" x-ref="wFileInput" accept=".jpg,.jpeg,.png,.webp" x-on:change="wHandleFile($event)" class="hidden">
                                <p class="text-sm text-gray-400">Click to select image</p>
                            </div>
                        </div>

                        <div x-show="wstate === 'settings'" class="space-y-3">
                            <div class="flex items-center gap-2">
                                <span class="text-xs font-semibold text-gray-500 flex-shrink-0">File:</span>
                                <span class="text-xs text-gray-700 truncate" x-text="wfileName"></span>
                                <button x-on:click="wReset()" class="ml-auto text-gray-400 hover:text-red-500 flex-shrink-0"><svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg></button>
                            </div>
                            <input type="text" x-model="wtext" maxlength="100" placeholder="Watermark text (e.g. © MyBrand)"
                                class="w-full border border-gray-300 rounded-xl px-3 py-2.5 text-sm focus:ring-2 focus:ring-pink-400 focus:border-transparent outline-none">
                            <div class="flex gap-2">
                                <div class="flex-1">
                                    <label class="text-xs text-gray-500 mb-1 block">Position</label>
                                    <select x-model="wposition" class="w-full border border-gray-300 rounded-xl px-3 py-2 text-sm focus:ring-2 focus:ring-pink-400 outline-none">
                                        <option value="bottom-right">Bottom Right</option>
                                        <option value="bottom-left">Bottom Left</option>
                                        <option value="top-right">Top Right</option>
                                        <option value="top-left">Top Left</option>
                                        <option value="center">Center</option>
                                    </select>
                                </div>
                                <div class="flex-1">
                                    <label class="text-xs text-gray-500 mb-1 block">Opacity: <span x-text="wopacity + '%'"></span></label>
                                    <input type="range" min="10" max="100" step="5" x-model.number="wopacity" class="w-full mt-1.5">
                                </div>
                            </div>
                            <button x-on:click="wApply()" :disabled="!wtext.trim()"
                                :class="wtext.trim() ? 'opacity-100 hover:scale-[1.02]' : 'opacity-50 cursor-not-allowed'"
                                class="w-full bg-gradient-to-r from-pink-600 to-pink-700 text-white font-bold py-3 rounded-xl transition-all flex items-center justify-center gap-2 text-sm">
                                <svg x-show="wstate !== 'processing'" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931z"/></svg>
                                Apply Watermark
                            </button>
                        </div>

                        <div x-show="wstate === 'processing'" class="text-center py-4">
                            <svg class="animate-spin w-8 h-8 text-pink-600 mx-auto" fill="none" viewBox="0 0 24 24"><circle class="opacity-20" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="3"/><path class="opacity-80" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/></svg>
                            <p class="text-sm text-gray-500 mt-2">Applying watermark...</p>
                        </div>

                        <div x-show="wstate === 'result'" class="space-y-3">
                            <div class="flex items-center gap-2 bg-green-50 rounded-xl px-3 py-2.5">
                                <svg class="w-5 h-5 text-green-600 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                <span class="text-sm font-semibold text-green-700">Watermark applied!</span>
                            </div>
                            <a :href="wresult.download_url" download
                               class="flex w-full items-center justify-center gap-2 py-3 bg-pink-600 hover:bg-pink-700 text-white font-bold rounded-xl text-sm transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 10v6m0 0l-3-3m3 3l3-3"/></svg>
                                Download
                            </a>
                            <button x-on:click="wReset()" class="w-full py-2 text-sm text-gray-500 hover:text-gray-700 transition-colors">Apply another</button>
                        </div>

                        <div x-show="werrorMessage" class="bg-red-50 rounded-xl px-3 py-2 text-xs text-red-600" x-text="werrorMessage"></div>
                    </div>
                </div>

                {{-- URL Compress Tool --}}
                <div x-data="urlCompressor()" class="bg-white rounded-2xl border border-gray-200/60 overflow-hidden shadow-sm">
                    <div class="px-5 py-4 border-b border-gray-100 flex items-center gap-3">
                        <div class="w-10 h-10 bg-teal-100 rounded-xl flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-teal-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13.19 8.688a4.5 4.5 0 011.242 7.244l-4.5 4.5a4.5 4.5 0 01-6.364-6.364l1.757-1.757m13.35-.622l1.757-1.757a4.5 4.5 0 00-6.364-6.364l-4.5 4.5a4.5 4.5 0 001.242 7.244"/></svg>
                        </div>
                        <div>
                            <h3 class="font-bold text-gray-900 text-sm">Compress from URL</h3>
                            <p class="text-xs text-gray-500">Paste image URL to compress</p>
                        </div>
                    </div>
                    <div class="p-5 space-y-4">
                        <div x-show="ustate === 'idle' || ustate === 'error'" class="space-y-3">
                            <input type="url" x-model="uurl" placeholder="https://example.com/image.jpg"
                                class="w-full border border-gray-300 rounded-xl px-3 py-2.5 text-sm focus:ring-2 focus:ring-teal-400 focus:border-transparent outline-none"
                                x-on:keydown.enter="uCompress()">
                            <div class="flex items-center gap-2">
                                <label class="text-xs text-gray-500 flex-shrink-0">Quality</label>
                                <input type="range" min="10" max="90" step="5" x-model.number="uquality" class="flex-1">
                                <span class="text-xs font-bold text-teal-700 bg-teal-50 px-2 py-1 rounded-lg flex-shrink-0" x-text="uquality + '%'"></span>
                            </div>
                            <button x-on:click="uCompress()" :disabled="!uurl.trim()"
                                :class="uurl.trim() ? 'opacity-100' : 'opacity-50 cursor-not-allowed'"
                                class="w-full bg-gradient-to-r from-teal-600 to-teal-700 text-white font-bold py-3 rounded-xl transition-all flex items-center justify-center gap-2 text-sm hover:scale-[1.02]">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3"/></svg>
                                Compress URL Image
                            </button>
                            <div x-show="uerrorMessage" class="bg-red-50 rounded-xl px-3 py-2 text-xs text-red-600" x-text="uerrorMessage"></div>
                        </div>

                        <div x-show="ustate === 'processing'" class="text-center py-4">
                            <svg class="animate-spin w-8 h-8 text-teal-600 mx-auto" fill="none" viewBox="0 0 24 24"><circle class="opacity-20" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="3"/><path class="opacity-80" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/></svg>
                            <p class="text-sm text-gray-500 mt-2">Fetching and compressing...</p>
                        </div>

                        <div x-show="ustate === 'result'" class="space-y-3">
                            <div class="grid grid-cols-3 gap-2">
                                <div class="bg-gray-50 rounded-xl p-2 text-center">
                                    <p class="text-xs text-gray-400">Original</p>
                                    <p class="text-xs font-bold text-gray-700" x-text="uresult.formatted_original"></p>
                                </div>
                                <div class="bg-teal-50 rounded-xl p-2 text-center">
                                    <p class="text-xs text-gray-400">Compressed</p>
                                    <p class="text-xs font-bold text-teal-600" x-text="uresult.formatted_compressed"></p>
                                </div>
                                <div class="bg-green-50 rounded-xl p-2 text-center">
                                    <p class="text-xs text-gray-400">Saved</p>
                                    <p class="text-xs font-bold text-green-600" x-text="uresult.reduction + '%'"></p>
                                </div>
                            </div>
                            <a :href="uresult.download_url" download
                               class="flex w-full items-center justify-center gap-2 py-3 bg-teal-600 hover:bg-teal-700 text-white font-bold rounded-xl text-sm transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 10v6m0 0l-3-3m3 3l3-3"/></svg>
                                Download
                            </a>
                            <button x-on:click="uReset()" class="w-full py-2 text-sm text-gray-500 hover:text-gray-700 transition-colors">Compress another</button>
                        </div>
                    </div>
                </div>

                {{-- Image → PDF Tool --}}
                <div x-data="imgToPdfTool()" class="bg-white rounded-2xl border border-gray-200/60 overflow-hidden shadow-sm">
                    <div class="px-5 py-4 border-b border-gray-100 flex items-center gap-3">
                        <div class="w-10 h-10 bg-red-100 rounded-xl flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/></svg>
                        </div>
                        <div>
                            <h3 class="font-bold text-gray-900 text-sm">Image → PDF</h3>
                            <p class="text-xs text-gray-500">Convert image to PDF document</p>
                        </div>
                    </div>
                    <div class="p-5 space-y-4">
                        <div x-show="pstate === 'idle' || pstate === 'error'">
                            <div x-on:click="$refs.pdfImgInput.click()" class="border-2 border-dashed border-gray-200 rounded-2xl p-6 text-center cursor-pointer hover:border-red-400 hover:bg-red-50 transition-all">
                                <input type="file" x-ref="pdfImgInput" accept=".jpg,.jpeg,.png,.webp" x-on:change="pHandleFile($event)" class="hidden">
                                <p class="text-sm text-gray-400">Click to select image</p>
                            </div>
                        </div>

                        <div x-show="pstate === 'settings'" class="space-y-3">
                            <div class="flex items-center justify-between">
                                <span class="text-xs font-semibold text-gray-600 truncate flex-1" x-text="pfileName"></span>
                                <button x-on:click="pReset()" class="ml-2 text-gray-400 hover:text-red-500 flex-shrink-0"><svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg></button>
                            </div>
                            <div class="flex gap-2">
                                <div class="flex-1">
                                    <label class="text-xs text-gray-500 mb-1 block">Page Size</label>
                                    <select x-model="ppageSize" class="w-full border border-gray-300 rounded-xl px-3 py-2 text-sm focus:ring-2 focus:ring-red-400 outline-none">
                                        <option value="A4">A4</option>
                                        <option value="A3">A3</option>
                                        <option value="Letter">Letter</option>
                                        <option value="Legal">Legal</option>
                                    </select>
                                </div>
                                <div class="flex-1">
                                    <label class="text-xs text-gray-500 mb-1 block">Orientation</label>
                                    <select x-model="porientation" class="w-full border border-gray-300 rounded-xl px-3 py-2 text-sm focus:ring-2 focus:ring-red-400 outline-none">
                                        <option value="portrait">Portrait</option>
                                        <option value="landscape">Landscape</option>
                                    </select>
                                </div>
                            </div>
                            <button x-on:click="pConvert()"
                                class="w-full bg-gradient-to-r from-red-600 to-red-700 text-white font-bold py-3 rounded-xl transition-all flex items-center justify-center gap-2 text-sm hover:scale-[1.02]">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/></svg>
                                Convert to PDF
                            </button>
                        </div>

                        <div x-show="pstate === 'processing'" class="text-center py-4">
                            <svg class="animate-spin w-8 h-8 text-red-600 mx-auto" fill="none" viewBox="0 0 24 24"><circle class="opacity-20" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="3"/><path class="opacity-80" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/></svg>
                            <p class="text-sm text-gray-500 mt-2">Generating PDF...</p>
                        </div>

                        <div x-show="pstate === 'result'" class="space-y-3">
                            <div class="flex items-center gap-2 bg-green-50 rounded-xl px-3 py-2.5">
                                <svg class="w-5 h-5 text-green-600 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                <span class="text-sm text-green-700 font-semibold">PDF ready! <span class="font-normal" x-text="'(' + presult.formatted_size + ')'"></span></span>
                            </div>
                            <a :href="presult.download_url" download
                               class="flex w-full items-center justify-center gap-2 py-3 bg-red-600 hover:bg-red-700 text-white font-bold rounded-xl text-sm transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 10v6m0 0l-3-3m3 3l3-3"/></svg>
                                Download PDF
                            </a>
                            <button x-on:click="pReset()" class="w-full py-2 text-sm text-gray-500 hover:text-gray-700 transition-colors">Convert another</button>
                        </div>

                        <div x-show="perrorMessage" class="bg-red-50 rounded-xl px-3 py-2 text-xs text-red-600" x-text="perrorMessage"></div>
                    </div>
                </div>

                {{-- PDF → Image Tool --}}
                <div x-data="pdfToImgTool()" class="bg-white rounded-2xl border border-gray-200/60 overflow-hidden shadow-sm">
                    <div class="px-5 py-4 border-b border-gray-100 flex items-center gap-3">
                        <div class="w-10 h-10 bg-indigo-100 rounded-xl flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909M3.75 21h16.5A2.25 2.25 0 0022.5 18.75V5.25A2.25 2.25 0 0020.25 3H3.75A2.25 2.25 0 001.5 5.25v13.5A2.25 2.25 0 003.75 21z"/></svg>
                        </div>
                        <div>
                            <h3 class="font-bold text-gray-900 text-sm">PDF → Image</h3>
                            <p class="text-xs text-gray-500">Convert PDF page to image</p>
                        </div>
                    </div>
                    <div class="p-5 space-y-4">
                        <div x-show="pdfistate === 'idle' || pdfistate === 'error'">
                            <div x-on:click="$refs.pdfFileInput.click()" class="border-2 border-dashed border-gray-200 rounded-2xl p-6 text-center cursor-pointer hover:border-indigo-400 hover:bg-indigo-50 transition-all">
                                <input type="file" x-ref="pdfFileInput" accept=".pdf" x-on:change="pdfiHandleFile($event)" class="hidden">
                                <p class="text-sm text-gray-400">Click to select PDF file</p>
                                <p class="text-xs text-gray-400 mt-1">Max 20MB</p>
                            </div>
                        </div>

                        <div x-show="pdfistate === 'settings'" class="space-y-3">
                            <div class="flex items-center justify-between">
                                <span class="text-xs font-semibold text-gray-600 truncate flex-1" x-text="pdfifileName"></span>
                                <button x-on:click="pdfiReset()" class="ml-2 text-gray-400 hover:text-red-500 flex-shrink-0"><svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg></button>
                            </div>
                            <div class="flex gap-2">
                                <div class="flex-1">
                                    <label class="text-xs text-gray-500 mb-1 block">Output Format</label>
                                    <select x-model="pdfiformat" class="w-full border border-gray-300 rounded-xl px-3 py-2 text-sm focus:ring-2 focus:ring-indigo-400 outline-none">
                                        <option value="jpg">JPG</option>
                                        <option value="png">PNG</option>
                                        <option value="webp">WebP</option>
                                    </select>
                                </div>
                                <div class="flex-1">
                                    <label class="text-xs text-gray-500 mb-1 block">DPI</label>
                                    <select x-model.number="pdfidpi" class="w-full border border-gray-300 rounded-xl px-3 py-2 text-sm focus:ring-2 focus:ring-indigo-400 outline-none">
                                        <option value="72">72</option>
                                        <option value="96">96</option>
                                        <option value="150" selected>150</option>
                                        <option value="200">200</option>
                                        <option value="300">300</option>
                                    </select>
                                </div>
                            </div>
                            <button x-on:click="pdfiConvert()"
                                class="w-full bg-gradient-to-r from-indigo-600 to-indigo-700 text-white font-bold py-3 rounded-xl transition-all flex items-center justify-center gap-2 text-sm hover:scale-[1.02]">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909"/></svg>
                                Convert to Image
                            </button>
                        </div>

                        <div x-show="pdfistate === 'processing'" class="text-center py-4">
                            <svg class="animate-spin w-8 h-8 text-indigo-600 mx-auto" fill="none" viewBox="0 0 24 24"><circle class="opacity-20" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="3"/><path class="opacity-80" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/></svg>
                            <p class="text-sm text-gray-500 mt-2">Converting PDF...</p>
                        </div>

                        <div x-show="pdfistate === 'result'" class="space-y-3">
                            <div class="grid grid-cols-2 gap-2">
                                <div class="bg-indigo-50 rounded-xl p-2 text-center">
                                    <p class="text-xs text-gray-400">Size</p>
                                    <p class="text-xs font-bold text-indigo-600" x-text="pdfiresult.formatted_size"></p>
                                </div>
                                <div class="bg-indigo-50 rounded-xl p-2 text-center">
                                    <p class="text-xs text-gray-400">Dimensions</p>
                                    <p class="text-xs font-bold text-indigo-600" x-text="(pdfiresult.width||'—') + '×' + (pdfiresult.height||'—')"></p>
                                </div>
                            </div>
                            <a :href="pdfiresult.download_url" download
                               class="flex w-full items-center justify-center gap-2 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl text-sm transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 10v6m0 0l-3-3m3 3l3-3"/></svg>
                                Download Image
                            </a>
                            <button x-on:click="pdfiReset()" class="w-full py-2 text-sm text-gray-500 hover:text-gray-700 transition-colors">Convert another</button>
                        </div>

                        <div x-show="pdfierrorMessage" class="bg-red-50 rounded-xl px-3 py-2 text-xs text-red-600" x-text="pdfierrorMessage"></div>
                    </div>
                </div>

            </div>{{-- end grid --}}
        </div>{{-- end tools tab --}}

    </div>{{-- end toolTabs wrapper --}}

    {{-- Trust / Stats Bar --}}
    <section class="bg-white border-y border-gray-200/60 py-8 mt-4" aria-label="Statistics">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-6 text-center">
                <div>
                    <p class="text-3xl sm:text-4xl font-extrabold text-brand-600">90%</p>
                    <p class="text-sm text-gray-500 mt-1 font-medium">Max size reduction</p>
                </div>
                <div>
                    <p class="text-3xl sm:text-4xl font-extrabold text-brand-600">20MB</p>
                    <p class="text-sm text-gray-500 mt-1 font-medium">Max file size</p>
                </div>
                <div>
                    <p class="text-3xl sm:text-4xl font-extrabold text-brand-600">4</p>
                    <p class="text-sm text-gray-500 mt-1 font-medium">Formats supported</p>
                </div>
                <div>
                    <p class="text-3xl sm:text-4xl font-extrabold text-brand-600">100%</p>
                    <p class="text-sm text-gray-500 mt-1 font-medium">Free · No signup</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Ad Banner: Middle --}}
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 my-10">
        <div class="bg-gray-100/60 border border-dashed border-gray-300 rounded-xl p-3 text-center text-gray-400 text-xs font-medium tracking-wide uppercase">
            Advertisement
        </div>
    </div>

    {{-- How It Works Section --}}
    <section class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-16" aria-labelledby="how-it-works-title">
        <div class="text-center mb-12">
            <h2 id="how-it-works-title" class="text-3xl sm:text-4xl font-extrabold mb-4">How to Compress Images Online</h2>
            <p class="text-gray-500 max-w-xl mx-auto">Three simple steps — done in under 10 seconds</p>
        </div>
        <div class="grid sm:grid-cols-3 gap-6 relative">
            {{-- connector line (desktop only) --}}
            <div class="hidden sm:block absolute top-10 left-1/6 right-1/6 h-0.5 bg-gradient-to-r from-brand-200 via-brand-400 to-brand-200 z-0" style="left:16%;right:16%;top:2.5rem;"></div>

            {{-- Step 1 --}}
            <div class="relative z-10 bg-white rounded-2xl border border-gray-200/60 p-6 text-center shadow-sm hover:shadow-lg transition-shadow">
                <div class="w-16 h-16 bg-gradient-to-br from-brand-500 to-brand-700 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg shadow-brand-500/30">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5"/></svg>
                </div>
                <span class="inline-block bg-brand-100 text-brand-700 text-xs font-bold px-2.5 py-1 rounded-full mb-3">Step 1</span>
                <h3 class="font-bold text-lg mb-2">Upload Your Image</h3>
                <p class="text-sm text-gray-500 leading-relaxed">Drag & drop, click to browse, or paste from clipboard with <kbd class="text-xs bg-gray-100 border border-gray-200 rounded px-1.5 py-0.5">Ctrl+V</kbd></p>
            </div>

            {{-- Step 2 --}}
            <div class="relative z-10 bg-white rounded-2xl border border-gray-200/60 p-6 text-center shadow-sm hover:shadow-lg transition-shadow">
                <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-purple-700 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg shadow-purple-500/30">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6h9.75M10.5 6a1.5 1.5 0 11-3 0m3 0a1.5 1.5 0 10-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-9.75 0h9.75"/></svg>
                </div>
                <span class="inline-block bg-purple-100 text-purple-700 text-xs font-bold px-2.5 py-1 rounded-full mb-3">Step 2</span>
                <h3 class="font-bold text-lg mb-2">Choose Settings</h3>
                <p class="text-sm text-gray-500 leading-relaxed">Set quality level (10–90%) for compression, or pick your target format for conversion.</p>
            </div>

            {{-- Step 3 --}}
            <div class="relative z-10 bg-white rounded-2xl border border-gray-200/60 p-6 text-center shadow-sm hover:shadow-lg transition-shadow">
                <div class="w-16 h-16 bg-gradient-to-br from-accent-500 to-accent-700 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg shadow-accent-500/30">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                </div>
                <span class="inline-block bg-accent-100 text-accent-700 text-xs font-bold px-2.5 py-1 rounded-full mb-3">Step 3</span>
                <h3 class="font-bold text-lg mb-2">Download Result</h3>
                <p class="text-sm text-gray-500 leading-relaxed">Click Download to save your optimised image. See original vs compressed size comparison instantly.</p>
            </div>
        </div>
    </section>

    {{-- Features Section --}}
    <section class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-16" aria-labelledby="features-title">
        <div class="text-center mb-12">
            <h2 id="features-title" class="text-3xl sm:text-4xl font-extrabold mb-4">Why Choose Our Compressor?</h2>
            <p class="text-gray-500 max-w-xl mx-auto">Trusted by thousands of creators, developers, and businesses worldwide</p>
        </div>
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-5">
            {{-- Feature 1 --}}
            <div class="bg-white rounded-2xl border border-gray-200/60 p-6 hover:shadow-lg transition-shadow group">
                <div class="w-12 h-12 bg-brand-50 rounded-2xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6 text-brand-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                </div>
                <h3 class="font-bold text-lg mb-2">Lightning Fast</h3>
                <p class="text-sm text-gray-500 leading-relaxed">Server-side compression in milliseconds. No waiting, no queues.</p>
            </div>
            {{-- Feature 2 --}}
            <div class="bg-white rounded-2xl border border-gray-200/60 p-6 hover:shadow-lg transition-shadow group">
                <div class="w-12 h-12 bg-accent-50 rounded-2xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6 text-accent-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                </div>
                <h3 class="font-bold text-lg mb-2">100% Secure</h3>
                <p class="text-sm text-gray-500 leading-relaxed">Files auto-delete in 30 minutes. We never store or analyze your data.</p>
            </div>
            {{-- Feature 3 --}}
            <div class="bg-white rounded-2xl border border-gray-200/60 p-6 hover:shadow-lg transition-shadow group">
                <div class="w-12 h-12 bg-purple-50 rounded-2xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"/></svg>
                </div>
                <h3 class="font-bold text-lg mb-2">Format Conversion</h3>
                <p class="text-sm text-gray-500 leading-relaxed">Convert between JPG, PNG, and WEBP while compressing.</p>
            </div>
            {{-- Feature 4 --}}
            <div class="bg-white rounded-2xl border border-gray-200/60 p-6 hover:shadow-lg transition-shadow group">
                <div class="w-12 h-12 bg-amber-50 rounded-2xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                </div>
                <h3 class="font-bold text-lg mb-2">Mobile Friendly</h3>
                <p class="text-sm text-gray-500 leading-relaxed">Fully responsive. Compress images from any device, anywhere.</p>
            </div>
            {{-- Feature 5 --}}
            <div class="bg-white rounded-2xl border border-gray-200/60 p-6 hover:shadow-lg transition-shadow group">
                <div class="w-12 h-12 bg-rose-50 rounded-2xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6 text-rose-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                </div>
                <h3 class="font-bold text-lg mb-2">Quality Control</h3>
                <p class="text-sm text-gray-500 leading-relaxed">Fine-tune compression with a precise quality slider (10–90%).</p>
            </div>
            {{-- Feature 6 --}}
            <div class="bg-white rounded-2xl border border-gray-200/60 p-6 hover:shadow-lg transition-shadow group">
                <div class="w-12 h-12 bg-teal-50 rounded-2xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6 text-teal-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <h3 class="font-bold text-lg mb-2">Totally Free</h3>
                <p class="text-sm text-gray-500 leading-relaxed">No signup, no watermarks, no limits. Compress as many images as you need.</p>
            </div>
        </div>
    </section>

    {{-- Why Compress / Formats Section --}}
    <section class="bg-white border-y border-gray-200/60 py-16" aria-labelledby="why-compress-title">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 id="why-compress-title" class="text-3xl font-extrabold mb-6">Why Compress Images?</h2>
            <p class="text-gray-600 mb-6 leading-relaxed">
                Image compression is essential for modern web development and digital content. Large files slow down websites, waste bandwidth, and hurt user experience.
            </p>
            <div class="grid sm:grid-cols-2 gap-4 mb-10">
                <div class="flex gap-3 items-start"><div class="w-6 h-6 bg-accent-100 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5"><svg class="w-3.5 h-3.5 text-accent-600" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg></div><p class="text-gray-600 text-sm"><strong class="text-gray-800">Faster websites</strong> — Compressed images load instantly, improving Core Web Vitals.</p></div>
                <div class="flex gap-3 items-start"><div class="w-6 h-6 bg-accent-100 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5"><svg class="w-3.5 h-3.5 text-accent-600" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg></div><p class="text-gray-600 text-sm"><strong class="text-gray-800">Better SEO</strong> — Google uses page speed as a ranking factor.</p></div>
                <div class="flex gap-3 items-start"><div class="w-6 h-6 bg-accent-100 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5"><svg class="w-3.5 h-3.5 text-accent-600" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg></div><p class="text-gray-600 text-sm"><strong class="text-gray-800">Save storage</strong> — Reduce sizes by up to 80% without quality loss.</p></div>
                <div class="flex gap-3 items-start"><div class="w-6 h-6 bg-accent-100 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5"><svg class="w-3.5 h-3.5 text-accent-600" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg></div><p class="text-gray-600 text-sm"><strong class="text-gray-800">Lower costs</strong> — Less bandwidth = lower hosting and CDN bills.</p></div>
            </div>

            <h2 class="text-3xl font-extrabold mb-6">Supported Formats</h2>
            <div class="grid sm:grid-cols-2 gap-4">
                <div class="bg-gray-50 rounded-2xl p-5 border border-gray-200/60">
                    <div class="flex items-center gap-2 mb-2"><span class="text-lg font-bold">📸</span><h3 class="font-bold">JPEG / JPG</h3></div>
                    <p class="text-sm text-gray-500">Best for photographs. Lossy compression with adjustable quality.</p>
                </div>
                <div class="bg-gray-50 rounded-2xl p-5 border border-gray-200/60">
                    <div class="flex items-center gap-2 mb-2"><span class="text-lg font-bold">🎨</span><h3 class="font-bold">PNG</h3></div>
                    <p class="text-sm text-gray-500">Ideal for graphics with transparency. Lossless compression.</p>
                </div>
                <div class="bg-gray-50 rounded-2xl p-5 border border-gray-200/60">
                    <div class="flex items-center gap-2 mb-2"><span class="text-lg font-bold">🌐</span><h3 class="font-bold">WEBP</h3></div>
                    <p class="text-sm text-gray-500">Modern format, 30% smaller than JPEG at equivalent quality.</p>
                </div>
                <div class="bg-gray-50 rounded-2xl p-5 border border-gray-200/60">
                    <div class="flex items-center gap-2 mb-2"><span class="text-lg font-bold">🎞️</span><h3 class="font-bold">GIF</h3></div>
                    <p class="text-sm text-gray-500">Animated images and simple graphics with limited colors.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- FAQ Section --}}
    <section class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-16" x-data="{ openFaq: null }">
        <div class="text-center mb-10">
            <h2 class="text-3xl sm:text-4xl font-extrabold mb-3">Frequently Asked Questions</h2>
            <p class="text-gray-500">Everything you need to know</p>
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
                <div class="bg-white rounded-2xl border border-gray-200/60 overflow-hidden transition-shadow hover:shadow-md">
                    <button x-on:click="openFaq = openFaq === {{ $i }} ? null : {{ $i }}"
                            class="w-full px-6 py-5 text-left font-semibold text-gray-900 flex items-center justify-between gap-4 hover:bg-gray-50:bg-gray-800/50 transition-colors">
                        <span>{{ $faq[0] }}</span>
                        <svg :class="openFaq === {{ $i }} ? 'rotate-180' : ''" class="w-5 h-5 flex-shrink-0 text-gray-400 transition-transform duration-200" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div x-show="openFaq === {{ $i }}" x-collapse>
                        <div class="px-6 pb-5 text-gray-600 leading-relaxed">{{ $faq[1] }}</div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    {{-- Footer --}}
    <footer class="bg-gradient-to-r from-gray-900 via-indigo-950 to-gray-900 border-t border-indigo-800/40 pt-12 pb-6" itemscope itemtype="https://schema.org/WPFooter">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Top row: logo + tagline + tool links --}}
            <div class="grid sm:grid-cols-3 gap-8 pb-10 border-b border-indigo-800/40">

                {{-- Brand --}}
                <div>
                    <a href="/" class="flex items-center gap-2.5 mb-3">
                        <img src="{{ asset('logo.png') }}" alt="CompresslyPro logo" class="h-9 w-auto flex-shrink-0">
                        <div class="flex flex-col leading-tight">
                            <span class="text-white font-bold text-sm tracking-tight">CompresslyPro</span>
                            <span class="text-indigo-300/70 text-[10px] font-medium">Free Image Compressor</span>
                        </div>
                    </a>
                    <p class="text-indigo-300/60 text-xs leading-relaxed max-w-xs">
                        Compress & convert JPG, PNG, WebP and GIF images online for free. No signup, no watermarks, privacy-first.
                    </p>
                </div>

                {{-- Tools --}}
                <div>
                    <h3 class="text-white font-semibold text-sm mb-3 uppercase tracking-wider">Tools</h3>
                    <nav aria-label="Footer tools" class="space-y-2">
                        <a href="/#compress" class="block text-indigo-300/70 hover:text-white text-sm transition-colors">Image Compressor</a>
                        <a href="/#convert" class="block text-indigo-300/70 hover:text-white text-sm transition-colors">Image Converter</a>
                        <a href="/#compress" class="block text-indigo-300/70 hover:text-white text-sm transition-colors">JPG Compressor</a>
                        <a href="/#compress" class="block text-indigo-300/70 hover:text-white text-sm transition-colors">PNG Compressor</a>
                        <a href="/#compress" class="block text-indigo-300/70 hover:text-white text-sm transition-colors">WebP Compressor</a>
                    </nav>
                </div>

                {{-- Info --}}
                <div>
                    <h3 class="text-white font-semibold text-sm mb-3 uppercase tracking-wider">Information</h3>
                    <nav aria-label="Footer info links" class="space-y-2">
                        <a href="/sitemap.xml" class="block text-indigo-300/70 hover:text-white text-sm transition-colors" rel="nofollow">Sitemap</a>
                    </nav>
                    <div class="mt-4 space-y-1.5 text-xs text-indigo-300/50">
                        <div class="flex items-center gap-2">
                            <svg class="w-3.5 h-3.5 text-accent-400 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                            <span>Files auto-delete in 30 min</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <svg class="w-3.5 h-3.5 text-accent-400 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                            <span>100% secure &amp; private</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <svg class="w-3.5 h-3.5 text-accent-400 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            <span>Free · No signup required</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Bottom bar --}}
            <div class="pt-6 flex flex-col sm:flex-row items-center justify-between gap-3 text-xs text-indigo-300/50">
                <span>&copy; {{ date('Y') }} CompresslyPro. All rights reserved.</span>
                <div class="flex items-center gap-3 flex-wrap justify-center">
                    <span>Supported: JPG · PNG · WEBP · GIF</span>
                    <span class="w-1 h-1 bg-indigo-600 rounded-full"></span>
                    <span>Max 20MB per image</span>
                    <span class="w-1 h-1 bg-indigo-600 rounded-full"></span>
                    <a href="/sitemap.xml" class="hover:text-white transition-colors" rel="nofollow">Sitemap</a>
                </div>
            </div>

        </div>
    </footer>

    {{-- Alpine.js CDN (with collapse plugin) --}}
    <script defer src="https://cdn.jsdelivr.net/npm/@@alpinejs/collapse@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    {{-- API endpoint config (base64-encoded to avoid plain-text scraping) --}}
    <script>
        (function(){
            var _e = atob;
            window.__cp = {
                seg:  _e('{{ base64_encode(route("upload.chunk")) }}'),
                done: _e('{{ base64_encode(route("upload.finalize")) }}'),
                proc: _e('{{ base64_encode(route("image.compress")) }}'),
                xfm:  _e('{{ base64_encode(route("image.convert")) }}'),
                btch: _e('{{ base64_encode(route("batch.compress")) }}'),
                bzip: _e('{{ base64_encode(route("batch.zip")) }}'),
                rsz:  _e('{{ base64_encode(route("image.resize")) }}'),
                urlp: _e('{{ base64_encode(route("url.compress")) }}'),
                i2p:  _e('{{ base64_encode(route("image.to.pdf")) }}'),
                p2i:  _e('{{ base64_encode(route("pdf.to.image")) }}'),
                wmk:  _e('{{ base64_encode(route("image.watermark")) }}'),
            };
        })();
    </script>

    <script>
        /* ─── Tab controller ─────────────────────────────────────────── */
        function toolTabs() {
            return { activeTab: 'compress' };
        }

        /* ─── Shared chunked uploader ────────────────────────────────── */
        const CHUNK_SIZE = 1 * 1024 * 1024; // 1 MB per chunk

        async function uploadInChunks(file, onProgress) {
            const totalChunks = Math.ceil(file.size / CHUNK_SIZE);
            const uploadId    = crypto.randomUUID ? crypto.randomUUID() : Date.now().toString(36) + Math.random().toString(36).slice(2);
            const csrf        = document.querySelector('meta[name="csrf-token"]').content;

            for (let i = 0; i < totalChunks; i++) {
                const start = i * CHUNK_SIZE;
                const end   = Math.min(start + CHUNK_SIZE, file.size);
                const chunk = file.slice(start, end);

                const fd = new FormData();
                fd.append('chunk',        chunk, file.name);
                fd.append('upload_id',    uploadId);
                fd.append('chunk_index',  i);
                fd.append('total_chunks', totalChunks);

                const res = await fetch(window.__cp.seg, {
                    method: 'POST',
                    headers: { 'X-CSRF-TOKEN': csrf, 'Accept': 'application/json' },
                    body: fd,
                });
                if (!res.ok) {
                    const err = await res.json().catch(() => ({}));
                    throw new Error(err.message || `Chunk ${i} upload failed.`);
                }
                // Report progress: chunk upload counts for 80%, finalize for remaining 20%
                onProgress(Math.round(((i + 1) / totalChunks) * 80));
            }
            return { uploadId, totalChunks };
        }

        /* ─── COMPRESS component ─────────────────────────────────────── */
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
                uploadProgress: 0,
                // Clipboard state
                copied: false,
                copying: false,
                clipboardError: false,

                initComp() {
                    document.addEventListener('paste', (event) => {
                        if (document.querySelector('[x-data="toolTabs()"]')?._x_dataStack?.[0]?.activeTab !== 'compress') return;
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
                                setTimeout(() => { this.processFile(file); this.isPasting = false; }, 300);
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
                        this.state = 'error'; return;
                    }
                    if (file.size > 20 * 1024 * 1024) {
                        this.errorMessage = 'File size exceeds 20MB. Please choose a smaller image.';
                        this.state = 'error'; return;
                    }
                    this.file = file;
                    this.fileName = file.name;
                    this.fileSize = file.size;
                    this.fileType = file.type.split('/')[1];
                    if (this.fileType === 'jpeg') this.fileType = 'jpg';
                    if (this.previewUrl) URL.revokeObjectURL(this.previewUrl);
                    this.previewUrl = URL.createObjectURL(file);
                    this.state = 'settings';
                },

                async compress() {
                    this.state = 'processing';
                    this.uploadProgress = 0;
                    this.errorMessage = '';
                    this.copied = false;
                    this.clipboardError = false;
                    const csrf = document.querySelector('meta[name="csrf-token"]').content;

                    try {
                        // Small files (≤ 2MB): single direct upload
                        if (this.file.size <= 2 * 1024 * 1024) {
                            this.uploadProgress = 40;
                            const formData = new FormData();
                            formData.append('image',   this.file);
                            formData.append('quality', this.quality);
                            formData.append('format',  this.outputFormat);
                            const response = await fetch(window.__cp.proc, {
                                method: 'POST',
                                headers: { 'X-CSRF-TOKEN': csrf, 'Accept': 'application/json' },
                                body: formData,
                            });
                            this.uploadProgress = 90;
                            const data = await response.json();
                            if (!response.ok || !data.success) throw new Error(data.message || 'Compression failed. Please try again.');
                            this.uploadProgress = 100;
                            this.result = data;
                        } else {
                            // Large files: chunked upload then finalize
                            const { uploadId, totalChunks } = await uploadInChunks(this.file, p => { this.uploadProgress = p; });
                            this.uploadProgress = 85;
                            const fd = new FormData();
                            fd.append('upload_id',     uploadId);
                            fd.append('total_chunks',  totalChunks);
                            fd.append('original_name', this.file.name);
                            fd.append('action',        'compress');
                            fd.append('quality',       this.quality);
                            fd.append('format',        this.outputFormat);
                            const response = await fetch(window.__cp.done, {
                                method: 'POST',
                                headers: { 'X-CSRF-TOKEN': csrf, 'Accept': 'application/json' },
                                body: fd,
                            });
                            this.uploadProgress = 100;
                            const data = await response.json();
                            if (!response.ok || !data.success) throw new Error(data.message || 'Compression failed. Please try again.');
                            this.result = data;
                        }
                        this.state = 'result';
                    } catch (error) {
                        this.errorMessage = error.message || 'An unexpected error occurred.';
                        this.state = 'error';
                    }
                },

                /**
                 * Copy the compressed image to the system clipboard.
                 * Uses the modern Clipboard API (write + ClipboardItem).
                 * Falls back to a user-visible error notice when unavailable.
                 */
                async copyToClipboard() {
                    if (!this.result?.download_url) return;
                    this.clipboardError = false;

                    // Clipboard API requires a secure context (https or localhost)
                    if (!navigator.clipboard || !window.ClipboardItem) {
                        this.clipboardError = true;
                        return;
                    }

                    this.copying = true;
                    try {
                        const res  = await fetch(this.result.download_url);
                        const blob = await res.blob();

                        // Browsers only support writing PNG via ClipboardItem.
                        // If the compressed file is not PNG, we re-draw it on a canvas first.
                        let writeBlob = blob;
                        if (blob.type !== 'image/png') {
                            const bmp  = await createImageBitmap(blob);
                            const cvs  = document.createElement('canvas');
                            cvs.width  = bmp.width;
                            cvs.height = bmp.height;
                            cvs.getContext('2d').drawImage(bmp, 0, 0);
                            writeBlob = await new Promise(r => cvs.toBlob(r, 'image/png'));
                        }

                        await navigator.clipboard.write([
                            new ClipboardItem({ 'image/png': writeBlob }),
                        ]);
                        this.copied = true;
                        setTimeout(() => { this.copied = false; }, 2500);
                    } catch (e) {
                        // Common cause: user denied clipboard permission
                        this.clipboardError = true;
                    } finally {
                        this.copying = false;
                    }
                },

                reset() {
                    this.state = 'idle'; this.file = null; this.fileName = ''; this.fileSize = 0;
                    this.fileType = ''; this.quality = 50; this.outputFormat = 'original';
                    this.result = {}; this.errorMessage = ''; this.uploadProgress = 0;
                    this.copied = false; this.copying = false; this.clipboardError = false;
                    if (this.previewUrl) { URL.revokeObjectURL(this.previewUrl); this.previewUrl = null; }
                    if (this.$refs.fileInputC) this.$refs.fileInputC.value = '';
                },

                formatBytes(bytes, p = 2) {
                    if (bytes === 0) return '0 B';
                    const u = ['B','KB','MB','GB']; let i = 0, s = bytes;
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

        /* ─── CONVERT component ──────────────────────────────────────── */
        function converter() {
            return {
                cstate: 'idle',
                cisDragging: false,
                cerrorMessage: '',
                cfile: null,
                cfileName: '',
                cfileSize: 0,
                cfileType: '',
                ctargetFormat: '',
                cresult: {},
                cpreviewUrl: null,
                cuploadProgress: 0,

                initConv() {
                    document.addEventListener('paste', (event) => {
                        if (document.querySelector('[x-data="toolTabs()"]')?._x_dataStack?.[0]?.activeTab !== 'convert') return;
                        if (this.cstate === 'idle' || this.cstate === 'error') {
                            const items = event.clipboardData?.items;
                            if (!items) return;
                            for (let i = 0; i < items.length; i++) {
                                if (items[i].type.indexOf('image') !== -1) {
                                    event.preventDefault();
                                    const file = items[i].getAsFile();
                                    if (file) this.cProcessFile(file);
                                    break;
                                }
                            }
                        }
                    });
                },

                cHandleDrop(event) {
                    this.cisDragging = false;
                    const files = event.dataTransfer.files;
                    if (files.length > 0) this.cProcessFile(files[0]);
                },

                cHandleFileSelect(event) {
                    const files = event.target.files;
                    if (files.length > 0) this.cProcessFile(files[0]);
                },

                cProcessFile(file) {
                    this.cerrorMessage = '';
                    const allowedTypes = ['image/jpeg', 'image/png', 'image/webp', 'image/gif'];
                    if (!allowedTypes.includes(file.type)) {
                        this.cerrorMessage = 'Invalid file type. Please upload a JPG, PNG, WEBP, or GIF image.';
                        this.cstate = 'error'; return;
                    }
                    if (file.size > 20 * 1024 * 1024) {
                        this.cerrorMessage = 'File size exceeds 20MB. Please choose a smaller image.';
                        this.cstate = 'error'; return;
                    }
                    this.cfile = file;
                    this.cfileName = file.name;
                    this.cfileSize = file.size;
                    this.cfileType = file.type.split('/')[1];
                    if (this.cfileType === 'jpeg') this.cfileType = 'jpg';
                    const suggestions = { jpg: 'webp', png: 'webp', webp: 'jpg', gif: 'png' };
                    this.ctargetFormat = suggestions[this.cfileType] || 'jpg';
                    if (this.cpreviewUrl) URL.revokeObjectURL(this.cpreviewUrl);
                    this.cpreviewUrl = URL.createObjectURL(file);
                    this.cstate = 'settings';
                },

                async cconvert() {
                    if (!this.ctargetFormat) return;
                    this.cstate = 'processing';
                    this.cuploadProgress = 0;
                    this.cerrorMessage = '';
                    const csrf = document.querySelector('meta[name="csrf-token"]').content;

                    try {
                        // Small files (≤ 2MB): single direct upload
                        if (this.cfile.size <= 2 * 1024 * 1024) {
                            this.cuploadProgress = 40;
                            const formData = new FormData();
                            formData.append('image',  this.cfile);
                            formData.append('format', this.ctargetFormat);
                            const response = await fetch(window.__cp.xfm, {
                                method: 'POST',
                                headers: { 'X-CSRF-TOKEN': csrf, 'Accept': 'application/json' },
                                body: formData,
                            });
                            this.cuploadProgress = 90;
                            const data = await response.json();
                            if (!response.ok || !data.success) throw new Error(data.message || 'Conversion failed. Please try again.');
                            this.cuploadProgress = 100;
                            this.cresult = data;
                        } else {
                            // Large files: chunked upload then finalize
                            const { uploadId, totalChunks } = await uploadInChunks(this.cfile, p => { this.cuploadProgress = p; });
                            this.cuploadProgress = 85;
                            const fd = new FormData();
                            fd.append('upload_id',     uploadId);
                            fd.append('total_chunks',  totalChunks);
                            fd.append('original_name', this.cfile.name);
                            fd.append('action',        'convert');
                            fd.append('format',        this.ctargetFormat);
                            const response = await fetch(window.__cp.done, {
                                method: 'POST',
                                headers: { 'X-CSRF-TOKEN': csrf, 'Accept': 'application/json' },
                                body: fd,
                            });
                            this.cuploadProgress = 100;
                            const data = await response.json();
                            if (!response.ok || !data.success) throw new Error(data.message || 'Conversion failed. Please try again.');
                            this.cresult = data;
                        }
                        this.cstate = 'result';
                    } catch (error) {
                        this.cerrorMessage = error.message || 'An unexpected error occurred.';
                        this.cstate = 'error';
                    }
                },

                creset() {
                    this.cstate = 'idle'; this.cfile = null; this.cfileName = ''; this.cfileSize = 0;
                    this.cfileType = ''; this.ctargetFormat = ''; this.cresult = ''; this.cerrorMessage = '';
                    this.cuploadProgress = 0;
                    if (this.cpreviewUrl) { URL.revokeObjectURL(this.cpreviewUrl); this.cpreviewUrl = null; }
                    if (this.$refs.fileInputV) this.$refs.fileInputV.value = '';
                },

                cformatBytes(bytes, p = 2) {
                    if (bytes === 0) return '0 B';
                    const u = ['B','KB','MB','GB']; let i = 0, s = bytes;
                    while (s >= 1024 && i < u.length - 1) { s /= 1024; i++; }
                    return s.toFixed(p) + ' ' + u[i];
                },
            };
        }

        /* ─── Batch Compressor ───────────────────────────────────────── */
        function batchCompressor() {
            return {
                bstate: 'idle',
                bfiles: [],
                bquality: 50,
                bisDragging: false,
                berrorMessage: '',
                bresults: {},

                initBatch() {},

                get bTotalSize() {
                    return this.bfiles.reduce((s, f) => s + f.size, 0);
                },
                get bTotalSaved() {
                    if (!this.bresults.results) return 0;
                    return this.bresults.results.reduce((s, r) => {
                        if (r.success) return s + (r.original_size - r.compressed_size);
                        return s;
                    }, 0);
                },
                get bAvgReduction() {
                    if (!this.bresults.results) return 0;
                    const ok = this.bresults.results.filter(r => r.success);
                    if (!ok.length) return 0;
                    return Math.round(ok.reduce((s, r) => s + r.reduction, 0) / ok.length);
                },

                bHandleDrop(e) {
                    this.bisDragging = false;
                    const files = Array.from(e.dataTransfer.files || []);
                    this.bAddFiles(files);
                },
                bHandleFileSelect(e) {
                    const files = Array.from(e.target.files || []);
                    this.bAddFiles(files);
                    e.target.value = '';
                },
                bAddFiles(files) {
                    const allowed = ['image/jpeg','image/png','image/webp','image/gif'];
                    const valid = files.filter(f => allowed.includes(f.type) && f.size <= 20 * 1024 * 1024);
                    if (!valid.length) { this.berrorMessage = 'No valid images found (JPG/PNG/WebP/GIF, max 20MB each).'; return; }
                    const combined = [...this.bfiles, ...valid].slice(0, 20);
                    if (this.bfiles.length + valid.length > 20) {
                        this.berrorMessage = 'Maximum 20 files allowed. Only the first 20 were kept.';
                    } else {
                        this.berrorMessage = '';
                    }
                    this.bfiles = combined;
                    this.bstate = 'settings';
                },

                async bCompress() {
                    if (!this.bfiles.length) return;
                    this.bstate = 'processing';
                    this.berrorMessage = '';
                    const fd = new FormData();
                    this.bfiles.forEach(f => fd.append('images[]', f));
                    fd.append('quality', this.bquality);
                    try {
                        const res = await fetch(window.__cp.btch, {
                            method: 'POST',
                            headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content },
                            body: fd,
                        });
                        const data = await res.json();
                        if (!res.ok) throw new Error(data.message || 'Batch compression failed.');
                        this.bresults = data;
                        this.bstate = 'result';
                    } catch (err) {
                        this.berrorMessage = err.message || 'An error occurred.';
                        this.bstate = 'error';
                    }
                },

                async bDownloadZip() {
                    if (!this.bresults.filenames || !this.bresults.filenames.length) return;
                    const fd = new FormData();
                    this.bresults.filenames.forEach(fn => fd.append('filenames[]', fn));
                    fd.append('batch_id', this.bresults.batch_id || '');
                    try {
                        const res = await fetch(window.__cp.bzip, {
                            method: 'POST',
                            headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content },
                            body: fd,
                        });
                        if (!res.ok) { const d = await res.json(); throw new Error(d.message || 'ZIP error.'); }
                        const blob = await res.blob();
                        const url = URL.createObjectURL(blob);
                        const a = document.createElement('a');
                        a.href = url; a.download = 'compressed-batch.zip'; a.click();
                        setTimeout(() => URL.revokeObjectURL(url), 5000);
                    } catch (err) {
                        this.berrorMessage = err.message || 'Could not download ZIP.';
                    }
                },

                bReset() {
                    this.bstate = 'idle'; this.bfiles = []; this.bresults = {};
                    this.berrorMessage = ''; this.bquality = 50;
                },

                bFormatBytes(bytes, p = 1) {
                    if (!bytes || bytes === 0) return '0 B';
                    const u = ['B','KB','MB','GB']; let i = 0, s = bytes;
                    while (s >= 1024 && i < u.length - 1) { s /= 1024; i++; }
                    return s.toFixed(p) + ' ' + u[i];
                },
            };
        }

        /* ─── Resizer ────────────────────────────────────────────────── */
        function resizer() {
            return {
                rstate: 'idle',
                rfile: null,
                rfileName: '',
                rfileSize: 0,
                rmode: 'max_width',
                rwidth: 1920,
                rheight: 1080,
                rpercentage: 50,
                rquality: 85,
                rformat: 'original',
                rresult: {},
                rerrorMessage: '',
                risDragging: false,
                rpreviewUrl: null,
                rorigW: 0,
                rorigH: 0,

                initResize() {},

                rHandleDrop(e) {
                    this.risDragging = false;
                    const file = (e.dataTransfer.files || [])[0];
                    if (file) this.rSetFile(file);
                },
                rHandleFileSelect(e) {
                    const file = (e.target.files || [])[0];
                    if (file) { this.rSetFile(file); e.target.value = ''; }
                },
                rSetFile(file) {
                    const allowed = ['image/jpeg','image/png','image/webp','image/gif'];
                    if (!allowed.includes(file.type)) { this.rerrorMessage = 'Only JPG, PNG, WebP, GIF supported.'; this.rstate = 'error'; return; }
                    if (file.size > 20 * 1024 * 1024) { this.rerrorMessage = 'File too large (max 20MB).'; this.rstate = 'error'; return; }
                    this.rerrorMessage = '';
                    this.rfile = file;
                    this.rfileName = file.name;
                    this.rfileSize = file.size;
                    if (this.rpreviewUrl) URL.revokeObjectURL(this.rpreviewUrl);
                    this.rpreviewUrl = URL.createObjectURL(file);
                    const img = new Image();
                    img.onload = () => { this.rorigW = img.naturalWidth; this.rorigH = img.naturalHeight; };
                    img.src = this.rpreviewUrl;
                    this.rstate = 'settings';
                },

                async rResize() {
                    if (!this.rfile) return;
                    this.rstate = 'processing';
                    this.rerrorMessage = '';
                    const fd = new FormData();
                    fd.append('image', this.rfile);
                    fd.append('mode', this.rmode);
                    fd.append('quality', this.rquality);
                    fd.append('format', this.rformat);
                    if (this.rmode === 'percentage') { fd.append('percentage', this.rpercentage); }
                    else if (this.rmode === 'max_width') { fd.append('width', this.rwidth); }
                    else if (this.rmode === 'max_height') { fd.append('height', this.rheight); }
                    else if (this.rmode === 'exact') { fd.append('width', this.rwidth); fd.append('height', this.rheight); }
                    try {
                        const res = await fetch(window.__cp.rsz, {
                            method: 'POST',
                            headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content },
                            body: fd,
                        });
                        const data = await res.json();
                        if (!res.ok) throw new Error(data.message || 'Resize failed.');
                        this.rresult = data;
                        this.rstate = 'result';
                    } catch (err) {
                        this.rerrorMessage = err.message || 'An error occurred.';
                        this.rstate = 'error';
                    }
                },

                rReset() {
                    this.rstate = 'idle'; this.rfile = null; this.rfileName = '';
                    this.rfileSize = 0; this.rresult = {}; this.rerrorMessage = '';
                    this.rorigW = 0; this.rorigH = 0;
                    if (this.rpreviewUrl) { URL.revokeObjectURL(this.rpreviewUrl); this.rpreviewUrl = null; }
                },

                rformatBytes(bytes, p = 1) {
                    if (!bytes || bytes === 0) return '0 B';
                    const u = ['B','KB','MB','GB']; let i = 0, s = bytes;
                    while (s >= 1024 && i < u.length - 1) { s /= 1024; i++; }
                    return s.toFixed(p) + ' ' + u[i];
                },
            };
        }

        /* ─── Watermark Tool ─────────────────────────────────────────── */
        function watermarkTool() {
            return {
                wstate: 'idle',
                wfile: null,
                wfileName: '',
                wtext: '',
                wposition: 'bottom-right',
                wopacity: 70,
                wresult: {},
                werrorMessage: '',
                initWatermark() {},
                wHandleFile(e) {
                    const file = (e.target.files || [])[0];
                    if (!file) return;
                    const ok = ['image/jpeg','image/png','image/webp'];
                    if (!ok.includes(file.type)) { this.werrorMessage = 'Only JPG/PNG/WebP supported.'; return; }
                    if (file.size > 20 * 1024 * 1024) { this.werrorMessage = 'Max 20MB.'; return; }
                    this.werrorMessage = ''; this.wfile = file; this.wfileName = file.name;
                    this.wstate = 'settings';
                    e.target.value = '';
                },
                async wApply() {
                    if (!this.wfile || !this.wtext.trim()) return;
                    this.wstate = 'processing';
                    const fd = new FormData();
                    fd.append('image', this.wfile);
                    fd.append('text', this.wtext);
                    fd.append('position', this.wposition);
                    fd.append('opacity', this.wopacity);
                    try {
                        const res = await fetch(window.__cp.wmk, {
                            method: 'POST',
                            headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content },
                            body: fd,
                        });
                        const data = await res.json();
                        if (!res.ok) throw new Error(data.message || 'Watermark failed.');
                        this.wresult = data; this.wstate = 'result';
                    } catch (err) {
                        this.werrorMessage = err.message || 'Error applying watermark.';
                        this.wstate = 'settings';
                    }
                },
                wReset() {
                    this.wstate = 'idle'; this.wfile = null; this.wfileName = '';
                    this.wtext = ''; this.wresult = {}; this.werrorMessage = '';
                },
            };
        }

        /* ─── URL Compressor ─────────────────────────────────────────── */
        function urlCompressor() {
            return {
                ustate: 'idle',
                uurl: '',
                uquality: 50,
                uresult: {},
                uerrorMessage: '',
                async uCompress() {
                    if (!this.uurl.trim()) return;
                    this.ustate = 'processing';
                    this.uerrorMessage = '';
                    const fd = new FormData();
                    fd.append('url', this.uurl);
                    fd.append('quality', this.uquality);
                    try {
                        const res = await fetch(window.__cp.urlp, {
                            method: 'POST',
                            headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content },
                            body: fd,
                        });
                        const data = await res.json();
                        if (!res.ok) throw new Error(data.message || 'URL compression failed.');
                        this.uresult = data; this.ustate = 'result';
                    } catch (err) {
                        this.uerrorMessage = err.message || 'An error occurred.';
                        this.ustate = 'error';
                    }
                },
                uReset() {
                    this.ustate = 'idle'; this.uurl = ''; this.uresult = {}; this.uerrorMessage = '';
                },
            };
        }

        /* ─── Image → PDF Tool ───────────────────────────────────────── */
        function imgToPdfTool() {
            return {
                pstate: 'idle',
                pfile: null,
                pfileName: '',
                ppageSize: 'A4',
                porientation: 'portrait',
                presult: {},
                perrorMessage: '',
                pHandleFile(e) {
                    const file = (e.target.files || [])[0];
                    if (!file) return;
                    const ok = ['image/jpeg','image/png','image/webp'];
                    if (!ok.includes(file.type)) { this.perrorMessage = 'Only JPG/PNG/WebP supported.'; return; }
                    if (file.size > 20 * 1024 * 1024) { this.perrorMessage = 'Max 20MB.'; return; }
                    this.perrorMessage = ''; this.pfile = file; this.pfileName = file.name;
                    this.pstate = 'settings';
                    e.target.value = '';
                },
                async pConvert() {
                    if (!this.pfile) return;
                    this.pstate = 'processing';
                    const fd = new FormData();
                    fd.append('image', this.pfile);
                    fd.append('page_size', this.ppageSize);
                    fd.append('orientation', this.porientation);
                    try {
                        const res = await fetch(window.__cp.i2p, {
                            method: 'POST',
                            headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content },
                            body: fd,
                        });
                        const data = await res.json();
                        if (!res.ok) throw new Error(data.message || 'PDF conversion failed.');
                        this.presult = data; this.pstate = 'result';
                    } catch (err) {
                        this.perrorMessage = err.message || 'An error occurred.';
                        this.pstate = 'error';
                    }
                },
                pReset() {
                    this.pstate = 'idle'; this.pfile = null; this.pfileName = '';
                    this.presult = {}; this.perrorMessage = '';
                },
            };
        }

        /* ─── PDF → Image Tool ───────────────────────────────────────── */
        function pdfToImgTool() {
            return {
                pdfistate: 'idle',
                pdfifile: null,
                pdfifileName: '',
                pdfiformat: 'jpg',
                pdfidpi: 150,
                pdfiresult: {},
                pdfierrorMessage: '',
                pdfiHandleFile(e) {
                    const file = (e.target.files || [])[0];
                    if (!file) return;
                    if (file.type !== 'application/pdf') { this.pdfierrorMessage = 'Only PDF files supported.'; return; }
                    if (file.size > 20 * 1024 * 1024) { this.pdfierrorMessage = 'Max 20MB.'; return; }
                    this.pdfierrorMessage = ''; this.pdfifile = file; this.pdfifileName = file.name;
                    this.pdfistate = 'settings';
                    e.target.value = '';
                },
                async pdfiConvert() {
                    if (!this.pdfifile) return;
                    this.pdfistate = 'processing';
                    const fd = new FormData();
                    fd.append('pdf', this.pdfifile);
                    fd.append('format', this.pdfiformat);
                    fd.append('dpi', this.pdfidpi);
                    try {
                        const res = await fetch(window.__cp.p2i, {
                            method: 'POST',
                            headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content },
                            body: fd,
                        });
                        const data = await res.json();
                        if (!res.ok) throw new Error(data.message || 'Conversion failed.');
                        this.pdfiresult = data; this.pdfistate = 'result';
                    } catch (err) {
                        this.pdfierrorMessage = err.message || 'An error occurred.';
                        this.pdfistate = 'error';
                    }
                },
                pdfiReset() {
                    this.pdfistate = 'idle'; this.pdfifile = null; this.pdfifileName = '';
                    this.pdfiresult = {}; this.pdfierrorMessage = '';
                },
            };
        }
    </script>
</body>
</html>
