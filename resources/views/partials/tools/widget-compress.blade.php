<div x-data="compressor()" x-init="initComp()">

            {{-- IDLE / ERROR --}}
            <div x-show="state === 'idle' || state === 'error'" class="animate-slide-up">
                <div id="dropZone"
                     x-on:dragover.prevent="isDragging = true"
                     x-on:dragleave.prevent="isDragging = false"
                     x-on:drop.prevent="handleDrop($event)"
                     x-on:click="$refs.fileInputC.click()"
                     :class="{ 'drop-active ring-2 ring-brand-400': isDragging, 'ring-2 ring-green-400': isPasting }"
                     class="relative bg-white border-2 border-dashed border-gray-300 rounded-3xl p-10 sm:p-14 text-center cursor-pointer transition-all duration-300 group shadow-sm hover:shadow-lg hover:border-brand-400">
                    <input type="file" x-ref="fileInputC" x-on:change="handleFileSelect($event)" accept=".jpg,.jpeg,.png,.webp,.gif" class="hidden">
                    <div class="relative mx-auto w-20 h-20 sm:w-24 sm:h-24 mb-6">
                        <div class="absolute inset-0 bg-brand-100 rounded-3xl rotate-6 group-hover:rotate-12 transition-transform duration-300"></div>
                        <div class="relative bg-gradient-to-br from-brand-500 to-brand-700 rounded-3xl w-full h-full flex items-center justify-center shadow-xl shadow-brand-500/25">
                            <svg class="w-10 h-10 sm:w-12 sm:h-12 text-white" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5"/></svg>
                        </div>
                    </div>
                    <h2 class="text-xl sm:text-2xl font-bold mb-2">Drop your image here</h2>
                    <p class="text-gray-500 mb-5">or <span class="text-brand-600 font-semibold underline decoration-brand-300 underline-offset-2">browse files</span> from your device</p>
                    <div class="mb-5 flex items-center justify-center gap-2 text-sm text-gray-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        <span>or press <kbd class="px-2 py-0.5 text-xs bg-gray-100 border border-gray-300 rounded">Ctrl+V</kbd> to paste</span>
                    </div>
                    <div class="flex flex-wrap justify-center gap-2">
                        <span class="inline-flex items-center gap-1 bg-gray-100 text-gray-500 text-xs font-semibold px-3 py-1.5 rounded-full">JPG</span>
                        <span class="inline-flex items-center gap-1 bg-gray-100 text-gray-500 text-xs font-semibold px-3 py-1.5 rounded-full">PNG</span>
                        <span class="inline-flex items-center gap-1 bg-gray-100 text-gray-500 text-xs font-semibold px-3 py-1.5 rounded-full">WEBP</span>
                        <span class="inline-flex items-center gap-1 bg-gray-100 text-gray-500 text-xs font-semibold px-3 py-1.5 rounded-full">GIF</span>
                        <span class="inline-flex items-center gap-1 bg-brand-50 text-brand-600 text-xs font-semibold px-3 py-1.5 rounded-full">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                            Max 20MB
                        </span>
                    </div>
                </div>
                <div x-show="errorMessage" x-transition.duration.300ms class="mt-4 bg-red-50 border border-red-200 rounded-2xl p-4 flex items-start gap-3">
                    <div class="w-8 h-8 bg-red-100 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                        <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div>
                        <p class="text-red-700 text-sm font-medium" x-text="errorMessage"></p>
                        <button x-on:click="errorMessage = ''" class="text-red-400 text-xs mt-1 hover:text-red-600 transition-colors">Dismiss</button>
                    </div>
                </div>
            </div>

            {{-- SETTINGS --}}
            <div x-show="state === 'settings'" x-transition class="animate-slide-up">
                <div class="bg-white rounded-3xl shadow-xl shadow-gray-200/50 border border-gray-200/60 overflow-hidden">
                    <div class="px-6 sm:px-8 pt-6 sm:pt-8 pb-5 border-b border-gray-100 flex items-center gap-4">
                        <div class="w-14 h-14 bg-gradient-to-br from-brand-100 to-brand-50 rounded-2xl flex items-center justify-center flex-shrink-0">
                            <svg class="w-7 h-7 text-brand-600" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909M3.75 21h16.5A2.25 2.25 0 0022.5 18.75V5.25A2.25 2.25 0 0020.25 3H3.75A2.25 2.25 0 001.5 5.25v13.5A2.25 2.25 0 003.75 21z"/></svg>
                        </div>
                        <div class="min-w-0 flex-1">
                            <p class="font-bold text-base truncate" x-text="fileName"></p>
                            <p class="text-sm text-gray-500 flex items-center gap-2">
                                <span x-text="formatBytes(fileSize)"></span>
                                <span class="w-1 h-1 bg-gray-300 rounded-full"></span>
                                <span x-text="fileType.toUpperCase()"></span>
                            </p>
                        </div>
                        <button x-on:click="reset()" class="p-2 rounded-xl text-gray-400 hover:text-red-500 hover:bg-red-50 transition-all" title="Remove file">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                        </button>
                    </div>
                    <div class="px-6 sm:px-8 py-6 sm:py-8 space-y-7">
                        <div x-show="previewUrl" class="rounded-2xl overflow-hidden bg-gray-100 max-h-64 flex items-center justify-center">
                            <img :src="previewUrl" alt="Preview" class="max-h-64 object-contain w-full" loading="lazy">
                        </div>
                        {{-- Quality Slider --}}
                        <div>
                            <div class="flex items-center justify-between mb-3">
                                <label class="text-sm font-semibold text-gray-700">Compression Quality</label>
                                <span class="text-sm font-bold bg-brand-100 text-brand-700 px-3 py-1 rounded-full" x-text="quality + '%'"></span>
                            </div>
                            <input type="range" min="10" max="90" step="1" x-model.number="quality"
                                   class="w-full" :style="'background: linear-gradient(to right, #6366f1 ' + ((quality-10)/80*100) + '%, #e5e7eb ' + ((quality-10)/80*100) + '%)'">
                            <div class="flex justify-between mt-2 text-xs text-gray-400 font-medium">
                                <span>🗜️ Smaller file</span>
                                <span>🖼️ Higher quality</span>
                            </div>
                            <div class="flex gap-2 mt-4">
                                <button x-on:click="quality = 20" :class="quality >= 10 && quality <= 30 ? 'bg-brand-100 text-brand-700 border-brand-200 ring-1 ring-brand-200' : 'bg-gray-50 text-gray-600 border-gray-200 hover:border-brand-300'" class="flex-1 px-3 py-2.5 rounded-xl border text-xs font-semibold transition-all text-center">Max Compression</button>
                                <button x-on:click="quality = 50" :class="quality >= 31 && quality <= 65 ? 'bg-brand-100 text-brand-700 border-brand-200 ring-1 ring-brand-200' : 'bg-gray-50 text-gray-600 border-gray-200 hover:border-brand-300'" class="flex-1 px-3 py-2.5 rounded-xl border text-xs font-semibold transition-all text-center">Balanced</button>
                                <button x-on:click="quality = 80" :class="quality >= 66 && quality <= 90 ? 'bg-brand-100 text-brand-700 border-brand-200 ring-1 ring-brand-200' : 'bg-gray-50 text-gray-600 border-gray-200 hover:border-brand-300'" class="flex-1 px-3 py-2.5 rounded-xl border text-xs font-semibold transition-all text-center">High Quality</button>
                            </div>
                        </div>
                        <div class="flex items-center gap-2 text-sm text-gray-400 bg-gray-50 rounded-xl px-4 py-3">
                            <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            <span>Estimated time: <strong class="text-gray-600" x-text="estimatedTime()"></strong></span>
                        </div>
                        <button x-on:click="compress()"
                            class="w-full bg-gradient-to-r from-brand-600 to-brand-700 hover:from-brand-700 hover:to-brand-800 text-white font-bold py-4 px-6 rounded-2xl transition-all duration-200 flex items-center justify-center gap-2.5 text-lg shadow-xl shadow-brand-500/25 hover:scale-[1.02] active:scale-[0.98]">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3"/></svg>
                            Compress Image
                        </button>
                    </div>
                </div>
            </div>

            {{-- PROCESSING --}}
            <div x-show="state === 'processing'" x-transition class="animate-slide-up">
                <div class="bg-white rounded-3xl shadow-xl shadow-gray-200/50 border border-gray-200/60 p-10 sm:p-14 text-center">
                    <div class="relative w-20 h-20 mx-auto mb-6">
                        <div class="absolute inset-0 rounded-full bg-brand-100 animate-ping opacity-40"></div>
                        <div class="relative w-full h-full rounded-full bg-brand-50 flex items-center justify-center">
                            <svg class="animate-spin w-10 h-10 text-brand-600" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-20" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="3"/>
                                <path class="opacity-80" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"/>
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-2xl font-bold mb-2">Compressing your image...</h3>
                    <p class="text-gray-500 mb-4" x-text="uploadProgress > 0 && uploadProgress < 100 ? 'Uploading... ' + uploadProgress + '%' : 'Processing…'"></p>
                    <div class="w-full bg-gray-200 rounded-full h-2 overflow-hidden max-w-xs mx-auto">
                        <div class="bg-gradient-to-r from-brand-500 to-brand-600 h-2 rounded-full transition-all duration-300"
                             :class="uploadProgress === 0 || uploadProgress === 100 ? 'shimmer' : ''"
                             :style="'width:' + (uploadProgress > 0 ? uploadProgress : 33) + '%'"></div>
                    </div>
                </div>
            </div>

            {{-- RESULT --}}
            <div x-show="state === 'result'" x-transition class="animate-slide-up space-y-5">
                {{-- Stats row --}}
                <div class="grid grid-cols-3 gap-3">
                    <div class="bg-white rounded-2xl border border-gray-200/60 p-4 sm:p-5 text-center shadow-sm">
                        <div class="w-9 h-9 bg-gray-100 rounded-xl flex items-center justify-center mx-auto mb-2">
                            <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"/></svg>
                        </div>
                        <p class="text-xs text-gray-400 font-medium mb-0.5">Original</p>
                        <p class="text-base sm:text-lg font-bold text-gray-700" x-text="result.formatted_original"></p>
                    </div>
                    <div class="bg-white rounded-2xl border border-gray-200/60 p-4 sm:p-5 text-center shadow-sm">
                        <div class="w-9 h-9 bg-accent-50 rounded-xl flex items-center justify-center mx-auto mb-2">
                            <svg class="w-4 h-4 text-accent-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <p class="text-xs text-gray-400 font-medium mb-0.5">Compressed</p>
                        <p class="text-base sm:text-lg font-bold text-accent-600" x-text="result.formatted_compressed"></p>
                    </div>
                    <div class="bg-white rounded-2xl border border-gray-200/60 p-4 sm:p-5 text-center shadow-sm">
                        <div class="w-9 h-9 rounded-xl flex items-center justify-center mx-auto mb-2" :class="result.reduction > 0 ? 'bg-green-50' : 'bg-red-50'">
                            <svg class="w-4 h-4" :class="result.reduction > 0 ? 'text-green-600' : 'text-red-500'" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
                        </div>
                        <p class="text-xs text-gray-400 font-medium mb-0.5">Saved</p>
                        <p class="text-base sm:text-lg font-bold" :class="result.reduction > 0 ? 'text-green-600' : 'text-red-500'" x-text="result.reduction + '%'"></p>
                    </div>
                </div>

                {{-- ── Before / After Slider ────────────────────────────── --}}
                <div x-show="previewUrl && result.download_url"
                     x-data="{ sliderPos: 50, dragging: false }"
                     class="relative rounded-2xl overflow-hidden bg-gray-200 select-none touch-none"
                     style="height:260px;"
                     x-on:mousedown="dragging = true"
                     x-on:mouseup.window="dragging = false"
                     x-on:mousemove="if(dragging){ let r=$el.getBoundingClientRect(); sliderPos = Math.min(Math.max((($event.clientX - r.left)/r.width)*100, 2), 98) }"
                     x-on:touchmove.prevent="let r=$el.getBoundingClientRect(); sliderPos = Math.min(Math.max((($event.touches[0].clientX - r.left)/r.width)*100, 2), 98)">

                    {{-- Original image (full width, behind) --}}
                    <img :src="previewUrl"
                         class="absolute inset-0 w-full h-full object-contain pointer-events-none"
                         alt="Original image">

                    {{-- Compressed image (clipped to left side) --}}
                    <div class="absolute inset-0 overflow-hidden pointer-events-none"
                         :style="'width:' + sliderPos + '%'">
                        <img :src="result.download_url + '?t=' + Date.now()"
                             class="absolute inset-0 w-full h-full object-contain"
                             alt="Compressed image"
                             x-ref="compressedImg"
                             :style="'min-width:' + (100 / (sliderPos/100)) + '%'"
                             style="object-position: left center;">
                    </div>

                    {{-- Divider line --}}
                    <div class="absolute top-0 bottom-0 w-px bg-white shadow-[0_0_6px_rgba(0,0,0,0.4)] z-10 pointer-events-none"
                         :style="'left:' + sliderPos + '%'"></div>

                    {{-- Drag handle --}}
                    <div class="absolute top-1/2 -translate-y-1/2 -translate-x-1/2 z-20 cursor-ew-resize"
                         :style="'left:' + sliderPos + '%'"
                         x-on:mousedown.stop="dragging = true">
                        <div class="w-9 h-9 bg-white rounded-full shadow-xl flex items-center justify-center border-2 border-white/80">
                            <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8 9l-3 3 3 3M16 9l3 3-3 3"/>
                            </svg>
                        </div>
                    </div>

                    {{-- Labels --}}
                    <span class="absolute bottom-2 right-3 bg-black/50 text-white text-[10px] font-bold px-2 py-0.5 rounded pointer-events-none"
                          x-show="sliderPos < 90">Original</span>
                    <span class="absolute bottom-2 left-3 bg-brand-600/80 text-white text-[10px] font-bold px-2 py-0.5 rounded pointer-events-none"
                          x-show="sliderPos > 10">Compressed</span>

                    {{-- Instruction hint --}}
                    <div class="absolute top-2 left-1/2 -translate-x-1/2 bg-black/40 text-white text-[10px] font-medium px-3 py-1 rounded-full pointer-events-none whitespace-nowrap"
                         x-show="sliderPos === 50">
                        ← Drag to compare →
                    </div>
                </div>

                {{-- ── Main result card ─────────────────────────────────── --}}
                <div class="bg-white rounded-3xl shadow-xl shadow-gray-200/50 border border-gray-200/60 p-6 sm:p-8">
                    <div class="mb-6">
                        <div class="flex justify-between text-xs font-medium text-gray-400 mb-2">
                            <span>File size reduction</span>
                            <span x-text="result.reduction + '% smaller'"></span>
                        </div>
                        <div class="w-full bg-gray-100 rounded-full h-3 overflow-hidden">
                            <div class="h-3 rounded-full bg-gradient-to-r from-accent-400 to-accent-600 transition-all duration-1000 ease-out" :style="'width:' + Math.min(Math.max(result.reduction, 2), 100) + '%'"></div>
                        </div>
                    </div>

                    {{-- Action buttons --}}
                    <div class="flex flex-col sm:flex-row gap-3 mb-6">
                        <button x-on:click="downloadFromUrl(result.download_url, result.filename)"
                           class="flex-1 bg-gradient-to-r from-accent-600 to-accent-700 hover:from-accent-700 hover:to-accent-800 text-white font-bold py-4 px-6 rounded-2xl transition-all duration-200 flex items-center justify-center gap-2.5 text-base shadow-xl shadow-accent-500/25 hover:scale-[1.02] active:scale-[0.98]">
                            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            Download
                        </button>

                        {{-- Copy to Clipboard --}}
                        <button x-on:click="copyToClipboard()"
                                :disabled="copying"
                                :class="copied ? 'bg-green-100 text-green-700 border-green-200' : 'bg-gray-100 hover:bg-gray-200 text-gray-700'"
                                class="sm:w-auto px-5 py-4 rounded-2xl border border-transparent font-bold transition-all duration-200 flex items-center justify-center gap-2 text-sm active:scale-[0.97]"
                                title="Copy compressed image to clipboard">
                            <svg x-show="!copied" class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                            <svg x-show="copied" class="w-5 h-5 flex-shrink-0 text-green-600" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                            <span x-text="copied ? 'Copied!' : (copying ? '…' : 'Copy')"></span>
                        </button>

                        <button x-on:click="reset()" class="bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold py-4 px-5 rounded-2xl transition-all duration-200 flex items-center justify-center gap-2 text-sm">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                            New
                        </button>
                    </div>

                    {{-- Clipboard unsupported notice --}}
                    <div x-show="clipboardError" x-transition.duration.300ms
                         class="mb-4 bg-amber-50 border border-amber-200 rounded-xl px-4 py-2.5 text-xs text-amber-700 flex items-center gap-2">
                        <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <span>Clipboard API not supported in this browser. Please use the Download button instead.</span>
                    </div>

                    <div class="grid grid-cols-2 gap-x-6 gap-y-2 text-sm pt-5 border-t border-gray-100">
                        <div class="flex justify-between"><span class="text-gray-400">Format</span><strong class="text-gray-900" x-text="result.format"></strong></div>
                        <div class="flex justify-between"><span class="text-gray-400">Dimensions</span><strong class="text-gray-900" x-text="(result.width || '—') + ' × ' + (result.height || '—')"></strong></div>
                        <div class="flex justify-between"><span class="text-gray-400">Quality</span><strong class="text-gray-900" x-text="quality + '%'"></strong></div>
                        <div class="flex justify-between"><span class="text-gray-400">File</span><strong class="truncate max-w-[120px] block text-right text-gray-900" x-text="result.original_name"></strong></div>
                    </div>
                </div>
            </div>
