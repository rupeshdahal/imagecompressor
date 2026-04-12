                <div x-data="watermarkTool()" x-init="initWatermark()" class="bg-white rounded-3xl border border-gray-200/70 overflow-hidden shadow-xl shadow-pink-100/40">
                    <div class="px-5 py-4 border-b border-gray-100 flex items-center gap-3">
                        <div class="w-10 h-10 bg-pink-100 rounded-xl flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-pink-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"/></svg>
                        </div>
                        <div>
                            <h3 class="font-bold text-gray-900 text-sm">Add Watermark</h3>
                            <p class="text-xs text-gray-500">Text watermark with full customization</p>
                        </div>
                    </div>
                    <div class="p-6 space-y-5">
                        {{-- Idle / Drop zone --}}
                        <div x-show="wstate === 'idle' || wstate === 'error'">
                            <div x-on:click="$refs.wFileInput.click()" class="border-2 border-dashed border-gray-200 rounded-2xl p-10 text-center cursor-pointer hover:border-pink-400 hover:bg-pink-50 transition-all">
                                <input type="file" x-ref="wFileInput" accept=".jpg,.jpeg,.png,.webp" x-on:change="wHandleFile($event)" class="hidden">
                                <svg class="w-9 h-9 text-pink-400 mx-auto mb-2" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5"/></svg>
                                <p class="text-sm text-gray-500">Click to select image or paste with Ctrl+V</p>
                                <p class="text-xs text-gray-300 mt-1">JPG, PNG, WebP · max 20MB</p>
                            </div>
                        </div>

                        {{-- Settings panel --}}
                        <div x-show="wstate === 'settings'" class="space-y-4">
                            {{-- File name + reset --}}
                            <div class="flex items-center gap-2 bg-gray-50 rounded-xl px-3 py-2">
                                <svg class="w-4 h-4 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909M3 21h18M3.75 3h16.5"/></svg>
                                <span class="text-xs text-gray-700 truncate flex-1" x-text="wfileName"></span>
                                <button x-on:click="wReset()" class="text-gray-400 hover:text-red-500 flex-shrink-0"><svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg></button>
                            </div>

                            {{-- Watermark text --}}
                            <div>
                                <label class="text-xs font-semibold text-gray-600 mb-1.5 block">Watermark Text</label>
                                <input type="text" x-model="wtext" maxlength="200" placeholder="© YourBrand 2024"
                                    class="w-full border border-gray-300 rounded-xl px-3 py-2.5 text-sm focus:ring-2 focus:ring-pink-400 focus:border-transparent outline-none">
                            </div>

                            {{-- Font + Size row --}}
                            <div class="grid grid-cols-2 gap-3">
                                <div>
                                    <label class="text-xs font-semibold text-gray-600 mb-1.5 block">Font</label>
                                    <select x-model="wfontFamily" class="w-full border border-gray-300 rounded-xl px-3 py-2 text-sm focus:ring-2 focus:ring-pink-400 outline-none bg-white">
                                        <option value="arial">Arial</option>
                                        <option value="georgia">Georgia</option>
                                        <option value="impact">Impact</option>
                                        <option value="courier">Courier</option>
                                        <option value="verdana">Verdana</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="text-xs font-semibold text-gray-600 mb-1.5 block">Size: <span class="text-pink-600" x-text="wfontSize + 'px'"></span></label>
                                    <input type="range" min="12" max="120" step="4" x-model.number="wfontSize" class="w-full mt-2"
                                        :style="'background: linear-gradient(to right, #db2777 ' + ((wfontSize-12)/108*100) + '%, #e5e7eb ' + ((wfontSize-12)/108*100) + '%)'">
                                </div>
                            </div>

                            {{-- Color + Opacity row --}}
                            <div class="grid grid-cols-2 gap-3">
                                <div>
                                    <label class="text-xs font-semibold text-gray-600 mb-1.5 block">Color</label>
                                    <div class="flex items-center gap-2 border border-gray-300 rounded-xl px-2 py-1.5">
                                        <input type="color" x-model="wcolor" class="w-8 h-7 rounded cursor-pointer border-0 bg-transparent p-0">
                                        <span class="text-xs font-mono text-gray-600 uppercase" x-text="wcolor"></span>
                                    </div>
                                </div>
                                <div>
                                    <label class="text-xs font-semibold text-gray-600 mb-1.5 block">Opacity: <span class="text-pink-600" x-text="wopacity + '%'"></span></label>
                                    <input type="range" min="5" max="100" step="5" x-model.number="wopacity" class="w-full mt-2"
                                        :style="'background: linear-gradient(to right, #db2777 ' + ((wopacity-5)/95*100) + '%, #e5e7eb ' + ((wopacity-5)/95*100) + '%)'">
                                </div>
                            </div>

                            {{-- Mode toggle --}}
                            <div>
                                <label class="text-xs font-semibold text-gray-600 mb-2 block">Mode</label>
                                <div class="flex rounded-xl overflow-hidden border border-gray-200">
                                    <button x-on:click="wmode='single'"
                                        :class="wmode==='single' ? 'bg-pink-600 text-white' : 'bg-white text-gray-600 hover:bg-gray-50'"
                                        class="flex-1 py-2 text-xs font-semibold transition-colors flex items-center justify-center gap-1.5">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931z"/></svg>
                                        Single
                                    </button>
                                    <button x-on:click="wmode='tile'"
                                        :class="wmode==='tile' ? 'bg-pink-600 text-white' : 'bg-white text-gray-600 hover:bg-gray-50'"
                                        class="flex-1 py-2 text-xs font-semibold transition-colors flex items-center justify-center gap-1.5 border-l border-gray-200">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z"/></svg>
                                        Tile Repeat
                                    </button>
                                </div>
                            </div>

                            {{-- Position (9-grid) — single mode only --}}
                            <div x-show="wmode === 'single'">
                                <label class="text-xs font-semibold text-gray-600 mb-2 block">Position</label>
                                <div class="grid grid-cols-3 gap-1.5">
                                    <template x-for="pos in wpositions" :key="pos.value">
                                        <button
                                            x-on:click="wposition = pos.value"
                                            :class="wposition === pos.value ? 'bg-pink-600 text-white border-pink-600' : 'bg-gray-50 text-gray-500 border-gray-200 hover:border-pink-300 hover:bg-pink-50'"
                                            class="border rounded-lg py-2 text-xs font-medium transition-all"
                                            x-text="pos.label">
                                        </button>
                                    </template>
                                </div>
                            </div>

                            {{-- Tile spacing — tile mode only --}}
                            <div x-show="wmode === 'tile'">
                                <label class="text-xs font-semibold text-gray-600 mb-1.5 block">Tile Spacing: <span class="text-pink-600" x-text="wtileSpacing + 'px'"></span></label>
                                <input type="range" min="20" max="400" step="10" x-model.number="wtileSpacing" class="w-full"
                                    :style="'background: linear-gradient(to right, #db2777 ' + ((wtileSpacing-20)/380*100) + '%, #e5e7eb ' + ((wtileSpacing-20)/380*100) + '%)'">
                            </div>

                            {{-- Rotation --}}
                            <div>
                                <label class="text-xs font-semibold text-gray-600 mb-2 block">Rotation</label>
                                <div class="flex rounded-xl overflow-hidden border border-gray-200">
                                    <template x-for="rot in wrotations" :key="rot.value">
                                        <button
                                            x-on:click="wrotation = rot.value"
                                            :class="wrotation === rot.value ? 'bg-pink-600 text-white' : 'bg-white text-gray-600 hover:bg-gray-50'"
                                            class="flex-1 py-2 text-xs font-semibold transition-colors border-l border-gray-200 first:border-l-0"
                                            x-text="rot.label">
                                        </button>
                                    </template>
                                </div>
                            </div>

                            {{-- Apply button --}}
                            <button x-on:click="wApply()" :disabled="!wtext.trim()"
                                :class="wtext.trim() ? 'opacity-100 hover:scale-[1.02]' : 'opacity-50 cursor-not-allowed'"
                                class="w-full bg-gradient-to-r from-pink-600 to-pink-700 text-white font-bold py-3 rounded-xl transition-all flex items-center justify-center gap-2 text-sm shadow-sm">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931z"/></svg>
                                Apply Watermark
                            </button>
                        </div>

                        {{-- Processing --}}
                        <div x-show="wstate === 'processing'" class="text-center py-6">
                            <svg class="animate-spin w-8 h-8 text-pink-600 mx-auto" fill="none" viewBox="0 0 24 24"><circle class="opacity-20" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="3"/><path class="opacity-80" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/></svg>
                            <p class="text-sm text-gray-500 mt-2">Applying watermark…</p>
                            <div x-show="wuploadProgress > 0 && wuploadProgress < 100" class="mt-3 mx-auto w-40">
                                <div class="h-1.5 bg-gray-100 rounded-full overflow-hidden">
                                    <div class="h-full bg-pink-500 rounded-full transition-all" :style="'width:' + wuploadProgress + '%'"></div>
                                </div>
                                <p class="text-xs text-gray-400 mt-1 text-center" x-text="wuploadProgress + '%'"></p>
                            </div>
                        </div>

                        {{-- Result --}}
                        <div x-show="wstate === 'result'" class="space-y-3">
                            <div class="flex items-center gap-2 bg-green-50 rounded-xl px-3 py-2.5">
                                <svg class="w-5 h-5 text-green-600 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                <span class="text-sm font-semibold text-green-700">Watermark applied!</span>
                            </div>
                            <button x-on:click="downloadFromUrl(wresult.download_url, wresult.filename)"
                               class="flex w-full items-center justify-center gap-2 py-3 bg-pink-600 hover:bg-pink-700 text-white font-bold rounded-xl text-sm transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 10v6m0 0l-3-3m3 3l3-3M3 17v1a2 2 0 002 2h14a2 2 0 002-2v-1"/></svg>
                                Download
                            </button>
                            <button x-on:click="wReset()" class="w-full py-2 text-sm text-gray-500 hover:text-gray-700 transition-colors">Apply another</button>
                        </div>

                        {{-- Error message --}}
                        <div x-show="werrorMessage" class="bg-red-50 rounded-xl px-3 py-2 text-xs text-red-600" x-text="werrorMessage"></div>
                    </div>
                </div>

