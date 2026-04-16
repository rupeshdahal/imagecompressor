@extends('layouts.page')

@section('title', 'Edit Blog Post — Admin | CompresslyPro')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-2xl font-extrabold text-gray-900">Edit Blog Post</h1>
            <p class="text-sm text-gray-500 mt-1 font-mono">/blog/{{ $post->slug }}</p>
        </div>
        <div class="flex items-center gap-4">
            <a href="/blog/{{ $post->slug }}" target="_blank" class="text-sm text-brand-600 hover:text-brand-800 font-medium transition-colors">View Live ↗</a>
            <a href="{{ route('admin.blog.index') }}" class="text-sm text-gray-500 hover:text-gray-700 transition-colors">← Back to Posts</a>
        </div>
    </div>

    @if($errors->any())
    <div class="bg-red-50 border border-red-200 rounded-xl px-4 py-3 mb-6">
        <p class="text-red-700 font-semibold text-sm mb-1">Please fix the following errors:</p>
        <ul class="list-disc list-inside text-red-600 text-sm space-y-0.5">
            @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
        </ul>
    </div>
    @endif

    <form method="POST" action="{{ route('admin.blog.update', $post) }}" class="space-y-6">
        @csrf @method('PUT')
        @include('admin.blog._form', ['post' => $post])

        <div class="flex items-center gap-4 pt-2">
            <button type="submit"
                    class="bg-brand-600 text-white px-6 py-2.5 rounded-xl font-semibold text-sm hover:bg-brand-700 transition-colors shadow-sm">
                Save Changes
            </button>
            <a href="{{ route('admin.blog.index') }}" class="text-sm text-gray-500 hover:text-gray-700 transition-colors">Cancel</a>
        </div>
    </form>
</div>
@endsection
