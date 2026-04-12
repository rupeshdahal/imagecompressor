    {{-- Alpine.js CDN (with collapse + intersect plugins) --}}
    <script defer src="https://cdn.jsdelivr.net/npm/@@alpinejs/collapse@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/@@alpinejs/intersect@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    {{-- API endpoint config (base64-encoded to avoid plain-text scraping) --}}
    <script>
        (function(){
            var _e = atob;
            window.__cp = {
                seg:  _e('{{ base64_encode(route("upload.chunk")) }}'),
                done: _e('{{ base64_encode(route("upload.finalize")) }}'),
                proc: _e('{{ base64_encode(route("image.compress")) }}'),
                xfm:  _e('{{ base64_encode(route("image.convert")) }}'),
                btch: _e('{{ base64_encode(route("batch.compress")) }}'),
                bzip: _e('{{ base64_encode(route("batch.zip")) }}'),
                btchf: _e('{{ base64_encode(route("batch.finalize")) }}'),
                rsz:  _e('{{ base64_encode(route("image.resize")) }}'),
                urlp: _e('{{ base64_encode(route("url.compress")) }}'),
                i2p:  _e('{{ base64_encode(route("image.to.pdf")) }}'),
                p2i:  _e('{{ base64_encode(route("pdf.to.image")) }}'),
                wmk:  _e('{{ base64_encode(route("image.watermark")) }}'),
                t2seg: _e('{{ base64_encode(route("t2.chunk")) }}'),
                t2don: _e('{{ base64_encode(route("t2.finalize")) }}'),
            };
        })();
    </script>

    <script>
        /* ─── Tab controller ─────────────────────────────────────────── */
        function toolTabs() {
            return { activeTab: 'compress' };
        }

        function isToolContextActive(tabName) {
            const tabsRoot = document.querySelector('[x-data="toolTabs()"]');
            const activeTab = tabsRoot?._x_dataStack?.[0]?.activeTab;
            // Standalone tool pages have no tab controller, so they are always active.
            if (!tabsRoot || !activeTab) return true;
            return activeTab === tabName;
        }

        /* ─── Shared chunked uploader ────────────────────────────────── */
        const CHUNK_SIZE = 1 * 1024 * 1024; // 1 MB per chunk

        async function uploadInChunks(file, onProgress, chunkEndpoint) {
            const endpoint    = chunkEndpoint || window.__cp.seg;
            const totalChunks = Math.ceil(file.size / CHUNK_SIZE);
            const uploadId    = crypto.randomUUID ? crypto.randomUUID() : Date.now().toString(36) + Math.random().toString(36).slice(2);
            const csrf        = document.querySelector('meta[name="csrf-token"]').content;

            for (let i = 0; i < totalChunks; i++) {
                const start = i * CHUNK_SIZE;
                const end   = Math.min(start + CHUNK_SIZE, file.size);
                const chunk = file.slice(start, end);

                const fd = new FormData();
                fd.append('chunk',        chunk, file.name);
                fd.append('upload_id',    uploadId);
                fd.append('chunk_index',  i);
                fd.append('total_chunks', totalChunks);

                const res = await fetch(endpoint, {
                    method: 'POST',
                    headers: { 'X-CSRF-TOKEN': csrf, 'Accept': 'application/json' },
                    body: fd,
                });
                if (!res.ok) {
                    const err = await res.json().catch(() => ({}));
                    throw new Error(err.message || `Chunk ${i} upload failed.`);
                }
                // Report progress: chunk upload counts for 80%, finalize for remaining 20%
                onProgress(Math.round(((i + 1) / totalChunks) * 80));
            }
            return { uploadId, totalChunks };
        }

        /* ─── Shared download helper ─────────────────────────────────── */
        async function downloadFromUrl(url, filename) {
            if (!url) return;
            try {
                const res = await fetch(url, { headers: { 'Accept': '*/*' } });
                if (!res.ok) throw new Error('Download failed (' + res.status + ')');
                const blob = await res.blob();
                const objectUrl = URL.createObjectURL(blob);
                const a = document.createElement('a');
                a.href = objectUrl;
                a.download = filename || url.split('/').pop() || 'download';
                document.body.appendChild(a);
                a.click();
                document.body.removeChild(a);
                setTimeout(() => URL.revokeObjectURL(objectUrl), 10000);
            } catch (err) {
                console.error('Download error:', err);
                // Fallback: open in new tab
                window.open(url, '_blank');
            }
        }

        /* ─── COMPRESS component ─────────────────────────────────────── */
        function compressor() {
            return {
                state: 'idle',
                isDragging: false,
                isPasting: false,
                errorMessage: '',
                file: null,
                fileName: '',
                fileSize: 0,
                fileType: '',
                quality: 50,
                outputFormat: 'original',
                result: {},
                previewUrl: null,
                uploadProgress: 0,
                // Clipboard state
                copied: false,
                copying: false,
                clipboardError: false,

                initComp() {
                    document.addEventListener('paste', (event) => {
                        if (!isToolContextActive('compress')) return;
                        if (this.state === 'idle' || this.state === 'error') {
                            this.handlePaste(event);
                        }
                    });
                },

                handlePaste(event) {
                    const items = event.clipboardData?.items;
                    if (!items) return;
                    for (let i = 0; i < items.length; i++) {
                        if (items[i].type.indexOf('image') !== -1) {
                            event.preventDefault();
                            this.isPasting = true;
                            const file = items[i].getAsFile();
                            if (file) {
                                setTimeout(() => { this.processFile(file); this.isPasting = false; }, 300);
                            }
                            break;
                        }
                    }
                },

                handleDrop(event) {
                    this.isDragging = false;
                    const files = event.dataTransfer.files;
                    if (files.length > 0) this.processFile(files[0]);
                },

                handleFileSelect(event) {
                    const files = event.target.files;
                    if (files.length > 0) this.processFile(files[0]);
                },

                processFile(file) {
                    this.errorMessage = '';
                    const allowedTypes = ['image/jpeg', 'image/png', 'image/webp', 'image/gif'];
                    if (!allowedTypes.includes(file.type)) {
                        this.errorMessage = 'Invalid file type. Please upload a JPG, PNG, WEBP, or GIF image.';
                        this.state = 'error'; return;
                    }
                    if (file.size > 20 * 1024 * 1024) {
                        this.errorMessage = 'File size exceeds 20MB. Please choose a smaller image.';
                        this.state = 'error'; return;
                    }
                    this.file = file;
                    this.fileName = file.name;
                    this.fileSize = file.size;
                    this.fileType = file.type.split('/')[1];
                    if (this.fileType === 'jpeg') this.fileType = 'jpg';
                    if (this.previewUrl) URL.revokeObjectURL(this.previewUrl);
                    this.previewUrl = URL.createObjectURL(file);
                    this.state = 'settings';
                },

                async compress() {
                    this.state = 'processing';
                    this.uploadProgress = 0;
                    this.errorMessage = '';
                    this.copied = false;
                    this.clipboardError = false;
                    const csrf = document.querySelector('meta[name="csrf-token"]').content;

                    try {
                        // Small files (≤ 2MB): single direct upload
                        if (this.file.size <= 2 * 1024 * 1024) {
                            this.uploadProgress = 40;
                            const formData = new FormData();
                            formData.append('image',   this.file);
                            formData.append('quality', this.quality);
                            formData.append('format',  this.outputFormat);
                            const response = await fetch(window.__cp.proc, {
                                method: 'POST',
                                headers: { 'X-CSRF-TOKEN': csrf, 'Accept': 'application/json' },
                                body: formData,
                            });
                            this.uploadProgress = 90;
                            const data = await response.json();
                            if (!response.ok || !data.success) throw new Error(data.message || 'Compression failed. Please try again.');
                            this.uploadProgress = 100;
                            this.result = data;
                        } else {
                            // Large files: chunked upload then finalize
                            const { uploadId, totalChunks } = await uploadInChunks(this.file, p => { this.uploadProgress = p; });
                            this.uploadProgress = 85;
                            const fd = new FormData();
                            fd.append('upload_id',     uploadId);
                            fd.append('total_chunks',  totalChunks);
                            fd.append('original_name', this.file.name);
                            fd.append('action',        'compress');
                            fd.append('quality',       this.quality);
                            fd.append('format',        this.outputFormat);
                            const response = await fetch(window.__cp.done, {
                                method: 'POST',
                                headers: { 'X-CSRF-TOKEN': csrf, 'Accept': 'application/json' },
                                body: fd,
                            });
                            this.uploadProgress = 100;
                            const data = await response.json();
                            if (!response.ok || !data.success) throw new Error(data.message || 'Compression failed. Please try again.');
                            this.result = data;
                        }
                        this.state = 'result';
                    } catch (error) {
                        this.errorMessage = error.message || 'An unexpected error occurred.';
                        this.state = 'error';
                    }
                },

                /**
                 * Copy the compressed image to the system clipboard.
                 * Uses the modern Clipboard API (write + ClipboardItem).
                 * Falls back to a user-visible error notice when unavailable.
                 */
                async copyToClipboard() {
                    if (!this.result?.download_url) return;
                    this.clipboardError = false;

                    // Clipboard API requires a secure context (https or localhost)
                    if (!navigator.clipboard || !window.ClipboardItem) {
                        this.clipboardError = true;
                        return;
                    }

                    this.copying = true;
                    try {
                        const res  = await fetch(this.result.download_url);
                        const blob = await res.blob();

                        // Browsers only support writing PNG via ClipboardItem.
                        // If the compressed file is not PNG, we re-draw it on a canvas first.
                        let writeBlob = blob;
                        if (blob.type !== 'image/png') {
                            const bmp  = await createImageBitmap(blob);
                            const cvs  = document.createElement('canvas');
                            cvs.width  = bmp.width;
                            cvs.height = bmp.height;
                            cvs.getContext('2d').drawImage(bmp, 0, 0);
                            writeBlob = await new Promise(r => cvs.toBlob(r, 'image/png'));
                        }

                        await navigator.clipboard.write([
                            new ClipboardItem({ 'image/png': writeBlob }),
                        ]);
                        this.copied = true;
                        setTimeout(() => { this.copied = false; }, 2500);
                    } catch (e) {
                        // Common cause: user denied clipboard permission
                        this.clipboardError = true;
                    } finally {
                        this.copying = false;
                    }
                },

                reset() {
                    this.state = 'idle'; this.file = null; this.fileName = ''; this.fileSize = 0;
                    this.fileType = ''; this.quality = 50; this.outputFormat = 'original';
                    this.result = {}; this.errorMessage = ''; this.uploadProgress = 0;
                    this.copied = false; this.copying = false; this.clipboardError = false;
                    if (this.previewUrl) { URL.revokeObjectURL(this.previewUrl); this.previewUrl = null; }
                    if (this.$refs.fileInputC) this.$refs.fileInputC.value = '';
                },

                formatBytes(bytes, p = 2) {
                    if (bytes === 0) return '0 B';
                    const u = ['B','KB','MB','GB']; let i = 0, s = bytes;
                    while (s >= 1024 && i < u.length - 1) { s /= 1024; i++; }
                    return s.toFixed(p) + ' ' + u[i];
                },

                estimatedTime() {
                    if (!this.fileSize) return '—';
                    const sec = Math.max(1, Math.ceil(this.fileSize / (2 * 1024 * 1024) + 1));
                    if (sec <= 2) return '~1-2 seconds';
                    if (sec <= 5) return '~3-5 seconds';
                    return '~' + sec + ' seconds';
                },
            };
        }

        /* ─── CONVERT component ──────────────────────────────────────── */
        function converter() {
            return {
                cstate: 'idle',
                cisDragging: false,
                cerrorMessage: '',
                cfile: null,
                cfileName: '',
                cfileSize: 0,
                cfileType: '',
                ctargetFormat: '',
                cresult: {},
                cpreviewUrl: null,
                cuploadProgress: 0,

                initConv() {
                    document.addEventListener('paste', (event) => {
                        if (!isToolContextActive('convert')) return;
                        if (this.cstate === 'idle' || this.cstate === 'error') {
                            const items = event.clipboardData?.items;
                            if (!items) return;
                            for (let i = 0; i < items.length; i++) {
                                if (items[i].type.indexOf('image') !== -1) {
                                    event.preventDefault();
                                    const file = items[i].getAsFile();
                                    if (file) this.cProcessFile(file);
                                    break;
                                }
                            }
                        }
                    });
                },

                cHandleDrop(event) {
                    this.cisDragging = false;
                    const files = event.dataTransfer.files;
                    if (files.length > 0) this.cProcessFile(files[0]);
                },

                cHandleFileSelect(event) {
                    const files = event.target.files;
                    if (files.length > 0) this.cProcessFile(files[0]);
                },

                cProcessFile(file) {
                    this.cerrorMessage = '';
                    const allowedTypes = ['image/jpeg', 'image/png', 'image/webp', 'image/gif'];
                    if (!allowedTypes.includes(file.type)) {
                        this.cerrorMessage = 'Invalid file type. Please upload a JPG, PNG, WEBP, or GIF image.';
                        this.cstate = 'error'; return;
                    }
                    if (file.size > 20 * 1024 * 1024) {
                        this.cerrorMessage = 'File size exceeds 20MB. Please choose a smaller image.';
                        this.cstate = 'error'; return;
                    }
                    this.cfile = file;
                    this.cfileName = file.name;
                    this.cfileSize = file.size;
                    this.cfileType = file.type.split('/')[1];
                    if (this.cfileType === 'jpeg') this.cfileType = 'jpg';
                    const suggestions = { jpg: 'webp', png: 'webp', webp: 'jpg', gif: 'png' };
                    this.ctargetFormat = suggestions[this.cfileType] || 'jpg';
                    if (this.cpreviewUrl) URL.revokeObjectURL(this.cpreviewUrl);
                    this.cpreviewUrl = URL.createObjectURL(file);
                    this.cstate = 'settings';
                },

                async cconvert() {
                    if (!this.ctargetFormat) return;
                    this.cstate = 'processing';
                    this.cuploadProgress = 0;
                    this.cerrorMessage = '';
                    const csrf = document.querySelector('meta[name="csrf-token"]').content;

                    try {
                        // Small files (≤ 2MB): single direct upload
                        if (this.cfile.size <= 2 * 1024 * 1024) {
                            this.cuploadProgress = 40;
                            const formData = new FormData();
                            formData.append('image',  this.cfile);
                            formData.append('format', this.ctargetFormat);
                            const response = await fetch(window.__cp.xfm, {
                                method: 'POST',
                                headers: { 'X-CSRF-TOKEN': csrf, 'Accept': 'application/json' },
                                body: formData,
                            });
                            this.cuploadProgress = 90;
                            const data = await response.json();
                            if (!response.ok || !data.success) throw new Error(data.message || 'Conversion failed. Please try again.');
                            this.cuploadProgress = 100;
                            this.cresult = data;
                        } else {
                            // Large files: chunked upload then finalize
                            const { uploadId, totalChunks } = await uploadInChunks(this.cfile, p => { this.cuploadProgress = p; });
                            this.cuploadProgress = 85;
                            const fd = new FormData();
                            fd.append('upload_id',     uploadId);
                            fd.append('total_chunks',  totalChunks);
                            fd.append('original_name', this.cfile.name);
                            fd.append('action',        'convert');
                            fd.append('format',        this.ctargetFormat);
                            const response = await fetch(window.__cp.done, {
                                method: 'POST',
                                headers: { 'X-CSRF-TOKEN': csrf, 'Accept': 'application/json' },
                                body: fd,
                            });
                            this.cuploadProgress = 100;
                            const data = await response.json();
                            if (!response.ok || !data.success) throw new Error(data.message || 'Conversion failed. Please try again.');
                            this.cresult = data;
                        }
                        this.cstate = 'result';
                    } catch (error) {
                        this.cerrorMessage = error.message || 'An unexpected error occurred.';
                        this.cstate = 'error';
                    }
                },

                creset() {
                    this.cstate = 'idle'; this.cfile = null; this.cfileName = ''; this.cfileSize = 0;
                    this.cfileType = ''; this.ctargetFormat = ''; this.cresult = ''; this.cerrorMessage = '';
                    this.cuploadProgress = 0;
                    if (this.cpreviewUrl) { URL.revokeObjectURL(this.cpreviewUrl); this.cpreviewUrl = null; }
                    if (this.$refs.fileInputV) this.$refs.fileInputV.value = '';
                },

                cformatBytes(bytes, p = 2) {
                    if (bytes === 0) return '0 B';
                    const u = ['B','KB','MB','GB']; let i = 0, s = bytes;
                    while (s >= 1024 && i < u.length - 1) { s /= 1024; i++; }
                    return s.toFixed(p) + ' ' + u[i];
                },
            };
        }

        /* ─── Batch Compressor ───────────────────────────────────────── */
        function batchCompressor() {
            return {
                bstate: 'idle',
                bfiles: [],
                bquality: 50,
                bisDragging: false,
                berrorMessage: '',
                bresults: {},
                buploadProgress: 0,     // 0-100 across all files
                bCurrentFile: '',        // name of file being uploaded

                initBatch() {
                    document.addEventListener('paste', (event) => {
                        if (!isToolContextActive('batch')) return;
                        if (!['idle', 'settings', 'error'].includes(this.bstate)) return;
                        const items = event.clipboardData?.items;
                        if (!items) return;
                        const pastedFiles = [];
                        for (let i = 0; i < items.length; i++) {
                            if (items[i].type.indexOf('image') !== -1) {
                                const file = items[i].getAsFile();
                                if (file) pastedFiles.push(file);
                            }
                        }
                        if (pastedFiles.length) {
                            event.preventDefault();
                            this.bAddFiles(pastedFiles);
                        }
                    });
                },

                get bTotalSize() {
                    return this.bfiles.reduce((s, f) => s + f.size, 0);
                },
                get bTotalSaved() {
                    if (!this.bresults.results) return 0;
                    return this.bresults.results.reduce((s, r) => {
                        if (r.success) return s + (r.original_size - r.compressed_size);
                        return s;
                    }, 0);
                },
                get bAvgReduction() {
                    if (!this.bresults.results) return 0;
                    const ok = this.bresults.results.filter(r => r.success);
                    if (!ok.length) return 0;
                    return Math.round(ok.reduce((s, r) => s + r.reduction, 0) / ok.length);
                },

                bHandleDrop(e) {
                    this.bisDragging = false;
                    const files = Array.from(e.dataTransfer.files || []);
                    this.bAddFiles(files);
                },
                bHandleFileSelect(e) {
                    const files = Array.from(e.target.files || []);
                    this.bAddFiles(files);
                    e.target.value = '';
                },
                bAddFiles(files) {
                    const allowed = ['image/jpeg','image/png','image/webp','image/gif'];
                    const valid = files.filter(f => allowed.includes(f.type) && f.size <= 20 * 1024 * 1024);
                    if (!valid.length) { this.berrorMessage = 'No valid images found (JPG/PNG/WebP/GIF, max 20MB each).'; return; }
                    const combined = [...this.bfiles, ...valid].slice(0, 20);
                    if (this.bfiles.length + valid.length > 20) {
                        this.berrorMessage = 'Maximum 20 files allowed. Only the first 20 were kept.';
                    } else {
                        this.berrorMessage = '';
                    }
                    this.bfiles = combined;
                    this.bstate = 'settings';
                },

                async bCompress() {
                    if (!this.bfiles.length) return;
                    this.bstate = 'processing';
                    this.berrorMessage = '';
                    this.buploadProgress = 0;
                    this.bCurrentFile = '';
                    const csrf = document.querySelector('meta[name="csrf-token"]').content;
                    const total = this.bfiles.length;
                    const manifests = [];

                    // Upload every file in chunks individually — no single POST ever holds file bytes
                    for (let idx = 0; idx < total; idx++) {
                        const file = this.bfiles[idx];
                        this.bCurrentFile = file.name;
                        try {
                            const { uploadId, totalChunks } = await uploadInChunks(
                                file,
                                p => {
                                    // Overall progress: each file gets an equal slice of 0-90%
                                    this.buploadProgress = Math.round(
                                        ((idx + p / 100) / total) * 90
                                    );
                                },
                                window.__cp.t2seg
                            );
                            manifests.push({
                                upload_id:     uploadId,
                                total_chunks:  totalChunks,
                                original_name: file.name,
                            });
                        } catch (err) {
                            // Record a failed entry and keep going for remaining files
                            manifests.push({ upload_id: '', total_chunks: 0, original_name: file.name, _failed: true });
                        }
                    }

                    this.buploadProgress = 92;
                    this.bCurrentFile = 'Compressing…';

                    // Filter out locally-failed uploads before sending
                    const valid = manifests.filter(m => !m._failed);
                    if (!valid.length) {
                        this.berrorMessage = 'All file uploads failed. Please try again.';
                        this.bstate = 'error';
                        return;
                    }

                    try {
                        // Finalize: server assembles each uploaded ID and compresses it
                        const body = new URLSearchParams();
                        body.append('quality', this.bquality);
                        valid.forEach((m, i) => {
                            body.append(`files[${i}][upload_id]`,     m.upload_id);
                            body.append(`files[${i}][total_chunks]`,  m.total_chunks);
                            body.append(`files[${i}][original_name]`, m.original_name);
                        });
                        const res = await fetch(window.__cp.btchf, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': csrf,
                                'Content-Type': 'application/x-www-form-urlencoded',
                            },
                            body: body.toString(),
                        });
                        const data = await res.json();
                        if (!res.ok) throw new Error(data.message || 'Batch compression failed.');
                        this.buploadProgress = 100;
                        this.bresults = data;
                        this.bstate = 'result';
                    } catch (err) {
                        this.berrorMessage = err.message || 'An error occurred.';
                        this.bstate = 'error';
                    }
                },

                async bDownloadZip() {
                    if (!this.bresults.filenames || !this.bresults.filenames.length) return;
                    const fd = new FormData();
                    this.bresults.filenames.forEach(fn => fd.append('filenames[]', fn));
                    fd.append('batch_id', this.bresults.batch_id || '');
                    try {
                        const res = await fetch(window.__cp.bzip, {
                            method: 'POST',
                            headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content },
                            body: fd,
                        });
                        if (!res.ok) { const d = await res.json(); throw new Error(d.message || 'ZIP error.'); }
                        const blob = await res.blob();
                        const url = URL.createObjectURL(blob);
                        const a = document.createElement('a');
                        a.href = url; a.download = 'compresslypro-batch.zip'; a.click();
                        setTimeout(() => URL.revokeObjectURL(url), 5000);
                    } catch (err) {
                        this.berrorMessage = err.message || 'Could not download ZIP.';
                    }
                },

                bReset() {
                    this.bstate = 'idle'; this.bfiles = []; this.bresults = {};
                    this.berrorMessage = ''; this.bquality = 50;
                    this.buploadProgress = 0; this.bCurrentFile = '';
                },

                bFormatBytes(bytes, p = 1) {
                    if (!bytes || bytes === 0) return '0 B';
                    const u = ['B','KB','MB','GB']; let i = 0, s = bytes;
                    while (s >= 1024 && i < u.length - 1) { s /= 1024; i++; }
                    return s.toFixed(p) + ' ' + u[i];
                },
            };
        }

        /* ─── Resizer ────────────────────────────────────────────────── */
        function resizer() {
            return {
                rstate: 'idle',
                rfile: null,
                rfileName: '',
                rfileSize: 0,
                rmode: 'max_width',
                rwidth: 1920,
                rheight: 1080,
                rpercentage: 50,
                rquality: 85,
                rformat: 'original',
                rresult: {},
                rerrorMessage: '',
                risDragging: false,
                rpreviewUrl: null,
                rorigW: 0,
                rorigH: 0,
                ruploadProgress: 0,

                initResize() {
                    document.addEventListener('paste', (event) => {
                        if (!isToolContextActive('resize')) return;
                        if (!['idle', 'error'].includes(this.rstate)) return;
                        const items = event.clipboardData?.items;
                        if (!items) return;
                        for (let i = 0; i < items.length; i++) {
                            if (items[i].type.indexOf('image') !== -1) {
                                event.preventDefault();
                                const file = items[i].getAsFile();
                                if (file) this.rSetFile(file);
                                break;
                            }
                        }
                    });
                },

                rHandleDrop(e) {
                    this.risDragging = false;
                    const file = (e.dataTransfer.files || [])[0];
                    if (file) this.rSetFile(file);
                },
                rHandleFileSelect(e) {
                    const file = (e.target.files || [])[0];
                    if (file) { this.rSetFile(file); e.target.value = ''; }
                },
                rSetFile(file) {
                    const allowed = ['image/jpeg','image/png','image/webp','image/gif'];
                    if (!allowed.includes(file.type)) { this.rerrorMessage = 'Only JPG, PNG, WebP, GIF supported.'; this.rstate = 'error'; return; }
                    if (file.size > 20 * 1024 * 1024) { this.rerrorMessage = 'File too large (max 20MB).'; this.rstate = 'error'; return; }
                    this.rerrorMessage = '';
                    this.rfile = file;
                    this.rfileName = file.name;
                    this.rfileSize = file.size;
                    if (this.rpreviewUrl) URL.revokeObjectURL(this.rpreviewUrl);
                    this.rpreviewUrl = URL.createObjectURL(file);
                    const img = new Image();
                    img.onload = () => { this.rorigW = img.naturalWidth; this.rorigH = img.naturalHeight; };
                    img.src = this.rpreviewUrl;
                    this.rstate = 'settings';
                },

                async rResize() {
                    if (!this.rfile) return;
                    this.rstate = 'processing';
                    this.rerrorMessage = '';
                    this.ruploadProgress = 0;
                    const csrf = document.querySelector('meta[name="csrf-token"]').content;
                    try {
                        let data;
                        if (this.rfile.size <= 2 * 1024 * 1024) {
                            // Small file: direct POST
                            const fd = new FormData();
                            fd.append('image', this.rfile);
                            fd.append('mode', this.rmode);
                            fd.append('quality', this.rquality);
                            fd.append('format', this.rformat);
                            if (this.rmode === 'percentage') { fd.append('percentage', this.rpercentage); }
                            else if (this.rmode === 'max_width') { fd.append('width', this.rwidth); }
                            else if (this.rmode === 'max_height') { fd.append('height', this.rheight); }
                            else if (this.rmode === 'exact') { fd.append('width', this.rwidth); fd.append('height', this.rheight); }
                            const res = await fetch(window.__cp.rsz, {
                                method: 'POST',
                                headers: { 'X-CSRF-TOKEN': csrf },
                                body: fd,
                            });
                            data = await res.json();
                            if (!res.ok) throw new Error(data.message || 'Resize failed.');
                        } else {
                            // Large file: chunked upload then finalize
                            const { uploadId, totalChunks } = await uploadInChunks(
                                this.rfile,
                                p => { this.ruploadProgress = p; },
                                window.__cp.t2seg
                            );
                            this.ruploadProgress = 85;
                            const fd = new FormData();
                            fd.append('upload_id', uploadId);
                            fd.append('total_chunks', totalChunks);
                            fd.append('original_name', this.rfile.name);
                            fd.append('action', 'resize');
                            fd.append('mode', this.rmode);
                            fd.append('quality', this.rquality);
                            fd.append('format', this.rformat);
                            if (this.rmode === 'percentage') { fd.append('percentage', this.rpercentage); }
                            else if (this.rmode === 'max_width') { fd.append('width', this.rwidth); }
                            else if (this.rmode === 'max_height') { fd.append('height', this.rheight); }
                            else if (this.rmode === 'exact') { fd.append('width', this.rwidth); fd.append('height', this.rheight); }
                            const res = await fetch(window.__cp.t2don, {
                                method: 'POST',
                                headers: { 'X-CSRF-TOKEN': csrf },
                                body: fd,
                            });
                            data = await res.json();
                            if (!res.ok) throw new Error(data.message || 'Resize failed.');
                            this.ruploadProgress = 100;
                        }
                        this.rresult = data;
                        this.rstate = 'result';
                    } catch (err) {
                        this.rerrorMessage = err.message || 'An error occurred.';
                        this.rstate = 'error';
                    }
                },

                rReset() {
                    this.rstate = 'idle'; this.rfile = null; this.rfileName = '';
                    this.rfileSize = 0; this.rresult = {}; this.rerrorMessage = '';
                    this.rorigW = 0; this.rorigH = 0; this.ruploadProgress = 0;
                    if (this.rpreviewUrl) { URL.revokeObjectURL(this.rpreviewUrl); this.rpreviewUrl = null; }
                },

                rformatBytes(bytes, p = 1) {
                    if (!bytes || bytes === 0) return '0 B';
                    const u = ['B','KB','MB','GB']; let i = 0, s = bytes;
                    while (s >= 1024 && i < u.length - 1) { s /= 1024; i++; }
                    return s.toFixed(p) + ' ' + u[i];
                },
            };
        }

        /* ─── Watermark Tool ─────────────────────────────────────────── */
        function watermarkTool() {
            return {
                wstate: 'idle',
                wfile: null,
                wfileName: '',
                wtext: '',
                wposition: 'bottom-right',
                wopacity: 70,
                wfontSize: 36,
                wfontFamily: 'arial',
                wcolor: '#ffffff',
                wrotation: 0,
                wmode: 'single',
                wtileSpacing: 150,
                wresult: {},
                werrorMessage: '',
                wuploadProgress: 0,
                wpositions: [
                    { value: 'top-left',      label: '↖ Top Left' },
                    { value: 'top-center',    label: '↑ Top Center' },
                    { value: 'top-right',     label: '↗ Top Right' },
                    { value: 'middle-left',   label: '← Mid Left' },
                    { value: 'center',        label: '⊙ Center' },
                    { value: 'middle-right',  label: '→ Mid Right' },
                    { value: 'bottom-left',   label: '↙ Bot Left' },
                    { value: 'bottom-center', label: '↓ Bot Center' },
                    { value: 'bottom-right',  label: '↘ Bot Right' },
                ],
                wrotations: [
                    { value: 0,   label: '0°' },
                    { value: -30, label: '-30°' },
                    { value: -45, label: '-45°' },
                    { value: -60, label: '-60°' },
                ],
                initWatermark() {
                    document.addEventListener('paste', (event) => {
                        if (!isToolContextActive('tools') && !isToolContextActive('watermark')) return;
                        if (!['idle', 'error'].includes(this.wstate)) return;
                        const items = event.clipboardData?.items;
                        if (!items) return;
                        for (let i = 0; i < items.length; i++) {
                            if (items[i].type.indexOf('image') !== -1) {
                                event.preventDefault();
                                const file = items[i].getAsFile();
                                if (file) this.wHandleFile({ target: { files: [file] } });
                                break;
                            }
                        }
                    });
                },
                wHandleFile(e) {
                    const file = (e.target.files || [])[0];
                    if (!file) return;
                    const ok = ['image/jpeg','image/png','image/webp'];
                    if (!ok.includes(file.type)) { this.werrorMessage = 'Only JPG/PNG/WebP supported.'; return; }
                    if (file.size > 20 * 1024 * 1024) { this.werrorMessage = 'Max 20MB.'; return; }
                    this.werrorMessage = ''; this.wfile = file; this.wfileName = file.name;
                    this.wstate = 'settings';
                    e.target.value = '';
                },
                async wApply() {
                    if (!this.wfile || !this.wtext.trim()) return;
                    this.wstate = 'processing';
                    this.wuploadProgress = 0;
                    const csrf = document.querySelector('meta[name="csrf-token"]').content;
                    // Strip # from color hex for backend
                    const colorHex = this.wcolor.replace('#', '');
                    try {
                        let data;
                        if (this.wfile.size <= 2 * 1024 * 1024) {
                            const fd = new FormData();
                            fd.append('image', this.wfile);
                            fd.append('text', this.wtext);
                            fd.append('position', this.wposition);
                            fd.append('opacity', this.wopacity);
                            fd.append('size', this.wfontSize);
                            fd.append('color', this.wcolor);
                            fd.append('font_family', this.wfontFamily);
                            fd.append('rotation', this.wrotation);
                            fd.append('wm_mode', this.wmode);
                            fd.append('tile_spacing', this.wtileSpacing);
                            const res = await fetch(window.__cp.wmk, {
                                method: 'POST',
                                headers: { 'X-CSRF-TOKEN': csrf },
                                body: fd,
                            });
                            data = await res.json();
                            if (!res.ok) throw new Error(data.message || 'Watermark failed.');
                        } else {
                            const { uploadId, totalChunks } = await uploadInChunks(
                                this.wfile,
                                p => { this.wuploadProgress = p; },
                                window.__cp.t2seg
                            );
                            this.wuploadProgress = 85;
                            const fd = new FormData();
                            fd.append('upload_id', uploadId);
                            fd.append('total_chunks', totalChunks);
                            fd.append('original_name', this.wfile.name);
                            fd.append('action', 'watermark');
                            fd.append('text', this.wtext);
                            fd.append('position', this.wposition);
                            fd.append('opacity', this.wopacity);
                            fd.append('size', this.wfontSize);
                            fd.append('color', this.wcolor);
                            fd.append('font_family', this.wfontFamily);
                            fd.append('rotation', this.wrotation);
                            fd.append('wm_mode', this.wmode);
                            fd.append('tile_spacing', this.wtileSpacing);
                            const res = await fetch(window.__cp.t2don, {
                                method: 'POST',
                                headers: { 'X-CSRF-TOKEN': csrf },
                                body: fd,
                            });
                            data = await res.json();
                            if (!res.ok) throw new Error(data.message || 'Watermark failed.');
                            this.wuploadProgress = 100;
                        }
                        this.wresult = data; this.wstate = 'result';
                    } catch (err) {
                        this.werrorMessage = err.message || 'Error applying watermark.';
                        this.wstate = 'settings';
                    }
                },
                wReset() {
                    this.wstate = 'idle'; this.wfile = null; this.wfileName = '';
                    this.wtext = ''; this.wresult = {}; this.werrorMessage = ''; this.wuploadProgress = 0;
                },
            };
        }

        /* ─── URL Compressor ─────────────────────────────────────────── */
        function urlCompressor() {
            return {
                ustate: 'idle',
                uurl: '',
                uquality: 50,
                uresult: {},
                uerrorMessage: '',
                initUrl() {
                    document.addEventListener('paste', (event) => {
                        if (!isToolContextActive('tools') && !isToolContextActive('url')) return;
                        if (!['idle', 'error'].includes(this.ustate)) return;
                        const text = event.clipboardData?.getData('text')?.trim();
                        if (!text) return;
                        if (/^https?:\/\//i.test(text)) {
                            this.uurl = text;
                        }
                    });
                },
                async uCompress() {
                    if (!this.uurl.trim()) return;
                    this.ustate = 'processing';
                    this.uerrorMessage = '';
                    const fd = new FormData();
                    fd.append('url', this.uurl);
                    fd.append('quality', this.uquality);
                    try {
                        const res = await fetch(window.__cp.urlp, {
                            method: 'POST',
                            headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content },
                            body: fd,
                        });
                        const data = await res.json();
                        if (!res.ok) throw new Error(data.message || 'URL compression failed.');
                        this.uresult = data; this.ustate = 'result';
                    } catch (err) {
                        this.uerrorMessage = err.message || 'An error occurred.';
                        this.ustate = 'error';
                    }
                },
                uReset() {
                    this.ustate = 'idle'; this.uurl = ''; this.uresult = {}; this.uerrorMessage = '';
                },
            };
        }

        /* ─── Image → PDF Tool ───────────────────────────────────────── */
        function imgToPdfTool() {
            return {
                pstate: 'idle',
                pfile: null,
                pfileName: '',
                ppageSize: 'A4',
                porientation: 'portrait',
                presult: {},
                perrorMessage: '',
                puploadProgress: 0,
                initImgToPdf() {
                    document.addEventListener('paste', (event) => {
                        if (!isToolContextActive('tools') && !isToolContextActive('img2pdf')) return;
                        if (!['idle', 'error'].includes(this.pstate)) return;
                        const items = event.clipboardData?.items;
                        if (!items) return;
                        for (let i = 0; i < items.length; i++) {
                            if (items[i].type.indexOf('image') !== -1) {
                                event.preventDefault();
                                const file = items[i].getAsFile();
                                if (file) this.pHandleFile({ target: { files: [file] } });
                                break;
                            }
                        }
                    });
                },
                pHandleFile(e) {
                    const file = (e.target.files || [])[0];
                    if (!file) return;
                    const ok = ['image/jpeg','image/png','image/webp'];
                    if (!ok.includes(file.type)) { this.perrorMessage = 'Only JPG/PNG/WebP supported.'; return; }
                    if (file.size > 20 * 1024 * 1024) { this.perrorMessage = 'Max 20MB.'; return; }
                    this.perrorMessage = ''; this.pfile = file; this.pfileName = file.name;
                    this.pstate = 'settings';
                    e.target.value = '';
                },
                async pConvert() {
                    if (!this.pfile) return;
                    this.pstate = 'processing';
                    this.puploadProgress = 0;
                    const csrf = document.querySelector('meta[name="csrf-token"]').content;
                    try {
                        let data;
                        if (this.pfile.size <= 2 * 1024 * 1024) {
                            // Small file: direct POST
                            const fd = new FormData();
                            fd.append('image', this.pfile);
                            fd.append('page_size', this.ppageSize);
                            fd.append('orientation', this.porientation);
                            const res = await fetch(window.__cp.i2p, {
                                method: 'POST',
                                headers: { 'X-CSRF-TOKEN': csrf },
                                body: fd,
                            });
                            data = await res.json();
                            if (!res.ok) throw new Error(data.message || 'PDF conversion failed.');
                        } else {
                            // Large file: chunked upload then finalize
                            const { uploadId, totalChunks } = await uploadInChunks(
                                this.pfile,
                                p => { this.puploadProgress = p; },
                                window.__cp.t2seg
                            );
                            this.puploadProgress = 85;
                            const fd = new FormData();
                            fd.append('upload_id', uploadId);
                            fd.append('total_chunks', totalChunks);
                            fd.append('original_name', this.pfile.name);
                            fd.append('action', 'img_to_pdf');
                            fd.append('page_size', this.ppageSize);
                            fd.append('orientation', this.porientation);
                            const res = await fetch(window.__cp.t2don, {
                                method: 'POST',
                                headers: { 'X-CSRF-TOKEN': csrf },
                                body: fd,
                            });
                            data = await res.json();
                            if (!res.ok) throw new Error(data.message || 'PDF conversion failed.');
                            this.puploadProgress = 100;
                        }
                        this.presult = data; this.pstate = 'result';
                    } catch (err) {
                        this.perrorMessage = err.message || 'An error occurred.';
                        this.pstate = 'error';
                    }
                },
                pReset() {
                    this.pstate = 'idle'; this.pfile = null; this.pfileName = '';
                    this.presult = {}; this.perrorMessage = ''; this.puploadProgress = 0;
                },
            };
        }

        /* ─── PDF → Image Tool ───────────────────────────────────────── */
        function pdfToImgTool() {
            return {
                pdfistate: 'idle',
                pdfifile: null,
                pdfifileName: '',
                pdfiformat: 'jpg',
                pdfidpi: 150,
                pdfiresult: {},
                pdfierrorMessage: '',
                pdfiuploadProgress: 0,
                initPdfToImg() {
                    document.addEventListener('paste', (event) => {
                        if (!isToolContextActive('tools') && !isToolContextActive('pdf2img')) return;
                        if (!['idle', 'error'].includes(this.pdfistate)) return;
                        const items = event.clipboardData?.items;
                        if (!items) return;
                        for (let i = 0; i < items.length; i++) {
                            if (items[i].type === 'application/pdf') {
                                event.preventDefault();
                                const file = items[i].getAsFile();
                                if (file) this.pdfiHandleFile({ target: { files: [file] } });
                                break;
                            }
                        }
                    });
                },
                pdfiHandleFile(e) {
                    const file = (e.target.files || [])[0];
                    if (!file) return;
                    if (file.type !== 'application/pdf') { this.pdfierrorMessage = 'Only PDF files supported.'; return; }
                    if (file.size > 20 * 1024 * 1024) { this.pdfierrorMessage = 'Max 20MB.'; return; }
                    this.pdfierrorMessage = ''; this.pdfifile = file; this.pdfifileName = file.name;
                    this.pdfistate = 'settings';
                    e.target.value = '';
                },
                async pdfiConvert() {
                    if (!this.pdfifile) return;
                    this.pdfistate = 'processing';
                    this.pdfiuploadProgress = 0;
                    const csrf = document.querySelector('meta[name="csrf-token"]').content;
                    try {
                        let data;
                        if (this.pdfifile.size <= 2 * 1024 * 1024) {
                            // Small file: direct POST
                            const fd = new FormData();
                            fd.append('pdf', this.pdfifile);
                            fd.append('format', this.pdfiformat);
                            fd.append('dpi', this.pdfidpi);
                            const res = await fetch(window.__cp.p2i, {
                                method: 'POST',
                                headers: { 'X-CSRF-TOKEN': csrf },
                                body: fd,
                            });
                            data = await res.json();
                            if (!res.ok) throw new Error(data.message || 'Conversion failed.');
                        } else {
                            // Large file: chunked upload then finalize
                            const { uploadId, totalChunks } = await uploadInChunks(
                                this.pdfifile,
                                p => { this.pdfiuploadProgress = p; },
                                window.__cp.t2seg
                            );
                            this.pdfiuploadProgress = 85;
                            const fd = new FormData();
                            fd.append('upload_id', uploadId);
                            fd.append('total_chunks', totalChunks);
                            fd.append('original_name', this.pdfifile.name);
                            fd.append('action', 'pdf_to_img');
                            fd.append('format', this.pdfiformat);
                            fd.append('dpi', this.pdfidpi);
                            const res = await fetch(window.__cp.t2don, {
                                method: 'POST',
                                headers: { 'X-CSRF-TOKEN': csrf },
                                body: fd,
                            });
                            data = await res.json();
                            if (!res.ok) throw new Error(data.message || 'Conversion failed.');
                            this.pdfiuploadProgress = 100;
                        }
                        this.pdfiresult = data; this.pdfistate = 'result';
                    } catch (err) {
                        this.pdfierrorMessage = err.message || 'An error occurred.';
                        this.pdfistate = 'error';
                    }
                },
                pdfiReset() {
                    this.pdfistate = 'idle'; this.pdfifile = null; this.pdfifileName = '';
                    this.pdfiresult = {}; this.pdfierrorMessage = ''; this.pdfiuploadProgress = 0;
                },
            };
        }
    </script>

