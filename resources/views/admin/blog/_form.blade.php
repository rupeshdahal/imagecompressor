@php
    $publishedAt = old('published_at');
    $contentValue = old('content', $blogPost->content ?? '');
    $featuredImageValue = old('featured_image', $blogPost->featured_image ?? '');

    if (! $publishedAt && isset($blogPost) && $blogPost->published_at) {
        $publishedAt = $blogPost->published_at->format('Y-m-d\TH:i');
    }
@endphp

<div class="space-y-6" x-data="blogEditorForm({
    content: @js($contentValue),
    featuredImage: @js($featuredImageValue),
})" x-init="init()">
    <div>
        <label for="title" class="mb-1 block text-sm font-semibold text-gray-700 dark:text-gray-300">Title</label>
        <input id="title" name="title" type="text" required value="{{ old('title', $blogPost->title ?? '') }}" class="w-full rounded-xl border border-gray-300 bg-white px-4 py-2.5 text-sm text-gray-900 focus:border-brand-500 focus:outline-none focus:ring-2 focus:ring-brand-200 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-100 dark:focus:ring-brand-800">
        @error('title') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
    </div>

    <div class="grid gap-4 sm:grid-cols-2">
        <div>
            <label for="slug" class="mb-1 block text-sm font-semibold text-gray-700 dark:text-gray-300">Slug</label>
            <input id="slug" name="slug" type="text" value="{{ old('slug', $blogPost->slug ?? '') }}" class="w-full rounded-xl border border-gray-300 bg-white px-4 py-2.5 text-sm text-gray-900 focus:border-brand-500 focus:outline-none focus:ring-2 focus:ring-brand-200 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-100 dark:focus:ring-brand-800">
            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Leave empty to auto-generate from title.</p>
            @error('slug') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
        </div>
        <div>
            <label for="category" class="mb-1 block text-sm font-semibold text-gray-700 dark:text-gray-300">Category</label>
            <input id="category" name="category" type="text" value="{{ old('category', $blogPost->category ?? '') }}" class="w-full rounded-xl border border-gray-300 bg-white px-4 py-2.5 text-sm text-gray-900 focus:border-brand-500 focus:outline-none focus:ring-2 focus:ring-brand-200 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-100 dark:focus:ring-brand-800">
            @error('category') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
        </div>
    </div>

    <div class="rounded-2xl border border-gray-200 bg-gray-50/70 p-4 dark:border-gray-800 dark:bg-gray-950/40">
        <div class="flex flex-col gap-1 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <h3 class="text-sm font-bold text-gray-900 dark:text-gray-100">Featured image</h3>
                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Upload from device or paste an image URL. The preview updates instantly.</p>
            </div>
        </div>

        <div class="mt-4 grid gap-4 lg:grid-cols-[minmax(0,1.15fr)_minmax(0,0.85fr)]">
            <div class="rounded-2xl border border-dashed border-gray-300 bg-white p-4 dark:border-gray-700 dark:bg-gray-900">
                <label for="featured_image_file" class="mb-2 block text-sm font-semibold text-gray-700 dark:text-gray-300">Upload image</label>
                <input id="featured_image_file" name="featured_image_file" type="file" accept="image/*" @change="updateImagePreview($event)" class="block w-full rounded-xl border border-gray-300 bg-white px-3 py-2 text-sm text-gray-900 file:mr-3 file:rounded-lg file:border-0 file:bg-brand-600 file:px-3 file:py-2 file:text-xs file:font-semibold file:text-white hover:file:bg-brand-700 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-100">
                @error('featured_image_file') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror

                <label for="featured_image" class="mb-2 mt-4 block text-sm font-semibold text-gray-700 dark:text-gray-300">Image URL</label>
                <input id="featured_image" name="featured_image" type="text" x-model="featuredImage" @input="urlPreview = featuredImage" value="{{ $featuredImageValue }}" placeholder="https://..." class="w-full rounded-xl border border-gray-300 bg-white px-4 py-2.5 text-sm text-gray-900 focus:border-brand-500 focus:outline-none focus:ring-2 focus:ring-brand-200 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-100 dark:focus:ring-brand-800">
                @error('featured_image') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror

                <label class="mt-4 inline-flex items-center gap-2 text-xs font-medium text-red-600 dark:text-red-400">
                    <input type="checkbox" name="remove_featured_image" value="1" class="h-4 w-4 rounded border-gray-300 text-red-600 focus:ring-red-500">
                    Remove existing image on save
                </label>
            </div>

            <div class="rounded-2xl border border-gray-200 bg-white p-3 dark:border-gray-700 dark:bg-gray-900">
                <p class="mb-2 text-xs font-semibold uppercase tracking-[0.18em] text-gray-500 dark:text-gray-400">Preview</p>
                <div x-show="hasPreview()" x-cloak class="overflow-hidden rounded-xl border border-gray-200 dark:border-gray-700">
                    <img :src="previewImage()" alt="Featured image preview" class="h-56 w-full object-cover sm:h-64 lg:h-full lg:min-h-[280px]">
                </div>
                <div x-show="!hasPreview()" x-cloak class="flex h-56 items-center justify-center rounded-xl border border-dashed border-gray-300 text-sm text-gray-500 dark:border-gray-700 dark:text-gray-400 sm:h-64 lg:h-full lg:min-h-[280px]">
                    Image preview will appear here
                </div>
            </div>
        </div>
    </div>

    <div>
        <label for="excerpt" class="mb-1 block text-sm font-semibold text-gray-700 dark:text-gray-300">Excerpt</label>
        <textarea id="excerpt" name="excerpt" rows="3" class="w-full rounded-xl border border-gray-300 bg-white px-4 py-2.5 text-sm text-gray-900 focus:border-brand-500 focus:outline-none focus:ring-2 focus:ring-brand-200 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-100 dark:focus:ring-brand-800">{{ old('excerpt', $blogPost->excerpt ?? '') }}</textarea>
        @error('excerpt') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
    </div>

    <div class="rounded-2xl border border-gray-200 bg-gray-50/70 p-4 dark:border-gray-800 dark:bg-gray-950/40">
        <div class="flex flex-col gap-1 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Content editor</label>
                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Use the toolbar or paste HTML directly. The preview stays responsive on smaller screens.</p>
            </div>
        </div>

        <div class="mt-4 grid gap-4 xl:grid-cols-[minmax(0,1.4fr)_minmax(320px,0.9fr)]">
            <div class="overflow-hidden rounded-xl border border-gray-300 bg-white dark:border-gray-700 dark:bg-gray-900">
                <div class="flex flex-wrap items-center gap-2 border-b border-gray-200 bg-gray-50 p-2 dark:border-gray-700 dark:bg-gray-950">
                    <button type="button" @click="format('bold')" class="rounded-md border border-gray-300 bg-white px-2 py-1 text-xs font-semibold text-gray-700 hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-200">Bold</button>
                    <button type="button" @click="format('italic')" class="rounded-md border border-gray-300 bg-white px-2 py-1 text-xs font-semibold text-gray-700 hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-200">Italic</button>
                    <button type="button" @click="format('insertUnorderedList')" class="rounded-md border border-gray-300 bg-white px-2 py-1 text-xs font-semibold text-gray-700 hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-200">Bullet List</button>
                    <button type="button" @click="format('insertOrderedList')" class="rounded-md border border-gray-300 bg-white px-2 py-1 text-xs font-semibold text-gray-700 hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-200">Numbered List</button>
                    <button type="button" @click="addLink()" class="rounded-md border border-gray-300 bg-white px-2 py-1 text-xs font-semibold text-gray-700 hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-200">Link</button>
                </div>
                <div x-ref="editor" contenteditable="true" @input="syncEditor()" class="min-h-[280px] w-full resize-y bg-white px-4 py-3 text-sm leading-relaxed text-gray-800 focus:outline-none dark:bg-gray-900 dark:text-gray-100"></div>
                <textarea id="content" name="content" x-model="content" class="hidden"></textarea>
            </div>

            <div class="rounded-xl border border-gray-300 bg-white p-4 dark:border-gray-700 dark:bg-gray-900">
                <div class="flex items-center justify-between gap-3">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-[0.18em] text-gray-500 dark:text-gray-400">Live preview</p>
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Matches the post styling users will see.</p>
                    </div>
                    <span class="rounded-full bg-brand-100 px-2.5 py-1 text-[11px] font-semibold text-brand-700 dark:bg-brand-900/30 dark:text-brand-300">Responsive</span>
                </div>

                <div class="mt-4 rounded-xl border border-gray-200 bg-gray-50 p-4 dark:border-gray-800 dark:bg-gray-950">
                    <article class="blog-preview prose prose-sm max-w-none dark:prose-invert" x-html="content"></article>
                </div>
            </div>
        </div>
        @error('content') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
    </div>

    <div class="grid gap-4 sm:grid-cols-2">
        <div>
            <label for="published_at" class="mb-1 block text-sm font-semibold text-gray-700 dark:text-gray-300">Publish Date</label>
            <input id="published_at" name="published_at" type="datetime-local" value="{{ $publishedAt }}" class="w-full rounded-xl border border-gray-300 bg-white px-4 py-2.5 text-sm text-gray-900 focus:border-brand-500 focus:outline-none focus:ring-2 focus:ring-brand-200 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-100 dark:focus:ring-brand-800">
            @error('published_at') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
        </div>
        <div class="flex items-center gap-6 pt-8">
            <label class="inline-flex items-center gap-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                <input type="checkbox" name="is_published" value="1" {{ old('is_published', $blogPost->is_published ?? false) ? 'checked' : '' }} class="h-4 w-4 rounded border-gray-300 text-brand-600 focus:ring-brand-500">
                Published
            </label>
            <label class="inline-flex items-center gap-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $blogPost->is_featured ?? false) ? 'checked' : '' }} class="h-4 w-4 rounded border-gray-300 text-brand-600 focus:ring-brand-500">
                Featured
            </label>
        </div>
    </div>
</div>

<script>
    function blogEditorForm(initialState) {
        return {
            content: initialState.content || '',
            featuredImage: initialState.featuredImage || '',
            urlPreview: initialState.featuredImage || '',
            uploadedImagePreview: '',
            init() {
                this.$refs.editor.innerHTML = this.content;
            },
            syncEditor() {
                this.content = this.$refs.editor.innerHTML;
            },
            format(command) {
                this.$refs.editor.focus();
                document.execCommand(command, false, null);
                this.syncEditor();
            },
            addLink() {
                const url = window.prompt('Enter URL');

                if (!url) {
                    return;
                }

                this.$refs.editor.focus();
                document.execCommand('createLink', false, url);
                this.syncEditor();
            },
            updateImagePreview(event) {
                const file = event.target.files[0];

                if (!file) {
                    this.uploadedImagePreview = '';
                    return;
                }

                const reader = new FileReader();
                reader.onload = (loadEvent) => {
                    this.uploadedImagePreview = loadEvent.target?.result || '';
                };
                reader.readAsDataURL(file);
            },
            previewImage() {
                return this.uploadedImagePreview || this.urlPreview || this.featuredImage;
            },
            hasPreview() {
                return !!this.previewImage();
            },
        };
    }
</script>