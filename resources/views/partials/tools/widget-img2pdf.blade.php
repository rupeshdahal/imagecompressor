                <div x-data="imgToPdfTool()" x-init="initImgToPdf()" class="bg-white rounded-2xl border border-gray-200/60 overflow-hidden shadow-sm">
                    <div class="px-5 py-4 border-b border-gray-100 flex items-center gap-3">
                        <div class="w-10 h-10 bg-red-100 rounded-xl flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/></svg>
                        </div>
                        <div>
                            <h3 class="font-bold text-gray-900 text-sm">Image → PDF</h3>
                            <p class="text-xs text-gray-500">Convert image to PDF document</p>
                        </div>
                    </div>
                    <div class="p-5 space-y-4">
                        <div x-show="pstate === 'idle' || pstate === 'error'">
                            <div x-on:click="$refs.pdfImgInput.click()" class="border-2 border-dashed border-gray-200 rounded-2xl p-6 text-center cursor-pointer hover:border-red-400 hover:bg-red-50 transition-all">
                                <input type="file" x-ref="pdfImgInput" accept=".jpg,.jpeg,.png,.webp" x-on:change="pHandleFile($event)" class="hidden">
                                <p class="text-sm text-gray-400">Click to select image</p>
                            </div>
                        </div>

                        <div x-show="pstate === 'settings'" class="space-y-3">
                            <div class="flex items-center justify-between">
                                <span class="text-xs font-semibold text-gray-600 truncate flex-1" x-text="pfileName"></span>
                                <button x-on:click="pReset()" class="ml-2 text-gray-400 hover:text-red-500 flex-shrink-0"><svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg></button>
                            </div>
                            <div class="flex gap-2">
                                <div class="flex-1">
                                    <label class="text-xs text-gray-500 mb-1 block">Page Size</label>
                                    <select x-model="ppageSize" class="w-full border border-gray-300 rounded-xl px-3 py-2 text-sm focus:ring-2 focus:ring-red-400 outline-none">
                                        <option value="A4">A4</option>
                                        <option value="A3">A3</option>
                                        <option value="Letter">Letter</option>
                                        <option value="Legal">Legal</option>
                                    </select>
                                </div>
                                <div class="flex-1">
                                    <label class="text-xs text-gray-500 mb-1 block">Orientation</label>
                                    <select x-model="porientation" class="w-full border border-gray-300 rounded-xl px-3 py-2 text-sm focus:ring-2 focus:ring-red-400 outline-none">
                                        <option value="portrait">Portrait</option>
                                        <option value="landscape">Landscape</option>
                                    </select>
                                </div>
                            </div>
                            <button x-on:click="pConvert()"
                                class="w-full bg-gradient-to-r from-red-600 to-red-700 text-white font-bold py-3 rounded-xl transition-all flex items-center justify-center gap-2 text-sm hover:scale-[1.02]">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/></svg>
                                Convert to PDF
                            </button>
                        </div>

                        <div x-show="pstate === 'processing'" class="text-center py-4">
                            <svg class="animate-spin w-8 h-8 text-red-600 mx-auto" fill="none" viewBox="0 0 24 24"><circle class="opacity-20" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="3"/><path class="opacity-80" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/></svg>
                            <p class="text-sm text-gray-500 mt-2">Generating PDF...</p>
                        </div>

                        <div x-show="pstate === 'result'" class="space-y-3">
                            <div class="flex items-center gap-2 bg-green-50 rounded-xl px-3 py-2.5">
                                <svg class="w-5 h-5 text-green-600 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                <span class="text-sm text-green-700 font-semibold">PDF ready! <span class="font-normal" x-text="'(' + presult.formatted_size + ')'"></span></span>
                            </div>
                            <button x-on:click="downloadFromUrl(presult.download_url, presult.filename)"
                               class="flex w-full items-center justify-center gap-2 py-3 bg-red-600 hover:bg-red-700 text-white font-bold rounded-xl text-sm transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 10v6m0 0l-3-3m3 3l3-3"/></svg>
                                Download PDF
                            </button>
                            <button x-on:click="pReset()" class="w-full py-2 text-sm text-gray-500 hover:text-gray-700 transition-colors">Convert another</button>
                        </div>

                        <div x-show="perrorMessage" class="bg-red-50 rounded-xl px-3 py-2 text-xs text-red-600" x-text="perrorMessage"></div>
                    </div>
                </div>

