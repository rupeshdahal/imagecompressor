                <div x-data="urlCompressor()" x-init="initUrl()" class="bg-white rounded-3xl border border-gray-200/70 overflow-hidden shadow-xl shadow-cyan-100/40">
                    <div class="px-5 py-4 border-b border-gray-100 flex items-center gap-3">
                        <div class="w-10 h-10 bg-teal-100 rounded-xl flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-teal-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13.19 8.688a4.5 4.5 0 011.242 7.244l-4.5 4.5a4.5 4.5 0 01-6.364-6.364l1.757-1.757m13.35-.622l1.757-1.757a4.5 4.5 0 00-6.364-6.364l-4.5 4.5a4.5 4.5 0 001.242 7.244"/></svg>
                        </div>
                        <div>
                            <h3 class="font-bold text-gray-900 text-sm">Compress from URL</h3>
                            <p class="text-xs text-gray-500">Paste image URL to compress</p>
                        </div>
                    </div>
                    <div class="p-6 space-y-5">
                        <div x-show="ustate === 'idle' || ustate === 'error'" class="space-y-3">
                            <p class="text-sm text-gray-500">Paste an image URL below or press Ctrl+V.</p>
                            <input type="url" x-model="uurl" placeholder="https://example.com/image.jpg"
                                class="w-full border border-gray-300 rounded-xl px-3 py-2.5 text-sm focus:ring-2 focus:ring-teal-400 focus:border-transparent outline-none"
                                x-on:keydown.enter="uCompress()">
                            <div class="flex items-center gap-2">
                                <label class="text-xs text-gray-500 flex-shrink-0">Quality</label>
                                <input type="range" min="10" max="90" step="5" x-model.number="uquality" class="flex-1"
                                    :style="'background: linear-gradient(to right, #0d9488 ' + ((uquality-10)/80*100) + '%, #e5e7eb ' + ((uquality-10)/80*100) + '%)'">
                                <span class="text-xs font-bold text-teal-700 bg-teal-50 px-2 py-1 rounded-lg flex-shrink-0" x-text="uquality + '%'"></span>
                            </div>
                            <button x-on:click="uCompress()" :disabled="!uurl.trim()"
                                :class="uurl.trim() ? 'opacity-100' : 'opacity-50 cursor-not-allowed'"
                                class="w-full bg-gradient-to-r from-teal-600 to-teal-700 text-white font-bold py-3 rounded-xl transition-all flex items-center justify-center gap-2 text-sm hover:scale-[1.02]">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3"/></svg>
                                Compress URL Image
                            </button>
                            <div x-show="uerrorMessage" class="bg-red-50 rounded-xl px-3 py-2 text-xs text-red-600" x-text="uerrorMessage"></div>
                        </div>

                        <div x-show="ustate === 'processing'" class="text-center py-4">
                            <svg class="animate-spin w-8 h-8 text-teal-600 mx-auto" fill="none" viewBox="0 0 24 24"><circle class="opacity-20" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="3"/><path class="opacity-80" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/></svg>
                            <p class="text-sm text-gray-500 mt-2">Fetching and compressing...</p>
                        </div>

                        <div x-show="ustate === 'result'" class="space-y-3">
                            <div class="grid grid-cols-3 gap-2">
                                <div class="bg-gray-50 rounded-xl p-2 text-center">
                                    <p class="text-xs text-gray-400">Original</p>
                                    <p class="text-xs font-bold text-gray-700" x-text="uresult.formatted_original"></p>
                                </div>
                                <div class="bg-teal-50 rounded-xl p-2 text-center">
                                    <p class="text-xs text-gray-400">Compressed</p>
                                    <p class="text-xs font-bold text-teal-600" x-text="uresult.formatted_compressed"></p>
                                </div>
                                <div class="bg-green-50 rounded-xl p-2 text-center">
                                    <p class="text-xs text-gray-400">Saved</p>
                                    <p class="text-xs font-bold text-green-600" x-text="uresult.reduction + '%'"></p>
                                </div>
                            </div>
                            <button x-on:click="downloadFromUrl(uresult.download_url, uresult.filename)"
                               class="flex w-full items-center justify-center gap-2 py-3 bg-teal-600 hover:bg-teal-700 text-white font-bold rounded-xl text-sm transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 10v6m0 0l-3-3m3 3l3-3"/></svg>
                                Download
                            </button>
                            <button x-on:click="uReset()" class="w-full py-2 text-sm text-gray-500 hover:text-gray-700 transition-colors">Compress another</button>
                        </div>
                    </div>
                </div>

