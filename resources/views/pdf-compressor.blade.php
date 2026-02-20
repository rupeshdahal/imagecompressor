@extends('layouts.app')

@section('title', 'PDF Compressor - Reduce PDF File Size Online Free')
@section('description', 'Compress PDF files online for free. Reduce PDF file size while maintaining quality. No signup required.')
@section('keywords', 'pdf compressor, compress pdf, reduce pdf size, pdf compressor online free, shrink pdf')

@section('content')
    {{-- Hero --}}
    <header class="hero-bg pt-10 pb-6 sm:pt-14 sm:pb-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="inline-flex items-center gap-2 bg-orange-50 dark:bg-orange-900/30 text-orange-700 dark:text-orange-300 text-sm font-medium px-4 py-1.5 rounded-full mb-6 animate-slide-down">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m.75 12l3 3m0 0l3-3m-3 3v-6m-1.5-9H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/></svg>
                100% Free · No Signup · Fast & Secure
            </div>
            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight leading-tight mb-5">
                Compress PDF Files –
                <span class="gradient-text">Reduce Size, Keep Quality</span>
            </h1>
            <p class="text-lg sm:text-xl text-gray-500 dark:text-gray-400 max-w-2xl mx-auto leading-relaxed">
                Shrink your PDF files up to <strong class="text-gray-700 dark:text-gray-200">80%</strong>. Choose quality level for the perfect balance between size and quality.
            </p>
        </div>
    </header>

    {{-- Main App --}}
    <main class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 pb-12 -mt-2" x-data="pdfCompressor()" x-cloak>

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

                <input type="file" x-ref="fileInput" x-on:change="handleFileSelect($event)" accept=".pdf" class="hidden">

                <div class="relative mx-auto w-20 h-20 sm:w-24 sm:h-24 mb-6">
                    <div class="absolute inset-0 bg-orange-100 dark:bg-orange-900/40 rounded-3xl rotate-6 group-hover:rotate-12 transition-transform duration-300"></div>
                    <div class="relative bg-gradient-to-br from-orange-500 to-red-600 rounded-3xl w-full h-full flex items-center justify-center shadow-xl shadow-orange-500/25">
                        <svg class="w-10 h-10 sm:w-12 sm:h-12 text-white" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m.75 12l3 3m0 0l3-3m-3 3v-6m-1.5-9H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/></svg>
                    </div>
                </div>

                <h2 class="text-xl sm:text-2xl font-bold mb-2">Drop a PDF file here</h2>
                <p class="text-gray-500 dark:text-gray-400 mb-5">or <span class="text-brand-600 dark:text-brand-400 font-semibold underline underline-offset-2">browse files</span></p>

                <div class="flex flex-wrap justify-center gap-2">
                    <span class="inline-flex items-center gap-1 bg-red-50 dark:bg-red-900/30 text-red-600 dark:text-red-400 text-xs font-semibold px-3 py-1.5 rounded-full">PDF</span>
                    <span class="inline-flex items-center gap-1 bg-orange-50 dark:bg-orange-900/30 text-orange-600 dark:text-orange-400 text-xs font-semibold px-3 py-1.5 rounded-full">Max 50MB</span>
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

                {{-- File Info --}}
                <div class="px-6 sm:px-8 pt-6 sm:pt-8 pb-5 border-b border-gray-100 dark:border-gray-800">
                    <div class="flex items-center gap-4">
                        <div class="w-14 h-14 bg-red-50 dark:bg-red-900/30 rounded-2xl flex items-center justify-center flex-shrink-0">
                            <svg class="w-7 h-7 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/></svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="font-bold text-lg truncate" x-text="file?.name"></p>
                            <p class="text-sm text-gray-500 dark:text-gray-400" x-text="formatBytes(file?.size)"></p>
                        </div>
                        <button x-on:click="reset()" class="p-2 rounded-lg text-gray-400 hover:text-red-500 hover:bg-red-50 dark:hover:bg-red-900/20 transition-all">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                        </button>
                    </div>
                </div>

                {{-- Quality Selection --}}
                <div class="px-6 sm:px-8 py-6 space-y-5">
                    <label class="text-sm font-semibold text-gray-700 dark:text-gray-300 block">Compression Quality</label>

                    <div class="grid grid-cols-3 gap-3">
                        <button x-on:click="quality = 'low'"
                            :class="quality === 'low' ? 'ring-2 ring-brand-500 bg-brand-50 dark:bg-brand-900/20 border-brand-400' : 'border-gray-200 dark:border-gray-700 hover:border-brand-300'"
                            class="border rounded-2xl p-4 text-center transition-all cursor-pointer">
                            <div class="text-2xl mb-1">🗜️</div>
                            <p class="font-bold text-sm">Maximum</p>
                            <p class="text-xs text-gray-400 mt-1">72 DPI · Smallest</p>
                        </button>
                        <button x-on:click="quality = 'medium'"
                            :class="quality === 'medium' ? 'ring-2 ring-brand-500 bg-brand-50 dark:bg-brand-900/20 border-brand-400' : 'border-gray-200 dark:border-gray-700 hover:border-brand-300'"
                            class="border rounded-2xl p-4 text-center transition-all cursor-pointer">
                            <div class="text-2xl mb-1">⚖️</div>
                            <p class="font-bold text-sm">Balanced</p>
                            <p class="text-xs text-gray-400 mt-1">150 DPI · Medium</p>
                        </button>
                        <button x-on:click="quality = 'high'"
                            :class="quality === 'high' ? 'ring-2 ring-brand-500 bg-brand-50 dark:bg-brand-900/20 border-brand-400' : 'border-gray-200 dark:border-gray-700 hover:border-brand-300'"
                            class="border rounded-2xl p-4 text-center transition-all cursor-pointer">
                            <div class="text-2xl mb-1">✨</div>
                            <p class="font-bold text-sm">Quality</p>
                            <p class="text-xs text-gray-400 mt-1">300 DPI · Best</p>
                        </button>
                    </div>

                    {{-- Compress Button --}}
                    <button x-on:click="compress()"
                        class="w-full bg-gradient-to-r from-orange-600 to-red-600 hover:from-orange-700 hover:to-red-700 text-white font-bold py-4 px-6 rounded-2xl transition-all duration-200 flex items-center justify-center gap-2.5 text-lg shadow-xl shadow-orange-500/25 hover:shadow-orange-500/40 hover:scale-[1.02] active:scale-[0.98]">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m.75 12l3 3m0 0l3-3m-3 3v-6m-1.5-9H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/></svg>
                        Compress PDF
                    </button>
                </div>
            </div>
        </div>

        {{-- ======== PROCESSING STATE ======== --}}
        <div x-show="state === 'processing'" x-transition class="animate-slide-up">
            <div class="bg-white dark:bg-gray-900 rounded-3xl shadow-xl border border-gray-200/60 dark:border-gray-800/60 p-10 sm:p-14 text-center">
                <div class="relative w-20 h-20 mx-auto mb-6">
                    <div class="absolute inset-0 rounded-full bg-orange-100 dark:bg-orange-900/30 animate-ping opacity-40"></div>
                    <div class="relative w-full h-full rounded-full bg-orange-50 dark:bg-orange-900/20 flex items-center justify-center">
                        <svg class="animate-spin w-10 h-10 text-orange-600" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-20" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="3"/>
                            <path class="opacity-80" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"/>
                        </svg>
                    </div>
                </div>
                <h3 class="text-2xl font-bold mb-2">Compressing PDF...</h3>
                <p class="text-gray-500 dark:text-gray-400 mb-6" x-text="'Processing ' + file?.name"></p>
                <div class="w-full bg-gray-200 dark:bg-gray-800 rounded-full h-1.5 overflow-hidden max-w-xs mx-auto">
                    <div class="bg-gradient-to-r from-orange-500 to-red-500 h-1.5 rounded-full w-1/3 shimmer"></div>
                </div>
            </div>
        </div>

        {{-- ======== RESULT STATE ======== --}}
        <div x-show="state === 'result'" x-transition class="animate-slide-up space-y-5">

            {{-- Stats --}}
            <div class="grid grid-cols-3 gap-3">
                <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200/60 dark:border-gray-800/60 p-4 sm:p-5 text-center shadow-sm">
                    <p class="text-xs text-gray-400 font-medium mb-0.5">Original</p>
                    <p class="text-lg font-bold text-gray-700 dark:text-gray-200" x-text="result.formatted_original"></p>
                </div>
                <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200/60 dark:border-gray-800/60 p-4 sm:p-5 text-center shadow-sm">
                    <p class="text-xs text-gray-400 font-medium mb-0.5">Compressed</p>
                    <p class="text-lg font-bold text-green-600" x-text="result.formatted_compressed"></p>
                </div>
                <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200/60 dark:border-gray-800/60 p-4 sm:p-5 text-center shadow-sm">
                    <p class="text-xs text-gray-400 font-medium mb-0.5">Reduced</p>
                    <p class="text-2xl font-bold" :class="parseFloat(result.reduction) > 0 ? 'text-green-600' : 'text-amber-600'" x-text="result.reduction + '%'"></p>
                </div>
            </div>

            {{-- Download --}}
            <div class="bg-white dark:bg-gray-900 rounded-3xl shadow-xl border border-gray-200/60 dark:border-gray-800/60 p-6 sm:p-8">
                <div class="flex items-center gap-4 mb-6">
                    <div class="w-14 h-14 bg-green-50 dark:bg-green-900/30 rounded-2xl flex items-center justify-center">
                        <svg class="w-7 h-7 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                    </div>
                    <div>
                        <p class="font-bold text-lg">Compression Complete!</p>
                        <p class="text-sm text-gray-500" x-text="parseFloat(result.reduction) > 0 ? 'Saved ' + result.reduction + '% file size' : 'PDF is already optimized'"></p>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-x-6 gap-y-2 text-sm mb-6 p-4 bg-gray-50 dark:bg-gray-800/50 rounded-xl">
                    <div class="flex justify-between"><span class="text-gray-400">Original Size</span><strong x-text="result.formatted_original"></strong></div>
                    <div class="flex justify-between"><span class="text-gray-400">Compressed Size</span><strong x-text="result.formatted_compressed"></strong></div>
                    <div class="flex justify-between"><span class="text-gray-400">Quality</span><strong x-text="quality.charAt(0).toUpperCase() + quality.slice(1)"></strong></div>
                    <div class="flex justify-between"><span class="text-gray-400">Savings</span><strong x-text="result.reduction + '%'"></strong></div>
                </div>

                <div class="flex flex-col sm:flex-row gap-3">
                    <a :href="result.download_url" download
                       class="flex-1 bg-gradient-to-r from-orange-600 to-red-600 hover:from-orange-700 hover:to-red-700 text-white font-bold py-4 px-6 rounded-2xl transition-all flex items-center justify-center gap-2.5 text-lg shadow-xl shadow-orange-500/25 hover:shadow-orange-500/40 hover:scale-[1.02] active:scale-[0.98]">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        Download Compressed PDF
                    </a>
                    <button x-on:click="reset()" class="bg-gray-100 dark:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-200 font-bold py-4 px-6 rounded-2xl transition-all flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                        New Compression
                    </button>
                </div>
            </div>
        </div>

    </main>

    {{-- Features --}}
    <section class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="text-center mb-12">
            <h2 class="text-3xl sm:text-4xl font-extrabold mb-4">How PDF Compression Works</h2>
            <p class="text-gray-500 dark:text-gray-400 max-w-xl mx-auto">Three simple steps to smaller PDFs</p>
        </div>
        <div class="grid sm:grid-cols-3 gap-6">
            <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200/60 dark:border-gray-800/60 p-6 text-center hover:shadow-lg transition-shadow">
                <div class="w-14 h-14 bg-orange-50 dark:bg-orange-900/30 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <span class="text-2xl font-extrabold text-orange-600">1</span>
                </div>
                <h3 class="font-bold text-lg mb-2">Upload PDF</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400">Drag & drop or click to select a PDF up to 50MB.</p>
            </div>
            <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200/60 dark:border-gray-800/60 p-6 text-center hover:shadow-lg transition-shadow">
                <div class="w-14 h-14 bg-red-50 dark:bg-red-900/30 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <span class="text-2xl font-extrabold text-red-600">2</span>
                </div>
                <h3 class="font-bold text-lg mb-2">Choose Quality</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400">Select Maximum, Balanced, or Quality compression.</p>
            </div>
            <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200/60 dark:border-gray-800/60 p-6 text-center hover:shadow-lg transition-shadow">
                <div class="w-14 h-14 bg-green-50 dark:bg-green-900/30 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <span class="text-2xl font-extrabold text-green-600">3</span>
                </div>
                <h3 class="font-bold text-lg mb-2">Download</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400">Get your compressed PDF with one click.</p>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
<script>
    function pdfCompressor() {
        return {
            state: 'idle',
            isDragging: false,
            errorMessage: '',
            file: null,
            quality: 'medium',
            result: {},

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
                if (file.type !== 'application/pdf') {
                    this.errorMessage = 'Please select a PDF file.';
                    this.state = 'error';
                    return;
                }
                if (file.size > 50 * 1024 * 1024) {
                    this.errorMessage = 'File exceeds 50MB limit.';
                    this.state = 'error';
                    return;
                }
                this.file = file;
                this.state = 'settings';
            },

            async compress() {
                this.state = 'processing';
                this.errorMessage = '';

                const formData = new FormData();
                formData.append('pdf', this.file);
                formData.append('quality', this.quality);

                try {
                    const response = await fetch('{{ route("pdf.compress") }}', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'Accept': 'application/json',
                        },
                        body: formData,
                    });
                    const data = await response.json();
                    if (!response.ok || !data.success) {
                        throw new Error(data.message || 'Compression failed.');
                    }
                    this.result = data;
                    this.state = 'result';
                } catch (error) {
                    this.errorMessage = error.message || 'An unexpected error occurred.';
                    this.state = 'error';
                }
            },

            reset() {
                this.file = null;
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
