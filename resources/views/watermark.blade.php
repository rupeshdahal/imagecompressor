<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Free Image Watermark Tool - Add Text Watermarks Online | ImageCompressor</title>
    <meta name="description" content="Add custom text watermarks to your images online for free. Choose position, opacity, and color. Supports JPG, PNG, WEBP, GIF. No signup required.">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="{{ url('/watermark') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwindcss.config = {
            theme: {
                extend: {
                    colors: {
                        primary: { 50:'#eff6ff',100:'#dbeafe',200:'#bfdbfe',300:'#93c5fd',400:'#60a5fa',500:'#3b82f6',600:'#2563eb',700:'#1d4ed8',800:'#1e40af',900:'#1e3a8a' },
                        purple: { 50:'#faf5ff',100:'#f3e8ff',200:'#e9d5ff',300:'#d8b4fe',400:'#c084fc',500:'#a855f7',600:'#9333ea',700:'#7e22ce',800:'#6b21a8',900:'#581c87' }
                    }
                }
            }
        }
    </script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        [x-cloak] { display: none !important; }
        .drop-active { border-color: #9333ea !important; background-color: #faf5ff !important; }
        @keyframes progress { 0% { width:0; } 50% { width:70%; } 100% { width:95%; } }
    </style>
</head>
<body class="bg-gray-50 text-gray-800 min-h-screen flex flex-col">
    <!-- Header -->
    <header class="bg-white border-b border-gray-200 sticky top-0 z-50">
        <div class="max-w-5xl mx-auto px-4 py-3 flex items-center justify-between">
            <a href="/" class="flex items-center gap-2">
                <div class="w-9 h-9 bg-gradient-to-br from-primary-500 to-primary-700 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                </div>
                <span class="text-xl font-bold text-gray-900">Image<span class="text-primary-600">Compressor</span></span>
            </a>
            <nav class="hidden sm:flex items-center gap-6 text-sm font-medium">
                <a href="{{ route('compressor') }}" class="text-gray-600 hover:text-primary-600 transition">Compressor</a>
                <a href="{{ route('watermark') }}" class="text-purple-600 font-semibold">Watermark</a>
            </nav>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-1 max-w-5xl mx-auto px-4 py-8 w-full" x-data="watermarkApp()" x-cloak>
        <!-- Title -->
        <section class="text-center mb-8">
            <h1 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-2">Image <span class="text-purple-600">Watermark</span></h1>
            <p class="text-gray-500 max-w-xl mx-auto">Add custom text watermarks to protect your images. Choose position, color, and opacity.</p>
        </section>

        <!-- Tool Card -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden mb-8">
            <!-- Upload Zone -->
            <div class="border-2 border-dashed border-gray-300 rounded-xl m-4 p-8 text-center cursor-pointer transition-all hover:border-purple-400"
                :class="{ 'drop-active': isDragging }"
                @dragover.prevent="isDragging = true"
                @dragleave.prevent="isDragging = false"
                @drop.prevent="handleDrop($event)"
                @click="$refs.fileInput.click()"
                x-show="!selectedFile">
                <input type="file" x-ref="fileInput" class="hidden" accept="image/jpeg,image/png,image/webp,image/gif" @change="handleFileSelect($event)">
                <div class="flex flex-col items-center gap-3">
                    <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center">
                        <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                    </div>
                    <p class="text-lg font-semibold text-gray-700">Drop your image here</p>
                    <p class="text-sm text-gray-400">or click to browse &bull; Paste with Ctrl+V</p>
                    <p class="text-xs text-gray-400">JPG, PNG, WEBP, GIF &bull; Max 20MB</p>
                </div>
            </div>

            <!-- File Preview -->
            <div x-show="selectedFile" class="m-4 p-4 bg-gray-50 rounded-xl border border-gray-200">
                <div class="flex items-center gap-4">
                    <img :src="previewUrl" class="w-20 h-20 object-cover rounded-lg border border-gray-200" x-show="previewUrl">
                    <div class="flex-1 min-w-0">
                        <p class="font-medium text-gray-900 truncate" x-text="fileName"></p>
                        <p class="text-sm text-gray-500" x-text="fileSize"></p>
                    </div>
                    <button @click="clearFile()" class="p-2 text-gray-400 hover:text-red-500 rounded-lg transition" title="Remove file">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>
            </div>

            <!-- Watermark Settings -->
            <div x-show="selectedFile" class="border-t border-gray-100">
                <!-- Watermark Text -->
                <div class="p-5">
                    <label class="text-sm font-semibold text-gray-700 block mb-2">Watermark Text <span class="text-red-500">*</span></label>
                    <input type="text" x-model="watermarkText" maxlength="100" placeholder="e.g. © Your Name, Company Logo, etc."
                        class="w-full px-4 py-3 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-purple-500 outline-none transition text-gray-900 placeholder-gray-400">
                    <p class="text-xs text-gray-400 mt-1" x-text="watermarkText.length + '/100 characters'"></p>
                </div>

                <!-- Position -->
                <div class="p-5 border-t border-gray-100">
                    <label class="text-sm font-semibold text-gray-700 block mb-3">Position</label>
                    <div class="grid grid-cols-3 gap-2 max-w-xs">
                        <template x-for="pos in [
                            {val:'top-left', label:'Top Left'},
                            {val:'center', label:'Center'},
                            {val:'top-right', label:'Top Right'},
                            {val:'bottom-left', label:'Bottom Left'},
                            {val:'_spacer', label:''},
                            {val:'bottom-right', label:'Bottom Right'}
                        ]" :key="pos.val">
                            <button
                                x-show="pos.val !== '_spacer'"
                                @click="watermarkPosition = pos.val"
                                :class="watermarkPosition === pos.val ? 'bg-purple-600 text-white shadow-sm' : 'bg-gray-100 text-gray-700 hover:bg-gray-200'"
                                class="px-3 py-2 text-xs rounded-lg font-semibold transition-all" x-text="pos.label">
                            </button>
                            <div x-show="pos.val === '_spacer'"></div>
                        </template>
                    </div>
                </div>

                <!-- Opacity -->
                <div class="p-5 border-t border-gray-100">
                    <div class="flex items-center justify-between mb-2">
                        <label class="text-sm font-semibold text-gray-700">Opacity</label>
                        <span class="text-sm font-bold text-purple-600" x-text="watermarkOpacity + '%'"></span>
                    </div>
                    <input type="range" min="10" max="100" x-model="watermarkOpacity" class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer accent-purple-600">
                    <div class="flex justify-between text-xs text-gray-400 mt-1">
                        <span>Subtle</span>
                        <span>Opaque</span>
                    </div>
                </div>

                <!-- Color -->
                <div class="p-5 border-t border-gray-100">
                    <label class="text-sm font-semibold text-gray-700 block mb-3">Watermark Color</label>
                    <div class="flex flex-wrap gap-2">
                        <template x-for="c in [
                            {val:'#ffffff', label:'White', bg:'bg-white border-2 border-gray-300'},
                            {val:'#000000', label:'Black', bg:'bg-gray-900'},
                            {val:'#ef4444', label:'Red', bg:'bg-red-500'},
                            {val:'#3b82f6', label:'Blue', bg:'bg-blue-500'},
                            {val:'#22c55e', label:'Green', bg:'bg-green-500'},
                            {val:'#eab308', label:'Yellow', bg:'bg-yellow-500'}
                        ]" :key="c.val">
                            <button @click="watermarkColor = c.val"
                                :class="watermarkColor === c.val ? 'ring-2 ring-purple-500 ring-offset-2' : ''"
                                class="flex items-center gap-2 px-3 py-2 rounded-lg bg-gray-50 hover:bg-gray-100 transition-all">
                                <span :class="c.bg" class="w-5 h-5 rounded-full inline-block shrink-0"></span>
                                <span class="text-xs font-medium text-gray-700" x-text="c.label"></span>
                            </button>
                        </template>
                    </div>
                </div>

                <!-- Output Format -->
                <div class="p-5 border-t border-gray-100">
                    <label class="text-sm font-semibold text-gray-700 block mb-3">Output Format</label>
                    <div class="flex gap-2 flex-wrap">
                        <template x-for="fmt in [{label:'Original',val:'original'},{label:'JPG',val:'jpg'},{label:'PNG',val:'png'},{label:'WEBP',val:'webp'}]" :key="fmt.val">
                            <button @click="outputFormat = fmt.val"
                                :class="outputFormat === fmt.val ? 'bg-purple-600 text-white shadow-sm' : 'bg-gray-100 text-gray-700 hover:bg-gray-200'"
                                class="px-4 py-2 text-sm rounded-lg font-semibold transition-all" x-text="fmt.label">
                            </button>
                        </template>
                    </div>
                </div>

                <!-- Apply Button -->
                <div class="p-5 border-t border-gray-100">
                    <button @click="applyWatermark()" :disabled="isProcessing || !watermarkText.trim()"
                        class="w-full py-3.5 px-6 bg-gradient-to-r from-purple-600 to-purple-700 text-white font-bold rounded-xl hover:from-purple-700 hover:to-purple-800 transition-all disabled:opacity-60 disabled:cursor-not-allowed flex items-center justify-center gap-2 shadow-lg shadow-purple-600/20">
                        <span x-show="!isProcessing" class="flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                            Apply Watermark
                        </span>
                        <span x-show="isProcessing" class="flex items-center gap-2">
                            <svg class="animate-spin w-5 h-5" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/></svg>
                            Processing...
                        </span>
                    </button>
                    <p x-show="!watermarkText.trim() && selectedFile" class="text-center text-xs text-amber-600 mt-2">Please enter watermark text to continue.</p>
                </div>
            </div>
        </div>

        <!-- Progress -->
        <div x-show="isProcessing" class="mb-8">
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <p class="font-medium text-gray-800 mb-3">Applying watermark to your image...</p>
                <div class="w-full bg-gray-200 rounded-full h-2.5">
                    <div class="bg-purple-600 h-2.5 rounded-full" style="animation: progress 3s ease-in-out forwards;"></div>
                </div>
            </div>
        </div>

        <!-- Error -->
        <div x-show="errorMessage" class="mb-8">
            <div class="bg-red-50 border border-red-200 rounded-xl p-4 flex items-start gap-3">
                <svg class="w-5 h-5 text-red-500 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <p class="font-medium text-red-700 text-sm" x-text="errorMessage"></p>
                <button @click="errorMessage = ''" class="ml-auto text-red-400 hover:text-red-600">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
        </div>

        <!-- Result -->
        <div x-show="result" class="mb-8">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="p-4 bg-purple-50 border-b border-purple-200">
                    <div class="flex items-center gap-2">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <h3 class="font-bold text-purple-700">Watermark Applied!</h3>
                    </div>
                </div>
                <div class="p-5">
                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-3 mb-5">
                        <div class="bg-gray-50 rounded-lg p-3 text-center">
                            <p class="text-xs text-gray-500 mb-1">Original</p>
                            <p class="text-sm font-bold text-gray-900" x-text="result?.formatted_original"></p>
                        </div>
                        <div class="bg-gray-50 rounded-lg p-3 text-center">
                            <p class="text-xs text-gray-500 mb-1">Output</p>
                            <p class="text-sm font-bold text-purple-600" x-text="result?.formatted_output"></p>
                        </div>
                        <div class="bg-gray-50 rounded-lg p-3 text-center">
                            <p class="text-xs text-gray-500 mb-1">Format</p>
                            <p class="text-sm font-bold text-gray-900" x-text="result?.format"></p>
                        </div>
                    </div>
                    <a :href="result?.download_url" class="block w-full py-3 px-6 bg-purple-600 text-white font-bold rounded-xl hover:bg-purple-700 transition text-center shadow-lg shadow-purple-600/20">
                        Download Watermarked Image
                    </a>
                    <button @click="clearFile(); result = null;" class="w-full mt-3 py-2.5 text-sm font-medium text-gray-500 hover:text-gray-700 hover:bg-gray-50 rounded-lg transition">
                        Watermark Another Image
                    </button>
                </div>
            </div>
        </div>

        <!-- Ad Space -->
        <div class="mb-8 bg-white rounded-xl border border-gray-200 p-4 text-center">
            <p class="text-xs text-gray-400">Advertisement</p>
            <div class="h-24 bg-gray-100 rounded-lg mt-2 flex items-center justify-center"><p class="text-sm text-gray-400">Ad Space</p></div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t border-gray-200 py-6">
        <div class="max-w-5xl mx-auto px-4 flex flex-col sm:flex-row items-center justify-between gap-4">
            <p class="text-sm text-gray-500">&copy; {{ date('Y') }} ImageCompressor. All rights reserved.</p>
            <div class="flex items-center gap-6 text-sm text-gray-400">
                <a href="/" class="hover:text-gray-600 transition">Home</a>
                <a href="{{ route('compressor') }}" class="hover:text-gray-600 transition">Compressor Tool</a>
            </div>
        </div>
    </footer>

    <script>
    function watermarkApp() {
        return {
            selectedFile: null,
            previewUrl: null,
            fileName: '',
            fileSize: '',
            isDragging: false,
            isProcessing: false,
            errorMessage: '',
            result: null,
            watermarkText: '',
            watermarkPosition: 'bottom-right',
            watermarkOpacity: 50,
            watermarkColor: '#ffffff',
            outputFormat: 'original',

            init() {
                document.addEventListener('paste', (e) => {
                    const items = e.clipboardData?.items;
                    if (!items) return;
                    for (let item of items) {
                        if (item.type.startsWith('image/')) {
                            const file = item.getAsFile();
                            if (file) this.setFile(file);
                            break;
                        }
                    }
                });
            },

            handleFileSelect(e) {
                const file = e.target.files[0];
                if (file) this.setFile(file);
            },

            handleDrop(e) {
                this.isDragging = false;
                const file = e.dataTransfer.files[0];
                if (file && file.type.startsWith('image/')) this.setFile(file);
            },

            setFile(file) {
                if (file.size > 20 * 1024 * 1024) {
                    this.errorMessage = 'File size exceeds 20MB limit.';
                    return;
                }
                const allowed = ['image/jpeg', 'image/png', 'image/webp', 'image/gif'];
                if (!allowed.includes(file.type)) {
                    this.errorMessage = 'Invalid file type. Only JPG, PNG, WEBP, GIF allowed.';
                    return;
                }
                this.selectedFile = file;
                this.fileName = file.name;
                this.fileSize = this.formatBytes(file.size);
                this.errorMessage = '';
                this.result = null;
                const reader = new FileReader();
                reader.onload = (e) => { this.previewUrl = e.target.result; };
                reader.readAsDataURL(file);
            },

            clearFile() {
                this.selectedFile = null;
                this.previewUrl = null;
                this.fileName = '';
                this.fileSize = '';
                this.errorMessage = '';
                if (this.$refs.fileInput) this.$refs.fileInput.value = '';
            },

            async applyWatermark() {
                if (!this.selectedFile || !this.watermarkText.trim()) return;
                this.isProcessing = true;
                this.errorMessage = '';
                this.result = null;

                const formData = new FormData();
                formData.append('image', this.selectedFile);
                formData.append('watermark_text', this.watermarkText.trim());
                formData.append('watermark_position', this.watermarkPosition);
                formData.append('watermark_opacity', this.watermarkOpacity);
                formData.append('watermark_color', this.watermarkColor);
                formData.append('output_format', this.outputFormat);

                try {
                    const response = await fetch('/watermark/apply', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'Accept': 'application/json',
                        },
                        body: formData,
                    });
                    const data = await response.json();
                    if (data.success) {
                        this.result = data;
                    } else {
                        this.errorMessage = data.message || 'Failed to apply watermark.';
                    }
                } catch (err) {
                    this.errorMessage = 'An error occurred. Please try again.';
                    console.error(err);
                } finally {
                    this.isProcessing = false;
                }
            },

            formatBytes(bytes) {
                if (!bytes || bytes === 0) return '0 B';
                const k = 1024;
                const sizes = ['B', 'KB', 'MB', 'GB'];
                const i = Math.floor(Math.log(bytes) / Math.log(k));
                return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
            }
        }
    }
    </script>
</body>
</html>
