@php
    $isEdit = isset($post);
@endphp

@if($errors->any())
    <div class="mb-6 rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-700 dark:border-red-900/40 dark:bg-red-950/40 dark:text-red-300">
        <p class="font-semibold mb-2">Please fix the following issues:</p>
        <ul class="list-disc pl-5 space-y-1">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="lg:col-span-2 space-y-6">
        <div>
            <label for="title" class="block text-sm font-semibold text-gray-700 dark:text-gray-200 mb-1">Title</label>
            <input id="title" name="title" type="text" value="{{ old('title', $post->title ?? '') }}" required maxlength="160"
                class="w-full rounded-xl border border-gray-300 bg-white px-4 py-3 text-gray-900 placeholder-gray-400 focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-950 dark:text-gray-100 dark:placeholder-gray-500"
                placeholder="Enter post title">
        </div>

        <div>
            <label for="slug" class="block text-sm font-semibold text-gray-700 dark:text-gray-200 mb-1">Slug</label>
            <input id="slug" name="slug" type="text" value="{{ old('slug', $post->slug ?? '') }}" maxlength="180"
                class="w-full rounded-xl border border-gray-300 bg-white px-4 py-3 text-gray-900 placeholder-gray-400 focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-950 dark:text-gray-100 dark:placeholder-gray-500"
                placeholder="auto-generated-from-title">
            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Leave empty to auto-generate from title.</p>
        </div>

        <div>
            <label for="content" class="block text-sm font-semibold text-gray-700 dark:text-gray-200 mb-1">Content</label>
            <textarea id="content" name="content" rows="20" required
                class="w-full rounded-xl border border-gray-300 bg-white px-4 py-3 text-gray-900 placeholder-gray-400 focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-950 dark:text-gray-100 dark:placeholder-gray-500">{{ old('content', $post->content ?? '') }}</textarea>
        </div>
    </div>

    <div class="space-y-6">
        <div class="rounded-2xl border border-gray-200 p-4 bg-gray-50 dark:border-gray-800 dark:bg-gray-900">
            <label for="status" class="block text-sm font-semibold text-gray-700 dark:text-gray-200 mb-1">Status</label>
            <select id="status" name="status" class="w-full rounded-xl border border-gray-300 bg-white px-3 py-2 text-gray-900 focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-950 dark:text-gray-100">
                @php($currentStatus = old('status', $post->status ?? 'draft'))
                <option value="draft" @selected($currentStatus === 'draft')>Draft</option>
                <option value="published" @selected($currentStatus === 'published')>Published</option>
            </select>

            <label for="published_at" class="block text-sm font-semibold text-gray-700 dark:text-gray-200 mt-4 mb-1">Publish Date</label>
            <input id="published_at" name="published_at" type="datetime-local"
                value="{{ old('published_at', isset($post->published_at) && $post->published_at ? $post->published_at->format('Y-m-d\\TH:i') : '') }}"
                class="w-full rounded-xl border border-gray-300 bg-white px-3 py-2 text-gray-900 focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-950 dark:text-gray-100">
        </div>

        <div class="rounded-2xl border border-gray-200 p-4 bg-gray-50 dark:border-gray-800 dark:bg-gray-900">
            <label for="featured_image" class="block text-sm font-semibold text-gray-700 dark:text-gray-200 mb-2">Featured Image</label>
            <input id="featured_image" name="featured_image" type="file" accept="image/jpeg,image/png,image/webp" class="filepond">

            @if(!empty($post?->featured_image_path))
                <div class="mt-4">
                    <img src="{{ asset('storage/' . $post->featured_image_path) }}" alt="Current featured image" class="w-full rounded-lg border border-gray-200 dark:border-gray-700">
                    <label class="mt-3 inline-flex items-center gap-2 text-sm text-gray-600 dark:text-gray-300">
                        <input type="checkbox" name="remove_featured_image" value="1" class="rounded border-gray-300 dark:border-gray-600 dark:bg-gray-950">
                        Remove current image
                    </label>
                </div>
            @endif
        </div>

        <div class="rounded-2xl border border-gray-200 p-4 bg-gray-50 dark:border-gray-800 dark:bg-gray-900">
            <label for="meta_title" class="block text-sm font-semibold text-gray-700 dark:text-gray-200 mb-1">Meta Title</label>
            <input id="meta_title" name="meta_title" type="text" value="{{ old('meta_title', $post->meta_title ?? '') }}" maxlength="160"
                class="w-full rounded-xl border border-gray-300 bg-white px-3 py-2 text-gray-900 placeholder-gray-400 focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-950 dark:text-gray-100 dark:placeholder-gray-500"
                placeholder="Optional SEO title">

            <label for="meta_description" class="block text-sm font-semibold text-gray-700 dark:text-gray-200 mt-4 mb-1">Meta Description</label>
            <textarea id="meta_description" name="meta_description" rows="4" maxlength="320"
                class="w-full rounded-xl border border-gray-300 bg-white px-3 py-2 text-gray-900 placeholder-gray-400 focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-950 dark:text-gray-100 dark:placeholder-gray-500"
                placeholder="Optional SEO description">{{ old('meta_description', $post->meta_description ?? '') }}</textarea>

            <label for="excerpt" class="block text-sm font-semibold text-gray-700 dark:text-gray-200 mt-4 mb-1">Excerpt</label>
            <textarea id="excerpt" name="excerpt" rows="4" maxlength="2000"
                class="w-full rounded-xl border border-gray-300 bg-white px-3 py-2 text-gray-900 placeholder-gray-400 focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-950 dark:text-gray-100 dark:placeholder-gray-500"
                placeholder="Short summary for listing page">{{ old('excerpt', $post->excerpt ?? '') }}</textarea>
        </div>

        <button type="submit" class="w-full rounded-xl bg-indigo-600 text-white font-semibold px-4 py-3 hover:bg-indigo-500 transition-colors">
            {{ $isEdit ? 'Update Post' : 'Create Post' }}
        </button>
    </div>
</div>
