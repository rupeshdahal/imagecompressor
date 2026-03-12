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
<article class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-16">

    @if($page->hero_title)
    @php
        $badgeColors = [
            'brand'  => 'bg-indigo-100 text-indigo-700',
            'green'  => 'bg-green-100 text-green-700',
            'purple' => 'bg-purple-100 text-purple-700',
        ];
        $bc = $badgeColors[$page->hero_badge_color ?? 'brand'] ?? $badgeColors['brand'];
    @endphp
    <div class="mb-12 text-center">
        @if($page->hero_badge)
        <span class="inline-block {{ $bc }} text-xs font-semibold px-3 py-1 rounded-full mb-4">{{ $page->hero_badge }}</span>
        @endif
        <h1 class="text-4xl sm:text-5xl font-extrabold mb-4">
            {{ $page->hero_title }}@if($page->hero_title_gradient) <span class="gradient-text">{{ $page->hero_title_gradient }}</span>@endif
        </h1>
        @if($page->hero_description)
        <p class="text-lg text-gray-500 max-w-2xl mx-auto leading-relaxed">{!! $page->hero_description !!}</p>
        @endif
    </div>
    @endif

    @if($page->body)
    <div class="bg-white rounded-2xl border border-gray-200/60 shadow-sm p-8 sm:p-10">
        <div class="prose max-w-none">{!! $page->body !!}</div>
    </div>
    @endif
</article>
@endsection
