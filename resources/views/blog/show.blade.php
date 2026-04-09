@extends('layouts.page')

@section('title', $post->meta_title ?: ($post->title . ' | CompresslyPro'))
@section('description', $post->meta_description ?: $post->excerpt)
@section('canonical', url('/blog/' . $post->slug))
@section('og_type', 'article')
@section('og_title', $post->og_title ?: $post->title)
@section('og_description', $post->og_description ?: ($post->meta_description ?: $post->excerpt))

@section('breadcrumb')
    <li class="flex items-center gap-1.5">
        <svg class="w-3.5 h-3.5 text-gray-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
        <a href="{{ route('blog') }}" itemprop="item" class="hover:text-brand-600 transition-colors font-medium"><span itemprop="name">Blog</span></a>
        <meta itemprop="position" content="2">
    </li>
    <li class="flex items-center gap-1.5">
        <svg class="w-3.5 h-3.5 text-gray-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
        <span class="text-gray-600 font-medium">{{ $post->title }}</span>
        <meta itemprop="position" content="3">
    </li>
@endsection

@section('head')
@if($post->schema_json)
{!! $post->schema_json !!}
@endif
@endsection

@section('content')
{!! $post->content !!}

@if($relatedPosts->isNotEmpty())
<section class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 pb-16">
    <div class="mt-4">
        <h2 class="text-2xl font-extrabold mb-6">Related Articles</h2>
        <div class="grid sm:grid-cols-2 gap-5">
            @foreach($relatedPosts as $related)
            <a href="{{ route('blog.show', $related->slug) }}" class="bg-white rounded-2xl border border-gray-200/60 p-6 hover:shadow-lg transition-shadow group">
                @if($related->category)
                <span class="inline-block bg-indigo-100 text-indigo-700 text-xs font-semibold px-2.5 py-1 rounded-full mb-3">{{ $related->category }}</span>
                @endif
                <h3 class="font-bold mb-2 group-hover:text-brand-600 transition-colors">{{ $related->title }}</h3>
                <p class="text-sm text-gray-500">{{ $related->excerpt }}</p>
            </a>
            @endforeach
        </div>
    </div>
</section>
@endif
@endsection
