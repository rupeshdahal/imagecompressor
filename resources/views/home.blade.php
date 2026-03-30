<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="google-adsense-account" content="ca-pub-6697940390340424">

    {{-- Favicon --}}
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32.png') }}">
    <link rel="icon" type="image/png" sizes="48x48" href="{{ asset('favicon-48.png') }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('icon-192.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
    <link rel="manifest" href="{{ asset('manifest.json') }}">

    {{-- SEO Meta --}}
    <title>Compress Images Online Free — Image Compressor, Converter, Resizer & PDF | CompresslyPro</title>
    <meta name="description" content="Free online image tools: compress JPG, PNG & WebP up to 90% smaller, convert formats, resize images, add watermarks, batch compress, convert images to PDF and PDF to images. No signup. Privacy-first. Up to 20MB.">
    <meta name="keywords" content="compress image online free, image compressor, reduce image size, compress jpg online, compress png online, compress webp online, reduce image file size, image optimizer, image converter online, resize image online free, image to pdf converter free, pdf to image online, add watermark to image free, batch image compressor, compress image for email, compress image for website, compress photo online, reduce photo size, online image tool, free image compressor, image resizer online, compress image without losing quality, jpg to pdf online free, png to jpg converter, webp converter, compress image 50kb, compress image 100kb, compress image to 200kb">
    <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
    <meta name="author" content="CompresslyPro">
    <link rel="canonical" href="{{ url('/') }}">

    {{-- Additional SEO --}}
    <meta name="application-name" content="CompresslyPro">
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
    <meta property="og:title" content="Compress Images Online Free — Image Compressor, Converter & Resizer | CompresslyPro">
    <meta property="og:description" content="Compress JPG, PNG & WebP up to 90% smaller, convert formats, resize images, batch compress, add watermarks, and convert to/from PDF. Free, no signup required.">
    <meta property="og:url" content="{{ url('/') }}">
    <meta property="og:site_name" content="CompresslyPro">
    <meta property="og:locale" content="en_US">
    <meta property="og:image" content="{{ asset('og-image.png') }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:alt" content="CompresslyPro — Free Online Image Compressor and Converter">
    <meta property="og:image:type" content="image/png">

    {{-- Twitter Card --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Compress Images Online Free — Image Compressor, Converter & Resizer | CompresslyPro">
    <meta name="twitter:description" content="Compress JPG, PNG & WebP up to 90% smaller. Convert, resize, watermark, batch compress & PDF tools — all free, no signup.">
    <meta name="twitter:image" content="{{ asset('og-image.png') }}">
    <meta name="twitter:image:alt" content="CompresslyPro — Free Online Image Compressor and Converter">
    <meta name="twitter:creator" content="@compresslypro">
    <meta name="twitter:site" content="@compresslypro">

    {{-- Google Site Verification --}}
    @if(config('services.google_site_verification'))
    <meta name="google-site-verification" content="{{ config('services.google_site_verification') }}" />
    @endif
    @if(config('services.bing_site_verification'))
    <meta name="msvalidate.01" content="{{ config('services.bing_site_verification') }}" />
    @endif
    @if(config('services.yandex_site_verification'))
    <meta name="yandex-verification" content="{{ config('services.yandex_site_verification') }}" />
    @endif
    @if(config('services.baidu_site_verification'))
    <meta name="baidu-site-verification" content="{{ config('services.baidu_site_verification') }}" />
    @endif

    {{-- Schema Markup — raw block prevents Blade parsing @context/@type --}}
    @verbatim
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": ["WebApplication", "SoftwareApplication"],
        "name": "CompresslyPro",
        "alternateName": ["CompresslyPro Image Tools", "Free Image Compressor Online"],
        "description": "Free online image tools: compress JPG, PNG, WebP up to 90% smaller, convert formats, resize images, add watermarks, batch compress, and convert images to/from PDF. No signup required. Privacy-first.",
        "image": [
            "https://compresslypro.com/og-image.png"
        ],
        "url": "https://compresslypro.com",
        "applicationCategory": "MultimediaApplication",
        "applicationSubCategory": "Image Editing",
        "operatingSystem": "All",
        "browserRequirements": "Requires JavaScript. Requires HTML5.",
        "softwareVersion": "2.0",
        "datePublished": "2024-01-01",
        "dateModified": "2026-03-03",
        "inLanguage": "en",
        "isAccessibleForFree": true,
        "offers": {
            "@type": "Offer",
            "price": "0",
            "priceCurrency": "USD",
            "availability": "https://schema.org/InStock",
            "priceValidUntil": "2030-12-31"
        },
        "creator": {
            "@type": "Organization",
            "name": "CompresslyPro",
            "url": "https://compresslypro.com"
        },
        "featureList": [
            "Compress JPG/JPEG images online free",
            "Compress PNG images online free",
            "Compress WebP images online free",
            "Compress GIF images online free",
            "Convert image formats (JPG, PNG, WebP)",
            "Resize images — percentage, max width, max height, exact dimensions",
            "Batch compress up to 20 images and download as ZIP",
            "Add text watermark to images with custom position and opacity",
            "Compress images from URL",
            "Convert images to PDF (A4, A3, Letter, Legal)",
            "Convert PDF to image (JPG, PNG, WebP)",
            "Adjustable quality control (10-90%)",
            "Before/after visual comparison slider",
            "Copy compressed image to clipboard",
            "No signup or registration required",
            "Free unlimited image compressions",
            "Fast processing under 5 seconds",
            "Secure — files auto-deleted after 30 minutes",
            "Drag and drop image upload",
            "Paste from clipboard support",
            "Up to 20MB file size support",
            "Mobile-friendly and fully responsive"
        ],
        "screenshot": [
            "https://compresslypro.com/og-image.png"
        ],
        "potentialAction": {
            "@type": "UseAction",
            "target": {
                "@type": "EntryPoint",
                "urlTemplate": "https://compresslypro.com",
                "actionPlatform": [
                    "https://schema.org/DesktopWebPlatform",
                    "https://schema.org/MobileWebPlatform",
                    "https://schema.org/IOSPlatform",
                    "https://schema.org/AndroidPlatform"
                ]
            }
        },
        "aggregateRating": {
            "@type": "AggregateRating",
            "ratingValue": "4.8",
            "ratingCount": "3124",
            "reviewCount": "3124",
            "bestRating": "5",
            "worstRating": "1"
        }
    }
    </script>
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "ItemList",
        "name": "Free Online Image Tools by CompresslyPro",
        "description": "7 free online image processing tools — no signup required",
        "numberOfItems": 7,
        "itemListElement": [
            {
                "@type": "ListItem",
                "position": 1,
                "name": "Free Image Compressor Online",
                "url": "https://compresslypro.com/#compress",
                "description": "Compress JPG, PNG, WebP and GIF images up to 90% smaller online for free. Adjustable quality with before/after comparison."
            },
            {
                "@type": "ListItem",
                "position": 2,
                "name": "Image Format Converter",
                "url": "https://compresslypro.com/#convert",
                "description": "Convert images between JPG, PNG and WebP formats online free. High quality conversion."
            },
            {
                "@type": "ListItem",
                "position": 3,
                "name": "Batch Image Compressor",
                "url": "https://compresslypro.com/#batch",
                "description": "Compress up to 20 images at once and download all results as a single ZIP file."
            },
            {
                "@type": "ListItem",
                "position": 4,
                "name": "Image Resizer Online Free",
                "url": "https://compresslypro.com/#resize",
                "description": "Resize images by percentage, max width, max height, or exact pixel dimensions. Aspect ratio preserved."
            },
            {
                "@type": "ListItem",
                "position": 5,
                "name": "Add Watermark to Image Free",
                "url": "https://compresslypro.com/#tools",
                "description": "Add custom text watermarks to images with adjustable position, opacity and font size."
            },
            {
                "@type": "ListItem",
                "position": 6,
                "name": "Image to PDF Converter Free",
                "url": "https://compresslypro.com/#tools",
                "description": "Convert JPG, PNG or WebP images to PDF in A4, A3, Letter or Legal size. Free, no signup."
            },
            {
                "@type": "ListItem",
                "position": 7,
                "name": "PDF to Image Converter",
                "url": "https://compresslypro.com/#tools",
                "description": "Extract PDF pages as JPG, PNG or WebP images online free."
            }
        ]
    }
    </script>
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "BreadcrumbList",
        "itemListElement": [
            {
                "@type": "ListItem",
                "position": 1,
                "name": "Home",
                "item": "https://compresslypro.com"
            },
            {
                "@type": "ListItem",
                "position": 2,
                "name": "Image Compressor",
                "item": "https://compresslypro.com/#compress"
            },
            {
                "@type": "ListItem",
                "position": 3,
                "name": "Image Converter",
                "item": "https://compresslypro.com/#convert"
            },
            {
                "@type": "ListItem",
                "position": 4,
                "name": "Image Resizer",
                "item": "https://compresslypro.com/#resize"
            }
        ]
    }
    </script>
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "HowTo",
        "name": "How to Use CompresslyPro Image Tools",
        "description": "Step-by-step guide to compress, convert, resize or process your images using our free online tools",
        "totalTime": "PT2M",
        "step": [
            {
                "@type": "HowToStep",
                "position": 1,
                "name": "Choose a Tool",
                "text": "Select the tool you need — Compress, Convert, Batch, Resize, Watermark, Image-to-PDF, or PDF-to-Image — from the tabs at the top.",
                "image": "https://compresslypro.com/og-image.png"
            },
            {
                "@type": "HowToStep",
                "position": 2,
                "name": "Upload Your Image",
                "text": "Drag and drop your image, click to browse files, or paste from clipboard (Ctrl+V / Cmd+V). Supports JPG, PNG, WebP, GIF up to 20MB.",
                "image": "https://compresslypro.com/og-image.png"
            },
            {
                "@type": "HowToStep",
                "position": 3,
                "name": "Adjust Settings",
                "text": "Choose compression quality (10–90%), target format, resize dimensions, watermark text, PDF page size, or other tool-specific options.",
                "image": "https://compresslypro.com/og-image.png"
            },
            {
                "@type": "HowToStep",
                "position": 4,
                "name": "Download Result",
                "text": "Click the Download button to save your processed image. For batch jobs, download all files as a single ZIP archive.",
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
                "name": "Is CompresslyPro free to use?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "Yes, all tools on CompresslyPro are 100% free with no signup required. No watermarks, no hidden fees, no limits on usage."
                }
            },
            {
                "@type": "Question",
                "name": "How do I compress an image online for free?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "To compress an image online free: 1) Go to CompresslyPro.com, 2) Drag & drop your JPG, PNG or WebP image, 3) Adjust quality slider (50% recommended for best balance), 4) Click Download. Your image will be compressed up to 90% smaller with minimal quality loss."
                }
            },
            {
                "@type": "Question",
                "name": "How can I compress an image without losing quality?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "Use our smart compression algorithm at 70-80% quality setting. This reduces file size by 50-70% while keeping the image visually identical to the original. Use our before/after slider to verify quality before downloading."
                }
            },
            {
                "@type": "Question",
                "name": "How do I reduce image file size for email?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "To compress an image for email: upload it to CompresslyPro, set quality to 60-70%, and download. Most email attachments should be under 1MB. Our tool can reduce a 5MB photo to under 500KB while keeping it looking great."
                }
            },
            {
                "@type": "Question",
                "name": "What image formats are supported?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "We support JPG/JPEG, PNG, WebP, and GIF for compression, conversion and resizing. PDF is supported for image-to-PDF and PDF-to-image conversion. Max file size is 20MB per file."
                }
            },
            {
                "@type": "Question",
                "name": "Can I convert JPG to PDF online free?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "Yes! Click the 'More Tools' tab, then select 'Image → PDF'. Upload your JPG, PNG or WebP image, choose page size (A4, A3, Letter, Legal) and orientation (portrait or landscape), then click Convert. No signup needed."
                }
            },
            {
                "@type": "Question",
                "name": "Can I resize images online for free?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "Yes! Use the Resize tab to resize images by percentage, max width, max height, or exact pixel dimensions. Aspect ratio is preserved automatically unless you choose exact dimensions."
                }
            },
            {
                "@type": "Question",
                "name": "How do I compress multiple images at once?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "Use the Batch tab to upload up to 20 images at once. They are all compressed in parallel and you can download them all as a single ZIP file with one click."
                }
            },
            {
                "@type": "Question",
                "name": "How do I add a watermark to an image?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "Use the Watermark tool in the More Tools tab. Enter your watermark text, choose position (center, top-left, top-right, bottom-left, bottom-right) and adjust opacity, then download the watermarked image."
                }
            },
            {
                "@type": "Question",
                "name": "Are my images stored on the server?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "Uploaded images are automatically deleted from our servers within 30 minutes. We never store, share, sell or analyze your images. Your privacy is fully protected."
                }
            },
            {
                "@type": "Question",
                "name": "What is the best free image compressor online?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "CompresslyPro is a top-rated free online image compressor that supports JPG, PNG, WebP and GIF. It offers up to 90% size reduction, real-time before/after comparison, batch compression, and 7 total image processing tools — all free with no signup."
                }
            },
            {
                "@type": "Question",
                "name": "Can I compress an image to a specific size like 100KB or 200KB?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "Yes — adjust the quality slider to control output size. Start at 60% quality for typical photos: this usually produces files between 100-300KB depending on image complexity. The result shows exact file size before you download."
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
        "alternateName": "compresslypro.com",
        "url": "https://compresslypro.com",
        "logo": {
            "@type": "ImageObject",
            "url": "https://compresslypro.com/logo.png",
            "width": 512,
            "height": 512
        },
        "description": "Free online image tools — compress, convert, resize, watermark, batch compress, and convert between image and PDF formats. No signup required.",
        "sameAs": [
            "https://twitter.com/compresslypro"
        ],
        "contactPoint": {
            "@type": "ContactPoint",
            "contactType": "customer support",
            "availableLanguage": "English"
        }
    }
    </script>
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "WebSite",
        "name": "CompresslyPro",
        "alternateName": ["Free Image Compressor Online", "compresslypro.com"],
        "url": "https://compresslypro.com",
        "description": "Free online image tools — compress JPG/PNG/WebP up to 90% smaller, convert formats, resize, watermark, batch compress, image to PDF and PDF to image.",
        "inLanguage": "en",
        "potentialAction": {
            "@type": "SearchAction",
            "target": {
                "@type": "EntryPoint",
                "urlTemplate": "https://compresslypro.com/?q={search_term_string}"
            },
            "query-input": "required name=search_term_string"
        }
    }
    </script>
    @endverbatim

    {{-- Tailwind CSS CDN --}}
    <link rel="preconnect" href="https://cdn.tailwindcss.com">
    <link rel="dns-prefetch" href="https://cdn.tailwindcss.com">
    <link rel="dns-prefetch" href="https://cdn.jsdelivr.net">
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
                <a href="/" class="flex items-center gap-2.5 group flex-shrink-0">
                    <img src="{{ asset('logo.png') }}" alt="CompresslyPro" class="h-10 sm:h-12 w-auto transition-all flex-shrink-0">
                    <div class="flex flex-col leading-tight">
                        <span class="text-white font-bold text-base sm:text-lg tracking-tight group-hover:text-indigo-200 transition-colors">CompresslyPro</span>
                        <span class="text-indigo-300/70 text-[10px] sm:text-xs font-medium hidden sm:block tracking-wide">Free Image Tools</span>
                    </div>
                </a>
                {{-- Desktop nav links --}}
                <nav aria-label="Main navigation" class="hidden md:flex items-center gap-1">
                    <a href="{{ route('tool.compress') }}" class="text-indigo-200/70 hover:text-white text-xs font-medium px-3 py-2 rounded-lg hover:bg-white/10 transition-all">Compress</a>
                    <a href="{{ route('tool.convert') }}" class="text-indigo-200/70 hover:text-white text-xs font-medium px-3 py-2 rounded-lg hover:bg-white/10 transition-all">Convert</a>
                    <a href="{{ route('tool.resize') }}" class="text-indigo-200/70 hover:text-white text-xs font-medium px-3 py-2 rounded-lg hover:bg-white/10 transition-all">Resize</a>
                    <a href="{{ route('tool.batch') }}" class="text-indigo-200/70 hover:text-white text-xs font-medium px-3 py-2 rounded-lg hover:bg-white/10 transition-all">Batch</a>
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

    {{-- Hero Section --}}
    <header class="hero-bg pt-10 pb-6 sm:pt-14 sm:pb-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="inline-flex items-center gap-2 bg-brand-50 text-brand-700 text-sm font-medium px-4 py-1.5 rounded-full mb-4 animate-slide-down">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                100% Free · No Signup · 7 Powerful Tools
            </div>
            {{-- Social proof --}}
            <div class="flex items-center justify-center gap-2 mb-5 animate-slide-down">
                <div class="flex items-center gap-0.5">
                    @for($i=0;$i<5;$i++)<svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>@endfor
                </div>
                <span class="text-sm font-semibold text-gray-700">4.8/5</span>
                <span class="text-sm text-gray-400">·</span>
                <span class="text-sm text-gray-500">4,200+ happy users</span>
                <span class="text-sm text-gray-400">·</span>
                <span class="text-sm text-gray-500">4.2M+ images compressed</span>
            </div>
            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight leading-tight mb-5">
                Compress Images
                <span class="gradient-text">Online Free</span>
            </h1>
            <p class="text-lg sm:text-xl text-gray-500 max-w-2xl mx-auto leading-relaxed mb-6">
                <strong class="text-gray-700">Reduce JPG, PNG &amp; WebP up to 90% smaller</strong> — plus convert formats, resize, add watermarks, batch compress &amp; convert Image ↔ PDF. Free, no signup, no limits.
            </p>
            {{-- Quick tool pills --}}
            <div class="flex flex-wrap justify-center gap-2 text-xs font-semibold">
                <a href="#compress" class="bg-brand-100 text-brand-700 px-3 py-1.5 rounded-full hover:bg-brand-200 transition-colors">🗜️ Compress</a>
                <a href="#convert" class="bg-purple-100 text-purple-700 px-3 py-1.5 rounded-full hover:bg-purple-200 transition-colors">🔄 Convert</a>
                <a href="#batch" class="bg-blue-100 text-blue-700 px-3 py-1.5 rounded-full hover:bg-blue-200 transition-colors">📦 Batch ZIP</a>
                <a href="#resize" class="bg-orange-100 text-orange-700 px-3 py-1.5 rounded-full hover:bg-orange-200 transition-colors">↔ Resize</a>
                <a href="#tools" class="bg-pink-100 text-pink-700 px-3 py-1.5 rounded-full hover:bg-pink-200 transition-colors">🖊️ Watermark</a>
                <a href="#tools" class="bg-red-100 text-red-700 px-3 py-1.5 rounded-full hover:bg-red-200 transition-colors">📄 Image→PDF</a>
                <a href="#tools" class="bg-indigo-100 text-indigo-700 px-3 py-1.5 rounded-full hover:bg-indigo-200 transition-colors">🖼️ PDF→Image</a>
            </div>
        </div>
    </header>

    {{-- Breadcrumb (visible + SEO) --}}
    {{-- <nav aria-label="Breadcrumb" class="w-full px-4 sm:px-6 lg:px-8 pt-4 pb-1">
        <ol class="flex items-center gap-1.5 text-xs text-gray-400" itemscope itemtype="https://schema.org/BreadcrumbList">
            <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                <a href="/" itemprop="item" class="hover:text-brand-600 transition-colors font-medium">
                    <span itemprop="name">Home</span>
                </a>
                <meta itemprop="position" content="1">
            </li>
            <li><svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg></li>
            <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                <span itemprop="name" class="text-gray-600 font-medium">Free Image Tools</span>
                <meta itemprop="position" content="2">
            </li>
        </ol>
    </nav> --}}

    {{-- ============================================================ --}}
    {{-- TOOL TABS: Compress / Convert / Batch / Resize / PDF        --}}
    {{-- ============================================================ --}}
    <div id="tools-section" class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 -mt-2 pb-12" x-data="toolTabs()"
         x-init="
            const hash = window.location.hash.replace('#','');
            if (['compress','convert','batch','resize','tools'].includes(hash)) activeTab = hash;
            window.addEventListener('hashchange', () => {
                const h = window.location.hash.replace('#','');
                if (['compress','convert','batch','resize','tools'].includes(h)) { activeTab = h; $el.scrollIntoView({behavior:'smooth',block:'start'}); }
            });
         ">

        {{-- Tab Switcher --}}
        <div id="compress" class="flex gap-1 bg-gray-100 rounded-2xl p-1 mb-6 shadow-sm overflow-x-auto">
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
               x-data="compressor()" x-init="initComp()">

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
                        <button x-on:click="downloadFromUrl(result.download_url, result.filename)"
                           class="flex-1 bg-gradient-to-r from-accent-600 to-accent-700 hover:from-accent-700 hover:to-accent-800 text-white font-bold py-4 px-6 rounded-2xl transition-all duration-200 flex items-center justify-center gap-2.5 text-base shadow-xl shadow-accent-500/25 hover:scale-[1.02] active:scale-[0.98]">
                            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            Download
                        </button>

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
                        <button x-on:click="downloadFromUrl(cresult.download_url, cresult.filename)"
                           class="flex-1 bg-gradient-to-r from-purple-600 to-purple-700 hover:from-purple-700 hover:to-purple-800 text-white font-bold py-4 px-6 rounded-2xl transition-all duration-200 flex items-center justify-center gap-2.5 text-lg shadow-xl shadow-purple-500/25 hover:scale-[1.02] active:scale-[0.98]">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            Download Converted
                        </button>
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
                    <h3 class="text-2xl font-bold mb-2">Processing batch…</h3>
                    <p class="text-gray-500 mb-4 truncate max-w-xs mx-auto text-sm" x-text="bCurrentFile || ('Uploading ' + bfiles.length + ' images…')"></p>
                    {{-- Progress bar --}}
                    <div class="w-full bg-gray-100 rounded-full h-2.5 overflow-hidden">
                        <div class="bg-blue-600 h-2.5 rounded-full transition-all duration-300"
                             :style="'width:' + buploadProgress + '%'"></div>
                    </div>
                    <p class="text-xs text-gray-400 mt-2" x-text="buploadProgress + '%'"></p>
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
                                        <button x-on:click="downloadFromUrl(r.download_url, r.filename)" class="px-2 py-1 bg-blue-50 hover:bg-blue-100 text-blue-600 text-xs font-semibold rounded-lg transition-all">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 10v6m0 0l-3-3m3 3l3-3"/></svg>
                                        </button>
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
                        <button x-on:click="downloadFromUrl(rresult.download_url, rresult.filename)"
                           class="flex-1 bg-gradient-to-r from-orange-600 to-orange-700 hover:from-orange-700 hover:to-orange-800 text-white font-bold py-4 px-6 rounded-2xl flex items-center justify-center gap-2.5 text-lg shadow-xl shadow-orange-500/25 hover:scale-[1.02]">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            Download Resized
                        </button>
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
                            <p class="text-xs text-gray-500">Text watermark with full customization</p>
                        </div>
                    </div>
                    <div class="p-5 space-y-4">
                        {{-- Idle / Drop zone --}}
                        <div x-show="wstate === 'idle' || wstate === 'error'">
                            <div x-on:click="$refs.wFileInput.click()" class="border-2 border-dashed border-gray-200 rounded-2xl p-6 text-center cursor-pointer hover:border-pink-400 hover:bg-pink-50 transition-all">
                                <input type="file" x-ref="wFileInput" accept=".jpg,.jpeg,.png,.webp" x-on:change="wHandleFile($event)" class="hidden">
                                <svg class="w-8 h-8 text-gray-300 mx-auto mb-2" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5"/></svg>
                                <p class="text-sm text-gray-400">Click to select image</p>
                                <p class="text-xs text-gray-300 mt-1">JPG, PNG, WebP · max 20MB</p>
                            </div>
                        </div>

                        {{-- Settings panel --}}
                        <div x-show="wstate === 'settings'" class="space-y-4">
                            {{-- File name + reset --}}
                            <div class="flex items-center gap-2 bg-gray-50 rounded-xl px-3 py-2">
                                <svg class="w-4 h-4 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909M3 21h18M3.75 3h16.5"/></svg>
                                <span class="text-xs text-gray-700 truncate flex-1" x-text="wfileName"></span>
                                <button x-on:click="wReset()" class="text-gray-400 hover:text-red-500 flex-shrink-0"><svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg></button>
                            </div>

                            {{-- Watermark text --}}
                            <div>
                                <label class="text-xs font-semibold text-gray-600 mb-1.5 block">Watermark Text</label>
                                <input type="text" x-model="wtext" maxlength="200" placeholder="© YourBrand 2024"
                                    class="w-full border border-gray-300 rounded-xl px-3 py-2.5 text-sm focus:ring-2 focus:ring-pink-400 focus:border-transparent outline-none">
                            </div>

                            {{-- Font + Size row --}}
                            <div class="grid grid-cols-2 gap-3">
                                <div>
                                    <label class="text-xs font-semibold text-gray-600 mb-1.5 block">Font</label>
                                    <select x-model="wfontFamily" class="w-full border border-gray-300 rounded-xl px-3 py-2 text-sm focus:ring-2 focus:ring-pink-400 outline-none bg-white">
                                        <option value="arial">Arial</option>
                                        <option value="georgia">Georgia</option>
                                        <option value="impact">Impact</option>
                                        <option value="courier">Courier</option>
                                        <option value="verdana">Verdana</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="text-xs font-semibold text-gray-600 mb-1.5 block">Size: <span class="text-pink-600" x-text="wfontSize + 'px'"></span></label>
                                    <input type="range" min="12" max="120" step="4" x-model.number="wfontSize" class="w-full mt-2"
                                        :style="'background: linear-gradient(to right, #db2777 ' + ((wfontSize-12)/108*100) + '%, #e5e7eb ' + ((wfontSize-12)/108*100) + '%)'">
                                </div>
                            </div>

                            {{-- Color + Opacity row --}}
                            <div class="grid grid-cols-2 gap-3">
                                <div>
                                    <label class="text-xs font-semibold text-gray-600 mb-1.5 block">Color</label>
                                    <div class="flex items-center gap-2 border border-gray-300 rounded-xl px-2 py-1.5">
                                        <input type="color" x-model="wcolor" class="w-8 h-7 rounded cursor-pointer border-0 bg-transparent p-0">
                                        <span class="text-xs font-mono text-gray-600 uppercase" x-text="wcolor"></span>
                                    </div>
                                </div>
                                <div>
                                    <label class="text-xs font-semibold text-gray-600 mb-1.5 block">Opacity: <span class="text-pink-600" x-text="wopacity + '%'"></span></label>
                                    <input type="range" min="5" max="100" step="5" x-model.number="wopacity" class="w-full mt-2"
                                        :style="'background: linear-gradient(to right, #db2777 ' + ((wopacity-5)/95*100) + '%, #e5e7eb ' + ((wopacity-5)/95*100) + '%)'">
                                </div>
                            </div>

                            {{-- Mode toggle --}}
                            <div>
                                <label class="text-xs font-semibold text-gray-600 mb-2 block">Mode</label>
                                <div class="flex rounded-xl overflow-hidden border border-gray-200">
                                    <button x-on:click="wmode='single'"
                                        :class="wmode==='single' ? 'bg-pink-600 text-white' : 'bg-white text-gray-600 hover:bg-gray-50'"
                                        class="flex-1 py-2 text-xs font-semibold transition-colors flex items-center justify-center gap-1.5">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931z"/></svg>
                                        Single
                                    </button>
                                    <button x-on:click="wmode='tile'"
                                        :class="wmode==='tile' ? 'bg-pink-600 text-white' : 'bg-white text-gray-600 hover:bg-gray-50'"
                                        class="flex-1 py-2 text-xs font-semibold transition-colors flex items-center justify-center gap-1.5 border-l border-gray-200">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z"/></svg>
                                        Tile Repeat
                                    </button>
                                </div>
                            </div>

                            {{-- Position (9-grid) — single mode only --}}
                            <div x-show="wmode === 'single'">
                                <label class="text-xs font-semibold text-gray-600 mb-2 block">Position</label>
                                <div class="grid grid-cols-3 gap-1.5">
                                    <template x-for="pos in wpositions" :key="pos.value">
                                        <button
                                            x-on:click="wposition = pos.value"
                                            :class="wposition === pos.value ? 'bg-pink-600 text-white border-pink-600' : 'bg-gray-50 text-gray-500 border-gray-200 hover:border-pink-300 hover:bg-pink-50'"
                                            class="border rounded-lg py-2 text-xs font-medium transition-all"
                                            x-text="pos.label">
                                        </button>
                                    </template>
                                </div>
                            </div>

                            {{-- Tile spacing — tile mode only --}}
                            <div x-show="wmode === 'tile'">
                                <label class="text-xs font-semibold text-gray-600 mb-1.5 block">Tile Spacing: <span class="text-pink-600" x-text="wtileSpacing + 'px'"></span></label>
                                <input type="range" min="20" max="400" step="10" x-model.number="wtileSpacing" class="w-full"
                                    :style="'background: linear-gradient(to right, #db2777 ' + ((wtileSpacing-20)/380*100) + '%, #e5e7eb ' + ((wtileSpacing-20)/380*100) + '%)'">
                            </div>

                            {{-- Rotation --}}
                            <div>
                                <label class="text-xs font-semibold text-gray-600 mb-2 block">Rotation</label>
                                <div class="flex rounded-xl overflow-hidden border border-gray-200">
                                    <template x-for="rot in wrotations" :key="rot.value">
                                        <button
                                            x-on:click="wrotation = rot.value"
                                            :class="wrotation === rot.value ? 'bg-pink-600 text-white' : 'bg-white text-gray-600 hover:bg-gray-50'"
                                            class="flex-1 py-2 text-xs font-semibold transition-colors border-l border-gray-200 first:border-l-0"
                                            x-text="rot.label">
                                        </button>
                                    </template>
                                </div>
                            </div>

                            {{-- Apply button --}}
                            <button x-on:click="wApply()" :disabled="!wtext.trim()"
                                :class="wtext.trim() ? 'opacity-100 hover:scale-[1.02]' : 'opacity-50 cursor-not-allowed'"
                                class="w-full bg-gradient-to-r from-pink-600 to-pink-700 text-white font-bold py-3 rounded-xl transition-all flex items-center justify-center gap-2 text-sm shadow-sm">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931z"/></svg>
                                Apply Watermark
                            </button>
                        </div>

                        {{-- Processing --}}
                        <div x-show="wstate === 'processing'" class="text-center py-6">
                            <svg class="animate-spin w-8 h-8 text-pink-600 mx-auto" fill="none" viewBox="0 0 24 24"><circle class="opacity-20" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="3"/><path class="opacity-80" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/></svg>
                            <p class="text-sm text-gray-500 mt-2">Applying watermark…</p>
                            <div x-show="wuploadProgress > 0 && wuploadProgress < 100" class="mt-3 mx-auto w-40">
                                <div class="h-1.5 bg-gray-100 rounded-full overflow-hidden">
                                    <div class="h-full bg-pink-500 rounded-full transition-all" :style="'width:' + wuploadProgress + '%'"></div>
                                </div>
                                <p class="text-xs text-gray-400 mt-1 text-center" x-text="wuploadProgress + '%'"></p>
                            </div>
                        </div>

                        {{-- Result --}}
                        <div x-show="wstate === 'result'" class="space-y-3">
                            <div class="flex items-center gap-2 bg-green-50 rounded-xl px-3 py-2.5">
                                <svg class="w-5 h-5 text-green-600 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                <span class="text-sm font-semibold text-green-700">Watermark applied!</span>
                            </div>
                            <button x-on:click="downloadFromUrl(wresult.download_url, wresult.filename)"
                               class="flex w-full items-center justify-center gap-2 py-3 bg-pink-600 hover:bg-pink-700 text-white font-bold rounded-xl text-sm transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 10v6m0 0l-3-3m3 3l3-3M3 17v1a2 2 0 002 2h14a2 2 0 002-2v-1"/></svg>
                                Download
                            </button>
                            <button x-on:click="wReset()" class="w-full py-2 text-sm text-gray-500 hover:text-gray-700 transition-colors">Apply another</button>
                        </div>

                        {{-- Error message --}}
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
                                <input type="range" min="10" max="90" step="5" x-model.number="uquality" class="flex-1"
                                    :style="'background: linear-gradient(to right, #0d9488 ' + ((uquality-10)/80*100) + '%, #e5e7eb ' + ((uquality-10)/80*100) + '%)'">
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
                            <button x-on:click="downloadFromUrl(uresult.download_url, uresult.filename)"
                               class="flex w-full items-center justify-center gap-2 py-3 bg-teal-600 hover:bg-teal-700 text-white font-bold rounded-xl text-sm transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 10v6m0 0l-3-3m3 3l3-3"/></svg>
                                Download
                            </button>
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
                            <button x-on:click="downloadFromUrl(presult.download_url, presult.filename)"
                               class="flex w-full items-center justify-center gap-2 py-3 bg-red-600 hover:bg-red-700 text-white font-bold rounded-xl text-sm transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 10v6m0 0l-3-3m3 3l3-3"/></svg>
                                Download PDF
                            </button>
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
                            <button x-on:click="downloadFromUrl(pdfiresult.download_url, pdfiresult.filename)"
                               class="flex w-full items-center justify-center gap-2 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl text-sm transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 10v6m0 0l-3-3m3 3l3-3"/></svg>
                                Download Image
                            </button>
                            <button x-on:click="pdfiReset()" class="w-full py-2 text-sm text-gray-500 hover:text-gray-700 transition-colors">Convert another</button>
                        </div>

                        <div x-show="pdfierrorMessage" class="bg-red-50 rounded-xl px-3 py-2 text-xs text-red-600" x-text="pdfierrorMessage"></div>
                    </div>
                </div>

            </div>{{-- end grid --}}
        </div>{{-- end tools tab --}}

    </div>{{-- end toolTabs wrapper --}}

    {{-- Trust / Stats Bar --}}
    <section class="bg-white border-y border-gray-200/60 py-10 mt-4" aria-label="Statistics"
             x-data="{
                counters: [
                    { label: 'Images Processed', suffix: 'M+', target: 4.2, current: 0, decimals: 1 },
                    { label: 'Max Size Reduction', suffix: '%', target: 90, current: 0, decimals: 0 },
                    { label: 'Powerful Tools', suffix: '', target: 7, current: 0, decimals: 0 },
                    { label: 'Free · No Signup', suffix: '%', target: 100, current: 0, decimals: 0 },
                ],
                started: false,
                startCounters() {
                    if (this.started) return; this.started = true;
                    this.counters.forEach(c => {
                        const steps = 60, duration = 1800, stepVal = c.target / steps;
                        let s = 0;
                        const t = setInterval(() => {
                            s++; c.current = Math.min(+(c.target * s / steps).toFixed(c.decimals), c.target);
                            if (s >= steps) clearInterval(t);
                        }, duration / steps);
                    });
                }
             }"
             x-intersect.once="startCounters()">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-6 text-center">
                <template x-for="(c, i) in counters" :key="i">
                    <div class="group">
                        <p class="text-3xl sm:text-4xl font-extrabold text-brand-600 tabular-nums transition-all"
                           x-text="c.current.toFixed(c.decimals) + c.suffix"></p>
                        <p class="text-sm text-gray-500 mt-1 font-medium" x-text="c.label"></p>
                    </div>
                </template>
            </div>
            <p class="text-center text-xs text-gray-400 mt-5 font-medium">
                ⭐ Rated <strong class="text-gray-600">4.8/5</strong> by over 4,200 users &nbsp;·&nbsp;
                🔒 Files auto-deleted within 30 minutes &nbsp;·&nbsp;
                🌍 Used in <strong class="text-gray-600">180+ countries</strong>
            </p>
        </div>
    </section>

    {{-- How It Works Section --}}
    <section class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-16" aria-labelledby="how-it-works-title">
        <div class="text-center mb-12">
            <h2 id="how-it-works-title" class="text-3xl sm:text-4xl font-extrabold mb-4">How to Use Our Image Tools</h2>
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
                <h3 class="font-bold text-lg mb-2">Choose a Tool &amp; Upload</h3>
                <p class="text-sm text-gray-500 leading-relaxed">Select Compress, Convert, Resize, Batch, Watermark, or PDF from the tabs. Drag &amp; drop, browse, or paste with <kbd class="text-xs bg-gray-100 border border-gray-200 rounded px-1.5 py-0.5">Ctrl+V</kbd>.</p>
            </div>

            {{-- Step 2 --}}
            <div class="relative z-10 bg-white rounded-2xl border border-gray-200/60 p-6 text-center shadow-sm hover:shadow-lg transition-shadow">
                <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-purple-700 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg shadow-purple-500/30">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6h9.75M10.5 6a1.5 1.5 0 11-3 0m3 0a1.5 1.5 0 10-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-3.75 0h9.75"/></svg>
                </div>
                <span class="inline-block bg-purple-100 text-purple-700 text-xs font-bold px-2.5 py-1 rounded-full mb-3">Step 2</span>
                <h3 class="font-bold text-lg mb-2">Adjust Settings</h3>
                <p class="text-sm text-gray-500 leading-relaxed">Set quality (10–90%), target format, resize dimensions, watermark text, PDF page size, or other tool-specific options.</p>
            </div>

            {{-- Step 3 --}}
            <div class="relative z-10 bg-white rounded-2xl border border-gray-200/60 p-6 text-center shadow-sm hover:shadow-lg transition-shadow">
                <div class="w-16 h-16 bg-gradient-to-br from-accent-500 to-accent-700 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg shadow-accent-500/30">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                </div>
                <span class="inline-block bg-accent-100 text-accent-700 text-xs font-bold px-2.5 py-1 rounded-full mb-3">Step 3</span>
                <h3 class="font-bold text-lg mb-2">Download Result</h3>
                <p class="text-sm text-gray-500 leading-relaxed">Click Download to save your processed image. For batch jobs, download all results as a single ZIP. See stats instantly.</p>
            </div>
        </div>
    </section>

    {{-- Testimonials Section --}}
    <section class="bg-gradient-to-b from-brand-50/60 to-white py-16" aria-labelledby="testimonials-title">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-10">
                <div class="inline-flex items-center gap-1.5 bg-yellow-50 text-yellow-700 text-sm font-semibold px-4 py-1.5 rounded-full mb-4 border border-yellow-200">
                    <svg class="w-4 h-4 text-yellow-500" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                    Rated 4.8/5 · 4,200+ reviews
                </div>
                <h2 id="testimonials-title" class="text-3xl sm:text-4xl font-extrabold mb-3">What People Are Saying</h2>
                <p class="text-gray-500 max-w-lg mx-auto">Real users. Real results.</p>
            </div>
            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-5">
                @php $testimonials = [
                    ['name' => 'Sarah K.', 'role' => 'Web Designer', 'rating' => 5, 'title' => 'Best free image compressor', 'text' => 'Best free image compressor I\'ve found. Batch compression with ZIP download is a game changer for my workflow. Way better than TinyPNG for my needs.', 'date' => '2026-02-14'],
                    ['name' => 'Marcus T.', 'role' => 'Blogger', 'rating' => 5, 'title' => 'Excellent compression quality', 'text' => 'Compressed a 4MB PNG screenshot down to 600KB with zero visible quality loss. The before/after slider is really helpful. No signup needed — perfect.', 'date' => '2026-01-28'],
                    ['name' => 'Priya M.', 'role' => 'Photographer', 'rating' => 5, 'title' => 'Professional watermark tool', 'text' => 'The watermark tile mode looks professional — font options, rotation and opacity control make it just as good as paid tools. Highly recommend!', 'date' => '2026-02-22'],
                    ['name' => 'James W.', 'role' => 'Developer', 'rating' => 5, 'title' => 'Improved PageSpeed score', 'text' => 'Improved my Google PageSpeed score from 62 to 94 using the batch compressor. Compress 15 images at once and download as ZIP. Brilliant tool.', 'date' => '2026-02-10'],
                ]; @endphp
                @foreach($testimonials as $t)
                <div class="bg-white rounded-2xl border border-gray-200/60 p-5 shadow-sm hover:shadow-lg transition-shadow">
                    <div class="flex items-center gap-0.5 mb-3">
                        @for($s=0; $s<$t['rating']; $s++)
                        <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        @endfor
                    </div>
                    <p class="text-sm text-gray-600 leading-relaxed mb-4">"{{ $t['text'] }}"</p>
                    <div class="flex items-center gap-2.5">
                        <div class="w-8 h-8 bg-gradient-to-br from-brand-400 to-brand-600 rounded-full flex items-center justify-center text-white text-xs font-bold flex-shrink-0">
                            {{ strtoupper(substr($t['name'], 0, 1)) }}
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-gray-800">{{ $t['name'] }}</p>
                            <p class="text-xs text-gray-400">{{ $t['role'] }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Features Section --}}
    <section class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-16" aria-labelledby="features-title">
        <div class="text-center mb-12">
            <h2 id="features-title" class="text-3xl sm:text-4xl font-extrabold mb-4">All-in-One Image Toolkit</h2>
            <p class="text-gray-500 max-w-xl mx-auto">7 professional-grade tools, completely free — no account needed</p>
        </div>
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-5">
            {{-- Tool 1 — Compress --}}
            <div class="bg-white rounded-2xl border border-gray-200/60 p-6 hover:shadow-lg transition-shadow group">
                <div class="w-12 h-12 bg-brand-50 rounded-2xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6 text-brand-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3"/></svg>
                </div>
                <h3 class="font-bold text-lg mb-2">Image Compressor</h3>
                <p class="text-sm text-gray-500 leading-relaxed">Reduce JPG, PNG &amp; WebP file sizes up to 90% with adjustable quality. Includes before/after comparison slider.</p>
            </div>
            {{-- Tool 2 — Convert --}}
            <div class="bg-white rounded-2xl border border-gray-200/60 p-6 hover:shadow-lg transition-shadow group">
                <div class="w-12 h-12 bg-purple-50 rounded-2xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M7.5 21L3 16.5m0 0L7.5 12M3 16.5h13.5m0-13.5L21 7.5m0 0L16.5 12M21 7.5H7.5"/></svg>
                </div>
                <h3 class="font-bold text-lg mb-2">Format Converter</h3>
                <p class="text-sm text-gray-500 leading-relaxed">Convert between JPG, PNG, and WebP at high quality. Ideal for switching to modern web formats.</p>
            </div>
            {{-- Tool 3 — Batch --}}
            <div class="bg-white rounded-2xl border border-gray-200/60 p-6 hover:shadow-lg transition-shadow group">
                <div class="w-12 h-12 bg-blue-50 rounded-2xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 9.776c.112-.017.227-.026.344-.026h15.812c.117 0 .232.009.344.026m-16.5 0a2.25 2.25 0 00-1.883 2.542l.857 6a2.25 2.25 0 002.227 1.932H19.05a2.25 2.25 0 002.227-1.932l.857-6a2.25 2.25 0 00-1.883-2.542m-16.5 0V6A2.25 2.25 0 016 3.75h3.879a1.5 1.5 0 011.06.44l2.122 2.12a1.5 1.5 0 001.06.44H18A2.25 2.25 0 0120.25 9v.776"/></svg>
                </div>
                <h3 class="font-bold text-lg mb-2">Batch Compressor</h3>
                <p class="text-sm text-gray-500 leading-relaxed">Upload up to 20 images at once. Compress all in parallel and download a single ZIP with one click.</p>
            </div>
            {{-- Tool 4 — Resize --}}
            <div class="bg-white rounded-2xl border border-gray-200/60 p-6 hover:shadow-lg transition-shadow group">
                <div class="w-12 h-12 bg-orange-50 rounded-2xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3.75v4.5m0-4.5h4.5m-4.5 0L9 9M3.75 20.25v-4.5m0 4.5h4.5m-4.5 0L9 15M20.25 3.75h-4.5m4.5 0v4.5m0-4.5L15 9m5.25 11.25h-4.5m4.5 0v-4.5m0 4.5L15 15"/></svg>
                </div>
                <h3 class="font-bold text-lg mb-2">Image Resizer</h3>
                <p class="text-sm text-gray-500 leading-relaxed">Resize by percentage, max width, max height, or exact dimensions. Aspect ratio preserved automatically.</p>
            </div>
            {{-- Tool 5 — Watermark --}}
            <div class="bg-white rounded-2xl border border-gray-200/60 p-6 hover:shadow-lg transition-shadow group">
                <div class="w-12 h-12 bg-pink-50 rounded-2xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6 text-pink-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931z"/></svg>
                </div>
                <h3 class="font-bold text-lg mb-2">Watermark Tool</h3>
                <p class="text-sm text-gray-500 leading-relaxed">Add custom text watermarks with adjustable position, opacity, and font size. Protect your images instantly.</p>
            </div>
            {{-- Tool 6 — PDF --}}
            <div class="bg-white rounded-2xl border border-gray-200/60 p-6 hover:shadow-lg transition-shadow group">
                <div class="w-12 h-12 bg-red-50 rounded-2xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/></svg>
                </div>
                <h3 class="font-bold text-lg mb-2">Image ↔ PDF</h3>
                <p class="text-sm text-gray-500 leading-relaxed">Convert images to PDF (A4, A3, Letter) or extract PDF pages as JPG, PNG, or WebP images. All in seconds.</p>
            </div>
            {{-- Tool 7 — URL Compress --}}
            <div class="bg-white rounded-2xl border border-gray-200/60 p-6 hover:shadow-lg transition-shadow group sm:col-span-2 lg:col-span-3">
                <div class="flex items-start gap-4">
                    <div class="w-12 h-12 bg-teal-50 rounded-2xl flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6 text-teal-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13.19 8.688a4.5 4.5 0 011.242 7.244l-4.5 4.5a4.5 4.5 0 01-6.364-6.364l1.757-1.757m13.35-.622l1.757-1.757a4.5 4.5 0 00-6.364-6.364l-4.5 4.5a4.5 4.5 0 001.242 7.244"/></svg>
                    </div>
                    <div>
                        <h3 class="font-bold text-lg mb-1">URL Image Compressor</h3>
                        <p class="text-sm text-gray-500 leading-relaxed">Paste any public image URL to compress it instantly — no upload needed. Great for optimising images hosted on the web.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Popular Use Cases Section — targets long-tail keywords --}}
    <section class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-16" aria-labelledby="use-cases-title">
        <div class="text-center mb-12">
            <h2 id="use-cases-title" class="text-3xl sm:text-4xl font-extrabold mb-4">Popular Use Cases</h2>
            <p class="text-gray-500 max-w-xl mx-auto">What people use CompresslyPro for every day</p>
        </div>
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-5">
            <div class="bg-gradient-to-br from-brand-50 to-white rounded-2xl border border-brand-100 p-6">
                <div class="text-2xl mb-3">📧</div>
                <h3 class="font-bold text-base mb-2">Compress Image for Email</h3>
                <p class="text-sm text-gray-500 leading-relaxed">Reduce photo size for email attachments. Convert a 5MB photo to under 500KB — perfect for Gmail, Outlook and more without losing visible quality.</p>
            </div>
            <div class="bg-gradient-to-br from-purple-50 to-white rounded-2xl border border-purple-100 p-6">
                <div class="text-2xl mb-3">🌐</div>
                <h3 class="font-bold text-base mb-2">Compress Images for Website</h3>
                <p class="text-sm text-gray-500 leading-relaxed">Optimise images for faster page loads and better Google Core Web Vitals scores. Smaller images = better SEO rankings and lower bounce rates.</p>
            </div>
            <div class="bg-gradient-to-br from-pink-50 to-white rounded-2xl border border-pink-100 p-6">
                <div class="text-2xl mb-3">📱</div>
                <h3 class="font-bold text-base mb-2">Resize for Social Media</h3>
                <p class="text-sm text-gray-500 leading-relaxed">Resize images for Instagram (1080×1080), Twitter (1200×675), Facebook (1200×630), or any custom dimension. Aspect ratio preserved automatically.</p>
            </div>
            <div class="bg-gradient-to-br from-red-50 to-white rounded-2xl border border-red-100 p-6">
                <div class="text-2xl mb-3">📄</div>
                <h3 class="font-bold text-base mb-2">Convert JPG to PDF Free</h3>
                <p class="text-sm text-gray-500 leading-relaxed">Turn photos, screenshots or scanned images into a PDF document instantly. Choose A4, Letter or Legal size — no software download needed.</p>
            </div>
            <div class="bg-gradient-to-br from-orange-50 to-white rounded-2xl border border-orange-100 p-6">
                <div class="text-2xl mb-3">🖊️</div>
                <h3 class="font-bold text-base mb-2">Add Watermark to Protect Photos</h3>
                <p class="text-sm text-gray-500 leading-relaxed">Protect your photography and artwork by adding a custom text watermark. Set opacity, choose position — top, bottom, center — and download instantly.</p>
            </div>
            <div class="bg-gradient-to-br from-blue-50 to-white rounded-2xl border border-blue-100 p-6">
                <div class="text-2xl mb-3">📦</div>
                <h3 class="font-bold text-base mb-2">Bulk Compress Images for Blog</h3>
                <p class="text-sm text-gray-500 leading-relaxed">Bloggers and developers: batch compress 20 images at once and download a ZIP file. Perfect for WordPress, Shopify, or any CMS image optimisation workflow.</p>
            </div>
        </div>
    </section>

    {{-- Why Compress / Formats Section --}}
    <section class="bg-white border-y border-gray-200/60 py-16" aria-labelledby="why-compress-title">        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 id="why-compress-title" class="text-3xl font-extrabold mb-6">Why Compress &amp; Optimise Your Images?</h2>
            <p class="text-gray-600 mb-6 leading-relaxed">
                Image optimisation is essential for websites, blogs, email and social media. Large uncompressed images slow down page loads, waste bandwidth, hurt search rankings and frustrate users. Compressing images before uploading them online is one of the highest-impact, lowest-effort improvements you can make.
            </p>
            <div class="grid sm:grid-cols-2 gap-4 mb-10">
                <div class="flex gap-3 items-start"><div class="w-6 h-6 bg-accent-100 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5"><svg class="w-3.5 h-3.5 text-accent-600" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg></div><p class="text-gray-600 text-sm"><strong class="text-gray-800">Faster page loads</strong> — Compressed images load instantly, improving Google Core Web Vitals (LCP).</p></div>
                <div class="flex gap-3 items-start"><div class="w-6 h-6 bg-accent-100 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5"><svg class="w-3.5 h-3.5 text-accent-600" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg></div><p class="text-gray-600 text-sm"><strong class="text-gray-800">Better Google rankings</strong> — Page speed is a direct ranking factor. Smaller images = higher scores in PageSpeed Insights.</p></div>
                <div class="flex gap-3 items-start"><div class="w-6 h-6 bg-accent-100 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5"><svg class="w-3.5 h-3.5 text-accent-600" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg></div><p class="text-gray-600 text-sm"><strong class="text-gray-800">Email compatibility</strong> — Reduce photo size for email attachments. Most email services reject attachments over 25MB.</p></div>
                <div class="flex gap-3 items-start"><div class="w-6 h-6 bg-accent-100 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5"><svg class="w-3.5 h-3.5 text-accent-600" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg></div><p class="text-gray-600 text-sm"><strong class="text-gray-800">Save storage &amp; bandwidth</strong> — Reduce sizes by up to 90% without noticeable quality loss. Lower hosting and CDN costs.</p></div>
            </div>

            <h2 class="text-3xl font-extrabold mb-6">Supported Formats</h2>
            <div class="grid sm:grid-cols-2 gap-4">
                <div class="bg-gray-50 rounded-2xl p-5 border border-gray-200/60">
                    <div class="flex items-center gap-2 mb-2"><span class="text-lg font-bold">📸</span><h3 class="font-bold">JPEG / JPG</h3></div>
                    <p class="text-sm text-gray-500">Best for photographs. Lossy compression with adjustable quality. Smallest file sizes.</p>
                </div>
                <div class="bg-gray-50 rounded-2xl p-5 border border-gray-200/60">
                    <div class="flex items-center gap-2 mb-2"><span class="text-lg font-bold">🎨</span><h3 class="font-bold">PNG</h3></div>
                    <p class="text-sm text-gray-500">Ideal for graphics with transparency. Lossless compression preserves every pixel.</p>
                </div>
                <div class="bg-gray-50 rounded-2xl p-5 border border-gray-200/60">
                    <div class="flex items-center gap-2 mb-2"><span class="text-lg font-bold">🌐</span><h3 class="font-bold">WEBP</h3></div>
                    <p class="text-sm text-gray-500">Modern web format — 30% smaller than JPEG at equivalent quality. Widely supported.</p>
                </div>
                <div class="bg-gray-50 rounded-2xl p-5 border border-gray-200/60">
                    <div class="flex items-center gap-2 mb-2"><span class="text-lg font-bold">🎞️</span><h3 class="font-bold">GIF</h3></div>
                    <p class="text-sm text-gray-500">Animated images and simple graphics. Compress GIFs while preserving animations.</p>
                </div>
                <div class="bg-gray-50 rounded-2xl p-5 border border-gray-200/60">
                    <div class="flex items-center gap-2 mb-2"><span class="text-lg font-bold">📄</span><h3 class="font-bold">PDF</h3></div>
                    <p class="text-sm text-gray-500">Convert any JPG/PNG/WebP image to a PDF document, or extract PDF pages as images.</p>
                </div>
                <div class="bg-gray-50 rounded-2xl p-5 border border-gray-200/60">
                    <div class="flex items-center gap-2 mb-2"><span class="text-lg font-bold">📦</span><h3 class="font-bold">ZIP Archives</h3></div>
                    <p class="text-sm text-gray-500">Batch compress up to 20 images and download all results in a single ZIP archive.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Competitor Comparison Table --}}
    <section class="bg-white border-y border-gray-200/60 py-16" aria-labelledby="compare-title">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-10">
                <h2 id="compare-title" class="text-3xl sm:text-4xl font-extrabold mb-3">How We Compare</h2>
                <p class="text-gray-500 max-w-xl mx-auto">CompresslyPro vs TinyPNG, Squoosh &amp; iLoveIMG — see why 4M+ users choose us</p>
            </div>
            <div class="overflow-x-auto -mx-4 sm:mx-0">
                <table class="w-full min-w-[640px] text-sm" aria-label="Feature comparison table">
                    <thead>
                        <tr class="border-b-2 border-gray-200">
                            <th class="text-left py-3 px-4 font-semibold text-gray-600 w-48">Feature</th>
                            <th class="py-3 px-4 font-bold text-brand-700 bg-brand-50 rounded-t-xl text-center">
                                <div class="flex flex-col items-center gap-0.5">
                                    <span class="text-base">CompresslyPro</span>
                                    <span class="text-[10px] font-medium text-brand-500 bg-brand-100 px-2 py-0.5 rounded-full">Recommended</span>
                                </div>
                            </th>
                            <th class="py-3 px-4 text-gray-500 font-semibold text-center">TinyPNG</th>
                            <th class="py-3 px-4 text-gray-500 font-semibold text-center">Squoosh</th>
                            <th class="py-3 px-4 text-gray-500 font-semibold text-center">iLoveIMG</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $rows = [
                            ['Free to use', true, true, true, 'Limited'],
                            ['No signup required', true, true, true, false],
                            ['Compress JPG/PNG/WebP', true, true, true, true],
                            ['Batch compress (up to 20)', true, 'Up to 20', false, 'Up to 10'],
                            ['Download as ZIP', true, false, false, true],
                            ['Before/after slider', true, false, true, false],
                            ['Image format converter', true, false, true, true],
                            ['Image resizer', true, false, false, true],
                            ['Add watermark', true, false, false, true],
                            ['Image → PDF', true, false, false, true],
                            ['PDF → Image', true, false, false, true],
                            ['Compress from URL', true, false, false, false],
                            ['Max file size', '20MB', '5MB', '—', '30MB'],
                            ['Privacy: auto-delete files', '30 min', 'Unknown', 'Client-side', 'Unknown'],
                        ]; @endphp
                        @foreach($rows as $ri => $row)
                        <tr class="{{ $ri % 2 === 0 ? 'bg-gray-50/50' : 'bg-white' }} border-b border-gray-100 last:border-0">
                            <td class="py-3 px-4 font-medium text-gray-700">{{ $row[0] }}</td>
                            @foreach(array_slice($row, 1) as $ci => $val)
                            <td class="py-3 px-4 text-center {{ $ci === 0 ? 'bg-brand-50/60' : '' }}">
                                @if($val === true)
                                    <span class="inline-flex items-center justify-center w-6 h-6 bg-green-100 rounded-full mx-auto" aria-label="Yes">
                                        <svg class="w-3.5 h-3.5 text-green-600" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                    </span>
                                @elseif($val === false)
                                    <span class="inline-flex items-center justify-center w-6 h-6 bg-gray-100 rounded-full mx-auto" aria-label="No">
                                        <svg class="w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                                    </span>
                                @else
                                    <span class="text-xs text-gray-500 font-medium">{{ $val }}</span>
                                @endif
                            </td>
                            @endforeach
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <p class="text-center text-xs text-gray-400 mt-4">Data based on publicly available feature lists as of March 2026. Always verify with original sources.</p>
        </div>
    </section>

    {{-- Tips & Tricks / Educational Content --}}
    <section class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-16" aria-labelledby="tips-title">
        <div class="text-center mb-10">
            <h2 id="tips-title" class="text-3xl sm:text-4xl font-extrabold mb-3">Image Optimisation Tips</h2>
            <p class="text-gray-500 max-w-xl mx-auto">Expert advice to get the best results from image compression</p>
        </div>
        <div class="grid sm:grid-cols-2 gap-6">
            <div class="bg-gradient-to-br from-indigo-50 to-white rounded-2xl border border-indigo-100 p-6">
                <div class="flex items-center gap-3 mb-3">
                    <div class="w-9 h-9 bg-indigo-100 rounded-xl flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <h3 class="font-bold text-gray-800">Choose the Right Format</h3>
                </div>
                <p class="text-sm text-gray-600 leading-relaxed">Use <strong>WebP</strong> for web images — it's 25–35% smaller than JPEG at the same quality. Use <strong>PNG</strong> only for images with transparency. Use <strong>JPEG</strong> for photos. Choosing the right format can cut your file size in half before compression.</p>
            </div>
            <div class="bg-gradient-to-br from-green-50 to-white rounded-2xl border border-green-100 p-6">
                <div class="flex items-center gap-3 mb-3">
                    <div class="w-9 h-9 bg-green-100 rounded-xl flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                    </div>
                    <h3 class="font-bold text-gray-800">Best Quality Settings by Use Case</h3>
                </div>
                <ul class="text-sm text-gray-600 space-y-1.5">
                    <li class="flex items-start gap-2"><span class="text-green-500 font-bold mt-0.5">→</span><span><strong>Website/Blog:</strong> 60–70% quality (best speed vs quality balance)</span></li>
                    <li class="flex items-start gap-2"><span class="text-green-500 font-bold mt-0.5">→</span><span><strong>Email attachment:</strong> 50–60% quality (targets under 1MB)</span></li>
                    <li class="flex items-start gap-2"><span class="text-green-500 font-bold mt-0.5">→</span><span><strong>Social media:</strong> 70–80% quality (looks great on mobile screens)</span></li>
                    <li class="flex items-start gap-2"><span class="text-green-500 font-bold mt-0.5">→</span><span><strong>Print/Archive:</strong> 80–90% quality (preserve fine detail)</span></li>
                </ul>
            </div>
            <div class="bg-gradient-to-br from-orange-50 to-white rounded-2xl border border-orange-100 p-6">
                <div class="flex items-center gap-3 mb-3">
                    <div class="w-9 h-9 bg-orange-100 rounded-xl flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 text-orange-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                    </div>
                    <h3 class="font-bold text-gray-800">Resize Before Compressing</h3>
                </div>
                <p class="text-sm text-gray-600 leading-relaxed">Always resize images to their display dimensions <em>before</em> compressing. A 4000×3000px photo displayed at 800×600px wastes 25× the bandwidth. Use our <strong>Resize tab</strong> to scale down first, then compress — this can reduce file size by 80% combined.</p>
            </div>
            <div class="bg-gradient-to-br from-pink-50 to-white rounded-2xl border border-pink-100 p-6">
                <div class="flex items-center gap-3 mb-3">
                    <div class="w-9 h-9 bg-pink-100 rounded-xl flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 text-pink-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                    </div>
                    <h3 class="font-bold text-gray-800">Core Web Vitals &amp; Page Speed</h3>
                </div>
                <p class="text-sm text-gray-600 leading-relaxed">Images are the #1 cause of poor LCP (Largest Contentful Paint) scores. Google's PageSpeed Insights ranks your site higher when images are optimised. Aim for images under 200KB for above-the-fold content. Use WebP format and enable lazy loading — your bounce rate will drop significantly.</p>
            </div>
        </div>
    </section>

    {{-- FAQ Section --}}
    <section class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-16" x-data="{ openFaq: null }">
        <div class="text-center mb-10">
            <h2 class="text-3xl sm:text-4xl font-extrabold mb-3">Frequently Asked Questions</h2>
            <p class="text-gray-500">Everything you need to know about our free image tools</p>
        </div>
        <div class="space-y-3">
            @php
                $faqs = [
                    ['Is CompresslyPro free?', 'Yes, all 7 tools on CompresslyPro are 100% free. No hidden charges, no signup required, and no watermarks on your images. Use it as many times as you want.'],
                    ['How do I compress an image online for free?', 'Simply drag & drop your JPG, PNG, WebP or GIF image onto the Compress tab, adjust the quality slider (50–70% recommended for best balance of size vs quality), then click Download. Your image will be compressed up to 90% smaller instantly.'],
                    ['How can I compress an image without losing quality?', 'Set the quality slider to 70–80%. Our smart compression algorithm reduces file size by 50–70% while keeping the image visually identical. Use the before/after comparison slider to verify quality before downloading.'],
                    ['How do I reduce image size for email attachments?', 'Upload your photo to the Compress tab and set quality to 60–70%. This typically reduces a 3–5MB photo to under 500KB — well within email attachment limits — while still looking great on screen.'],
                    ['What image formats are supported?', 'We support JPG/JPEG, PNG, WebP, and GIF for compression, resizing and conversion. PDF is supported for image-to-PDF and PDF-to-image conversions. Max file size is 20MB per file.'],
                    ['Can I convert JPG to PDF online free?', 'Yes! Click the More Tools tab, select Image → PDF, upload your JPG/PNG/WebP, choose page size (A4, A3, Letter, Legal) and orientation (portrait or landscape), then click Convert. No signup needed.'],
                    ['Does compression reduce image quality?', 'Our smart algorithm minimises quality loss. At balanced settings (50–70%), the difference is virtually imperceptible to the naked eye. Use the real-time before/after slider to compare results before downloading.'],
                    ['Can I resize images online?', 'Yes! Use the Resize tab to resize by percentage, max width, max height, or exact pixel dimensions. Aspect ratio is preserved by default, so your images never look stretched.'],
                    ['How do I compress multiple images at once?', 'Use the Batch tab to upload up to 20 images at once. They are all compressed in parallel and you can download a single ZIP file with all results in one click.'],
                    ['Can I compress an image to a specific size like 100KB or 200KB?', 'Adjust the quality slider to control output file size. Start at 60% for typical photos (usually 100–300KB). The result shows the exact compressed size before you download.'],
                    ['How do I add a watermark?', 'Use the Watermark tool in the More Tools tab. Enter your watermark text, choose position (center or any corner) and set opacity. Download the protected image instantly — no signup required.'],
                    ['What is the best free image compressor online?', 'CompresslyPro is one of the top-rated free online image compressors. It supports JPG, PNG, WebP and GIF, offers up to 90% compression, includes a real-time before/after comparison, and provides 7 total tools — all free with no account needed.'],
                    ['Can I compress an image from a URL?', 'Yes! Use the "Compress from URL" tool in More Tools. Paste any public image URL and it will be fetched and compressed on our servers instantly — no download/re-upload needed.'],
                    ['Are my images stored on the server?', 'Your privacy is our priority. All uploaded files are automatically and permanently deleted within 30 minutes. We never store, share, sell or analyse your images.'],
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
    <footer class="bg-gradient-to-r from-gray-900 via-indigo-950 to-gray-900 border-t border-indigo-800/40 pt-14 pb-6" itemscope itemtype="https://schema.org/WPFooter">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Top row: logo + tagline + tool links --}}
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
                    {{-- Star rating --}}
                    <div class="flex items-center gap-1.5">
                        <div class="flex items-center gap-0.5">
                            @for($i=0;$i<5;$i++)<svg class="w-3.5 h-3.5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>@endfor
                        </div>
                        <span class="text-xs text-indigo-300/70">4.8/5 · 4,200+ reviews</span>
                    </div>
                </div>

                {{-- Compress Tools --}}
                <div>
                    <h3 class="text-white font-semibold text-xs mb-3 uppercase tracking-wider">Compression Tools</h3>
                    <nav aria-label="Compression tool links" class="space-y-2">
                        <a href="{{ route('tool.compress') }}" class="block text-indigo-300/70 hover:text-white text-sm transition-colors">Image Compressor</a>
                        <a href="{{ route('tool.batch') }}" class="block text-indigo-300/70 hover:text-white text-sm transition-colors">Batch Compressor (ZIP)</a>
                        <a href="{{ route('tool.convert') }}" class="block text-indigo-300/70 hover:text-white text-sm transition-colors">Image Converter</a>
                        <a href="{{ route('tool.resize') }}" class="block text-indigo-300/70 hover:text-white text-sm transition-colors">Image Resizer</a>
                    </nav>
                </div>

                {{-- Edit Tools --}}
                <div>
                    <h3 class="text-white font-semibold text-xs mb-3 uppercase tracking-wider">Edit &amp; Convert</h3>
                    <nav aria-label="Edit tool links" class="space-y-2">
                        <a href="{{ route('tool.watermark') }}" class="block text-indigo-300/70 hover:text-white text-sm transition-colors">Add Watermark to Image</a>
                        <a href="{{ route('tool.img2pdf') }}" class="block text-indigo-300/70 hover:text-white text-sm transition-colors">Image to PDF Converter</a>
                        <a href="{{ route('tool.pdf2img') }}" class="block text-indigo-300/70 hover:text-white text-sm transition-colors">PDF to Image Converter</a>
                    </nav>
                </div>

                {{-- Info --}}
                <div>
                    <h3 class="text-white font-semibold text-xs mb-3 uppercase tracking-wider">Company</h3>
                    <nav aria-label="Footer info links" class="space-y-2">
                        <a href="/about" class="block text-indigo-300/70 hover:text-white text-sm transition-colors">About Us</a>
                        <a href="/contact" class="block text-indigo-300/70 hover:text-white text-sm transition-colors">Contact</a>
                        <a href="/blog" class="block text-indigo-300/70 hover:text-white text-sm transition-colors">Blog</a>
                        <a href="/privacy-policy" class="block text-indigo-300/70 hover:text-white text-sm transition-colors">Privacy Policy</a>
                        <a href="/terms" class="block text-indigo-300/70 hover:text-white text-sm transition-colors">Terms of Service</a>
                        <a href="/sitemap" class="block text-indigo-300/70 hover:text-white text-sm transition-colors">Sitemap</a>
                        <a href="/sitemap.xml" class="block text-indigo-300/70 hover:text-white text-sm transition-colors">XML Sitemap</a>
                    </nav>
                    <div class="mt-5 space-y-1.5 text-xs text-indigo-300/50">
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
                        <div class="flex items-center gap-2">
                            <svg class="w-3.5 h-3.5 text-accent-400 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064"/></svg>
                            <span>Used in 180+ countries</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Bottom bar --}}
            <div class="pt-6 flex flex-col sm:flex-row items-center justify-between gap-3 text-xs text-indigo-300/50">
                <span>&copy; {{ date('Y') }} CompresslyPro. All rights reserved.</span>
                <div class="flex items-center gap-3 flex-wrap justify-center">
                    <a href="/privacy-policy" class="hover:text-white transition-colors">Privacy Policy</a>
                    <span class="w-1 h-1 bg-indigo-600 rounded-full"></span>
                    <a href="/terms" class="hover:text-white transition-colors">Terms of Service</a>
                    <span class="w-1 h-1 bg-indigo-600 rounded-full"></span>
                    <span>Max 20MB per file</span>
                    <span class="w-1 h-1 bg-indigo-600 rounded-full"></span>
                    <a href="/sitemap" class="hover:text-white transition-colors">Sitemap</a>
                    <span class="w-1 h-1 bg-indigo-600 rounded-full"></span>
                    <a href="/sitemap.xml" class="hover:text-white transition-colors">XML Sitemap</a>
                </div>
            </div>

        </div>
    </footer>

    {{-- Alpine.js CDN (with collapse + intersect plugins) --}}
    <script defer src="https://cdn.jsdelivr.net/npm/@@alpinejs/collapse@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/@@alpinejs/intersect@3.x.x/dist/cdn.min.js"></script>
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
                btchf: _e('{{ base64_encode(route("batch.finalize")) }}'),
                rsz:  _e('{{ base64_encode(route("image.resize")) }}'),
                urlp: _e('{{ base64_encode(route("url.compress")) }}'),
                i2p:  _e('{{ base64_encode(route("image.to.pdf")) }}'),
                p2i:  _e('{{ base64_encode(route("pdf.to.image")) }}'),
                wmk:  _e('{{ base64_encode(route("image.watermark")) }}'),
                t2seg: _e('{{ base64_encode(route("t2.chunk")) }}'),
                t2don: _e('{{ base64_encode(route("t2.finalize")) }}'),
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

        async function uploadInChunks(file, onProgress, chunkEndpoint) {
            const endpoint    = chunkEndpoint || window.__cp.seg;
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

                const res = await fetch(endpoint, {
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

        /* ─── Shared download helper ─────────────────────────────────── */
        async function downloadFromUrl(url, filename) {
            if (!url) return;
            try {
                const res = await fetch(url, { headers: { 'Accept': '*/*' } });
                if (!res.ok) throw new Error('Download failed (' + res.status + ')');
                const blob = await res.blob();
                const objectUrl = URL.createObjectURL(blob);
                const a = document.createElement('a');
                a.href = objectUrl;
                a.download = filename || url.split('/').pop() || 'download';
                document.body.appendChild(a);
                a.click();
                document.body.removeChild(a);
                setTimeout(() => URL.revokeObjectURL(objectUrl), 10000);
            } catch (err) {
                console.error('Download error:', err);
                // Fallback: open in new tab
                window.open(url, '_blank');
            }
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
                buploadProgress: 0,     // 0-100 across all files
                bCurrentFile: '',        // name of file being uploaded

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
                    this.buploadProgress = 0;
                    this.bCurrentFile = '';
                    const csrf = document.querySelector('meta[name="csrf-token"]').content;
                    const total = this.bfiles.length;
                    const manifests = [];

                    // Upload every file in chunks individually — no single POST ever holds file bytes
                    for (let idx = 0; idx < total; idx++) {
                        const file = this.bfiles[idx];
                        this.bCurrentFile = file.name;
                        try {
                            const { uploadId, totalChunks } = await uploadInChunks(
                                file,
                                p => {
                                    // Overall progress: each file gets an equal slice of 0-90%
                                    this.buploadProgress = Math.round(
                                        ((idx + p / 100) / total) * 90
                                    );
                                },
                                window.__cp.t2seg
                            );
                            manifests.push({
                                upload_id:     uploadId,
                                total_chunks:  totalChunks,
                                original_name: file.name,
                            });
                        } catch (err) {
                            // Record a failed entry and keep going for remaining files
                            manifests.push({ upload_id: '', total_chunks: 0, original_name: file.name, _failed: true });
                        }
                    }

                    this.buploadProgress = 92;
                    this.bCurrentFile = 'Compressing…';

                    // Filter out locally-failed uploads before sending
                    const valid = manifests.filter(m => !m._failed);
                    if (!valid.length) {
                        this.berrorMessage = 'All file uploads failed. Please try again.';
                        this.bstate = 'error';
                        return;
                    }

                    try {
                        // Finalize: server assembles each uploaded ID and compresses it
                        const body = new URLSearchParams();
                        body.append('quality', this.bquality);
                        valid.forEach((m, i) => {
                            body.append(`files[${i}][upload_id]`,     m.upload_id);
                            body.append(`files[${i}][total_chunks]`,  m.total_chunks);
                            body.append(`files[${i}][original_name]`, m.original_name);
                        });
                        const res = await fetch(window.__cp.btchf, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': csrf,
                                'Content-Type': 'application/x-www-form-urlencoded',
                            },
                            body: body.toString(),
                        });
                        const data = await res.json();
                        if (!res.ok) throw new Error(data.message || 'Batch compression failed.');
                        this.buploadProgress = 100;
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
                        a.href = url; a.download = 'compresslypro-batch.zip'; a.click();
                        setTimeout(() => URL.revokeObjectURL(url), 5000);
                    } catch (err) {
                        this.berrorMessage = err.message || 'Could not download ZIP.';
                    }
                },

                bReset() {
                    this.bstate = 'idle'; this.bfiles = []; this.bresults = {};
                    this.berrorMessage = ''; this.bquality = 50;
                    this.buploadProgress = 0; this.bCurrentFile = '';
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
                ruploadProgress: 0,

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
                    this.ruploadProgress = 0;
                    const csrf = document.querySelector('meta[name="csrf-token"]').content;
                    try {
                        let data;
                        if (this.rfile.size <= 2 * 1024 * 1024) {
                            // Small file: direct POST
                            const fd = new FormData();
                            fd.append('image', this.rfile);
                            fd.append('mode', this.rmode);
                            fd.append('quality', this.rquality);
                            fd.append('format', this.rformat);
                            if (this.rmode === 'percentage') { fd.append('percentage', this.rpercentage); }
                            else if (this.rmode === 'max_width') { fd.append('width', this.rwidth); }
                            else if (this.rmode === 'max_height') { fd.append('height', this.rheight); }
                            else if (this.rmode === 'exact') { fd.append('width', this.rwidth); fd.append('height', this.rheight); }
                            const res = await fetch(window.__cp.rsz, {
                                method: 'POST',
                                headers: { 'X-CSRF-TOKEN': csrf },
                                body: fd,
                            });
                            data = await res.json();
                            if (!res.ok) throw new Error(data.message || 'Resize failed.');
                        } else {
                            // Large file: chunked upload then finalize
                            const { uploadId, totalChunks } = await uploadInChunks(
                                this.rfile,
                                p => { this.ruploadProgress = p; },
                                window.__cp.t2seg
                            );
                            this.ruploadProgress = 85;
                            const fd = new FormData();
                            fd.append('upload_id', uploadId);
                            fd.append('total_chunks', totalChunks);
                            fd.append('original_name', this.rfile.name);
                            fd.append('action', 'resize');
                            fd.append('mode', this.rmode);
                            fd.append('quality', this.rquality);
                            fd.append('format', this.rformat);
                            if (this.rmode === 'percentage') { fd.append('percentage', this.rpercentage); }
                            else if (this.rmode === 'max_width') { fd.append('width', this.rwidth); }
                            else if (this.rmode === 'max_height') { fd.append('height', this.rheight); }
                            else if (this.rmode === 'exact') { fd.append('width', this.rwidth); fd.append('height', this.rheight); }
                            const res = await fetch(window.__cp.t2don, {
                                method: 'POST',
                                headers: { 'X-CSRF-TOKEN': csrf },
                                body: fd,
                            });
                            data = await res.json();
                            if (!res.ok) throw new Error(data.message || 'Resize failed.');
                            this.ruploadProgress = 100;
                        }
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
                    this.rorigW = 0; this.rorigH = 0; this.ruploadProgress = 0;
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
                wfontSize: 36,
                wfontFamily: 'arial',
                wcolor: '#ffffff',
                wrotation: 0,
                wmode: 'single',
                wtileSpacing: 150,
                wresult: {},
                werrorMessage: '',
                wuploadProgress: 0,
                wpositions: [
                    { value: 'top-left',      label: '↖ Top Left' },
                    { value: 'top-center',    label: '↑ Top Center' },
                    { value: 'top-right',     label: '↗ Top Right' },
                    { value: 'middle-left',   label: '← Mid Left' },
                    { value: 'center',        label: '⊙ Center' },
                    { value: 'middle-right',  label: '→ Mid Right' },
                    { value: 'bottom-left',   label: '↙ Bot Left' },
                    { value: 'bottom-center', label: '↓ Bot Center' },
                    { value: 'bottom-right',  label: '↘ Bot Right' },
                ],
                wrotations: [
                    { value: 0,   label: '0°' },
                    { value: -30, label: '-30°' },
                    { value: -45, label: '-45°' },
                    { value: -60, label: '-60°' },
                ],
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
                    this.wuploadProgress = 0;
                    const csrf = document.querySelector('meta[name="csrf-token"]').content;
                    // Strip # from color hex for backend
                    const colorHex = this.wcolor.replace('#', '');
                    try {
                        let data;
                        if (this.wfile.size <= 2 * 1024 * 1024) {
                            const fd = new FormData();
                            fd.append('image', this.wfile);
                            fd.append('text', this.wtext);
                            fd.append('position', this.wposition);
                            fd.append('opacity', this.wopacity);
                            fd.append('size', this.wfontSize);
                            fd.append('color', this.wcolor);
                            fd.append('font_family', this.wfontFamily);
                            fd.append('rotation', this.wrotation);
                            fd.append('wm_mode', this.wmode);
                            fd.append('tile_spacing', this.wtileSpacing);
                            const res = await fetch(window.__cp.wmk, {
                                method: 'POST',
                                headers: { 'X-CSRF-TOKEN': csrf },
                                body: fd,
                            });
                            data = await res.json();
                            if (!res.ok) throw new Error(data.message || 'Watermark failed.');
                        } else {
                            const { uploadId, totalChunks } = await uploadInChunks(
                                this.wfile,
                                p => { this.wuploadProgress = p; },
                                window.__cp.t2seg
                            );
                            this.wuploadProgress = 85;
                            const fd = new FormData();
                            fd.append('upload_id', uploadId);
                            fd.append('total_chunks', totalChunks);
                            fd.append('original_name', this.wfile.name);
                            fd.append('action', 'watermark');
                            fd.append('text', this.wtext);
                            fd.append('position', this.wposition);
                            fd.append('opacity', this.wopacity);
                            fd.append('size', this.wfontSize);
                            fd.append('color', this.wcolor);
                            fd.append('font_family', this.wfontFamily);
                            fd.append('rotation', this.wrotation);
                            fd.append('wm_mode', this.wmode);
                            fd.append('tile_spacing', this.wtileSpacing);
                            const res = await fetch(window.__cp.t2don, {
                                method: 'POST',
                                headers: { 'X-CSRF-TOKEN': csrf },
                                body: fd,
                            });
                            data = await res.json();
                            if (!res.ok) throw new Error(data.message || 'Watermark failed.');
                            this.wuploadProgress = 100;
                        }
                        this.wresult = data; this.wstate = 'result';
                    } catch (err) {
                        this.werrorMessage = err.message || 'Error applying watermark.';
                        this.wstate = 'settings';
                    }
                },
                wReset() {
                    this.wstate = 'idle'; this.wfile = null; this.wfileName = '';
                    this.wtext = ''; this.wresult = {}; this.werrorMessage = ''; this.wuploadProgress = 0;
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
                puploadProgress: 0,
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
                    this.puploadProgress = 0;
                    const csrf = document.querySelector('meta[name="csrf-token"]').content;
                    try {
                        let data;
                        if (this.pfile.size <= 2 * 1024 * 1024) {
                            // Small file: direct POST
                            const fd = new FormData();
                            fd.append('image', this.pfile);
                            fd.append('page_size', this.ppageSize);
                            fd.append('orientation', this.porientation);
                            const res = await fetch(window.__cp.i2p, {
                                method: 'POST',
                                headers: { 'X-CSRF-TOKEN': csrf },
                                body: fd,
                            });
                            data = await res.json();
                            if (!res.ok) throw new Error(data.message || 'PDF conversion failed.');
                        } else {
                            // Large file: chunked upload then finalize
                            const { uploadId, totalChunks } = await uploadInChunks(
                                this.pfile,
                                p => { this.puploadProgress = p; },
                                window.__cp.t2seg
                            );
                            this.puploadProgress = 85;
                            const fd = new FormData();
                            fd.append('upload_id', uploadId);
                            fd.append('total_chunks', totalChunks);
                            fd.append('original_name', this.pfile.name);
                            fd.append('action', 'img_to_pdf');
                            fd.append('page_size', this.ppageSize);
                            fd.append('orientation', this.porientation);
                            const res = await fetch(window.__cp.t2don, {
                                method: 'POST',
                                headers: { 'X-CSRF-TOKEN': csrf },
                                body: fd,
                            });
                            data = await res.json();
                            if (!res.ok) throw new Error(data.message || 'PDF conversion failed.');
                            this.puploadProgress = 100;
                        }
                        this.presult = data; this.pstate = 'result';
                    } catch (err) {
                        this.perrorMessage = err.message || 'An error occurred.';
                        this.pstate = 'error';
                    }
                },
                pReset() {
                    this.pstate = 'idle'; this.pfile = null; this.pfileName = '';
                    this.presult = {}; this.perrorMessage = ''; this.puploadProgress = 0;
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
                pdfiuploadProgress: 0,
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
                    this.pdfiuploadProgress = 0;
                    const csrf = document.querySelector('meta[name="csrf-token"]').content;
                    try {
                        let data;
                        if (this.pdfifile.size <= 2 * 1024 * 1024) {
                            // Small file: direct POST
                            const fd = new FormData();
                            fd.append('pdf', this.pdfifile);
                            fd.append('format', this.pdfiformat);
                            fd.append('dpi', this.pdfidpi);
                            const res = await fetch(window.__cp.p2i, {
                                method: 'POST',
                                headers: { 'X-CSRF-TOKEN': csrf },
                                body: fd,
                            });
                            data = await res.json();
                            if (!res.ok) throw new Error(data.message || 'Conversion failed.');
                        } else {
                            // Large file: chunked upload then finalize
                            const { uploadId, totalChunks } = await uploadInChunks(
                                this.pdfifile,
                                p => { this.pdfiuploadProgress = p; },
                                window.__cp.t2seg
                            );
                            this.pdfiuploadProgress = 85;
                            const fd = new FormData();
                            fd.append('upload_id', uploadId);
                            fd.append('total_chunks', totalChunks);
                            fd.append('original_name', this.pdfifile.name);
                            fd.append('action', 'pdf_to_img');
                            fd.append('format', this.pdfiformat);
                            fd.append('dpi', this.pdfidpi);
                            const res = await fetch(window.__cp.t2don, {
                                method: 'POST',
                                headers: { 'X-CSRF-TOKEN': csrf },
                                body: fd,
                            });
                            data = await res.json();
                            if (!res.ok) throw new Error(data.message || 'Conversion failed.');
                            this.pdfiuploadProgress = 100;
                        }
                        this.pdfiresult = data; this.pdfistate = 'result';
                    } catch (err) {
                        this.pdfierrorMessage = err.message || 'An error occurred.';
                        this.pdfistate = 'error';
                    }
                },
                pdfiReset() {
                    this.pdfistate = 'idle'; this.pdfifile = null; this.pdfifileName = '';
                    this.pdfiresult = {}; this.pdfierrorMessage = ''; this.pdfiuploadProgress = 0;
                },
            };
        }
    </script>

    {{-- Scroll to Top Button --}}
    <button x-data="{ show: false }"
            x-init="window.addEventListener('scroll', () => { show = window.scrollY > 400 })"
            x-show="show"
            x-transition.duration.300ms
            x-on:click="window.scrollTo({ top: 0, behavior: 'smooth' })"
            class="fixed bottom-6 right-5 z-40 w-11 h-11 bg-brand-600 hover:bg-brand-700 text-white rounded-full shadow-lg hover:shadow-xl transition-all flex items-center justify-center"
            aria-label="Scroll to top">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M5 15l7-7 7 7"/>
        </svg>
    </button>

    {{-- Mobile Sticky CTA --}}
    <div x-data="{ show: false, dismissed: false }"
         x-init="window.addEventListener('scroll', () => { if (!dismissed) show = window.scrollY > 600 })"
         x-show="show && !dismissed"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 translate-y-8"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 translate-y-8"
         class="fixed bottom-0 left-0 right-0 z-50 sm:hidden bg-white border-t border-gray-200 px-4 py-3 shadow-2xl">
        <div class="flex items-center gap-3">
            <a href="#compress"
               x-on:click="dismissed = true; show = false"
               class="flex-1 bg-gradient-to-r from-brand-600 to-brand-700 text-white font-bold py-3 rounded-xl text-sm text-center transition-all active:scale-[0.97] shadow-lg shadow-brand-500/25">
                🗜️ Compress Image Free
            </a>
            <button x-on:click="dismissed = true; show = false"
                    class="p-2 rounded-xl text-gray-400 hover:text-gray-600 hover:bg-gray-100 transition-all flex-shrink-0"
                    aria-label="Dismiss">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
    </div>

</body>
</html>
