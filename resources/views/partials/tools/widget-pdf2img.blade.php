                <div x-data="pdfToImgTool()" x-init="initPdfToImg()" class="bg-white rounded-2xl border border-gray-200/60 overflow-hidden shadow-sm">
                    <div class="px-5 py-4 border-b border-gray-100 flex items-center gap-3">
                        <div class="w-10 h-10 bg-indigo-100 rounded-xl flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909M3.75 21h16.5A2.25 2.25 0 0022.5 18.75V5.25A2.25 2.25 0 0020.25 3H3.75A2.25 2.25 0 001.5 5.25v13.5A2.25 2.25 0 003.75 21z"/></svg>
                        </div>
                        <div>
                            <h3 class="font-bold text-gray-900 text-sm">PDF → Image</h3>
                            <p class="text-xs text-gray-500">Convert PDF page to image</p>
                        </div>
                    </div>
                    <div class="p-5 space-y-4">
                        <div x-show="pdfistate === 'idle' || pdfistate === 'error'">
                            <div x-on:click="$refs.pdfFileInput.click()" class="border-2 border-dashed border-gray-200 rounded-2xl p-6 text-center cursor-pointer hover:border-indigo-400 hover:bg-indigo-50 transition-all">
                                <input type="file" x-ref="pdfFileInput" accept=".pdf" x-on:change="pdfiHandleFile($event)" class="hidden">
                                <p class="text-sm text-gray-400">Click to select PDF file</p>
                                <p class="text-xs text-gray-400 mt-1">Max 20MB</p>
                            </div>
                        </div>

                        <div x-show="pdfistate === 'settings'" class="space-y-3">
                            <div class="flex items-center justify-between">
                                <span class="text-xs font-semibold text-gray-600 truncate flex-1" x-text="pdfifileName"></span>
                                <button x-on:click="pdfiReset()" class="ml-2 text-gray-400 hover:text-red-500 flex-shrink-0"><svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg></button>
                            </div>
                            <div class="flex gap-2">
                                <div class="flex-1">
                                    <label class="text-xs text-gray-500 mb-1 block">Output Format</label>
                                    <select x-model="pdfiformat" class="w-full border border-gray-300 rounded-xl px-3 py-2 text-sm focus:ring-2 focus:ring-indigo-400 outline-none">
                                        <option value="jpg">JPG</option>
                                        <option value="png">PNG</option>
                                        <option value="webp">WebP</option>
                                    </select>
                                </div>
                                <div class="flex-1">
                                    <label class="text-xs text-gray-500 mb-1 block">DPI</label>
                                    <select x-model.number="pdfidpi" class="w-full border border-gray-300 rounded-xl px-3 py-2 text-sm focus:ring-2 focus:ring-indigo-400 outline-none">
                                        <option value="72">72</option>
                                        <option value="96">96</option>
                                        <option value="150" selected>150</option>
                                        <option value="200">200</option>
                                        <option value="300">300</option>
                                    </select>
                                </div>
                            </div>
                            <button x-on:click="pdfiConvert()"
                                class="w-full bg-gradient-to-r from-indigo-600 to-indigo-700 text-white font-bold py-3 rounded-xl transition-all flex items-center justify-center gap-2 text-sm hover:scale-[1.02]">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909"/></svg>
                                Convert to Image
                            </button>
                        </div>

                        <div x-show="pdfistate === 'processing'" class="text-center py-4">
                            <svg class="animate-spin w-8 h-8 text-indigo-600 mx-auto" fill="none" viewBox="0 0 24 24"><circle class="opacity-20" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="3"/><path class="opacity-80" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/></svg>
                            <p class="text-sm text-gray-500 mt-2">Converting PDF...</p>
                        </div>

                        <div x-show="pdfistate === 'result'" class="space-y-3">
                            <div class="grid grid-cols-2 gap-2">
                                <div class="bg-indigo-50 rounded-xl p-2 text-center">
                                    <p class="text-xs text-gray-400">Size</p>
                                    <p class="text-xs font-bold text-indigo-600" x-text="pdfiresult.formatted_size"></p>
                                </div>
                                <div class="bg-indigo-50 rounded-xl p-2 text-center">
                                    <p class="text-xs text-gray-400">Dimensions</p>
                                    <p class="text-xs font-bold text-indigo-600" x-text="(pdfiresult.width||'—') + '×' + (pdfiresult.height||'—')"></p>
                                </div>
                            </div>
                            <button x-on:click="downloadFromUrl(pdfiresult.download_url, pdfiresult.filename)"
                               class="flex w-full items-center justify-center gap-2 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl text-sm transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 10v6m0 0l-3-3m3 3l3-3"/></svg>
                                Download Image
                            </button>
                            <button x-on:click="pdfiReset()" class="w-full py-2 text-sm text-gray-500 hover:text-gray-700 transition-colors">Convert another</button>
                        </div>

                        <div x-show="pdfierrorMessage" class="bg-red-50 rounded-xl px-3 py-2 text-xs text-red-600" x-text="pdfierrorMessage"></div>
                    </div>
                </div>

