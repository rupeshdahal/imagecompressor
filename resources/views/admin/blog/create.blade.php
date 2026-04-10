@extends('admin.layouts.app')

@section('title', 'Create Blog Post')
@section('page_title', 'Create Blog Post')
@section('nav_blog', 'bg-brand-50 dark:bg-brand-900/20 text-brand-700 dark:text-brand-300 font-semibold')

@section('admin_head')
    <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
@endsection

@section('content')
    <div class="max-w-7xl mx-auto">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 dark:text-gray-100">Create Blog Post</h1>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Write, optimize, and publish new content.</p>
            </div>
            <a href="{{ route('admin.blog.index') }}" class="rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-950 dark:text-gray-200 dark:hover:bg-gray-800">Back to Posts</a>
        </div>

        <form method="POST" action="{{ route('admin.blog.store') }}" enctype="multipart/form-data" class="bg-white border border-gray-200 rounded-2xl p-6 shadow-sm dark:bg-gray-900 dark:border-gray-800">
            @csrf
            @include('admin.blog.form')
        </form>
    </div>
@endsection

@section('admin_scripts')
    <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
    <script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>
    <script>
        FilePond.registerPlugin(FilePondPluginImagePreview);
        document.querySelectorAll('.filepond').forEach((input) => {
            FilePond.create(input, {
                allowMultiple: false,
                labelIdle: 'Drop featured image or <span class="filepond--label-action">Browse</span>',
            });
        });

        tinymce.init({
            selector: '#content',
            height: 600,
            menubar: false,
            plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
            toolbar: 'undo redo | blocks | bold italic underline | link image table | bullist numlist | removeformat | code',
            images_upload_url: '{{ route('admin.blog.editor-upload') }}',
            automatic_uploads: true,
            images_upload_credentials: true,
            relative_urls: false,
            convert_urls: false,
            setup: function (editor) {
                editor.on('init', function () {
                    editor.getDoc().body.style.fontFamily = 'Inter, sans-serif';
                });
            },
            images_upload_handler: (blobInfo, progress) => new Promise((resolve, reject) => {
                const xhr = new XMLHttpRequest();
                xhr.withCredentials = true;
                xhr.open('POST', '{{ route('admin.blog.editor-upload') }}');
                xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');

                xhr.upload.onprogress = (e) => {
                    progress(e.loaded / e.total * 100);
                };

                xhr.onload = () => {
                    if (xhr.status < 200 || xhr.status >= 300) {
                        reject('HTTP Error: ' + xhr.status);
                        return;
                    }

                    const json = JSON.parse(xhr.responseText);
                    if (!json || typeof json.location !== 'string') {
                        reject('Invalid JSON response');
                        return;
                    }

                    resolve(json.location);
                };

                xhr.onerror = () => reject('Image upload failed.');

                const formData = new FormData();
                formData.append('file', blobInfo.blob(), blobInfo.filename());
                xhr.send(formData);
            }),
        });

        const titleInput = document.getElementById('title');
        const slugInput = document.getElementById('slug');
        titleInput?.addEventListener('input', function () {
            if (slugInput.value.trim() !== '') {
                return;
            }
            slugInput.placeholder = titleInput.value
                .toLowerCase()
                .replace(/[^a-z0-9\s-]/g, '')
                .trim()
                .replace(/\s+/g, '-')
                .replace(/-+/g, '-');
        });
    </script>
@endsection
