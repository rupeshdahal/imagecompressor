    <div x-data="converter()" x-init="initConv()">

            {{-- IDLE / ERROR --}}
            <div x-show="cstate === 'idle' || cstate === 'error'" class="animate-slide-up">
                <div x-on:dragover.prevent="cisDragging = true"
                     x-on:dragleave.prevent="cisDragging = false"
                     x-on:drop.prevent="cHandleDrop($event)"
                     x-on:click="$refs.fileInputV.click()"
                     :class="{ 'drop-active ring-2 ring-purple-400': cisDragging }"
                     class="relative bg-white border-2 border-dashed border-gray-300 rounded-3xl p-10 sm:p-14 text-center cursor-pointer transition-all duration-300 group shadow-sm hover:shadow-lg hover:border-purple-400">
                    <input type="file" x-ref="fileInputV" x-on:change="cHandleFileSelect($event)" accept=".jpg,.jpeg,.png,.webp,.gif" class="hidden">
                    <div class="relative mx-auto w-20 h-20 sm:w-24 sm:h-24 mb-6">
                        <div class="absolute inset-0 bg-purple-100 rounded-3xl rotate-6 group-hover:rotate-12 transition-transform duration-300"></div>
                        <div class="relative bg-gradient-to-br from-purple-500 to-purple-700 rounded-3xl w-full h-full flex items-center justify-center shadow-xl shadow-purple-500/25">
                            <svg class="w-10 h-10 sm:w-12 sm:h-12 text-white" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 21L3 16.5m0 0L7.5 12M3 16.5h13.5m0-13.5L21 7.5m0 0L16.5 12M21 7.5H7.5"/>
                            </svg>
                        </div>
                    </div>
                    <h2 class="text-xl sm:text-2xl font-bold mb-2">Drop your image to convert</h2>
                    <p class="text-gray-500 mb-5">or <span class="text-purple-600 font-semibold underline decoration-purple-300 underline-offset-2">browse files</span> from your device</p>
                    <div class="mb-5 flex items-center justify-center gap-2 text-sm text-gray-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        <span>or press <kbd class="px-2 py-0.5 text-xs bg-gray-100 border border-gray-300 rounded">Ctrl+V</kbd> to paste</span>
                    </div>
                    <div class="flex flex-wrap justify-center gap-2">
                        <span class="inline-flex items-center gap-1 bg-gray-100 text-gray-500 text-xs font-semibold px-3 py-1.5 rounded-full">JPG</span>
                        <span class="inline-flex items-center gap-1 bg-gray-100 text-gray-500 text-xs font-semibold px-3 py-1.5 rounded-full">PNG</span>
                        <span class="inline-flex items-center gap-1 bg-gray-100 text-gray-500 text-xs font-semibold px-3 py-1.5 rounded-full">WEBP</span>
                        <span class="inline-flex items-center gap-1 bg-gray-100 text-gray-500 text-xs font-semibold px-3 py-1.5 rounded-full">GIF</span>
                        <span class="inline-flex items-center gap-1 bg-purple-50 text-purple-600 text-xs font-semibold px-3 py-1.5 rounded-full">Max 20MB</span>
                    </div>
                </div>
                <div x-show="cerrorMessage" x-transition.duration.300ms class="mt-4 bg-red-50 border border-red-200 rounded-2xl p-4 flex items-start gap-3">
                    <div class="w-8 h-8 bg-red-100 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                        <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div>
                        <p class="text-red-700 text-sm font-medium" x-text="cerrorMessage"></p>
                        <button x-on:click="cerrorMessage = ''" class="text-red-400 text-xs mt-1 hover:text-red-600 transition-colors">Dismiss</button>
                    </div>
                </div>
            </div>

            {{-- SETTINGS --}}
            <div x-show="cstate === 'settings'" x-transition class="animate-slide-up">
                <div class="bg-white rounded-3xl shadow-xl shadow-gray-200/50 border border-gray-200/60 overflow-hidden">
                    <div class="px-6 sm:px-8 pt-6 sm:pt-8 pb-5 border-b border-gray-100 flex items-center gap-4">
                        <div class="w-14 h-14 bg-gradient-to-br from-purple-100 to-purple-50 rounded-2xl flex items-center justify-center flex-shrink-0">
                            <svg class="w-7 h-7 text-purple-600" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909M3.75 21h16.5A2.25 2.25 0 0022.5 18.75V5.25A2.25 2.25 0 0020.25 3H3.75A2.25 2.25 0 001.5 5.25v13.5A2.25 2.25 0 003.75 21z"/></svg>
                        </div>
                        <div class="min-w-0 flex-1">
                            <p class="font-bold text-base truncate" x-text="cfileName"></p>
                            <p class="text-sm text-gray-500 flex items-center gap-2">
                                <span x-text="cformatBytes(cfileSize)"></span>
                                <span class="w-1 h-1 bg-gray-300 rounded-full"></span>
                                <span x-text="cfileType.toUpperCase()"></span>
                            </p>
                        </div>
                        <button x-on:click="creset()" class="p-2 rounded-xl text-gray-400 hover:text-red-500 hover:bg-red-50 transition-all" title="Remove file">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                        </button>
                    </div>
                    <div class="px-6 sm:px-8 py-6 sm:py-8 space-y-7">
                        <div x-show="cpreviewUrl" class="rounded-2xl overflow-hidden bg-gray-100 max-h-64 flex items-center justify-center">
                            <img :src="cpreviewUrl" alt="Preview" class="max-h-64 object-contain w-full" loading="lazy">
                        </div>

                        {{-- Format Picker with arrow --}}
                        <div>
                            <label class="text-sm font-semibold text-gray-700 mb-4 block">Convert To Format</label>

                            {{-- From / To visual --}}
                            <div class="flex items-center gap-3 mb-5 bg-gray-50 rounded-2xl p-4 border border-gray-200">
                                <div class="flex-1 text-center">
                                    <p class="text-xs text-gray-400 font-medium mb-1">From</p>
                                    <span class="inline-block bg-gray-200 text-gray-700 font-bold text-sm px-4 py-2 rounded-xl uppercase" x-text="cfileType || '?'"></span>
                                </div>
                                <div class="flex-shrink-0">
                                    <svg class="w-7 h-7 text-purple-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 21L3 16.5m0 0L7.5 12M3 16.5h13.5m0-13.5L21 7.5m0 0L16.5 12M21 7.5H7.5"/>
                                    </svg>
                                </div>
                                <div class="flex-1 text-center">
                                    <p class="text-xs text-gray-400 font-medium mb-1">To</p>
                                    <span class="inline-block bg-purple-600 text-white font-bold text-sm px-4 py-2 rounded-xl uppercase" x-text="ctargetFormat || 'Select'"></span>
                                </div>
                            </div>

                            {{-- Format buttons --}}
                            <div class="grid grid-cols-3 gap-3">
                                <template x-for="fmt in ['jpg', 'png', 'webp']" :key="fmt">
                                    <button x-on:click="ctargetFormat = fmt"
                                        :class="ctargetFormat === fmt
                                            ? 'bg-purple-600 text-white border-purple-600 shadow-lg shadow-purple-500/25 scale-105'
                                            : 'bg-white text-gray-600 border-gray-200 hover:border-purple-300'"
                                        class="px-4 py-4 rounded-2xl border text-sm font-bold transition-all duration-150 text-center">
                                        <div class="text-lg mb-1" x-text="fmt === 'jpg' ? '📸' : fmt === 'png' ? '🎨' : '🌐'"></div>
                                        <div x-text="fmt.toUpperCase()"></div>
                                        <div class="text-xs mt-0.5 opacity-70" x-text="fmt === 'jpg' ? 'Smallest size' : fmt === 'png' ? 'Lossless' : 'Modern web'"></div>
                                    </button>
                                </template>
                            </div>
                        </div>

                        {{-- Info note --}}
                        <div class="flex items-start gap-3 bg-purple-50 border border-purple-100 rounded-xl px-4 py-3 text-sm text-purple-700">
                            <svg class="w-4 h-4 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            <span>Images are converted at high quality (90%). Use the <strong>Compress</strong> tab to reduce file size.</span>
                        </div>

                        <button x-on:click="cconvert()" :disabled="!ctargetFormat"
                            :class="ctargetFormat ? 'opacity-100 hover:scale-[1.02] active:scale-[0.98]' : 'opacity-50 cursor-not-allowed'"
                            class="w-full bg-gradient-to-r from-purple-600 to-purple-700 hover:from-purple-700 hover:to-purple-800 text-white font-bold py-4 px-6 rounded-2xl transition-all duration-200 flex items-center justify-center gap-2.5 text-lg shadow-xl shadow-purple-500/25">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M7.5 21L3 16.5m0 0L7.5 12M3 16.5h13.5m0-13.5L21 7.5m0 0L16.5 12M21 7.5H7.5"/></svg>
                            Convert to <span class="uppercase ml-1" x-text="ctargetFormat || '...'"></span>
                        </button>
                    </div>
                </div>
            </div>

            {{-- PROCESSING --}}
            <div x-show="cstate === 'processing'" x-transition class="animate-slide-up">
                <div class="bg-white rounded-3xl shadow-xl shadow-gray-200/50 border border-gray-200/60 p-10 sm:p-14 text-center">
                    <div class="relative w-20 h-20 mx-auto mb-6">
                        <div class="absolute inset-0 rounded-full bg-purple-100 animate-ping opacity-40"></div>
                        <div class="relative w-full h-full rounded-full bg-purple-50 flex items-center justify-center">
                            <svg class="animate-spin w-10 h-10 text-purple-600" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-20" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="3"/>
                                <path class="opacity-80" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"/>
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-2xl font-bold mb-2">Converting your image...</h3>
                    <p class="text-gray-500 mb-4" x-text="cuploadProgress > 0 && cuploadProgress < 100 ? 'Uploading... ' + cuploadProgress + '%' : 'Processing…'"></p>
                    <div class="w-full bg-gray-200 rounded-full h-2 overflow-hidden max-w-xs mx-auto">
                        <div class="bg-gradient-to-r from-purple-500 to-purple-600 h-2 rounded-full transition-all duration-300"
                             :class="cuploadProgress === 0 || cuploadProgress === 100 ? 'shimmer' : ''"
                             :style="'width:' + (cuploadProgress > 0 ? cuploadProgress : 33) + '%'"></div>
                    </div>
                </div>
            </div>

            {{-- RESULT --}}
            <div x-show="cstate === 'result'" x-transition class="animate-slide-up space-y-5">
                <div class="grid grid-cols-3 gap-3">
                    <div class="bg-white rounded-2xl border border-gray-200/60 p-4 sm:p-5 text-center shadow-sm">
                        <div class="w-9 h-9 bg-gray-100 rounded-xl flex items-center justify-center mx-auto mb-2">
                            <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"/></svg>
                        </div>
                        <p class="text-xs text-gray-400 font-medium mb-0.5">Original</p>
                        <p class="text-base sm:text-lg font-bold text-gray-700" x-text="cresult.formatted_original"></p>
                    </div>
                    <div class="bg-white rounded-2xl border border-gray-200/60 p-4 sm:p-5 text-center shadow-sm">
                        <div class="w-9 h-9 bg-purple-50 rounded-xl flex items-center justify-center mx-auto mb-2">
                            <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <p class="text-xs text-gray-400 font-medium mb-0.5">Converted</p>
                        <p class="text-base sm:text-lg font-bold text-purple-600" x-text="cresult.formatted_converted"></p>
                    </div>
                    <div class="bg-white rounded-2xl border border-gray-200/60 p-4 sm:p-5 text-center shadow-sm">
                        <div class="w-9 h-9 bg-purple-50 rounded-xl flex items-center justify-center mx-auto mb-2">
                            <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M7.5 21L3 16.5m0 0L7.5 12M3 16.5h13.5m0-13.5L21 7.5"/></svg>
                        </div>
                        <p class="text-xs text-gray-400 font-medium mb-0.5">Format</p>
                        <p class="text-base sm:text-lg font-bold text-purple-600 uppercase" x-text="cresult.format"></p>
                    </div>
                </div>
                <div class="bg-white rounded-3xl shadow-xl shadow-gray-200/50 border border-gray-200/60 p-6 sm:p-8">
                    <div class="flex flex-col sm:flex-row gap-3 mb-6">
                        <button x-on:click="downloadFromUrl(cresult.download_url, cresult.filename)"
                           class="flex-1 bg-gradient-to-r from-purple-600 to-purple-700 hover:from-purple-700 hover:to-purple-800 text-white font-bold py-4 px-6 rounded-2xl transition-all duration-200 flex items-center justify-center gap-2.5 text-lg shadow-xl shadow-purple-500/25 hover:scale-[1.02] active:scale-[0.98]">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            Download Converted
                        </button>
                        <button x-on:click="creset()" class="bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold py-4 px-6 rounded-2xl transition-all duration-200 flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                            New Image
                        </button>
                    </div>
                    <div class="grid grid-cols-2 gap-x-6 gap-y-2 text-sm pt-5 border-t border-gray-100">
                        <div class="flex justify-between"><span class="text-gray-400">Output Format</span><strong class="text-gray-900 uppercase" x-text="cresult.format"></strong></div>
                        <div class="flex justify-between"><span class="text-gray-400">Dimensions</span><strong class="text-gray-900" x-text="(cresult.width || '—') + ' × ' + (cresult.height || '—')"></strong></div>
                        <div class="flex justify-between"><span class="text-gray-400">Original Size</span><strong class="text-gray-900" x-text="cresult.formatted_original"></strong></div>
                        <div class="flex justify-between"><span class="text-gray-400">File</span><strong class="truncate max-w-[120px] block text-right text-gray-900" x-text="cresult.original_name"></strong></div>
                    </div>
                </div>
            </div>
