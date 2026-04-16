@extends('layouts.page')

@section('title', $post->resolvedMetaTitle())
@section('description', $post->meta_description)
@section('keywords', $post->meta_keywords)
@section('canonical', url('/blog/' . $post->slug))
@section('og_type', 'article')
@section('og_title', $post->og_title ?: $post->title)
@section('og_description', $post->og_description ?: $post->meta_description)

@section('breadcrumb')
    <li class="flex items-center gap-1.5">
        <svg class="w-3.5 h-3.5 text-gray-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
        <a href="/blog" itemprop="item" class="hover:text-brand-600 transition-colors font-medium"><span itemprop="name">Blog</span></a>
        <meta itemprop="position" content="2">
    </li>
    <li class="flex items-center gap-1.5">
        <svg class="w-3.5 h-3.5 text-gray-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
        <span class="text-gray-600 font-medium">{{ Str::limit($post->title, 50) }}</span>
        <meta itemprop="position" content="3">
    </li>
@endsection

@section('head')
<script type="application/ld+json">
{
    "@@context": "https://schema.org",
    "@type": "BlogPosting",
    "headline": {{ Js::from($post->title) }},
    "description": {{ Js::from($post->meta_description) }},
    "author": { "@type": "Organization", "name": "CompresslyPro", "url": "{{ url('/') }}" },
    "publisher": { "@type": "Organization", "name": "CompresslyPro", "logo": { "@type": "ImageObject", "url": "{{ url('/og-image.png') }}" } },
    "datePublished": "{{ $post->date_published->toDateString() }}",
    "dateModified": "{{ $post->date_modified->toDateString() }}",
    "url": "{{ url('/blog/' . $post->slug) }}",
    "image": "{{ url('/og-image.png') }}",
    "mainEntityOfPage": { "@type": "WebPage", "@id": "{{ url('/blog/' . $post->slug) }}" },
    "wordCount": {{ $post->word_count }},
    "isPartOf": { "@type": "Blog", "name": "CompresslyPro Blog", "url": "{{ url('/blog') }}" }
    @if($post->schema_keywords)
    , "keywords": {{ Js::from($post->schema_keywords) }}
    @endif
}
</script>
@endsection

@section('content')
<article class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-16">

    {{-- Article Header --}}
    <div class="mb-10">
        <div class="flex items-center gap-3 mb-4">
            <span class="inline-block {{ \App\Models\BlogPost::categoryColor($post->category) }} text-xs font-semibold px-3 py-1 rounded-full">
                {{ $post->category }}
            </span>
            @foreach(($post->tags ?? []) as $idx => $tag)
                @if($idx > 0 && $tag !== $post->category)
                    <span class="inline-block bg-gray-100 text-gray-600 text-xs font-semibold px-3 py-1 rounded-full">{{ $tag }}</span>
                @endif
            @endforeach
        </div>

        <h1 class="text-3xl sm:text-4xl font-extrabold mb-4 leading-tight">{{ $post->title }}</h1>

        <div class="flex items-center gap-4 text-sm text-gray-400 mb-6">
            <span>📅 {{ $post->formatted_date }}</span>
            <span>·</span>
            <span>📖 {{ $post->read_time }} min read</span>
            <span>·</span>
            <span>By CompresslyPro Team</span>
        </div>

        <p class="text-lg text-gray-600 leading-relaxed border-l-4 border-brand-200 pl-4">
            {{ $post->excerpt }}
        </p>
    </div>

    {{-- Article Body --}}
    <div class="bg-white rounded-2xl border border-gray-200/60 shadow-sm p-8 sm:p-10">
        <div class="prose max-w-none">
            {!! $post->content !!}
        </div>
    </div>

    {{-- Related Articles --}}
    @if($related->isNotEmpty())
    <div class="mt-12">
        <h2 class="text-2xl font-extrabold mb-6">Related Articles</h2>
        <div class="grid sm:grid-cols-2 gap-5">
            @foreach($related as $rel)
            <a href="/blog/{{ $rel->slug }}" class="bg-white rounded-2xl border border-gray-200/60 p-6 hover:shadow-lg transition-shadow group">
                <span class="inline-block {{ \App\Models\BlogPost::categoryColor($rel->category) }} text-xs font-semibold px-2.5 py-1 rounded-full mb-3">{{ $rel->category }}</span>
                <h3 class="font-bold mb-2 group-hover:text-brand-600 transition-colors">{{ $rel->title }}</h3>
                <p class="text-sm text-gray-500">{{ Str::limit($rel->excerpt, 100) }}</p>
            </a>
            @endforeach
        </div>
    </div>
    @endif

</article>
@endsection
