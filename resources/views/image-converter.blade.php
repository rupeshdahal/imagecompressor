@extends('layouts.app')

@section('title', 'Image Converter - Convert JPG, PNG, WebP Online Free')
@section('description', 'Convert images between JPG, PNG, and WebP formats online for free. Fast, secure, and no signup required.')
@section('keywords', 'image converter, convert jpg to png, convert png to webp, convert webp to jpg, image format converter online free')

@section('content')
    {{-- Hero --}}
    <header class="hero-bg pt-10 pb-6 sm:pt-14 sm:pb-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="inline-flex items-center gap-2 bg-violet-50 dark:bg-violet-900/30 text-violet-700 dark:text-violet-300 text-sm font-medium px-4 py-1.5 rounded-full mb-6 animate-slide-down">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M7.5 21L3 16.5m0 0L7.5 12M3 16.5h13.5m0-13.5L21 7.5m0 0L16.5 12M21 7.5H7.5"/></svg>
                100% Free · No Signup · Instant Conversion
            </div>
            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight leading-tight mb-5">
                Convert Images –
                <span class="gradient-text">JPG · PNG · WebP</span>
            </h1>
            <p class="text-lg sm:text-xl text-gray-500 dark:text-gray-400 max-w-2xl mx-auto leading-relaxed">
                Convert images between <strong class="text-gray-700 dark:text-gray-200">JPG, PNG, and WebP</strong> formats. Adjust quality, preview results, and download instantly.
            </p>
        </div>
    </header>

    {{-- Main App --}}
    <main class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 pb-12 -mt-2" x-data="imageConverter()" x-cloak>

        {{-- ======== UPLOAD STATE ======== --}}
        <div x-show="state === 'idle' || state === 'error'" class="animate-slide-up">

            {{-- Drop Zone --}}
            <div id="dropZone"
                 x-on:dragover.prevent="isDragging = true"
                 x-on:dragleave.prevent="isDragging = false"
                 x-on:drop.prevent="handleDrop($event)"
                 x-on:click="$refs.fileInput.click()"
                 :class="{ 'drop-active ring-2 ring-brand-400': isDragging }"
                 class="relative bg-white dark:bg-gray-900 border-2 border-dashed border-gray-300 dark:border-gray-700 rounded-3xl p-10 sm:p-14 text-center cursor-pointer hover:border-brand-400 dark:hover:border-brand-500 transition-all duration-300 group shadow-sm hover:shadow-lg">

                <input type="file" x-ref="fileInput" x-on:change="handleFileSelect($event)" accept=".jpg,.jpeg,.png,.webp,.gif" class="hidden">

                <div class="relative mx-auto w-20 h-20 sm:w-24 sm:h-24 mb-6">
                    <div class="absolute inset-0 bg-violet-100 dark:bg-violet-900/40 rounded-3xl rotate-6 group-hover:rotate-12 transition-transform duration-300"></div>
                    <div class="relative bg-gradient-to-br from-violet-500 to-purple-700 rounded-3xl w-full h-full flex items-center justify-center shadow-xl shadow-violet-500/25">
                        <svg class="w-10 h-10 sm:w-12 sm:h-12 text-white" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M7.5 21L3 16.5m0 0L7.5 12M3 16.5h13.5m0-13.5L21 7.5m0 0L16.5 12M21 7.5H7.5"/></svg>
                    </div>
                </div>

                <h2 class="text-xl sm:text-2xl font-bold mb-2">Drop an image here to convert</h2>
                <p class="text-gray-500 dark:text-gray-400 mb-5">or <span class="text-brand-600 dark:text-brand-400 font-semibold underline underline-offset-2">browse files</span></p>

                <div class="flex flex-wrap justify-center gap-2">
                    <span class="inline-flex items-center gap-1 bg-gray-100 dark:bg-gray-800 text-gray-500 dark:text-gray-400 text-xs font-semibold px-3 py-1.5 rounded-full">JPG</span>
                    <span class="inline-flex items-center gap-1 bg-gray-100 dark:bg-gray-800 text-gray-500 dark:text-gray-400 text-xs font-semibold px-3 py-1.5 rounded-full">PNG</span>
                    <span class="inline-flex items-center gap-1 bg-gray-100 dark:bg-gray-800 text-gray-500 dark:text-gray-400 text-xs font-semibold px-3 py-1.5 rounded-full">WEBP</span>
                    <span class="inline-flex items-center gap-1 bg-gray-100 dark:bg-gray-800 text-gray-500 dark:text-gray-400 text-xs font-semibold px-3 py-1.5 rounded-full">GIF</span>
                    <span class="inline-flex items-center gap-1 bg-brand-50 dark:bg-brand-900/30 text-brand-600 dark:text-brand-400 text-xs font-semibold px-3 py-1.5 rounded-full">Max 20MB</span>
                </div>
            </div>

            {{-- Error Alert --}}
            <div x-show="errorMessage" x-transition class="mt-4 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800/40 rounded-2xl p-4 flex items-start gap-3">
                <div class="w-8 h-8 bg-red-100 dark:bg-red-900/40 rounded-full flex items-center justify-center flex-shrink-0">
                    <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <div>
                    <p class="text-red-700 dark:text-red-300 text-sm font-medium" x-text="errorMessage"></p>
                    <button x-on:click="errorMessage = ''" class="text-red-400 text-xs mt-1 hover:text-red-600">Dismiss</button>
                </div>
            </div>
        </div>

        {{-- ======== SETTINGS STATE ======== --}}
        <div x-show="state === 'settings'" x-transition class="animate-slide-up">
            <div class="bg-white dark:bg-gray-900 rounded-3xl shadow-xl border border-gray-200/60 dark:border-gray-800/60 overflow-hidden">

                {{-- File Preview --}}
                <div class="px-6 sm:px-8 pt-6 sm:pt-8 pb-5 border-b border-gray-100 dark:border-gray-800">
                    <div class="flex items-center gap-4">
                        <img :src="preview" class="w-16 h-16 rounded-xl object-cover flex-shrink-0 border border-gray-200 dark:border-gray-700" alt="preview">
                        <div class="flex-1 min-w-0">
                            <p class="font-bold text-lg truncate" x-text="file?.name"></p>
                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                <span x-text="formatBytes(file?.size)"></span> ·
                                <span class="uppercase font-semibold text-xs bg-gray-100 dark:bg-gray-800 px-2 py-0.5 rounded" x-text="currentFormat"></span>
                            </p>
                        </div>
                        <button x-on:click="reset()" class="p-2 rounded-lg text-gray-400 hover:text-red-500 hover:bg-red-50 dark:hover:bg-red-900/20 transition-all">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                        </button>
                    </div>
                </div>

                {{-- Format + Quality --}}
                <div class="px-6 sm:px-8 py-6 space-y-6">

                    {{-- Target Format --}}
                    <div>
                        <label class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3 block">Convert To</label>
                        <div class="grid grid-cols-3 gap-3">
                            <template x-for="fmt in formats" :key="fmt.value">
                                <button x-on:click="targetFormat = fmt.value"
                                    :class="targetFormat === fmt.value ? 'ring-2 ring-brand-500 bg-brand-50 dark:bg-brand-900/20 border-brand-400' : 'border-gray-200 dark:border-gray-700 hover:border-brand-300'"
                                    class="border rounded-2xl p-4 text-center transition-all cursor-pointer">
                                    <p class="text-xl font-extrabold uppercase" :class="fmt.color" x-text="fmt.value"></p>
                                    <p class="text-xs text-gray-400 mt-1" x-text="fmt.label"></p>
                                </button>
                            </template>
                        </div>
                    </div>

                    {{-- Quality Slider --}}
                    <div>
                        <div class="flex items-center justify-between mb-3">
                            <label class="text-sm font-semibold text-gray-700 dark:text-gray-300">Quality</label>
                            <span class="text-sm font-bold text-brand-600 bg-brand-50 dark:bg-brand-900/30 px-3 py-1 rounded-lg" x-text="quality + '%'"></span>
                        </div>
                        <input type="range" min="10" max="100" step="5" x-model="quality"
                            class="range-slider w-full h-2 bg-gray-200 dark:bg-gray-700 rounded-lg appearance-none cursor-pointer accent-brand-600">
                        <div class="flex justify-between text-xs text-gray-400 mt-2">
                            <span>Small File</span>
                            <span>Best Quality</span>
                        </div>
                    </div>

                    {{-- Convert Button --}}
                    <button x-on:click="convert()"
                        class="w-full bg-gradient-to-r from-violet-600 to-purple-700 hover:from-violet-700 hover:to-purple-800 text-white font-bold py-4 px-6 rounded-2xl transition-all duration-200 flex items-center justify-center gap-2.5 text-lg shadow-xl shadow-violet-500/25 hover:shadow-violet-500/40 hover:scale-[1.02] active:scale-[0.98]">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M7.5 21L3 16.5m0 0L7.5 12M3 16.5h13.5m0-13.5L21 7.5m0 0L16.5 12M21 7.5H7.5"/></svg>
                        <span>Convert to <span class="uppercase" x-text="targetFormat"></span></span>
                    </button>
                </div>
            </div>
        </div>

        {{-- ======== PROCESSING STATE ======== --}}
        <div x-show="state === 'processing'" x-transition class="animate-slide-up">
            <div class="bg-white dark:bg-gray-900 rounded-3xl shadow-xl border border-gray-200/60 dark:border-gray-800/60 p-10 sm:p-14 text-center">
                <div class="relative w-20 h-20 mx-auto mb-6">
                    <div class="absolute inset-0 rounded-full bg-violet-100 dark:bg-violet-900/30 animate-ping opacity-40"></div>
                    <div class="relative w-full h-full rounded-full bg-violet-50 dark:bg-violet-900/20 flex items-center justify-center">
                        <svg class="animate-spin w-10 h-10 text-violet-600" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-20" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="3"/>
                            <path class="opacity-80" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"/>
                        </svg>
                    </div>
                </div>
                <h3 class="text-2xl font-bold mb-2">Converting...</h3>
                <p class="text-gray-500 dark:text-gray-400 mb-6">
                    <span class="uppercase font-semibold" x-text="currentFormat"></span> →
                    <span class="uppercase font-semibold" x-text="targetFormat"></span>
                </p>
                <div class="w-full bg-gray-200 dark:bg-gray-800 rounded-full h-1.5 overflow-hidden max-w-xs mx-auto">
                    <div class="bg-gradient-to-r from-violet-500 to-purple-600 h-1.5 rounded-full w-1/3 shimmer"></div>
                </div>
            </div>
        </div>

        {{-- ======== RESULT STATE ======== --}}
        <div x-show="state === 'result'" x-transition class="animate-slide-up space-y-5">

            {{-- Stats --}}
            <div class="grid grid-cols-3 gap-3">
                <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200/60 dark:border-gray-800/60 p-4 sm:p-5 text-center shadow-sm">
                    <p class="text-xs text-gray-400 font-medium mb-0.5">Original</p>
                    <p class="text-lg font-bold text-gray-700 dark:text-gray-200" x-text="result.original_size"></p>
                    <p class="text-xs text-gray-400 uppercase font-semibold" x-text="currentFormat"></p>
                </div>
                <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200/60 dark:border-gray-800/60 p-4 sm:p-5 text-center shadow-sm">
                    <p class="text-xs text-gray-400 font-medium mb-0.5">Converted</p>
                    <p class="text-lg font-bold text-green-600" x-text="result.compressed_size"></p>
                    <p class="text-xs text-gray-400 uppercase font-semibold" x-text="targetFormat"></p>
                </div>
                <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200/60 dark:border-gray-800/60 p-4 sm:p-5 text-center shadow-sm">
                    <p class="text-xs text-gray-400 font-medium mb-0.5">Size Change</p>
                    <p class="text-2xl font-bold" :class="parseFloat(result.reduction) > 0 ? 'text-green-600' : 'text-amber-600'" x-text="result.reduction + '%'"></p>
                </div>
            </div>

            {{-- Preview & Download --}}
            <div class="bg-white dark:bg-gray-900 rounded-3xl shadow-xl border border-gray-200/60 dark:border-gray-800/60 overflow-hidden">
                {{-- Preview --}}
                <div class="bg-gray-50 dark:bg-gray-800/50 p-4 flex items-center justify-center min-h-[200px] border-b border-gray-200/60 dark:border-gray-800/60">
                    <img :src="result.preview_url" alt="Converted image" class="max-h-80 rounded-xl shadow-md object-contain">
                </div>

                <div class="p-6 sm:p-8">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="w-14 h-14 bg-green-50 dark:bg-green-900/30 rounded-2xl flex items-center justify-center">
                            <svg class="w-7 h-7 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                        </div>
                        <div>
                            <p class="font-bold text-lg">Conversion Complete!</p>
                            <p class="text-sm text-gray-500">
                                <span class="uppercase" x-text="currentFormat"></span> →
                                <span class="uppercase font-semibold text-brand-600" x-text="targetFormat"></span>
                            </p>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-x-6 gap-y-2 text-sm mb-6 p-4 bg-gray-50 dark:bg-gray-800/50 rounded-xl">
                        <div class="flex justify-between"><span class="text-gray-400">Original Format</span><strong class="uppercase" x-text="currentFormat"></strong></div>
                        <div class="flex justify-between"><span class="text-gray-400">New Format</span><strong class="uppercase" x-text="targetFormat"></strong></div>
                        <div class="flex justify-between"><span class="text-gray-400">Original Size</span><strong x-text="result.original_size"></strong></div>
                        <div class="flex justify-between"><span class="text-gray-400">New Size</span><strong x-text="result.compressed_size"></strong></div>
                    </div>

                    <div class="flex flex-col sm:flex-row gap-3">
                        <a :href="result.download_url" download
                           class="flex-1 bg-gradient-to-r from-violet-600 to-purple-700 hover:from-violet-700 hover:to-purple-800 text-white font-bold py-4 px-6 rounded-2xl transition-all flex items-center justify-center gap-2.5 text-lg shadow-xl shadow-violet-500/25 hover:shadow-violet-500/40 hover:scale-[1.02] active:scale-[0.98]">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                            Download <span class="uppercase" x-text="targetFormat"></span>
                        </a>
                        <button x-on:click="reset()" class="bg-gray-100 dark:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-200 font-bold py-4 px-6 rounded-2xl transition-all flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                            New Conversion
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </main>

    {{-- Format Comparison --}}
    <section class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="text-center mb-12">
            <h2 class="text-3xl sm:text-4xl font-extrabold mb-4">When to Use Which Format?</h2>
            <p class="text-gray-500 dark:text-gray-400 max-w-xl mx-auto">Each format has its strengths</p>
        </div>
        <div class="grid sm:grid-cols-3 gap-5">
            <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200/60 dark:border-gray-800/60 p-6 hover:shadow-lg transition-shadow">
                <div class="w-12 h-12 bg-blue-50 dark:bg-blue-900/30 rounded-2xl flex items-center justify-center mb-4">
                    <span class="text-lg font-extrabold text-blue-600">JPG</span>
                </div>
                <h3 class="font-bold text-lg mb-2">JPEG / JPG</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400 mb-3">Best for photographs and complex images with many colors.</p>
                <ul class="text-xs text-gray-400 space-y-1">
                    <li>✅ Small file size</li>
                    <li>✅ Universal support</li>
                    <li>❌ No transparency</li>
                    <li>❌ Lossy compression</li>
                </ul>
            </div>
            <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200/60 dark:border-gray-800/60 p-6 hover:shadow-lg transition-shadow">
                <div class="w-12 h-12 bg-green-50 dark:bg-green-900/30 rounded-2xl flex items-center justify-center mb-4">
                    <span class="text-lg font-extrabold text-green-600">PNG</span>
                </div>
                <h3 class="font-bold text-lg mb-2">PNG</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400 mb-3">Best for logos, text, and images with transparency.</p>
                <ul class="text-xs text-gray-400 space-y-1">
                    <li>✅ Transparency support</li>
                    <li>✅ Lossless quality</li>
                    <li>❌ Larger file size</li>
                    <li>❌ Not for photos</li>
                </ul>
            </div>
            <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200/60 dark:border-gray-800/60 p-6 hover:shadow-lg transition-shadow">
                <div class="w-12 h-12 bg-purple-50 dark:bg-purple-900/30 rounded-2xl flex items-center justify-center mb-4">
                    <span class="text-lg font-extrabold text-purple-600">WebP</span>
                </div>
                <h3 class="font-bold text-lg mb-2">WebP</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400 mb-3">Best for web – smaller than JPG/PNG with same quality.</p>
                <ul class="text-xs text-gray-400 space-y-1">
                    <li>✅ Smallest file size</li>
                    <li>✅ Transparency support</li>
                    <li>✅ Great for web</li>
                    <li>❌ Limited legacy support</li>
                </ul>
            </div>
        </div>
    </section>

    {{-- FAQ --}}
    <section class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 pb-16">
        <div class="text-center mb-10">
            <h2 class="text-3xl sm:text-4xl font-extrabold mb-4">Frequently Asked Questions</h2>
        </div>
        <div class="space-y-3" x-data="{ openFaq: null }">
            <div class="bg-white dark:bg-gray-900 rounded-xl border border-gray-200/60 dark:border-gray-800/60 overflow-hidden">
                <button x-on:click="openFaq = openFaq === 1 ? null : 1" class="w-full text-left p-5 flex items-center justify-between">
                    <span class="font-semibold">How do I convert PNG to JPG?</span>
                    <svg :class="openFaq === 1 ? 'rotate-180' : ''" class="w-5 h-5 text-gray-400 transition-transform" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
                </button>
                <div x-show="openFaq === 1" x-collapse>
                    <p class="px-5 pb-5 text-sm text-gray-500 dark:text-gray-400">Upload your PNG image, select "JPG" as the output format, adjust quality if needed, and click Convert. Your image will be instantly converted.</p>
                </div>
            </div>
            <div class="bg-white dark:bg-gray-900 rounded-xl border border-gray-200/60 dark:border-gray-800/60 overflow-hidden">
                <button x-on:click="openFaq = openFaq === 2 ? null : 2" class="w-full text-left p-5 flex items-center justify-between">
                    <span class="font-semibold">Will I lose image quality?</span>
                    <svg :class="openFaq === 2 ? 'rotate-180' : ''" class="w-5 h-5 text-gray-400 transition-transform" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
                </button>
                <div x-show="openFaq === 2" x-collapse>
                    <p class="px-5 pb-5 text-sm text-gray-500 dark:text-gray-400">Quality depends on the format and quality setting. PNG is lossless, so no quality is lost. JPG and WebP are lossy – set quality to 90-100% for minimal loss. We recommend 80% for the best balance.</p>
                </div>
            </div>
            <div class="bg-white dark:bg-gray-900 rounded-xl border border-gray-200/60 dark:border-gray-800/60 overflow-hidden">
                <button x-on:click="openFaq = openFaq === 3 ? null : 3" class="w-full text-left p-5 flex items-center justify-between">
                    <span class="font-semibold">What is WebP and why should I use it?</span>
                    <svg :class="openFaq === 3 ? 'rotate-180' : ''" class="w-5 h-5 text-gray-400 transition-transform" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
                </button>
                <div x-show="openFaq === 3" x-collapse>
                    <p class="px-5 pb-5 text-sm text-gray-500 dark:text-gray-400">WebP is a modern image format by Google. It provides 25-35% smaller files than JPG at the same quality, and supports transparency like PNG. It's ideal for websites and is supported by all modern browsers.</p>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
<script>
    function imageConverter() {
        return {
            state: 'idle',
            isDragging: false,
            errorMessage: '',
            file: null,
            preview: null,
            currentFormat: '',
            targetFormat: 'webp',
            quality: 80,
            result: {},

            formats: [
                { value: 'jpg', label: 'Universal', color: 'text-blue-600' },
                { value: 'png', label: 'Lossless', color: 'text-green-600' },
                { value: 'webp', label: 'Modern Web', color: 'text-purple-600' },
            ],

            handleDrop(event) {
                this.isDragging = false;
                const files = event.dataTransfer.files;
                if (files.length > 0) this.selectFile(files[0]);
            },

            handleFileSelect(event) {
                const files = event.target.files;
                if (files.length > 0) this.selectFile(files[0]);
            },

            selectFile(file) {
                this.errorMessage = '';
                const allowed = ['image/jpeg', 'image/png', 'image/webp', 'image/gif'];
                if (!allowed.includes(file.type)) {
                    this.errorMessage = 'Unsupported format. Use JPG, PNG, WebP, or GIF.';
                    this.state = 'error';
                    return;
                }
                if (file.size > 20 * 1024 * 1024) {
                    this.errorMessage = 'File exceeds 20MB limit.';
                    this.state = 'error';
                    return;
                }
                this.file = file;
                this.preview = URL.createObjectURL(file);

                // Detect current format
                const extMap = { 'image/jpeg': 'jpg', 'image/png': 'png', 'image/webp': 'webp', 'image/gif': 'gif' };
                this.currentFormat = extMap[file.type] || 'unknown';

                // Auto-select a different target format
                if (this.currentFormat === 'webp') this.targetFormat = 'jpg';
                else if (this.currentFormat === 'jpg') this.targetFormat = 'webp';
                else this.targetFormat = 'webp';

                this.state = 'settings';
            },

            async convert() {
                this.state = 'processing';
                this.errorMessage = '';

                const formData = new FormData();
                formData.append('image', this.file);
                formData.append('quality', this.quality);
                formData.append('format', this.targetFormat);

                try {
                    const response = await fetch('{{ route("image.compress") }}', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'Accept': 'application/json',
                        },
                        body: formData,
                    });
                    const data = await response.json();
                    if (!response.ok || !data.success) {
                        throw new Error(data.message || 'Conversion failed.');
                    }
                    this.result = data;
                    this.state = 'result';
                } catch (error) {
                    this.errorMessage = error.message || 'An unexpected error occurred.';
                    this.state = 'error';
                }
            },

            reset() {
                if (this.preview) URL.revokeObjectURL(this.preview);
                this.file = null;
                this.preview = null;
                this.state = 'idle';
                this.errorMessage = '';
                this.result = {};
            },

            formatBytes(bytes) {
                if (!bytes || bytes === 0) return '0 B';
                const u = ['B', 'KB', 'MB', 'GB'];
                let i = 0, s = bytes;
                while (s >= 1024 && i < u.length - 1) { s /= 1024; i++; }
                return s.toFixed(2) + ' ' + u[i];
            },
        };
    }
</script>
@endpush
