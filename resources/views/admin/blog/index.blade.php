@extends('layouts.page')

@section('title', 'Blog Posts — Admin | CompresslyPro')

@section('content')
<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

    {{-- Header --}}
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-2xl font-extrabold text-gray-900">Blog Posts</h1>
            <p class="text-sm text-gray-500 mt-1">{{ $posts->total() }} total posts</p>
        </div>
        <a href="{{ route('admin.blog.create') }}"
           class="inline-flex items-center gap-2 bg-brand-600 text-white px-5 py-2.5 rounded-xl font-semibold text-sm hover:bg-brand-700 transition-colors shadow-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
            New Post
        </a>
    </div>

    @if(session('success'))
    <div class="bg-green-50 border border-green-200 text-green-800 rounded-xl px-4 py-3 mb-6 text-sm font-medium">
        ✅ {{ session('success') }}
    </div>
    @endif

    {{-- Posts Table --}}
    <div class="bg-white rounded-2xl border border-gray-200/60 shadow-sm overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 border-b border-gray-200">
                <tr>
                    <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Title</th>
                    <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Category</th>
                    <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Published</th>
                    <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($posts as $post)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-2">
                            @if($post->is_featured)
                                <span class="inline-block bg-yellow-100 text-yellow-700 text-[10px] font-bold px-1.5 py-0.5 rounded">★ Featured</span>
                            @endif
                            <div>
                                <div class="font-medium text-gray-900 leading-snug">{{ Str::limit($post->title, 60) }}</div>
                                <div class="text-xs text-gray-400 mt-0.5">/blog/{{ $post->slug }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <span class="inline-block {{ \App\Models\BlogPost::categoryColor($post->category) }} text-xs font-semibold px-2.5 py-1 rounded-full">
                            {{ $post->category }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-gray-600">{{ $post->short_date }}</td>
                    <td class="px-6 py-4">
                        @if($post->is_published)
                            <span class="inline-flex items-center gap-1 text-green-700 bg-green-50 px-2.5 py-1 rounded-full text-xs font-semibold">
                                <span class="w-1.5 h-1.5 rounded-full bg-green-500 inline-block"></span> Live
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1 text-gray-500 bg-gray-100 px-2.5 py-1 rounded-full text-xs font-semibold">
                                <span class="w-1.5 h-1.5 rounded-full bg-gray-400 inline-block"></span> Draft
                            </span>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            <a href="/blog/{{ $post->slug }}" target="_blank"
                               class="text-gray-400 hover:text-brand-600 transition-colors text-xs font-medium" title="View live">
                                View ↗
                            </a>
                            <a href="{{ route('admin.blog.edit', $post) }}"
                               class="text-indigo-600 hover:text-indigo-800 transition-colors text-xs font-medium">
                                Edit
                            </a>
                            <form method="POST" action="{{ route('admin.blog.destroy', $post) }}"
                                  onsubmit="return confirm('Delete \'{{ addslashes($post->title) }}\'? This cannot be undone.');">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700 transition-colors text-xs font-medium">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-12 text-center text-gray-400">
                        No blog posts yet. <a href="{{ route('admin.blog.create') }}" class="text-brand-600 font-medium">Create the first one →</a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    @if($posts->hasPages())
    <div class="mt-6">{{ $posts->links() }}</div>
    @endif

    {{-- Back to Dashboard --}}
    <div class="mt-6">
        <a href="{{ route('admin.dashboard') }}" class="text-sm text-gray-500 hover:text-gray-700 transition-colors">← Back to Dashboard</a>
    </div>
</div>
@endsection
