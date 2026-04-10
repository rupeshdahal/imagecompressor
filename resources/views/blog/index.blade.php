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

    @if($posts->count() > 0)
        @php($featured = $posts->first())
        <a href="{{ route('blog.show', $featured->slug) }}" class="block bg-gradient-to-br from-brand-600 to-brand-800 rounded-2xl p-8 sm:p-10 mb-10 text-white hover:shadow-2xl transition-shadow group">
            <span class="inline-block bg-white/20 text-white text-xs font-semibold px-3 py-1 rounded-full mb-4">Featured Guide</span>
            <h2 class="text-2xl sm:text-3xl font-extrabold mb-3 group-hover:underline decoration-2 underline-offset-4">{{ $featured->title }}</h2>
            <p class="text-indigo-100 leading-relaxed max-w-2xl mb-4">{{ \Illuminate\Support\Str::limit($featured->excerpt ?: strip_tags($featured->content), 220) }}</p>
            <div class="flex items-center gap-4 text-sm text-indigo-200">
                <span>{{ optional($featured->published_at)->format('M d, Y') ?? $featured->created_at->format('M d, Y') }}</span>
            </div>
        </a>

        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($posts as $post)
                <a href="{{ route('blog.show', $post->slug) }}" class="bg-white rounded-2xl border border-gray-200/60 overflow-hidden hover:shadow-lg transition-shadow group">
                    @if($post->featured_image_path)
                        <img src="{{ asset('storage/' . $post->featured_image_path) }}" alt="{{ $post->title }}" class="h-44 w-full object-cover">
                    @else
                        <div class="bg-gradient-to-br from-indigo-100 to-indigo-50 p-6">
                            <span class="text-2xl font-semibold text-indigo-700">{{ strtoupper(substr($post->title, 0, 1)) }}</span>
                        </div>
                    @endif
                    <div class="p-6">
                        <h3 class="font-bold text-lg mb-2 group-hover:text-brand-600 transition-colors">{{ $post->title }}</h3>
                        <p class="text-sm text-gray-500 leading-relaxed mb-3">{{ \Illuminate\Support\Str::limit($post->excerpt ?: strip_tags($post->content), 110) }}</p>
                        <div class="text-xs text-gray-400">{{ optional($post->published_at)->format('M d, Y') ?? $post->created_at->format('M d, Y') }}</div>
                    </div>
                </a>
            @endforeach
        </div>

        <div class="mt-8">
            {{ $posts->links() }}
        </div>
    @else
        <div class="bg-white border border-gray-200 rounded-2xl p-10 text-center">
            <h2 class="text-2xl font-bold text-gray-900 mb-2">No posts published yet</h2>
            <p class="text-gray-500">Check back soon for fresh image optimization guides.</p>
        </div>
    @endif
</div>
@endsection
