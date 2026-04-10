@extends('admin.layouts.app')

@section('title', 'Manage Blog')
@section('page_title', 'Manage Blog Posts')
@section('nav_blog', 'bg-brand-50 dark:bg-brand-900/20 text-brand-700 dark:text-brand-300 font-semibold')

@section('header_actions')
    <a href="{{ route('admin.blog.create') }}" class="rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-500">New Post</a>
@endsection

@section('content')
    <div class="max-w-7xl mx-auto">
        <div class="flex flex-wrap items-center justify-between gap-4 mb-6">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Manage Blog Posts</h1>
                <p class="text-sm text-gray-500 mt-1">Create, edit, publish, and delete posts.</p>
            </div>
            <div class="flex items-center gap-2">
                <a href="{{ route('admin.blog.create') }}" class="rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-500">New Post</a>
            </div>
        </div>

        @if(session('success'))
            <div class="mb-4 rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">
                {{ session('success') }}
            </div>
        @endif

        <form method="GET" action="{{ route('admin.blog.index') }}" class="bg-white border border-gray-200 rounded-2xl p-4 mb-4 flex flex-wrap items-end gap-4">
            <div class="flex-1 min-w-[220px]">
                <label for="search" class="block text-xs font-semibold text-gray-600 mb-1">Search</label>
                <input id="search" name="search" value="{{ $search }}" type="text" placeholder="Title or slug"
                       class="w-full rounded-lg border border-gray-300 px-3 py-2 focus:border-indigo-500 focus:ring-indigo-500">
            </div>
            <div class="w-full sm:w-48">
                <label for="status" class="block text-xs font-semibold text-gray-600 mb-1">Status</label>
                <select id="status" name="status" class="w-full rounded-lg border border-gray-300 px-3 py-2 focus:border-indigo-500 focus:ring-indigo-500">
                    <option value="">All</option>
                    <option value="draft" @selected($status === 'draft')>Draft</option>
                    <option value="published" @selected($status === 'published')>Published</option>
                </select>
            </div>
            <button type="submit" class="rounded-lg bg-gray-900 px-4 py-2 text-sm font-semibold text-white hover:bg-gray-700">Filter</button>
        </form>

        <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Title</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Slug</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Status</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Updated</th>
                            <th class="px-4 py-3 text-right text-xs font-semibold uppercase tracking-wider text-gray-500">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($posts as $post)
                            <tr>
                                <td class="px-4 py-3 text-sm font-semibold text-gray-900">{{ $post->title }}</td>
                                <td class="px-4 py-3 text-sm text-gray-600">{{ $post->slug }}</td>
                                <td class="px-4 py-3">
                                    <span class="inline-flex rounded-full px-2.5 py-1 text-xs font-semibold {{ $post->status === 'published' ? 'bg-green-100 text-green-700' : 'bg-amber-100 text-amber-700' }}">
                                        {{ ucfirst($post->status) }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-sm text-gray-600">{{ $post->updated_at->diffForHumans() }}</td>
                                <td class="px-4 py-3 text-right">
                                    <div class="inline-flex items-center gap-2">
                                        <a href="{{ route('blog.show', $post->slug) }}" target="_blank" class="rounded-lg border border-gray-300 bg-white px-3 py-1.5 text-xs font-medium text-gray-700 hover:bg-gray-50">View</a>
                                        <a href="{{ route('admin.blog.edit', $post) }}" class="rounded-lg border border-indigo-300 bg-indigo-50 px-3 py-1.5 text-xs font-medium text-indigo-700 hover:bg-indigo-100">Edit</a>
                                        <form method="POST" action="{{ route('admin.blog.destroy', $post) }}" onsubmit="return confirm('Delete this post?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="rounded-lg border border-red-300 bg-red-50 px-3 py-1.5 text-xs font-medium text-red-700 hover:bg-red-100">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-4 py-8 text-center text-sm text-gray-500">No blog posts found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-4">
            {{ $posts->links() }}
        </div>
    </div>
@endsection
