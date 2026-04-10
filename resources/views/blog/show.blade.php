@extends('layouts.page')

@section('title', ($post->meta_title ?: $post->title) . ' | CompresslyPro Blog')
@section('description', $post->meta_description ?: \Illuminate\Support\Str::limit(strip_tags($post->excerpt ?: $post->content), 155))
@section('canonical', url('/blog/' . $post->slug))
@section('og_title', $post->meta_title ?: $post->title)
@section('og_description', $post->meta_description ?: \Illuminate\Support\Str::limit(strip_tags($post->excerpt ?: $post->content), 155))
@section('og_type', 'article')

@section('breadcrumb')
    <li class="flex items-center gap-1.5">
        <svg class="w-3.5 h-3.5 text-gray-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
        <a href="{{ route('blog') }}" class="text-gray-500 hover:text-brand-600 font-medium">Blog</a>
        <meta itemprop="position" content="2">
    </li>
    <li class="flex items-center gap-1.5">
        <svg class="w-3.5 h-3.5 text-gray-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
        <span class="text-gray-700 font-medium">{{ $post->title }}</span>
        <meta itemprop="position" content="3">
    </li>
@endsection

@section('content')
<article class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-14">
    <header class="mb-8">
        <p class="text-sm text-gray-500 mb-3">{{ optional($post->published_at)->format('F d, Y') ?? $post->created_at->format('F d, Y') }}</p>
        <h1 class="text-3xl sm:text-5xl font-extrabold text-gray-900 leading-tight mb-5">{{ $post->title }}</h1>
        @if($post->excerpt)
            <p class="text-lg text-gray-600 leading-relaxed">{{ $post->excerpt }}</p>
        @endif
    </header>

    @if($post->featured_image_path)
        <img src="{{ asset('storage/' . $post->featured_image_path) }}" alt="{{ $post->title }}" class="w-full rounded-2xl border border-gray-200 mb-8">
    @endif

    <div class="prose prose-lg max-w-none prose-img:rounded-xl prose-img:border prose-img:border-gray-200">
        {!! $post->content !!}
    </div>
</article>
@endsection
