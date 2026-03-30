@extends('layouts.page')

@section('title', 'Sitemap — All CompresslyPro Pages')
@section('description', 'Browse all CompresslyPro pages including image tools, blog posts, and legal pages.')
@section('canonical', url('/sitemap'))
@section('og_title', 'Sitemap — CompresslyPro')
@section('og_description', 'Browse all image tools and blog guides on CompresslyPro.')

@section('content')
<section class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <h1 class="text-3xl sm:text-4xl font-extrabold text-gray-900 mb-4">Sitemap</h1>
    <p class="text-gray-600 mb-10">A complete list of public pages on CompresslyPro.</p>

    <div class="grid gap-8 md:grid-cols-2">
        <article class="bg-white border border-gray-200 rounded-2xl p-6 shadow-sm">
            <h2 class="text-xl font-bold text-gray-900 mb-4">Core Pages</h2>
            <ul class="space-y-2 text-brand-700">
                <li><a class="hover:underline" href="/">Home</a></li>
                <li><a class="hover:underline" href="/about">About</a></li>
                <li><a class="hover:underline" href="/contact">Contact</a></li>
                <li><a class="hover:underline" href="/blog">Blog</a></li>
                <li><a class="hover:underline" href="/sitemap.xml">XML Sitemap</a></li>
            </ul>
        </article>

        <article class="bg-white border border-gray-200 rounded-2xl p-6 shadow-sm">
            <h2 class="text-xl font-bold text-gray-900 mb-4">Image Tools</h2>
            <ul class="space-y-2 text-brand-700">
                <li><a class="hover:underline" href="/compress">Image Compressor</a></li>
                <li><a class="hover:underline" href="/convert">Image Converter</a></li>
                <li><a class="hover:underline" href="/resize">Image Resizer</a></li>
                <li><a class="hover:underline" href="/batch-compress">Batch Compressor</a></li>
                <li><a class="hover:underline" href="/watermark">Watermark Tool</a></li>
                <li><a class="hover:underline" href="/image-to-pdf">Image to PDF</a></li>
                <li><a class="hover:underline" href="/pdf-to-image">PDF to Image</a></li>
            </ul>
        </article>

        <article class="bg-white border border-gray-200 rounded-2xl p-6 shadow-sm md:col-span-2">
            <h2 class="text-xl font-bold text-gray-900 mb-4">Blog Posts</h2>
            <ul class="grid gap-2 sm:grid-cols-2 text-brand-700">
                @foreach($blogSlugs as $slug)
                <li>
                    <a class="hover:underline" href="{{ url('/blog/' . $slug) }}">{{ ucwords(str_replace('-', ' ', $slug)) }}</a>
                </li>
                @endforeach
            </ul>
        </article>

        <article class="bg-white border border-gray-200 rounded-2xl p-6 shadow-sm md:col-span-2">
            <h2 class="text-xl font-bold text-gray-900 mb-4">Legal</h2>
            <ul class="space-y-2 text-brand-700">
                <li><a class="hover:underline" href="/privacy-policy">Privacy Policy</a></li>
                <li><a class="hover:underline" href="/terms">Terms of Service</a></li>
            </ul>
        </article>
    </div>
</section>
@endsection
