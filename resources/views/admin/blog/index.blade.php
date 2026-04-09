<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Manager - CompresslyPro Admin</title>
    <meta name="robots" content="noindex, nofollow">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-900 min-h-screen">
    <header class="bg-white border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <img src="{{ asset('logo.png') }}" alt="CompresslyPro" class="h-9 w-auto">
                <span class="text-sm font-semibold text-gray-700">Admin Blog Manager</span>
            </div>
            <div class="flex items-center gap-3 text-sm">
                <a href="{{ route('admin.dashboard') }}" class="text-gray-600 hover:text-brand-600">Dashboard</a>
                <a href="{{ route('reports') }}" class="text-gray-600 hover:text-brand-600">Reports</a>
                <a href="{{ route('blog') }}" target="_blank" class="text-gray-600 hover:text-brand-600">Public Blog</a>
                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="px-3 py-1.5 rounded-lg bg-red-50 text-red-600 hover:bg-red-100">Logout</button>
                </form>
            </div>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-2xl font-bold">Blog Posts</h1>
                <p class="text-sm text-gray-500">Manage all blog content from one place.</p>
            </div>
            <a href="{{ route('admin.blog.create') }}" class="px-4 py-2 rounded-xl bg-indigo-600 text-white font-semibold hover:bg-indigo-500">New Post</a>
        </div>

        @if(session('success'))
            <div class="mb-4 rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-green-700 text-sm">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 text-gray-600">
                    <tr>
                        <th class="px-4 py-3 text-left">Title</th>
                        <th class="px-4 py-3 text-left">Slug</th>
                        <th class="px-4 py-3 text-left">Status</th>
                        <th class="px-4 py-3 text-left">Published</th>
                        <th class="px-4 py-3 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($posts as $post)
                    <tr>
                        <td class="px-4 py-3">
                            <div class="font-semibold text-gray-900">{{ $post->title }}</div>
                            <div class="text-xs text-gray-500">{{ $post->category ?: 'Uncategorized' }}</div>
                        </td>
                        <td class="px-4 py-3 text-gray-600">{{ $post->slug }}</td>
                        <td class="px-4 py-3">
                            @if($post->is_published)
                                <span class="px-2 py-1 rounded-full text-xs bg-green-100 text-green-700">Published</span>
                            @else
                                <span class="px-2 py-1 rounded-full text-xs bg-yellow-100 text-yellow-700">Draft</span>
                            @endif
                            @if($post->featured)
                                <span class="px-2 py-1 rounded-full text-xs bg-indigo-100 text-indigo-700">Featured</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-gray-600">{{ optional($post->published_at)->format('Y-m-d H:i') ?: '-' }}</td>
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-3">
                                <a href="{{ route('blog.show', $post->slug) }}" target="_blank" class="text-indigo-600 hover:text-indigo-500">View</a>
                                <a href="{{ route('admin.blog.edit', $post) }}" class="text-blue-600 hover:text-blue-500">Edit</a>
                                <form action="{{ route('admin.blog.destroy', $post) }}" method="POST" onsubmit="return confirm('Delete this post?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-500">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-4 py-10 text-center text-gray-500">No blog posts found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </main>
</body>
</html>
