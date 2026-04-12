    <div x-data="batchCompressor()" x-init="initBatch()">

            {{-- IDLE --}}
            <div x-show="bstate === 'idle' || bstate === 'error'" class="animate-slide-up">
                <div x-on:dragover.prevent="bisDragging = true"
                     x-on:dragleave.prevent="bisDragging = false"
                     x-on:drop.prevent="bHandleDrop($event)"
                     x-on:click="$refs.batchFileInput.click()"
                     :class="{ 'drop-active ring-2 ring-blue-400': bisDragging }"
                     class="relative bg-white border-2 border-dashed border-gray-300 rounded-3xl p-10 sm:p-14 text-center cursor-pointer transition-all duration-300 group shadow-sm hover:shadow-lg hover:border-blue-400">
                    <input type="file" x-ref="batchFileInput" multiple accept=".jpg,.jpeg,.png,.webp,.gif" x-on:change="bHandleFileSelect($event)" class="hidden">
                    <div class="relative mx-auto w-20 h-20 sm:w-24 sm:h-24 mb-6">
                        <div class="absolute inset-0 bg-blue-100 rounded-3xl rotate-6 group-hover:rotate-12 transition-transform duration-300"></div>
                        <div class="relative bg-gradient-to-br from-blue-500 to-blue-700 rounded-3xl w-full h-full flex items-center justify-center shadow-xl shadow-blue-500/25">
                            <svg class="w-10 h-10 sm:w-12 sm:h-12 text-white" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 9.776c.112-.017.227-.026.344-.026h15.812c.117 0 .232.009.344.026m-16.5 0a2.25 2.25 0 00-1.883 2.542l.857 6a2.25 2.25 0 002.227 1.932H19.05a2.25 2.25 0 002.227-1.932l.857-6a2.25 2.25 0 00-1.883-2.542m-16.5 0V6A2.25 2.25 0 016 3.75h3.879a1.5 1.5 0 011.06.44l2.122 2.12a1.5 1.5 0 001.06.44H18A2.25 2.25 0 0120.25 9v.776"/></svg>
                        </div>
                    </div>
                    <h2 class="text-xl sm:text-2xl font-bold mb-2">Batch compress up to 20 images</h2>
                    <p class="text-gray-500 mb-5">Drop multiple files or <span class="text-blue-600 font-semibold underline decoration-blue-300 underline-offset-2">browse files</span></p>
                    <div class="flex flex-wrap justify-center gap-2">
                        <span class="inline-flex items-center gap-1 bg-gray-100 text-gray-500 text-xs font-semibold px-3 py-1.5 rounded-full">JPG</span>
                        <span class="inline-flex items-center gap-1 bg-gray-100 text-gray-500 text-xs font-semibold px-3 py-1.5 rounded-full">PNG</span>
                        <span class="inline-flex items-center gap-1 bg-gray-100 text-gray-500 text-xs font-semibold px-3 py-1.5 rounded-full">WEBP</span>
                        <span class="inline-flex items-center gap-1 bg-blue-50 text-blue-600 text-xs font-semibold px-3 py-1.5 rounded-full">Max 20 files · 20MB each</span>
                    </div>
                </div>
                <div x-show="berrorMessage" x-transition.duration.300ms class="mt-4 bg-red-50 border border-red-200 rounded-2xl p-4 flex items-start gap-3">
                    <svg class="w-5 h-5 text-red-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <p class="text-red-700 text-sm font-medium" x-text="berrorMessage"></p>
                </div>
            </div>

            {{-- SETTINGS --}}
            <div x-show="bstate === 'settings'" x-transition class="animate-slide-up">
                <div class="bg-white rounded-3xl shadow-xl shadow-gray-200/50 border border-gray-200/60 overflow-hidden">
                    <div class="px-6 sm:px-8 pt-6 sm:pt-8 pb-5 border-b border-gray-100 flex items-center justify-between">
                        <div>
                            <p class="font-bold text-base text-gray-900" x-text="bfiles.length + ' image' + (bfiles.length === 1 ? '' : 's') + ' selected'"></p>
                            <p class="text-sm text-gray-500">Total: <span x-text="bFormatBytes(bTotalSize)"></span></p>
                        </div>
                        <button x-on:click="bReset()" class="p-2 rounded-xl text-gray-400 hover:text-red-500 hover:bg-red-50 transition-all" title="Clear all">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                        </button>
                    </div>
                    {{-- File list --}}
                    <div class="max-h-48 overflow-y-auto divide-y divide-gray-100">
                        <template x-for="(f, i) in bfiles" :key="i">
                            <div class="px-6 py-3 flex items-center gap-3 hover:bg-gray-50">
                                <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909M3.75 21h16.5A2.25 2.25 0 0022.5 18.75V5.25A2.25 2.25 0 0020.25 3H3.75A2.25 2.25 0 001.5 5.25v13.5A2.25 2.25 0 003.75 21z"/></svg>
                                </div>
                                <span class="text-sm text-gray-700 truncate flex-1" x-text="f.name"></span>
                                <span class="text-xs text-gray-400 flex-shrink-0" x-text="bFormatBytes(f.size)"></span>
                            </div>
                        </template>
                    </div>
                    <div class="px-6 sm:px-8 py-6 space-y-5">
                        {{-- Quality Slider --}}
                        <div>
                            <div class="flex items-center justify-between mb-3">
                                <label class="text-sm font-semibold text-gray-700">Compression Quality</label>
                                <span class="text-sm font-bold bg-blue-100 text-blue-700 px-3 py-1 rounded-full" x-text="bquality + '%'"></span>
                            </div>
                            <input type="range" min="10" max="90" step="1" x-model.number="bquality"
                                   class="w-full" :style="'background: linear-gradient(to right, #3b82f6 ' + ((bquality-10)/80*100) + '%, #e5e7eb ' + ((bquality-10)/80*100) + '%)'">
                            <div class="flex gap-2 mt-3">
                                <button x-on:click="bquality = 20" :class="bquality <= 30 ? 'bg-blue-100 text-blue-700 border-blue-200' : 'bg-gray-50 text-gray-600 border-gray-200'" class="flex-1 px-3 py-2 rounded-xl border text-xs font-semibold transition-all">Max Compress</button>
                                <button x-on:click="bquality = 50" :class="bquality > 30 && bquality <= 65 ? 'bg-blue-100 text-blue-700 border-blue-200' : 'bg-gray-50 text-gray-600 border-gray-200'" class="flex-1 px-3 py-2 rounded-xl border text-xs font-semibold transition-all">Balanced</button>
                                <button x-on:click="bquality = 80" :class="bquality > 65 ? 'bg-blue-100 text-blue-700 border-blue-200' : 'bg-gray-50 text-gray-600 border-gray-200'" class="flex-1 px-3 py-2 rounded-xl border text-xs font-semibold transition-all">High Quality</button>
                            </div>
                        </div>
                        <button x-on:click="bCompress()"
                            class="w-full bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-bold py-4 px-6 rounded-2xl transition-all flex items-center justify-center gap-2.5 text-lg shadow-xl shadow-blue-500/25 hover:scale-[1.02] active:scale-[0.98]">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 9.776c.112-.017.227-.026.344-.026h15.812c.117 0 .232.009.344.026m-16.5 0a2.25 2.25 0 00-1.883 2.542l.857 6a2.25 2.25 0 002.227 1.932H19.05a2.25 2.25 0 002.227-1.932l.857-6a2.25 2.25 0 00-1.883-2.542m-16.5 0V6A2.25 2.25 0 016 3.75h3.879a1.5 1.5 0 011.06.44l2.122 2.12a1.5 1.5 0 001.06.44H18A2.25 2.25 0 0120.25 9v.776"/></svg>
                            Compress All Images
                        </button>
                    </div>
                </div>
            </div>

            {{-- PROCESSING --}}
            <div x-show="bstate === 'processing'" x-transition class="animate-slide-up">
                <div class="bg-white rounded-3xl shadow-xl border border-gray-200/60 p-10 text-center">
                    <div class="relative w-20 h-20 mx-auto mb-6">
                        <div class="absolute inset-0 rounded-full bg-blue-100 animate-ping opacity-40"></div>
                        <div class="relative w-full h-full rounded-full bg-blue-50 flex items-center justify-center">
                            <svg class="animate-spin w-10 h-10 text-blue-600" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-20" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="3"/>
                                <path class="opacity-80" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"/>
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-2xl font-bold mb-2">Processing batch…</h3>
                    <p class="text-gray-500 mb-4 truncate max-w-xs mx-auto text-sm" x-text="bCurrentFile || ('Uploading ' + bfiles.length + ' images…')"></p>
                    {{-- Progress bar --}}
                    <div class="w-full bg-gray-100 rounded-full h-2.5 overflow-hidden">
                        <div class="bg-blue-600 h-2.5 rounded-full transition-all duration-300"
                             :style="'width:' + buploadProgress + '%'"></div>
                    </div>
                    <p class="text-xs text-gray-400 mt-2" x-text="buploadProgress + '%'"></p>
                </div>
            </div>

            {{-- RESULTS --}}
            <div x-show="bstate === 'result'" x-transition class="animate-slide-up space-y-4">
                {{-- Summary --}}
                <div class="grid grid-cols-3 gap-3">
                    <div class="bg-white rounded-2xl border border-gray-200/60 p-4 text-center shadow-sm">
                        <p class="text-xs text-gray-400 mb-1">Processed</p>
                        <p class="text-xl font-bold text-blue-600" x-text="bresults.succeeded + '/' + bresults.total"></p>
                    </div>
                    <div class="bg-white rounded-2xl border border-gray-200/60 p-4 text-center shadow-sm">
                        <p class="text-xs text-gray-400 mb-1">Total Saved</p>
                        <p class="text-xl font-bold text-green-600" x-text="bFormatBytes(bTotalSaved)"></p>
                    </div>
                    <div class="bg-white rounded-2xl border border-gray-200/60 p-4 text-center shadow-sm">
                        <p class="text-xs text-gray-400 mb-1">Avg Reduction</p>
                        <p class="text-xl font-bold text-amber-600" x-text="bAvgReduction + '%'"></p>
                    </div>
                </div>

                {{-- File list --}}
                <div class="bg-white rounded-2xl border border-gray-200/60 overflow-hidden shadow-sm">
                    <div class="px-5 py-3 border-b border-gray-100 flex items-center justify-between">
                        <h3 class="font-bold text-gray-900 text-sm">Results</h3>
                        <div class="flex gap-2">
                            <button x-on:click="bDownloadZip()" x-show="bresults.filenames && bresults.filenames.length > 0"
                                class="flex items-center gap-2 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold rounded-xl transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                Download ZIP
                            </button>
                            <button x-on:click="bReset()" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-semibold rounded-xl transition-all">New Batch</button>
                        </div>
                    </div>
                    <div class="divide-y divide-gray-100 max-h-72 overflow-y-auto">
                        <template x-for="r in (bresults.results || [])" :key="r.original_name">
                            <div class="px-5 py-3 flex items-center gap-3">
                                <div :class="r.success ? 'bg-green-100 text-green-600' : 'bg-red-100 text-red-500'" class="w-7 h-7 rounded-full flex items-center justify-center flex-shrink-0">
                                    <svg x-show="r.success" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                    <svg x-show="!r.success" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                                </div>
                                <span class="text-sm text-gray-700 truncate flex-1" x-text="r.original_name"></span>
                                <template x-if="r.success">
                                    <div class="flex items-center gap-2 flex-shrink-0">
                                        <span class="text-xs text-green-600 font-semibold" x-text="'-' + r.reduction + '%'"></span>
                                        <button x-on:click="downloadFromUrl(r.download_url, r.filename)" class="px-2 py-1 bg-blue-50 hover:bg-blue-100 text-blue-600 text-xs font-semibold rounded-lg transition-all">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 10v6m0 0l-3-3m3 3l3-3"/></svg>
                                        </button>
                                    </div>
                                </template>
                                <template x-if="!r.success">
                                    <span class="text-xs text-red-500 flex-shrink-0" x-text="r.message || 'Failed'"></span>
                                </template>
                            </div>
                        </template>
                    </div>
                </div>
            </div>
