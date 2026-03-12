@extends('layouts.page')

@section('title', $page->title)
@section('description', $page->meta_description)
@section('canonical', $page->canonical_url)
@section('og_type', $page->og_type ?? 'website')
@section('og_title', $page->og_title ?? $page->title)
@section('og_description', $page->og_description ?? $page->meta_description)

@section('breadcrumb')
    <li class="flex items-center gap-1.5">
        <svg class="w-3.5 h-3.5 text-gray-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
        <span class="text-gray-600 font-medium" itemprop="name">{{ $page->breadcrumb_label ?? $page->hero_title }}</span>
        <meta itemprop="position" content="2">
    </li>
@endsection

@section('head')
@if($page->schema_markup)
<script type="application/ld+json">{!! json_encode($page->schema_markup, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}</script>
@endif
@endsection

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

    {{-- Hero --}}
    @if($page->hero_title)
    @php
        $badgeColors = [
            'brand'  => 'bg-brand-50 text-brand-700',
            'green'  => 'bg-green-50 text-green-700',
            'purple' => 'bg-purple-50 text-purple-700',
            'blue'   => 'bg-blue-50 text-blue-700',
            'pink'   => 'bg-pink-50 text-pink-700',
            'amber'  => 'bg-amber-50 text-amber-700',
            'red'    => 'bg-red-50 text-red-700',
        ];
        $bc = $badgeColors[$page->hero_badge_color ?? 'brand'] ?? $badgeColors['brand'];
    @endphp
    <div class="text-center mb-10">
        @if($page->hero_badge)
        <div class="inline-flex items-center gap-2 {{ $bc }} text-sm font-semibold px-4 py-1.5 rounded-full mb-4">{{ $page->hero_badge }}</div>
        @endif
        <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight leading-tight mb-4">
            {{ $page->hero_title }}@if($page->hero_title_gradient) <span class="gradient-text">{{ $page->hero_title_gradient }}</span>@endif
        </h1>
        @if($page->hero_description)
        <p class="text-lg text-gray-500 max-w-2xl mx-auto leading-relaxed">{!! $page->hero_description !!}</p>
        @endif
    </div>
    @endif

    {{-- CTA Block --}}
    @if($page->cta_button_url)
    @php
        $ctaMap = [
            'brand'  => ['border-brand-300','hover:border-brand-500','from-brand-500 to-brand-700','shadow-brand-500/25','from-brand-600 to-brand-700','hover:from-brand-500 hover:to-brand-600'],
            'green'  => ['border-green-300','hover:border-green-500','from-green-500 to-green-700','shadow-green-500/25','from-green-600 to-green-700','hover:from-green-500 hover:to-green-600'],
            'purple' => ['border-purple-300','hover:border-purple-500','from-purple-500 to-purple-700','shadow-purple-500/25','from-purple-600 to-purple-700','hover:from-purple-500 hover:to-purple-600'],
            'blue'   => ['border-blue-300','hover:border-blue-500','from-blue-500 to-blue-700','shadow-blue-500/25','from-blue-600 to-blue-700','hover:from-blue-500 hover:to-blue-600'],
            'pink'   => ['border-pink-300','hover:border-pink-500','from-pink-500 to-pink-700','shadow-pink-500/25','from-pink-600 to-pink-700','hover:from-pink-500 hover:to-pink-600'],
            'amber'  => ['border-amber-300','hover:border-amber-500','from-amber-500 to-amber-700','shadow-amber-500/25','from-amber-600 to-amber-700','hover:from-amber-500 hover:to-amber-600'],
            'red'    => ['border-red-300','hover:border-red-500','from-red-500 to-red-700','shadow-red-500/25','from-red-600 to-red-700','hover:from-red-500 hover:to-red-600'],
        ];
        $c = $ctaMap[$page->cta_color ?? 'brand'] ?? $ctaMap['brand'];
    @endphp
    <div class="bg-white rounded-3xl border-2 border-dashed {{ $c[0] }} p-10 text-center mb-14 {{ $c[1] }} hover:shadow-lg transition-all">
        <div class="mx-auto w-20 h-20 bg-gradient-to-br {{ $c[2] }} rounded-3xl flex items-center justify-center mb-5 shadow-xl {{ $c[3] }}">
            <span class="text-4xl text-white">{!! $page->cta_icon ?? '🚀' !!}</span>
        </div>
        <h2 class="text-xl font-bold mb-2">{{ $page->cta_title }}</h2>
        <p class="text-gray-500 mb-6 max-w-md mx-auto">{{ $page->cta_description }}</p>
        <a href="{{ $page->cta_button_url }}" class="inline-flex items-center gap-2 bg-gradient-to-r {{ $c[4] }} text-white font-bold px-8 py-3.5 rounded-2xl shadow-lg {{ $c[3] }} hover:shadow-xl {{ $c[5] }} transition-all text-base">
            {{ $page->cta_button_text }}
        </a>
    </div>
    @endif

    {{-- Body Content --}}
    @if($page->body)
    <div class="bg-white rounded-2xl border border-gray-200/60 shadow-sm p-8 sm:p-10 mb-10">
        <div class="prose max-w-none">{!! $page->body !!}</div>
    </div>
    @endif

    {{-- Related Tools --}}
    @if($page->related_tools && count($page->related_tools) > 0)
    <div class="mb-10">
        <h2 class="text-2xl font-extrabold mb-6">Related Tools</h2>
        <div class="grid sm:grid-cols-3 gap-4">
            @foreach($page->related_tools as $tool)
            <a href="/tools/{{ $tool['slug'] }}" class="bg-white rounded-2xl border border-gray-200/60 p-5 hover:shadow-lg transition-shadow group text-center">
                <div class="text-3xl mb-2">{{ $tool['emoji'] }}</div>
                <h3 class="font-bold text-sm mb-1 group-hover:text-brand-600 transition-colors">{{ $tool['title'] }}</h3>
                <p class="text-xs text-gray-500">{{ $tool['description'] }}</p>
            </a>
            @endforeach
        </div>
    </div>
    @endif

    {{-- Related Blog Posts --}}
    @if($page->related_posts && count($page->related_posts) > 0)
    <div>
        <h2 class="text-2xl font-extrabold mb-6">Learn More</h2>
        <div class="grid sm:grid-cols-2 gap-4">
            @foreach($page->related_posts as $post)
            <a href="/blog/{{ $post['slug'] }}" class="bg-white rounded-2xl border border-gray-200/60 p-5 hover:shadow-lg transition-shadow group">
                <h3 class="font-bold text-sm mb-1 group-hover:text-brand-600 transition-colors">{{ $post['title'] }}</h3>
                <p class="text-xs text-gray-500">{{ $post['description'] }}</p>
            </a>
            @endforeach
        </div>
    </div>
    @endif
</div>
@endsection
