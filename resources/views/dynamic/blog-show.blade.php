@extends('layouts.page')

@section('title', $post->title . ' | CompresslyPro')
@section('description', $post->excerpt ?? Str::limit(strip_tags($post->body), 150))
@section('canonical', url('/blog/' . $post->slug))
@section('og_title', $post->title)
@section('og_description', $post->excerpt ?? Str::limit(strip_tags($post->body), 150))
@section('og_type', 'article')

@section('breadcrumb')
    <li class="flex items-center gap-1.5">
        <svg class="w-3.5 h-3.5 text-gray-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
        <a href="/blog" class="text-gray-600 hover:text-brand-600 font-medium">Blog</a>
        <meta itemprop="position" content="2">
    </li>
    <li class="flex items-center gap-1.5">
        <svg class="w-3.5 h-3.5 text-gray-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
        <span class="text-gray-600 font-medium truncate max-w-[200px]" title="{{ $post->title }}">{{ $post->title }}</span>
        <meta itemprop="position" content="3">
    </li>
@endsection

@section('content')
<article class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-16">

    <div class="mb-10">
        @if($post->category)
        <div class="flex items-center gap-3 mb-4">
            <span class="inline-block bg-brand-100 text-brand-700 text-xs font-semibold px-3 py-1 rounded-full">{{ $post->category }}</span>
        </div>
        @endif
        
        <h1 class="text-3xl sm:text-4xl font-extrabold mb-4 leading-tight text-slate-900">
            {{ $post->title }}
        </h1>
        
        <div class="flex items-center gap-4 text-sm text-gray-500 mb-6 font-medium">
            <span>📅 {{ \Carbon\Carbon::parse($post->published_at ?? $post->created_at)->format('F j, Y') }}</span>
            @if($post->read_time)
            <span>·</span>
            <span>📖 {{ $post->read_time }}</span>
            @endif
            <span>·</span>
            <span>By CompresslyPro Team</span>
        </div>
        
        @if($post->excerpt)
        <p class="text-lg text-gray-600 leading-relaxed border-l-4 border-brand-200 pl-4">
            {{ $post->excerpt }}
        </p>
        @endif
    </div>

    <div class="bg-white rounded-2xl border border-gray-200/60 shadow-sm p-8 sm:p-10">
        <div class="prose prose-lg sm:prose-xl mx-auto prose-slate prose-a:text-brand-600 hover:prose-a:text-brand-700 max-w-none prose-img:rounded-xl">
            {!! $post->body !!}
        </div>
    </div>
</article>
@endsection