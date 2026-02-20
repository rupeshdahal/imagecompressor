@extends('layouts.app')

@section('title', 'Image to PDF Converter - Convert JPG, PNG, WebP to PDF Online Free')
@section('description', 'Convert images to PDF online for free. Upload multiple JPG, PNG, or WebP images and combine them into a single PDF document. No signup required.')
@section('keywords', 'image to pdf, jpg to pdf, png to pdf, convert image to pdf online free, multiple images to pdf')

@section('content')
    {{-- Hero --}}
    <header class="hero-bg pt-10 pb-6 sm:pt-14 sm:pb-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="inline-flex items-center gap-2 bg-red-50 dark:bg-red-900/30 text-red-700 dark:text-red-300 text-sm font-medium px-4 py-1.5 rounded-full mb-6 animate-slide-down">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                100% Free · No Signup · Multiple Images
            </div>
            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight leading-tight mb-5">
                Convert Images to PDF –
                <span class="gradient-text">Combine Multiple Images into One PDF</span>
            </h1>
            <p class="text-lg sm:text-xl text-gray-500 dark:text-gray-400 max-w-2xl mx-auto leading-relaxed">
                Upload up to <strong class="text-gray-700 dark:text-gray-200">20 images</strong> (JPG, PNG, WebP, GIF) and convert them to a single PDF. Drag to reorder. Choose page size, orientation, and margins.
            </p>
        </div>
    </header>

    {{-- Main App --}}
    <main class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 pb-12 -mt-2" x-data="imageToPdf()" x-cloak>

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

                <input type="file" x-ref="fileInput" x-on:change="handleFileSelect($event)" accept=".jpg,.jpeg,.png,.webp,.gif" multiple class="hidden">

                <div class="relative mx-auto w-20 h-20 sm:w-24 sm:h-24 mb-6">
                    <div class="absolute inset-0 bg-red-100 dark:bg-red-900/40 rounded-3xl rotate-6 group-hover:rotate-12 transition-transform duration-300"></div>
                    <div class="relative bg-gradient-to-br from-red-500 to-red-700 rounded-3xl w-full h-full flex items-center justify-center shadow-xl shadow-red-500/25">
                        <svg class="w-10 h-10 sm:w-12 sm:h-12 text-white" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/></svg>
                    </div>
                </div>

                <h2 class="text-xl sm:text-2xl font-bold mb-2">Drop images here to create PDF</h2>
                <p class="text-gray-500 dark:text-gray-400 mb-5">or <span class="text-brand-600 dark:text-brand-400 font-semibold underline underline-offset-2">browse files</span> · Select multiple images</p>

                <div class="flex flex-wrap justify-center gap-2">
                    <span class="inline-flex items-center gap-1 bg-gray-100 dark:bg-gray-800 text-gray-500 dark:text-gray-400 text-xs font-semibold px-3 py-1.5 rounded-full">JPG</span>
                    <span class="inline-flex items-center gap-1 bg-gray-100 dark:bg-gray-800 text-gray-500 dark:text-gray-400 text-xs font-semibold px-3 py-1.5 rounded-full">PNG</span>
                    <span class="inline-flex items-center gap-1 bg-gray-100 dark:bg-gray-800 text-gray-500 dark:text-gray-400 text-xs font-semibold px-3 py-1.5 rounded-full">WEBP</span>
                    <span class="inline-flex items-center gap-1 bg-gray-100 dark:bg-gray-800 text-gray-500 dark:text-gray-400 text-xs font-semibold px-3 py-1.5 rounded-full">GIF</span>
                    <span class="inline-flex items-center gap-1 bg-red-50 dark:bg-red-900/30 text-red-600 dark:text-red-400 text-xs font-semibold px-3 py-1.5 rounded-full">
                        → PDF
                    </span>
                    <span class="inline-flex items-center gap-1 bg-brand-50 dark:bg-brand-900/30 text-brand-600 dark:text-brand-400 text-xs font-semibold px-3 py-1.5 rounded-full">Max 20 images</span>
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
        <div x-show="state === 'settings'" x-transition class="animate-slide-up space-y-5">

            {{-- Image List --}}
            <div class="bg-white dark:bg-gray-900 rounded-3xl shadow-xl border border-gray-200/60 dark:border-gray-800/60 overflow-hidden">
                <div class="px-6 sm:px-8 pt-6 sm:pt-8 pb-4 border-b border-gray-100 dark:border-gray-800 flex items-center justify-between">
                    <div>
                        <h3 class="font-bold text-lg">Selected Images</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400" x-text="images.length + ' image' + (images.length > 1 ? 's' : '') + ' selected'"></p>
                    </div>
                    <div class="flex gap-2">
                        <button x-on:click="$refs.addMore.click()" class="text-sm font-medium text-brand-600 dark:text-brand-400 hover:text-brand-700 px-3 py-1.5 rounded-lg bg-brand-50 dark:bg-brand-900/30 hover:bg-brand-100 transition-colors">+ Add More</button>
                        <input type="file" x-ref="addMore" x-on:change="addFiles($event)" accept=".jpg,.jpeg,.png,.webp,.gif" multiple class="hidden">
                    </div>
                </div>

                <div class="px-6 sm:px-8 py-4 space-y-2 max-h-80 overflow-y-auto">
                    <template x-for="(img, index) in images" :key="img.id">
                        <div class="flex items-center gap-3 p-3 rounded-xl bg-gray-50 dark:bg-gray-800/50 border border-gray-200/60 dark:border-gray-700/60">
                            {{-- Thumbnail --}}
                            <img :src="img.preview" class="w-12 h-12 rounded-lg object-cover flex-shrink-0" alt="thumbnail">
                            {{-- Info --}}
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium truncate" x-text="img.name"></p>
                                <p class="text-xs text-gray-400" x-text="formatBytes(img.size)"></p>
                            </div>
                            {{-- Page number --}}
                            <span class="text-xs font-bold text-gray-400 bg-gray-100 dark:bg-gray-700 px-2 py-1 rounded-lg" x-text="'Page ' + (index + 1)"></span>
                            {{-- Move buttons --}}
                            <button x-on:click="moveUp(index)" :disabled="index === 0" class="p-1.5 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-700 disabled:opacity-30 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 15l7-7 7 7"/></svg>
                            </button>
                            <button x-on:click="moveDown(index)" :disabled="index === images.length - 1" class="p-1.5 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-700 disabled:opacity-30 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
                            </button>
                            {{-- Remove --}}
                            <button x-on:click="removeImage(index)" class="p-1.5 rounded-lg text-gray-400 hover:text-red-500 hover:bg-red-50 dark:hover:bg-red-900/20 transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                            </button>
                        </div>
                    </template>
                </div>

                {{-- Settings --}}
                <div class="px-6 sm:px-8 py-6 space-y-5 border-t border-gray-100 dark:border-gray-800">

                    {{-- Page Size & Orientation --}}
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2 block">Page Size</label>
                            <select x-model="pageSize" class="w-full px-4 py-2.5 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm font-medium focus:ring-2 focus:ring-brand-500 focus:border-brand-500 transition-all">
                                <option value="a4">A4 (210 × 297mm)</option>
                                <option value="letter">Letter (8.5 × 11in)</option>
                                <option value="a3">A3 (297 × 420mm)</option>
                                <option value="a5">A5 (148 × 210mm)</option>
                            </select>
                        </div>
                        <div>
                            <label class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2 block">Orientation</label>
                            <div class="grid grid-cols-2 gap-2">
                                <button x-on:click="orientation = 'portrait'"
                                    :class="orientation === 'portrait' ? 'bg-brand-600 text-white border-brand-600' : 'bg-white dark:bg-gray-800 text-gray-600 dark:text-gray-400 border-gray-200 dark:border-gray-700 hover:border-brand-300'"
                                    class="px-3 py-2.5 rounded-xl border text-sm font-semibold transition-all text-center">Portrait</button>
                                <button x-on:click="orientation = 'landscape'"
                                    :class="orientation === 'landscape' ? 'bg-brand-600 text-white border-brand-600' : 'bg-white dark:bg-gray-800 text-gray-600 dark:text-gray-400 border-gray-200 dark:border-gray-700 hover:border-brand-300'"
                                    class="px-3 py-2.5 rounded-xl border text-sm font-semibold transition-all text-center">Landscape</button>
                            </div>
                        </div>
                    </div>

                    {{-- Margin & Fit --}}
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2 block">Margin (mm)</label>
                            <select x-model="margin" class="w-full px-4 py-2.5 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm font-medium focus:ring-2 focus:ring-brand-500 focus:border-brand-500 transition-all">
                                <option value="0">No Margin</option>
                                <option value="5">5mm</option>
                                <option value="10">10mm (Default)</option>
                                <option value="20">20mm</option>
                                <option value="30">30mm</option>
                            </select>
                        </div>
                        <div>
                            <label class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2 block">Image Fit</label>
                            <select x-model="fitMode" class="w-full px-4 py-2.5 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm font-medium focus:ring-2 focus:ring-brand-500 focus:border-brand-500 transition-all">
                                <option value="fit">Fit (contain)</option>
                                <option value="fill">Fill (cover)</option>
                                <option value="stretch">Stretch</option>
                            </select>
                        </div>
                    </div>

                    {{-- Convert Button --}}
                    <button x-on:click="convert()"
                        class="w-full bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white font-bold py-4 px-6 rounded-2xl transition-all duration-200 flex items-center justify-center gap-2.5 text-lg shadow-xl shadow-red-500/25 hover:shadow-red-500/40 hover:scale-[1.02] active:scale-[0.98]">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                        Convert to PDF
                    </button>
                </div>
            </div>
        </div>

        {{-- ======== PROCESSING STATE ======== --}}
        <div x-show="state === 'processing'" x-transition class="animate-slide-up">
            <div class="bg-white dark:bg-gray-900 rounded-3xl shadow-xl border border-gray-200/60 dark:border-gray-800/60 p-10 sm:p-14 text-center">
                <div class="relative w-20 h-20 mx-auto mb-6">
                    <div class="absolute inset-0 rounded-full bg-red-100 dark:bg-red-900/30 animate-ping opacity-40"></div>
                    <div class="relative w-full h-full rounded-full bg-red-50 dark:bg-red-900/20 flex items-center justify-center">
                        <svg class="animate-spin w-10 h-10 text-red-600" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-20" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="3"/>
                            <path class="opacity-80" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"/>
                        </svg>
                    </div>
                </div>
                <h3 class="text-2xl font-bold mb-2">Creating your PDF...</h3>
                <p class="text-gray-500 dark:text-gray-400 mb-6" x-text="'Converting ' + images.length + ' image' + (images.length > 1 ? 's' : '') + ' to PDF'"></p>
                <div class="w-full bg-gray-200 dark:bg-gray-800 rounded-full h-1.5 overflow-hidden max-w-xs mx-auto">
                    <div class="bg-gradient-to-r from-red-500 to-red-600 h-1.5 rounded-full w-1/3 shimmer"></div>
                </div>
            </div>
        </div>

        {{-- ======== RESULT STATE ======== --}}
        <div x-show="state === 'result'" x-transition class="animate-slide-up space-y-5">

            {{-- Stats --}}
            <div class="grid grid-cols-3 gap-3">
                <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200/60 dark:border-gray-800/60 p-4 sm:p-5 text-center shadow-sm">
                    <p class="text-xs text-gray-400 font-medium mb-0.5">Images</p>
                    <p class="text-2xl font-bold text-brand-600" x-text="result.image_count"></p>
                </div>
                <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200/60 dark:border-gray-800/60 p-4 sm:p-5 text-center shadow-sm">
                    <p class="text-xs text-gray-400 font-medium mb-0.5">Pages</p>
                    <p class="text-2xl font-bold text-accent-600" x-text="result.page_count"></p>
                </div>
                <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200/60 dark:border-gray-800/60 p-4 sm:p-5 text-center shadow-sm">
                    <p class="text-xs text-gray-400 font-medium mb-0.5">PDF Size</p>
                    <p class="text-lg font-bold text-gray-700 dark:text-gray-200" x-text="result.formatted_size"></p>
                </div>
            </div>

            {{-- Download --}}
            <div class="bg-white dark:bg-gray-900 rounded-3xl shadow-xl border border-gray-200/60 dark:border-gray-800/60 p-6 sm:p-8">
                <div class="flex items-center gap-4 mb-6">
                    <div class="w-14 h-14 bg-red-50 dark:bg-red-900/30 rounded-2xl flex items-center justify-center">
                        <svg class="w-7 h-7 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/></svg>
                    </div>
                    <div>
                        <p class="font-bold text-lg">PDF Created Successfully!</p>
                        <p class="text-sm text-gray-500" x-text="result.image_count + ' images combined into ' + result.page_count + ' pages'"></p>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-x-6 gap-y-2 text-sm mb-6 p-4 bg-gray-50 dark:bg-gray-800/50 rounded-xl">
                    <div class="flex justify-between"><span class="text-gray-400">Original Images</span><strong x-text="result.formatted_original"></strong></div>
                    <div class="flex justify-between"><span class="text-gray-400">PDF Size</span><strong x-text="result.formatted_size"></strong></div>
                    <div class="flex justify-between"><span class="text-gray-400">Page Size</span><strong x-text="pageSize.toUpperCase()"></strong></div>
                    <div class="flex justify-between"><span class="text-gray-400">Orientation</span><strong x-text="orientation.charAt(0).toUpperCase() + orientation.slice(1)"></strong></div>
                </div>

                <div class="flex flex-col sm:flex-row gap-3">
                    <a :href="result.download_url" download
                       class="flex-1 bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white font-bold py-4 px-6 rounded-2xl transition-all flex items-center justify-center gap-2.5 text-lg shadow-xl shadow-red-500/25 hover:shadow-red-500/40 hover:scale-[1.02] active:scale-[0.98]">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        Download PDF
                    </a>
                    <button x-on:click="reset()" class="bg-gray-100 dark:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-200 font-bold py-4 px-6 rounded-2xl transition-all flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                        New Conversion
                    </button>
                </div>
            </div>
        </div>

    </main>

    {{-- Features --}}
    <section class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="text-center mb-12">
            <h2 class="text-3xl sm:text-4xl font-extrabold mb-4">Why Use Our Image to PDF Converter?</h2>
            <p class="text-gray-500 dark:text-gray-400 max-w-xl mx-auto">The fastest way to create PDFs from images</p>
        </div>
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-5">
            <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200/60 dark:border-gray-800/60 p-6 hover:shadow-lg transition-shadow">
                <div class="w-12 h-12 bg-red-50 dark:bg-red-900/30 rounded-2xl flex items-center justify-center mb-4"><svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg></div>
                <h3 class="font-bold text-lg mb-2">Multiple Images</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400">Upload up to 20 images at once and combine them into one PDF.</p>
            </div>
            <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200/60 dark:border-gray-800/60 p-6 hover:shadow-lg transition-shadow">
                <div class="w-12 h-12 bg-blue-50 dark:bg-blue-900/30 rounded-2xl flex items-center justify-center mb-4"><svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"/></svg></div>
                <h3 class="font-bold text-lg mb-2">Custom Layout</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400">Choose page size, orientation, margins, and image fit mode.</p>
            </div>
            <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200/60 dark:border-gray-800/60 p-6 hover:shadow-lg transition-shadow">
                <div class="w-12 h-12 bg-green-50 dark:bg-green-900/30 rounded-2xl flex items-center justify-center mb-4"><svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4"/></svg></div>
                <h3 class="font-bold text-lg mb-2">Reorder Pages</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400">Drag and reorder images to control page order in the PDF.</p>
            </div>
            <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200/60 dark:border-gray-800/60 p-6 hover:shadow-lg transition-shadow">
                <div class="w-12 h-12 bg-purple-50 dark:bg-purple-900/30 rounded-2xl flex items-center justify-center mb-4"><svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg></div>
                <h3 class="font-bold text-lg mb-2">100% Secure</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400">Files are auto-deleted in 30 minutes. No data stored.</p>
            </div>
            <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200/60 dark:border-gray-800/60 p-6 hover:shadow-lg transition-shadow">
                <div class="w-12 h-12 bg-amber-50 dark:bg-amber-900/30 rounded-2xl flex items-center justify-center mb-4"><svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg></div>
                <h3 class="font-bold text-lg mb-2">Lightning Fast</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400">Server-side processing. Your PDF is ready in seconds.</p>
            </div>
            <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200/60 dark:border-gray-800/60 p-6 hover:shadow-lg transition-shadow">
                <div class="w-12 h-12 bg-teal-50 dark:bg-teal-900/30 rounded-2xl flex items-center justify-center mb-4"><svg class="w-6 h-6 text-teal-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg></div>
                <h3 class="font-bold text-lg mb-2">Totally Free</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400">No signup, no watermarks, no limits. Create PDFs anytime.</p>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
<script>
    function imageToPdf() {
        return {
            state: 'idle',
            isDragging: false,
            errorMessage: '',
            images: [],
            pageSize: 'a4',
            orientation: 'portrait',
            margin: '10',
            fitMode: 'fit',
            result: {},
            idCounter: 0,

            handleDrop(event) {
                this.isDragging = false;
                this.addFilesFromList(event.dataTransfer.files);
            },

            handleFileSelect(event) {
                this.addFilesFromList(event.target.files);
            },

            addFiles(event) {
                this.addFilesFromList(event.target.files);
            },

            addFilesFromList(fileList) {
                this.errorMessage = '';
                const allowed = ['image/jpeg', 'image/png', 'image/webp', 'image/gif'];
                const maxSize = 20 * 1024 * 1024;

                for (let i = 0; i < fileList.length; i++) {
                    if (this.images.length >= 20) {
                        this.errorMessage = 'Maximum 20 images allowed.';
                        break;
                    }
                    const file = fileList[i];
                    if (!allowed.includes(file.type)) {
                        this.errorMessage = `"${file.name}" is not a supported image format.`;
                        continue;
                    }
                    if (file.size > maxSize) {
                        this.errorMessage = `"${file.name}" exceeds 20MB limit.`;
                        continue;
                    }
                    this.images.push({
                        id: ++this.idCounter,
                        file: file,
                        name: file.name,
                        size: file.size,
                        preview: URL.createObjectURL(file),
                    });
                }

                if (this.images.length > 0) {
                    this.state = 'settings';
                } else if (!this.errorMessage) {
                    this.errorMessage = 'No valid images selected.';
                    this.state = 'error';
                }
            },

            moveUp(index) {
                if (index > 0) {
                    [this.images[index], this.images[index - 1]] = [this.images[index - 1], this.images[index]];
                }
            },

            moveDown(index) {
                if (index < this.images.length - 1) {
                    [this.images[index], this.images[index + 1]] = [this.images[index + 1], this.images[index]];
                }
            },

            removeImage(index) {
                URL.revokeObjectURL(this.images[index].preview);
                this.images.splice(index, 1);
                if (this.images.length === 0) this.state = 'idle';
            },

            async convert() {
                this.state = 'processing';
                this.errorMessage = '';

                const formData = new FormData();
                this.images.forEach((img, i) => {
                    formData.append('images[]', img.file);
                });
                formData.append('orientation', this.orientation);
                formData.append('page_size', this.pageSize);
                formData.append('margin', this.margin);
                formData.append('fit_mode', this.fitMode);

                try {
                    const response = await fetch('{{ route("image.to.pdf.convert") }}', {
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
                this.images.forEach(img => URL.revokeObjectURL(img.preview));
                this.images = [];
                this.state = 'idle';
                this.errorMessage = '';
                this.result = {};
            },

            formatBytes(bytes) {
                if (bytes === 0) return '0 B';
                const u = ['B', 'KB', 'MB', 'GB'];
                let i = 0, s = bytes;
                while (s >= 1024 && i < u.length - 1) { s /= 1024; i++; }
                return s.toFixed(2) + ' ' + u[i];
            },
        };
    }
</script>
@endpush
