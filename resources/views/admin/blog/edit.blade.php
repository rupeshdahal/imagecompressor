@extends('admin.blog.layout')

@section('title', 'Edit Blog Post')
@section('page_title', 'Edit Blog Post')

@section('content')
<div class="mx-auto max-w-4xl">
    <form action="{{ route('admin.blog.update', $blogPost) }}" method="POST" enctype="multipart/form-data" class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-800 dark:bg-gray-900">
        @csrf
        @method('PUT')
        @include('admin.blog._form', ['blogPost' => $blogPost])

        <div class="mt-6 flex items-center justify-end gap-3">
            <a href="{{ route('admin.blog.index') }}" class="rounded-xl border border-gray-300 px-4 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-100 dark:border-gray-700 dark:text-gray-300 dark:hover:bg-gray-800">Cancel</a>
            <button type="submit" class="rounded-xl bg-brand-600 px-4 py-2 text-sm font-semibold text-white hover:bg-brand-700">Save Changes</button>
        </div>
    </form>
</div>
@endsection