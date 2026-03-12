@extends('layouts.page')

@section('title', 'Blog — Image Optimisation Guides & Tips | CompresslyPro')
@section('description', 'Expert guides on image compression, format comparison, SEO best practices, and web performance optimisation.')
@section('canonical', url('/blog'))
@section('og_title', 'CompresslyPro Blog — Image Optimisation Guides & Tips')
@section('og_description', 'Expert guides on image compression, WebP vs JPG vs PNG, image SEO, and web performance.')
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
            Practical, expert advice on image compression, web performance, and getting the most out of your images.
        </p>
    </div>

    {{-- Featured Article --}}
    @if($featured)
    <a href="/blog/{{ $featured->slug }}" class="block bg-gradient-to-br from-brand-600 to-brand-800 rounded-2xl p-8 sm:p-10 mb-10 text-white hover:shadow-2xl transition-shadow group">
        <span class="inline-block bg-white/20 text-white text-xs font-semibold px-3 py-1 rounded-full mb-4">Featured Guide</span>
        <h2 class="text-2xl sm:text-3xl font-extrabold mb-3 group-hover:underline decoration-2 underline-offset-4">{{ $featured->hero_title ?? $featured->title }}</h2>
        <p class="text-indigo-100 leading-relaxed max-w-2xl mb-4">{{ $featured->excerpt }}</p>
        <div class="flex items-center gap-4 text-sm text-indigo-200">
            @if($featured->published_at)<span>📅 {{ $featured->published_at->format('F j, Y') }}</span>@endif
            @if($featured->read_time)<span>·</span><span>📖 {{ $featured->read_time }}</span>@endif
            @if($featured->category)<span>·</span><span>🏷️ {{ $featured->category }}</span>@endif
        </div>
    </a>
    @endif

    {{-- Article Grid --}}
    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($posts as $post)
        @php
            $cardColors = [
                'purple' => ['from-purple-100 to-purple-50','bg-purple-100 text-purple-700'],
                'green'  => ['from-green-100 to-green-50','bg-green-100 text-green-700'],
                'orange' => ['from-orange-100 to-orange-50','bg-orange-100 text-orange-700'],
                'pink'   => ['from-pink-100 to-pink-50','bg-pink-100 text-pink-700'],
                'blue'   => ['from-blue-100 to-blue-50','bg-blue-100 text-blue-700'],
                'cyan'   => ['from-cyan-100 to-cyan-50','bg-cyan-100 text-cyan-700'],
                'rose'   => ['from-rose-100 to-rose-50','bg-rose-100 text-rose-700'],
                'indigo' => ['from-indigo-100 to-indigo-50','bg-indigo-100 text-indigo-700'],
                'amber'  => ['from-amber-100 to-amber-50','bg-amber-100 text-amber-700'],
                'brand'  => ['from-indigo-100 to-indigo-50','bg-indigo-100 text-indigo-700'],
            ];
            $cc = $cardColors[$post->category_color ?? 'brand'] ?? $cardColors['brand'];
        @endphp
        <a href="/blog/{{ $post->slug }}" class="bg-white rounded-2xl border border-gray-200/60 overflow-hidden hover:shadow-lg transition-shadow group">
            <div class="bg-gradient-to-br {{ $cc[0] }} p-6">
                <span class="text-4xl">{{ $post->listing_emoji ?? '📝' }}</span>
            </div>
            <div class="p-6">
                @if($post->category)
                <span class="inline-block {{ $cc[1] }} text-xs font-semibold px-2.5 py-1 rounded-full mb-3">{{ $post->category }}</span>
                @endif
                <h3 class="font-bold text-lg mb-2 group-hover:text-brand-600 transition-colors">{{ $post->hero_title ?? $post->title }}</h3>
                <p class="text-sm text-gray-500 leading-relaxed mb-3">{{ $post->excerpt }}</p>
                <div class="text-xs text-gray-400">
                    @if($post->published_at)📅 {{ $post->published_at->format('F j, Y') }}@endif
                    @if($post->read_time) · {{ $post->read_time }}@endif
                </div>
            </div>
        </a>
        @endforeach
    </div>
</div>
@endsection
