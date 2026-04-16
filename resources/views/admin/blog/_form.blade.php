{{-- Shared form partial for create & edit blog posts --}}
{{-- $post = null (create) or BlogPost instance (edit) --}}

@php $isEdit = !is_null($post); @endphp

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    {{-- ── Left: Main content ─────────────────────────────────── --}}
    <div class="lg:col-span-2 space-y-5">

        {{-- Title --}}
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1.5" for="title">Post Title <span class="text-red-500">*</span></label>
            <input id="title" name="title" type="text" required autofocus
                   value="{{ old('title', $isEdit ? $post->title : '') }}"
                   class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-brand-500 focus:border-transparent"
                   placeholder="The Complete Guide to Image Compression…">
        </div>

        {{-- Slug --}}
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1.5" for="slug">
                URL Slug <span class="text-red-500">*</span>
                <span class="font-normal text-gray-400 ml-1">— used in /blog/<em>slug</em></span>
            </label>
            <input id="slug" name="slug" type="text" required
                   value="{{ old('slug', $isEdit ? $post->slug : '') }}"
                   class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm font-mono focus:outline-none focus:ring-2 focus:ring-brand-500 focus:border-transparent"
                   placeholder="how-to-compress-images-for-web">
        </div>

        {{-- Excerpt --}}
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1.5" for="excerpt">
                Excerpt <span class="text-red-500">*</span>
                <span class="font-normal text-gray-400 ml-1">— short summary shown in article header and index cards</span>
            </label>
            <textarea id="excerpt" name="excerpt" rows="3" required maxlength="500"
                      class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-brand-500 focus:border-transparent"
                      placeholder="One to two sentences summarising the article for readers and search engines…">{{ old('excerpt', $isEdit ? $post->excerpt : '') }}</textarea>
        </div>

        {{-- Content --}}
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1.5" for="content">
                Article Body (HTML) <span class="text-red-500">*</span>
            </label>
            <textarea id="content" name="content" rows="28" required
                      class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm font-mono focus:outline-none focus:ring-2 focus:ring-brand-500 focus:border-transparent"
                      placeholder="<h2>Introduction</h2>&#10;<p>Your article content here…</p>">{{ old('content', $isEdit ? $post->content : '') }}</textarea>
            <p class="text-xs text-gray-400 mt-1">Raw HTML — use &lt;h2&gt;, &lt;h3&gt;, &lt;p&gt;, &lt;ul&gt;, &lt;ol&gt;, &lt;table&gt;, &lt;blockquote&gt;, &lt;code&gt;, &lt;a href="…"&gt; etc.</p>
        </div>
    </div>

    {{-- ── Right: Meta & settings ──────────────────────────────── --}}
    <div class="space-y-5">

        {{-- Publishing --}}
        <div class="bg-gray-50 rounded-xl border border-gray-200 p-4 space-y-3">
            <h3 class="text-sm font-semibold text-gray-700 mb-2">Publishing</h3>

            <label class="flex items-center gap-2.5 cursor-pointer">
                <input type="checkbox" name="is_published" id="is_published" value="1"
                       {{ old('is_published', $isEdit ? $post->is_published : true) ? 'checked' : '' }}
                       class="w-4 h-4 accent-brand-600 rounded">
                <span class="text-sm text-gray-700">Published (visible on site)</span>
            </label>

            <label class="flex items-center gap-2.5 cursor-pointer">
                <input type="checkbox" name="is_featured" id="is_featured" value="1"
                       {{ old('is_featured', $isEdit ? $post->is_featured : false) ? 'checked' : '' }}
                       class="w-4 h-4 accent-brand-600 rounded">
                <span class="text-sm text-gray-700">Featured (hero on blog index)</span>
            </label>

            <div>
                <label class="block text-xs font-semibold text-gray-600 mb-1" for="date_published">Date Published</label>
                <input id="date_published" name="date_published" type="date" required
                       value="{{ old('date_published', $isEdit ? $post->date_published->toDateString() : now()->toDateString()) }}"
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-brand-500">
            </div>

            <div>
                <label class="block text-xs font-semibold text-gray-600 mb-1" for="date_modified">Date Modified</label>
                <input id="date_modified" name="date_modified" type="date" required
                       value="{{ old('date_modified', $isEdit ? $post->date_modified->toDateString() : now()->toDateString()) }}"
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-brand-500">
            </div>
        </div>

        {{-- Taxonomy --}}
        <div class="bg-gray-50 rounded-xl border border-gray-200 p-4 space-y-3">
            <h3 class="text-sm font-semibold text-gray-700 mb-2">Taxonomy</h3>

            <div>
                <label class="block text-xs font-semibold text-gray-600 mb-1" for="category">Category <span class="text-red-500">*</span></label>
                <select id="category" name="category" required
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-brand-500">
                    @foreach(['Compression','Formats','SEO','Performance','Email','Workflow','Social Media','Watermark','WordPress','PDF','General'] as $cat)
                    <option value="{{ $cat }}" {{ old('category', $isEdit ? $post->category : '') === $cat ? 'selected' : '' }}>{{ $cat }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-xs font-semibold text-gray-600 mb-1" for="tags">
                    Tags <span class="font-normal text-gray-400">(comma-separated)</span>
                </label>
                <input id="tags" name="tags" type="text"
                       value="{{ old('tags', $isEdit && $post->tags ? implode(', ', $post->tags) : '') }}"
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-brand-500"
                       placeholder="Compression, WebP, Performance">
            </div>
        </div>

        {{-- Article stats --}}
        <div class="bg-gray-50 rounded-xl border border-gray-200 p-4 space-y-3">
            <h3 class="text-sm font-semibold text-gray-700 mb-2">Article Stats</h3>

            <div>
                <label class="block text-xs font-semibold text-gray-600 mb-1" for="read_time">Read Time (minutes) <span class="text-red-500">*</span></label>
                <input id="read_time" name="read_time" type="number" min="1" max="60" required
                       value="{{ old('read_time', $isEdit ? $post->read_time : 5) }}"
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-brand-500">
            </div>

            <div>
                <label class="block text-xs font-semibold text-gray-600 mb-1" for="word_count">Word Count</label>
                <input id="word_count" name="word_count" type="number" min="0"
                       value="{{ old('word_count', $isEdit ? $post->word_count : 0) }}"
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-brand-500">
            </div>
        </div>

        {{-- SEO meta --}}
        <div class="bg-gray-50 rounded-xl border border-gray-200 p-4 space-y-3">
            <h3 class="text-sm font-semibold text-gray-700 mb-2">SEO Meta</h3>

            <div>
                <label class="block text-xs font-semibold text-gray-600 mb-1" for="meta_title">Meta Title <span class="font-normal text-gray-400">(optional — defaults to title)</span></label>
                <input id="meta_title" name="meta_title" type="text" maxlength="255"
                       value="{{ old('meta_title', $isEdit ? $post->meta_title : '') }}"
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-brand-500"
                       placeholder="Leave blank to use post title">
            </div>

            <div>
                <label class="block text-xs font-semibold text-gray-600 mb-1" for="meta_description">Meta Description</label>
                <textarea id="meta_description" name="meta_description" rows="3" maxlength="320"
                          class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-brand-500"
                          placeholder="Up to 160 characters for best SEO…">{{ old('meta_description', $isEdit ? $post->meta_description : '') }}</textarea>
            </div>

            <div>
                <label class="block text-xs font-semibold text-gray-600 mb-1" for="meta_keywords">Keywords <span class="font-normal text-gray-400">(comma-separated)</span></label>
                <input id="meta_keywords" name="meta_keywords" type="text"
                       value="{{ old('meta_keywords', $isEdit ? $post->meta_keywords : '') }}"
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-brand-500">
            </div>

            <div>
                <label class="block text-xs font-semibold text-gray-600 mb-1" for="og_title">OG Title</label>
                <input id="og_title" name="og_title" type="text" maxlength="255"
                       value="{{ old('og_title', $isEdit ? $post->og_title : '') }}"
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-brand-500">
            </div>

            <div>
                <label class="block text-xs font-semibold text-gray-600 mb-1" for="og_description">OG Description</label>
                <textarea id="og_description" name="og_description" rows="2" maxlength="320"
                          class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-brand-500">{{ old('og_description', $isEdit ? $post->og_description : '') }}</textarea>
            </div>

            <div>
                <label class="block text-xs font-semibold text-gray-600 mb-1" for="schema_keywords">Schema Keywords <span class="font-normal text-gray-400">(JSON-LD)</span></label>
                <input id="schema_keywords" name="schema_keywords" type="text"
                       value="{{ old('schema_keywords', $isEdit ? $post->schema_keywords : '') }}"
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-brand-500">
            </div>
        </div>

    </div>
</div>

{{-- Auto-generate slug from title --}}
<script>
(function () {
    const titleEl = document.getElementById('title');
    const slugEl  = document.getElementById('slug');
    if (!titleEl || !slugEl) return;

    titleEl.addEventListener('input', function () {
        if (slugEl.dataset.touched) return; // don't overwrite manually edited slug
        slugEl.value = titleEl.value
            .toLowerCase()
            .replace(/[^a-z0-9\s-]/g, '')
            .trim()
            .replace(/[\s]+/g, '-')
            .replace(/-+/g, '-')
            .substring(0, 120);
    });

    slugEl.addEventListener('input', function () {
        slugEl.dataset.touched = '1';
    });
})();
</script>
