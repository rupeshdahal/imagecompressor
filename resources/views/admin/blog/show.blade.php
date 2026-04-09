@extends('admin.blog.layout')

@section('title', 'View Blog Post')
@section('page_title', 'View Blog Post')

@section('content')
<div class="mx-auto max-w-4xl space-y-5">
    <div class="flex flex-wrap items-center justify-between gap-3">
        <div>
            <h2 class="text-xl font-bold text-gray-900 dark:text-gray-100">{{ $blogPost->title }}</h2>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">/{{ $blogPost->slug }}</p>
        </div>
        <div class="flex items-center gap-2">
            <a href="{{ route('admin.blog.edit', $blogPost) }}" class="rounded-xl bg-brand-600 px-4 py-2 text-sm font-semibold text-white hover:bg-brand-700">Edit</a>
            <a href="{{ route('admin.blog.index') }}" class="rounded-xl border border-gray-300 px-4 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-100 dark:border-gray-700 dark:text-gray-300 dark:hover:bg-gray-800">Back</a>
        </div>
    </div>

    <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-800 dark:bg-gray-900">
        <div class="mb-4 flex flex-wrap gap-2">
            <span class="inline-flex items-center rounded-full bg-gray-100 px-3 py-1 text-xs font-semibold text-gray-700 dark:bg-gray-800 dark:text-gray-300">{{ $blogPost->category ?: 'Uncategorized' }}</span>
            @if ($blogPost->is_published)
                <span class="inline-flex items-center rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700 dark:bg-green-900/30 dark:text-green-300">Published</span>
            @else
                <span class="inline-flex items-center rounded-full bg-amber-100 px-3 py-1 text-xs font-semibold text-amber-700 dark:bg-amber-900/30 dark:text-amber-300">Draft</span>
            @endif
            @if ($blogPost->is_featured)
                <span class="inline-flex items-center rounded-full bg-purple-100 px-3 py-1 text-xs font-semibold text-purple-700 dark:bg-purple-900/30 dark:text-purple-300">Featured</span>
            @endif
        </div>

        @if ($blogPost->excerpt)
            <p class="mb-6 rounded-xl border-l-4 border-brand-400 bg-brand-50 px-4 py-3 text-sm text-gray-700 dark:border-brand-500 dark:bg-brand-900/20 dark:text-gray-200">
                {{ $blogPost->excerpt }}
            </p>
        @endif

        @if ($blogPost->featured_image)
            <div class="mb-6 overflow-hidden rounded-xl border border-gray-200 dark:border-gray-800">
                <img src="{{ $blogPost->featured_image }}" alt="{{ $blogPost->title }}" class="h-auto max-h-[460px] w-full object-cover">
            </div>
        @endif

        <div class="blog-content max-w-none text-gray-800 dark:text-gray-100">
            {!! $blogPost->content !!}
        </div>
    </div>
</div>

<style>
    .blog-content {
        line-height: 1.75;
        word-break: break-word;
    }

    .blog-content * {
        color: inherit;
    }

    .blog-content h1,
    .blog-content h2,
    .blog-content h3,
    .blog-content h4 {
        font-weight: 700;
        line-height: 1.35;
        margin-top: 1.1rem;
        margin-bottom: 0.7rem;
    }

    .blog-content p,
    .blog-content ul,
    .blog-content ol,
    .blog-content blockquote {
        margin-bottom: 0.9rem;
    }

    .blog-content ul,
    .blog-content ol {
        padding-left: 1.25rem;
    }

    .blog-content a {
        color: #4f46e5;
        text-decoration: underline;
    }

    .dark .blog-content a {
        color: #a5b4fc;
    }

    .blog-content strong,
    .blog-content b {
        color: inherit;
        font-weight: 700;
    }

    .blog-content blockquote {
        border-left: 4px solid rgb(99 102 241 / 0.35);
        padding-left: 1rem;
        color: inherit;
        font-style: italic;
    }

    .blog-content table {
        width: 100%;
        border-collapse: collapse;
        margin: 1rem 0;
    }

    .blog-content th,
    .blog-content td {
        border: 1px solid rgb(148 163 184 / 0.25);
        padding: 0.75rem;
        text-align: left;
    }

    .dark .blog-content th,
    .dark .blog-content td {
        border-color: rgb(71 85 105 / 0.6);
    }

    .blog-content img {
        max-width: 100%;
        height: auto;
        border-radius: 0.75rem;
        margin: 0.75rem 0;
    }

    .blog-preview {
        min-height: 280px;
        color: #1f2937;
        line-height: 1.7;
    }

    .dark .blog-preview {
        color: #f9fafb;
    }

    .blog-preview h1,
    .blog-preview h2,
    .blog-preview h3,
    .blog-preview h4,
    .blog-preview p,
    .blog-preview li,
    .blog-preview blockquote,
    .blog-preview strong,
    .blog-preview b,
    .blog-preview a {
        color: inherit;
    }

    .blog-preview h1,
    .blog-preview h2,
    .blog-preview h3,
    .blog-preview h4 {
        font-weight: 700;
        line-height: 1.3;
        margin-bottom: 0.65rem;
    }

    .blog-preview img {
        max-width: 100%;
        height: auto;
        border-radius: 0.75rem;
        margin: 0.75rem 0;
    }
</style>
@endsection