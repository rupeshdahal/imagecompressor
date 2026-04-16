@extends('layouts.page')

@section('title', 'Blog — Image Optimisation Guides & Tips | CompresslyPro')
@section('description', 'Expert guides on image compression, format comparison, SEO best practices, and web performance optimisation. Learn how to optimise images for websites, email, and social media.')
@section('keywords', 'image optimization blog, image compression guide, webp vs jpg, core web vitals images, image SEO tips, image resizing guide')
@section('canonical', url('/blog'))
@section('og_title', 'CompresslyPro Blog — Image Optimisation Guides & Tips')
@section('og_description', 'Expert guides on image compression, WebP vs JPG vs PNG, image SEO, and web performance. Free practical advice from the CompresslyPro team.')
@section('og_type', 'blog')

@section('head')
<script type="application/ld+json">
{
    "@@context": "https://schema.org",
    "@type": "Blog",
    "name": "CompresslyPro Blog",
    "description": "Expert guides on image compression, web performance, and image SEO.",
    "url": "{{ url('/blog') }}",
    "publisher": { "@type": "Organization", "name": "CompresslyPro", "url": "{{ url('/') }}" },
    "blogPost": [
        @foreach($posts as $i => $post)
        {
            "@type": "BlogPosting",
            "headline": {{ Js::from($post->title) }},
            "url": "{{ url('/blog/' . $post->slug) }}",
            "datePublished": "{{ $post->date_published->toDateString() }}"
        }{{ !$loop->last ? ',' : '' }}
        @endforeach
    ]
}
</script>
@endsection

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

    {{-- Featured Article (from DB) --}}
    @if($featured)
    <a href="/blog/{{ $featured->slug }}" class="block bg-gradient-to-br from-brand-600 to-brand-800 rounded-2xl p-8 sm:p-10 mb-10 text-white hover:shadow-2xl transition-shadow group">
        <span class="inline-block bg-white/20 text-white text-xs font-semibold px-3 py-1 rounded-full mb-4">Featured Guide</span>
        <h2 class="text-2xl sm:text-3xl font-extrabold mb-3 group-hover:underline decoration-2 underline-offset-4">
            {{ $featured->title }}
        </h2>
        <p class="text-indigo-100 leading-relaxed max-w-2xl mb-4">
            {{ $featured->excerpt }}
        </p>
        <div class="flex items-center gap-4 text-sm text-indigo-200">
            <span>📅 {{ $featured->formatted_date }}</span>
            <span>·</span>
            <span>📖 {{ $featured->read_time }} min read</span>
            @if($featured->tags)
            <span>·</span>
            <span>🏷️ {{ implode(', ', array_slice($featured->tags, 0, 2)) }}</span>
            @endif
        </div>
    </a>
    @endif

    {{-- Article Grid --}}
    @php
        $categoryEmojis = [
            'Compression'  => '🗜️',
            'Formats'      => '🖼️',
            'SEO'          => '🔍',
            'Email'        => '📧',
            'Performance'  => '⚡',
            'Workflow'     => '📦',
            'Social Media' => '📱',
            'Watermark'    => '🖊️',
            'WordPress'    => '🌐',
            'PDF'          => '📄',
        ];
        $categoryGrads = [
            'Compression'  => 'from-brand-100 to-brand-50',
            'Formats'      => 'from-purple-100 to-purple-50',
            'SEO'          => 'from-green-100 to-green-50',
            'Email'        => 'from-orange-100 to-orange-50',
            'Performance'  => 'from-pink-100 to-pink-50',
            'Workflow'     => 'from-blue-100 to-blue-50',
            'Social Media' => 'from-cyan-100 to-cyan-50',
            'Watermark'    => 'from-rose-100 to-rose-50',
            'WordPress'    => 'from-indigo-100 to-indigo-50',
            'PDF'          => 'from-amber-100 to-amber-50',
        ];
    @endphp

    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($posts as $post)
            @if($featured && $post->id === $featured->id) @continue @endif
            @php
                $grad  = $categoryGrads[$post->category]  ?? 'from-gray-100 to-gray-50';
                $emoji = $categoryEmojis[$post->category] ?? '📝';
            @endphp
            <a href="/blog/{{ $post->slug }}" class="bg-white rounded-2xl border border-gray-200/60 overflow-hidden hover:shadow-lg transition-shadow group">
                <div class="bg-gradient-to-br {{ $grad }} p-6">
                    <span class="text-4xl">{{ $emoji }}</span>
                </div>
                <div class="p-6">
                    <span class="inline-block {{ \App\Models\BlogPost::categoryColor($post->category) }} text-xs font-semibold px-2.5 py-1 rounded-full mb-3">
                        {{ $post->category }}
                    </span>
                    <h3 class="font-bold text-lg mb-2 group-hover:text-brand-600 transition-colors leading-snug">
                        {{ $post->title }}
                    </h3>
                    <p class="text-sm text-gray-500 leading-relaxed mb-3">
                        {{ Str::limit($post->excerpt, 110) }}
                    </p>
                    <div class="text-xs text-gray-400">📅 {{ $post->short_date }} · {{ $post->read_time }} min read</div>
                </div>
            </a>
        @endforeach
    </div>

    {{-- Pagination --}}
    @if($posts->hasPages())
    <div class="mt-10">
        {{ $posts->links() }}
    </div>
    @endif

</div>
@endsection
