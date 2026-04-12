    <div x-data="resizer()" x-init="initResize()">

            {{-- IDLE --}}
            <div x-show="rstate === 'idle' || rstate === 'error'" class="animate-slide-up">
                <div x-on:dragover.prevent="risDragging = true"
                     x-on:dragleave.prevent="risDragging = false"
                     x-on:drop.prevent="rHandleDrop($event)"
                     x-on:click="$refs.resizeFileInput.click()"
                     :class="{ 'drop-active ring-2 ring-orange-400': risDragging }"
                     class="relative bg-white border-2 border-dashed border-gray-300 rounded-3xl p-10 sm:p-14 text-center cursor-pointer transition-all duration-300 group shadow-sm hover:shadow-lg hover:border-orange-400">
                    <input type="file" x-ref="resizeFileInput" accept=".jpg,.jpeg,.png,.webp,.gif" x-on:change="rHandleFileSelect($event)" class="hidden">
                    <div class="relative mx-auto w-20 h-20 sm:w-24 sm:h-24 mb-6">
                        <div class="absolute inset-0 bg-orange-100 rounded-3xl rotate-6 group-hover:rotate-12 transition-transform duration-300"></div>
                        <div class="relative bg-gradient-to-br from-orange-500 to-orange-700 rounded-3xl w-full h-full flex items-center justify-center shadow-xl shadow-orange-500/25">
                            <svg class="w-10 h-10 sm:w-12 sm:h-12 text-white" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3.75v4.5m0-4.5h4.5m-4.5 0L9 9M3.75 20.25v-4.5m0 4.5h4.5m-4.5 0L9 15M20.25 3.75h-4.5m4.5 0v4.5m0-4.5L15 9m5.25 11.25h-4.5m4.5 0v-4.5m0 4.5L15 15"/></svg>
                        </div>
                    </div>
                    <h2 class="text-xl sm:text-2xl font-bold mb-2">Resize your image</h2>
                    <p class="text-gray-500 mb-5">or <span class="text-orange-600 font-semibold underline decoration-orange-300 underline-offset-2">browse files</span></p>
                    <div class="flex flex-wrap justify-center gap-2">
                        <span class="inline-flex items-center bg-orange-50 text-orange-600 text-xs font-semibold px-3 py-1.5 rounded-full">Exact size · Percentage · Fit width/height</span>
                    </div>
                </div>
                <div x-show="rerrorMessage" x-transition.duration.300ms class="mt-4 bg-red-50 border border-red-200 rounded-2xl p-4 flex items-start gap-3">
                    <svg class="w-5 h-5 text-red-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <p class="text-red-700 text-sm font-medium" x-text="rerrorMessage"></p>
                </div>
            </div>

            {{-- SETTINGS --}}
            <div x-show="rstate === 'settings'" x-transition class="animate-slide-up">
                <div class="bg-white rounded-3xl shadow-xl shadow-gray-200/50 border border-gray-200/60 overflow-hidden">
                    <div class="px-6 sm:px-8 pt-6 pb-5 border-b border-gray-100 flex items-center gap-4">
                        <div class="w-14 h-14 bg-orange-100 rounded-2xl flex items-center justify-center flex-shrink-0">
                            <svg class="w-7 h-7 text-orange-600" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909M3.75 21h16.5A2.25 2.25 0 0022.5 18.75V5.25A2.25 2.25 0 0020.25 3H3.75A2.25 2.25 0 001.5 5.25v13.5A2.25 2.25 0 003.75 21z"/></svg>
                        </div>
                        <div class="min-w-0 flex-1">
                            <p class="font-bold text-base truncate" x-text="rfileName"></p>
                            <p class="text-sm text-gray-500">
                                <span x-text="rformatBytes(rfileSize)"></span>
                                <span x-show="rorigW && rorigH"> · <span x-text="rorigW + '×' + rorigH + ' px'"></span></span>
                            </p>
                        </div>
                        <button x-on:click="rReset()" class="p-2 rounded-xl text-gray-400 hover:text-red-500 hover:bg-red-50 transition-all">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                        </button>
                    </div>
                    <div class="px-6 sm:px-8 py-6 space-y-5">
                        {{-- Preview --}}
                        <div x-show="rpreviewUrl" class="rounded-2xl overflow-hidden bg-gray-100 max-h-48 flex items-center justify-center">
                            <img :src="rpreviewUrl" class="max-h-48 object-contain w-full" loading="lazy">
                        </div>

                        {{-- Mode selection --}}
                        <div>
                            <label class="text-sm font-semibold text-gray-700 mb-3 block">Resize Mode</label>
                            <div class="grid grid-cols-2 sm:grid-cols-4 gap-2">
                                <template x-for="m in [{v:'percentage',l:'Percentage'},{v:'max_width',l:'Max Width'},{v:'max_height',l:'Max Height'},{v:'exact',l:'Exact Size'}]" :key="m.v">
                                    <button x-on:click="rmode = m.v"
                                        :class="rmode === m.v ? 'bg-orange-600 text-white border-orange-600 shadow-md' : 'bg-white text-gray-600 border-gray-200 hover:border-orange-300'"
                                        class="px-3 py-3 rounded-xl border text-xs font-bold transition-all text-center" x-text="m.l">
                                    </button>
                                </template>
                            </div>
                        </div>

                        {{-- Percentage mode --}}
                        <div x-show="rmode === 'percentage'" class="space-y-3">
                            <div class="flex items-center justify-between">
                                <label class="text-sm font-semibold text-gray-700">Scale</label>
                                <span class="text-sm font-bold bg-orange-100 text-orange-700 px-3 py-1 rounded-full" x-text="rpercentage + '%'"></span>
                            </div>
                            <input type="range" min="10" max="200" step="5" x-model.number="rpercentage"
                                class="w-full" :style="'background: linear-gradient(to right, #f97316 ' + ((rpercentage-10)/190*100) + '%, #e5e7eb ' + ((rpercentage-10)/190*100) + '%)'">
                            <div class="flex gap-2 mt-2">
                                <button x-on:click="rpercentage=25" :class="rpercentage===25?'bg-orange-100 text-orange-700 border-orange-200':'bg-gray-50 text-gray-600 border-gray-200'" class="flex-1 px-3 py-2 rounded-xl border text-xs font-semibold">25%</button>
                                <button x-on:click="rpercentage=50" :class="rpercentage===50?'bg-orange-100 text-orange-700 border-orange-200':'bg-gray-50 text-gray-600 border-gray-200'" class="flex-1 px-3 py-2 rounded-xl border text-xs font-semibold">50%</button>
                                <button x-on:click="rpercentage=75" :class="rpercentage===75?'bg-orange-100 text-orange-700 border-orange-200':'bg-gray-50 text-gray-600 border-gray-200'" class="flex-1 px-3 py-2 rounded-xl border text-xs font-semibold">75%</button>
                                <button x-on:click="rpercentage=150" :class="rpercentage===150?'bg-orange-100 text-orange-700 border-orange-200':'bg-gray-50 text-gray-600 border-gray-200'" class="flex-1 px-3 py-2 rounded-xl border text-xs font-semibold">150%</button>
                            </div>
                            <div x-show="rorigW && rorigH" class="text-xs text-gray-400 text-center">
                                Output: <span x-text="Math.round(rorigW * rpercentage / 100) + ' × ' + Math.round(rorigH * rpercentage / 100) + ' px'"></span>
                            </div>
                        </div>

                        {{-- Max width mode --}}
                        <div x-show="rmode === 'max_width'" class="space-y-3">
                            <label class="text-sm font-semibold text-gray-700 block">Maximum Width (px)</label>
                            <div class="flex items-center gap-3">
                                <input type="number" x-model.number="rwidth" min="1" max="8000"
                                    class="flex-1 border border-gray-300 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-orange-400 focus:border-transparent outline-none" placeholder="e.g. 1920">
                                <span class="text-sm text-gray-400">px</span>
                            </div>
                            <div class="flex gap-2">
                                <button x-on:click="rwidth=320" :class="rwidth===320?'bg-orange-100 text-orange-700 border-orange-200':'bg-gray-50 text-gray-600 border-gray-200'" class="flex-1 px-3 py-2 rounded-xl border text-xs font-semibold">320</button>
                                <button x-on:click="rwidth=640" :class="rwidth===640?'bg-orange-100 text-orange-700 border-orange-200':'bg-gray-50 text-gray-600 border-gray-200'" class="flex-1 px-3 py-2 rounded-xl border text-xs font-semibold">640</button>
                                <button x-on:click="rwidth=1280" :class="rwidth===1280?'bg-orange-100 text-orange-700 border-orange-200':'bg-gray-50 text-gray-600 border-gray-200'" class="flex-1 px-3 py-2 rounded-xl border text-xs font-semibold">1280</button>
                                <button x-on:click="rwidth=1920" :class="rwidth===1920?'bg-orange-100 text-orange-700 border-orange-200':'bg-gray-50 text-gray-600 border-gray-200'" class="flex-1 px-3 py-2 rounded-xl border text-xs font-semibold">1920</button>
                            </div>
                        </div>

                        {{-- Max height mode --}}
                        <div x-show="rmode === 'max_height'" class="space-y-3">
                            <label class="text-sm font-semibold text-gray-700 block">Maximum Height (px)</label>
                            <div class="flex items-center gap-3">
                                <input type="number" x-model.number="rheight" min="1" max="8000"
                                    class="flex-1 border border-gray-300 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-orange-400 focus:border-transparent outline-none" placeholder="e.g. 1080">
                                <span class="text-sm text-gray-400">px</span>
                            </div>
                            <div class="flex gap-2">
                                <button x-on:click="rheight=480" :class="rheight===480?'bg-orange-100 text-orange-700 border-orange-200':'bg-gray-50 text-gray-600 border-gray-200'" class="flex-1 px-3 py-2 rounded-xl border text-xs font-semibold">480</button>
                                <button x-on:click="rheight=720" :class="rheight===720?'bg-orange-100 text-orange-700 border-orange-200':'bg-gray-50 text-gray-600 border-gray-200'" class="flex-1 px-3 py-2 rounded-xl border text-xs font-semibold">720</button>
                                <button x-on:click="rheight=1080" :class="rheight===1080?'bg-orange-100 text-orange-700 border-orange-200':'bg-gray-50 text-gray-600 border-gray-200'" class="flex-1 px-3 py-2 rounded-xl border text-xs font-semibold">1080</button>
                                <button x-on:click="rheight=2160" :class="rheight===2160?'bg-orange-100 text-orange-700 border-orange-200':'bg-gray-50 text-gray-600 border-gray-200'" class="flex-1 px-3 py-2 rounded-xl border text-xs font-semibold">2160</button>
                            </div>
                        </div>

                        {{-- Exact mode --}}
                        <div x-show="rmode === 'exact'" class="space-y-3">
                            <label class="text-sm font-semibold text-gray-700 block">Exact Dimensions</label>
                            <div class="flex items-center gap-3">
                                <input type="number" x-model.number="rwidth" min="1" max="8000"
                                    class="flex-1 border border-gray-300 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-orange-400 focus:border-transparent outline-none" placeholder="Width">
                                <span class="text-gray-400 text-sm font-bold">×</span>
                                <input type="number" x-model.number="rheight" min="1" max="8000"
                                    class="flex-1 border border-gray-300 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-orange-400 focus:border-transparent outline-none" placeholder="Height">
                                <span class="text-sm text-gray-400">px</span>
                            </div>
                        </div>

                        <button x-on:click="rResize()"
                            class="w-full bg-gradient-to-r from-orange-600 to-orange-700 hover:from-orange-700 hover:to-orange-800 text-white font-bold py-4 px-6 rounded-2xl transition-all flex items-center justify-center gap-2.5 text-lg shadow-xl shadow-orange-500/25 hover:scale-[1.02] active:scale-[0.98]">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3.75v4.5m0-4.5h4.5m-4.5 0L9 9M3.75 20.25v-4.5m0 4.5h4.5m-4.5 0L9 15M20.25 3.75h-4.5m4.5 0v4.5m0-4.5L15 9m5.25 11.25h-4.5m4.5 0v-4.5m0 4.5L15 15"/></svg>
                            Resize Image
                        </button>
                    </div>
                </div>
            </div>

            {{-- PROCESSING --}}
            <div x-show="rstate === 'processing'" x-transition class="animate-slide-up">
                <div class="bg-white rounded-3xl shadow-xl border border-gray-200/60 p-10 text-center">
                    <div class="relative w-20 h-20 mx-auto mb-6">
                        <div class="absolute inset-0 rounded-full bg-orange-100 animate-ping opacity-40"></div>
                        <div class="relative w-full h-full rounded-full bg-orange-50 flex items-center justify-center">
                            <svg class="animate-spin w-10 h-10 text-orange-600" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-20" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="3"/>
                                <path class="opacity-80" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"/>
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-2xl font-bold mb-2">Resizing your image...</h3>
                </div>
            </div>

            {{-- RESULT --}}
            <div x-show="rstate === 'result'" x-transition class="animate-slide-up space-y-5">
                <div class="grid grid-cols-3 gap-3">
                    <div class="bg-white rounded-2xl border border-gray-200/60 p-4 text-center shadow-sm">
                        <p class="text-xs text-gray-400 mb-1">Original</p>
                        <p class="text-lg font-bold text-gray-700" x-text="rresult.formatted_original"></p>
                    </div>
                    <div class="bg-white rounded-2xl border border-gray-200/60 p-4 text-center shadow-sm">
                        <p class="text-xs text-gray-400 mb-1">Resized</p>
                        <p class="text-lg font-bold text-orange-600" x-text="rresult.formatted_resized"></p>
                    </div>
                    <div class="bg-white rounded-2xl border border-gray-200/60 p-4 text-center shadow-sm">
                        <p class="text-xs text-gray-400 mb-1">Dimensions</p>
                        <p class="text-sm font-bold text-gray-700" x-text="(rresult.width || '—') + '×' + (rresult.height || '—')"></p>
                    </div>
                </div>
                <div class="bg-white rounded-3xl shadow-xl border border-gray-200/60 p-6">
                    <div class="flex flex-col sm:flex-row gap-3">
                        <button x-on:click="downloadFromUrl(rresult.download_url, rresult.filename)"
                           class="flex-1 bg-gradient-to-r from-orange-600 to-orange-700 hover:from-orange-700 hover:to-orange-800 text-white font-bold py-4 px-6 rounded-2xl flex items-center justify-center gap-2.5 text-lg shadow-xl shadow-orange-500/25 hover:scale-[1.02]">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            Download Resized
                        </button>
                        <button x-on:click="rReset()" class="bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold py-4 px-5 rounded-2xl flex items-center justify-center gap-2 text-sm">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                            New Image
                        </button>
                    </div>
                </div>
            </div>
