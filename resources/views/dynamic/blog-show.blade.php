@extends('layouts.page')

@section('title', $page->title)
@section('description', $page->meta_description)
@section('canonical', $page->canonical_url)
@section('og_type', 'article')
@section('og_title', $page->og_title ?? $page->title)
@section('og_description', $page->og_description ?? $page->meta_description)

@section('breadcrumb')
    <li class="flex items-center gap-1.5">
        <svg class="w-3.5 h-3.5 text-gray-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
        <a href="/blog" itemprop="item" class="hover:text-brand-600 transition-colors font-medium"><span itemprop="name">Blog</span></a>
        <meta itemprop="position" content="2">
    </li>
    <li class="flex items-center gap-1.5">
        <svg class="w-3.5 h-3.5 text-gray-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
        <span class="text-gray-600 font-medium" itemprop="name">{{ $page->breadcrumb_label ?? $page->hero_title }}</span>
        <meta itemprop="position" content="3">
    </li>
@endsection

@section('head')
@if($page->schema_markup)
<script type="application/ld+json">{!! json_encode($page->schema_markup, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}</script>
@endif
@endsection

@section('content')
<article class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-16">

    {{-- Article Header --}}
    <header class="mb-10">
        <div class="flex items-center gap-3 mb-4">
            @if($page->category)
            @php
                $catColors = [
                    'brand'  => 'bg-brand-100 text-brand-700',
                    'purple' => 'bg-purple-100 text-purple-700',
                    'green'  => 'bg-green-100 text-green-700',
                    'orange' => 'bg-orange-100 text-orange-700',
                    'pink'   => 'bg-pink-100 text-pink-700',
                    'blue'   => 'bg-blue-100 text-blue-700',
                    'cyan'   => 'bg-cyan-100 text-cyan-700',
                    'rose'   => 'bg-rose-100 text-rose-700',
                    'indigo' => 'bg-indigo-100 text-indigo-700',
                    'amber'  => 'bg-amber-100 text-amber-700',
                ];
                $cc = $catColors[$page->category_color ?? 'brand'] ?? $catColors['brand'];
            @endphp
            @foreach(explode(',', $page->category) as $cat)
            <span class="inline-block {{ $cc }} text-xs font-semibold px-3 py-1 rounded-full">{{ trim($cat) }}</span>
            @endforeach
            @endif
        </div>
        <h1 class="text-3xl sm:text-4xl font-extrabold tracking-tight mb-4 leading-tight">{{ $page->hero_title ?? $page->title }}</h1>
        <div class="flex items-center gap-4 text-sm text-gray-400 mb-6">
            @if($page->published_at)<span>📅 {{ $page->published_at->format('F j, Y') }}</span><span>·</span>@endif
            @if($page->read_time)<span>📖 {{ $page->read_time }}</span><span>·</span>@endif
            <span>By CompresslyPro Team</span>
        </div>
        @if($page->hero_description)
        <p class="text-lg text-gray-600 leading-relaxed border-l-4 border-brand-200 pl-4">{!! $page->hero_description !!}</p>
        @endif
    </header>

    {{-- Body --}}
    @if($page->body)
    <div class="bg-white rounded-2xl border border-gray-200/60 shadow-sm p-8 sm:p-10">
        <div class="prose max-w-none">{!! $page->body !!}</div>
    </div>
    @endif
</article>
@endsection
