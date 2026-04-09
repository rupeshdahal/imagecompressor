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

    @if($featuredPost)
    {{-- Featured Article --}}
    <a href="{{ route('blog.show', $featuredPost->slug) }}" class="block bg-gradient-to-br from-brand-600 to-brand-800 rounded-2xl p-8 sm:p-10 mb-10 text-white hover:shadow-2xl transition-shadow group">
        <span class="inline-block bg-white/20 text-white text-xs font-semibold px-3 py-1 rounded-full mb-4">Featured Guide</span>
        <h2 class="text-2xl sm:text-3xl font-extrabold mb-3 group-hover:underline decoration-2 underline-offset-4">{{ $featuredPost->title }}</h2>
        <p class="text-indigo-100 leading-relaxed max-w-2xl mb-4">
            {{ $featuredPost->excerpt }}
        </p>
        <div class="flex items-center gap-4 text-sm text-indigo-200">
            <span>Published {{ optional($featuredPost->published_at)->format('M d, Y') }}</span>
            @if($featuredPost->read_time_minutes)
            <span>·</span>
            <span>{{ $featuredPost->read_time_minutes }} min read</span>
            @endif
            @if($featuredPost->category)
            <span>·</span>
            <span>{{ $featuredPost->category }}</span>
            @endif
        </div>
    </a>
    @endif

    {{-- Article Grid --}}
    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($posts as $post)
            @if(! $featuredPost || $post->id !== $featuredPost->id)
            <a href="{{ route('blog.show', $post->slug) }}" class="bg-white rounded-2xl border border-gray-200/60 overflow-hidden hover:shadow-lg transition-shadow group">
                <div class="bg-gradient-to-br from-indigo-100 to-indigo-50 p-6">
                    <span class="inline-block bg-white/80 text-xs font-semibold px-2.5 py-1 rounded-full text-indigo-700">{{ $post->category ?: 'Guide' }}</span>
                </div>
                <div class="p-6">
                    @if($post->category)
                    <span class="inline-block bg-indigo-100 text-indigo-700 text-xs font-semibold px-2.5 py-1 rounded-full mb-3">{{ $post->category }}</span>
                    @endif
                    <h3 class="font-bold text-lg mb-2 group-hover:text-brand-600 transition-colors">{{ $post->title }}</h3>
                    <p class="text-sm text-gray-500 leading-relaxed mb-3">{{ $post->excerpt }}</p>
                    <div class="text-xs text-gray-400">
                        {{ optional($post->published_at)->format('M d, Y') }}
                        @if($post->read_time_minutes)
                            · {{ $post->read_time_minutes }} min read
                        @endif
                    </div>
                </div>
            </a>
            @endif
        @empty
        <div class="sm:col-span-2 lg:col-span-3 bg-white border border-gray-200/60 rounded-2xl p-8 text-center text-gray-500">
            No blog posts published yet.
        </div>
        @endforelse

    </div>
</div>
@endsection
