<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $post->exists ? 'Edit Post' : 'New Post' }} - CompresslyPro Admin</title>
    <meta name="robots" content="noindex, nofollow">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-900 min-h-screen">
    <main class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-2xl font-bold">{{ $post->exists ? 'Edit Blog Post' : 'Create Blog Post' }}</h1>
                <p class="text-sm text-gray-500">HTML content is supported in the content editor.</p>
            </div>
            <a href="{{ route('admin.blog.index') }}" class="px-4 py-2 rounded-xl border border-gray-300 bg-white hover:bg-gray-50">Back</a>
        </div>

        @if($errors->any())
            <div class="mb-4 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-red-700 text-sm">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ $post->exists ? route('admin.blog.update', $post) : route('admin.blog.store') }}" class="space-y-5">
            @csrf
            @if($post->exists)
                @method('PUT')
            @endif

            <div class="grid md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold mb-1">Title</label>
                    <input name="title" value="{{ old('title', $post->title) }}" required class="w-full px-3 py-2 rounded-xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                </div>
                <div>
                    <label class="block text-sm font-semibold mb-1">Slug</label>
                    <input name="slug" value="{{ old('slug', $post->slug) }}" required class="w-full px-3 py-2 rounded-xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                </div>
            </div>

            <div>
                <label class="block text-sm font-semibold mb-1">Excerpt</label>
                <textarea name="excerpt" rows="3" class="w-full px-3 py-2 rounded-xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500">{{ old('excerpt', $post->excerpt) }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-semibold mb-1">Content (HTML)</label>
                <textarea name="content" rows="20" required class="w-full px-3 py-2 rounded-xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 font-mono text-sm">{{ old('content', $post->content) }}</textarea>
            </div>

            <div class="grid md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold mb-1">Meta Title</label>
                    <input name="meta_title" value="{{ old('meta_title', $post->meta_title) }}" class="w-full px-3 py-2 rounded-xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                </div>
                <div>
                    <label class="block text-sm font-semibold mb-1">Category</label>
                    <input name="category" value="{{ old('category', $post->category) }}" class="w-full px-3 py-2 rounded-xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                </div>
            </div>

            <div class="grid md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold mb-1">Meta Description</label>
                    <textarea name="meta_description" rows="3" class="w-full px-3 py-2 rounded-xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500">{{ old('meta_description', $post->meta_description) }}</textarea>
                </div>
                <div>
                    <label class="block text-sm font-semibold mb-1">OG Description</label>
                    <textarea name="og_description" rows="3" class="w-full px-3 py-2 rounded-xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500">{{ old('og_description', $post->og_description) }}</textarea>
                </div>
            </div>

            <div class="grid md:grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-semibold mb-1">OG Title</label>
                    <input name="og_title" value="{{ old('og_title', $post->og_title) }}" class="w-full px-3 py-2 rounded-xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                </div>
                <div>
                    <label class="block text-sm font-semibold mb-1">Read Time (minutes)</label>
                    <input type="number" min="1" max="120" name="read_time_minutes" value="{{ old('read_time_minutes', $post->read_time_minutes) }}" class="w-full px-3 py-2 rounded-xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                </div>
                <div>
                    <label class="block text-sm font-semibold mb-1">Published At</label>
                    <input type="datetime-local" name="published_at" value="{{ old('published_at', optional($post->published_at)->format('Y-m-d\\TH:i')) }}" class="w-full px-3 py-2 rounded-xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                </div>
            </div>

            <div>
                <label class="block text-sm font-semibold mb-1">Schema JSON / Head HTML</label>
                <textarea name="schema_json" rows="8" class="w-full px-3 py-2 rounded-xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 font-mono text-sm">{{ old('schema_json', $post->schema_json) }}</textarea>
            </div>

            <div class="flex items-center gap-6">
                <label class="inline-flex items-center gap-2 text-sm">
                    <input type="checkbox" name="is_published" value="1" {{ old('is_published', $post->is_published) ? 'checked' : '' }}>
                    Published
                </label>
                <label class="inline-flex items-center gap-2 text-sm">
                    <input type="checkbox" name="featured" value="1" {{ old('featured', $post->featured) ? 'checked' : '' }}>
                    Featured
                </label>
            </div>

            <div class="pt-2">
                <button type="submit" class="px-5 py-2.5 rounded-xl bg-indigo-600 text-white font-semibold hover:bg-indigo-500">
                    {{ $post->exists ? 'Update Post' : 'Create Post' }}
                </button>
            </div>
        </form>
    </main>
</body>
</html>
