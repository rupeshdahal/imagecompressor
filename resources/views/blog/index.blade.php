@extends('layouts.page')

@section('title', 'Blog — Image Optimisation Guides & Tips | CompresslyPro')
@section('description', 'Expert guides on image compression, format comparison, SEO best practices, and web performance optimisation. Learn how to optimise images for websites, email, and social media.')
@section('canonical', url('/blog'))
@section('og_title', 'CompresslyPro Blog — Image Optimisation Guides & Tips')
@section('og_description', 'Expert guides on image compression, WebP vs JPG vs PNG, image SEO, and web performance. Free practical advice from the CompresslyPro team.')
@section('og_type', 'blog')

@section('breadcrumb')
    <li class="flex items-center gap-1.5">
        <svg class="w-3.5 h-3.5 text-gray-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
        <span class="text-gray-600 font-medium">Blog</span>
        <meta itemprop="position" content="2">
    </li>
@endsection

@section('content')
<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-16">

    {{-- Header --}}
    <div class="mb-12 text-center">
        <span class="inline-block bg-indigo-100 text-indigo-700 text-xs font-semibold px-3 py-1 rounded-full mb-4">Blog & Guides</span>
        <h1 class="text-4xl sm:text-5xl font-extrabold mb-4">Image <span class="gradient-text">Optimisation</span> Guides</h1>
        <p class="text-lg text-gray-500 max-w-2xl mx-auto leading-relaxed">
            Practical, expert advice on image compression, web performance, and getting the most out of your images. Written by the CompresslyPro team.
        </p>
    </div>

    {{-- Featured Article --}}
    <a href="/blog/how-to-compress-images-for-web" class="block bg-gradient-to-br from-brand-600 to-brand-800 rounded-2xl p-8 sm:p-10 mb-10 text-white hover:shadow-2xl transition-shadow group">
        <span class="inline-block bg-white/20 text-white text-xs font-semibold px-3 py-1 rounded-full mb-4">Featured Guide</span>
        <h2 class="text-2xl sm:text-3xl font-extrabold mb-3 group-hover:underline decoration-2 underline-offset-4">The Complete Guide to Image Compression for the Web in 2026</h2>
        <p class="text-indigo-100 leading-relaxed max-w-2xl mb-4">
            Everything you need to know about compressing images for websites — from choosing the right format and quality settings to advanced techniques for Core Web Vitals optimisation. Practical, step-by-step advice with real examples.
        </p>
        <div class="flex items-center gap-4 text-sm text-indigo-200">
            <span>📅 March 10, 2026</span>
            <span>·</span>
            <span>📖 12 min read</span>
            <span>·</span>
            <span>🏷️ Compression, Web Performance</span>
        </div>
    </a>

    {{-- Article Grid --}}
    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">

        {{-- Article 2 --}}
        <a href="/blog/webp-vs-jpg-vs-png" class="bg-white rounded-2xl border border-gray-200/60 overflow-hidden hover:shadow-lg transition-shadow group">
            <div class="bg-gradient-to-br from-purple-100 to-purple-50 p-6">
                <span class="text-4xl">🖼️</span>
            </div>
            <div class="p-6">
                <span class="inline-block bg-purple-100 text-purple-700 text-xs font-semibold px-2.5 py-1 rounded-full mb-3">Formats</span>
                <h3 class="font-bold text-lg mb-2 group-hover:text-brand-600 transition-colors">WebP vs JPG vs PNG: Which Image Format Should You Use?</h3>
                <p class="text-sm text-gray-500 leading-relaxed mb-3">A detailed comparison of the three most popular web image formats — with recommendations for every use case.</p>
                <div class="text-xs text-gray-400">📅 March 8, 2026 · 9 min read</div>
            </div>
        </a>

        {{-- Article 3 --}}
        <a href="/blog/image-seo-best-practices" class="bg-white rounded-2xl border border-gray-200/60 overflow-hidden hover:shadow-lg transition-shadow group">
            <div class="bg-gradient-to-br from-green-100 to-green-50 p-6">
                <span class="text-4xl">🔍</span>
            </div>
            <div class="p-6">
                <span class="inline-block bg-green-100 text-green-700 text-xs font-semibold px-2.5 py-1 rounded-full mb-3">SEO</span>
                <h3 class="font-bold text-lg mb-2 group-hover:text-brand-600 transition-colors">Image SEO Best Practices: How to Rank Images in Google</h3>
                <p class="text-sm text-gray-500 leading-relaxed mb-3">Learn how to optimise your images for search engines — from file names and alt text to lazy loading and structured data.</p>
                <div class="text-xs text-gray-400">📅 March 5, 2026 · 10 min read</div>
            </div>
        </a>

        {{-- Article 4 --}}
        <a href="/blog/reduce-image-size-for-email" class="bg-white rounded-2xl border border-gray-200/60 overflow-hidden hover:shadow-lg transition-shadow group">
            <div class="bg-gradient-to-br from-orange-100 to-orange-50 p-6">
                <span class="text-4xl">📧</span>
            </div>
            <div class="p-6">
                <span class="inline-block bg-orange-100 text-orange-700 text-xs font-semibold px-2.5 py-1 rounded-full mb-3">Practical</span>
                <h3 class="font-bold text-lg mb-2 group-hover:text-brand-600 transition-colors">How to Reduce Image Size for Email Attachments</h3>
                <p class="text-sm text-gray-500 leading-relaxed mb-3">Step-by-step guide to compressing photos for email — with specific settings for Gmail, Outlook, and other providers.</p>
                <div class="text-xs text-gray-400">📅 March 1, 2026 · 6 min read</div>
            </div>
        </a>

        {{-- Article 5 --}}
        <a href="/blog/core-web-vitals-image-optimization" class="bg-white rounded-2xl border border-gray-200/60 overflow-hidden hover:shadow-lg transition-shadow group">
            <div class="bg-gradient-to-br from-pink-100 to-pink-50 p-6">
                <span class="text-4xl">⚡</span>
            </div>
            <div class="p-6">
                <span class="inline-block bg-pink-100 text-pink-700 text-xs font-semibold px-2.5 py-1 rounded-full mb-3">Performance</span>
                <h3 class="font-bold text-lg mb-2 group-hover:text-brand-600 transition-colors">Core Web Vitals: How Images Impact Your Google Rankings</h3>
                <p class="text-sm text-gray-500 leading-relaxed mb-3">Understand LCP, CLS, and INP — and learn exactly how image optimisation can boost your PageSpeed scores.</p>
                <div class="text-xs text-gray-400">📅 February 25, 2026 · 11 min read</div>
            </div>
        </a>

        {{-- Article 6 --}}
        <a href="/blog/batch-image-compression-workflow" class="bg-white rounded-2xl border border-gray-200/60 overflow-hidden hover:shadow-lg transition-shadow group">
            <div class="bg-gradient-to-br from-blue-100 to-blue-50 p-6">
                <span class="text-4xl">📦</span>
            </div>
            <div class="p-6">
                <span class="inline-block bg-blue-100 text-blue-700 text-xs font-semibold px-2.5 py-1 rounded-full mb-3">Workflow</span>
                <h3 class="font-bold text-lg mb-2 group-hover:text-brand-600 transition-colors">The Ultimate Batch Image Compression Workflow for Bloggers</h3>
                <p class="text-sm text-gray-500 leading-relaxed mb-3">How to compress dozens of blog images at once, download as ZIP, and upload to WordPress in minutes.</p>
                <div class="text-xs text-gray-400">📅 February 20, 2026 · 7 min read</div>
            </div>
        </a>

        {{-- Article 7 --}}
        <a href="/blog/best-image-formats-for-social-media" class="bg-white rounded-2xl border border-gray-200/60 overflow-hidden hover:shadow-lg transition-shadow group">
            <div class="bg-gradient-to-br from-cyan-100 to-cyan-50 p-6">
                <span class="text-4xl">📱</span>
            </div>
            <div class="p-6">
                <span class="inline-block bg-cyan-100 text-cyan-700 text-xs font-semibold px-2.5 py-1 rounded-full mb-3">Social Media</span>
                <h3 class="font-bold text-lg mb-2 group-hover:text-brand-600 transition-colors">Best Image Formats for Social Media in 2025 — Complete Size Guide</h3>
                <p class="text-sm text-gray-500 leading-relaxed mb-3">Exact image dimensions and recommended formats for Facebook, Instagram, Twitter/X, LinkedIn, and Pinterest.</p>
                <div class="text-xs text-gray-400">📅 March 15, 2025 · 12 min read</div>
            </div>
        </a>

        {{-- Article 8 --}}
        <a href="/blog/how-to-add-watermark-to-photos" class="bg-white rounded-2xl border border-gray-200/60 overflow-hidden hover:shadow-lg transition-shadow group">
            <div class="bg-gradient-to-br from-rose-100 to-rose-50 p-6">
                <span class="text-4xl">🖊️</span>
            </div>
            <div class="p-6">
                <span class="inline-block bg-rose-100 text-rose-700 text-xs font-semibold px-2.5 py-1 rounded-full mb-3">Protection</span>
                <h3 class="font-bold text-lg mb-2 group-hover:text-brand-600 transition-colors">How to Add a Watermark to Photos — Protect Your Images Online</h3>
                <p class="text-sm text-gray-500 leading-relaxed mb-3">Step-by-step guide to watermarking your photos. Best practices for placement, opacity, and protection levels.</p>
                <div class="text-xs text-gray-400">📅 March 18, 2025 · 9 min read</div>
            </div>
        </a>

        {{-- Article 9 --}}
        <a href="/blog/optimize-images-for-wordpress" class="bg-white rounded-2xl border border-gray-200/60 overflow-hidden hover:shadow-lg transition-shadow group">
            <div class="bg-gradient-to-br from-indigo-100 to-indigo-50 p-6">
                <span class="text-4xl">🌐</span>
            </div>
            <div class="p-6">
                <span class="inline-block bg-indigo-100 text-indigo-700 text-xs font-semibold px-2.5 py-1 rounded-full mb-3">WordPress</span>
                <h3 class="font-bold text-lg mb-2 group-hover:text-brand-600 transition-colors">How to Optimise Images for WordPress — Speed Up Your Website</h3>
                <p class="text-sm text-gray-500 leading-relaxed mb-3">Complete guide to WordPress image optimisation. Reduce load times, improve Core Web Vitals, and boost SEO.</p>
                <div class="text-xs text-gray-400">📅 March 20, 2025 · 11 min read</div>
            </div>
        </a>

        {{-- Article 10 --}}
        <a href="/blog/convert-images-to-pdf-guide" class="bg-white rounded-2xl border border-gray-200/60 overflow-hidden hover:shadow-lg transition-shadow group">
            <div class="bg-gradient-to-br from-amber-100 to-amber-50 p-6">
                <span class="text-4xl">📄</span>
            </div>
            <div class="p-6">
                <span class="inline-block bg-amber-100 text-amber-700 text-xs font-semibold px-2.5 py-1 rounded-full mb-3">Conversion</span>
                <h3 class="font-bold text-lg mb-2 group-hover:text-brand-600 transition-colors">How to Convert Images to PDF — Complete Step-by-Step Guide</h3>
                <p class="text-sm text-gray-500 leading-relaxed mb-3">Convert JPG, PNG, and WebP images to PDF documents. Merge multiple images with custom page settings.</p>
                <div class="text-xs text-gray-400">📅 March 22, 2025 · 8 min read</div>
            </div>
        </a>

    </div>
</div>
@endsection
