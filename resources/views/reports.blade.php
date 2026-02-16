<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compression Reports – ImageCompressor</title>
    <meta name="robots" content="noindex, nofollow">

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        brand:  { 50:'#eef2ff',100:'#e0e7ff',200:'#c7d2fe',300:'#a5b4fc',400:'#818cf8',500:'#6366f1',600:'#4f46e5',700:'#4338ca',800:'#3730a3',900:'#312e81' },
                        accent: { 50:'#ecfdf5',100:'#d1fae5',200:'#a7f3d0',300:'#6ee7b7',400:'#34d399',500:'#10b981',600:'#059669',700:'#047857',800:'#065f46',900:'#064e3b' },
                    },
                    fontFamily: {
                        sans: ['Inter', 'system-ui', '-apple-system', 'sans-serif'],
                    },
                }
            }
        }
    </script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        [x-cloak] { display: none !important; }
        .glass { backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px); }
        @keyframes slideUp { 0%{opacity:0;transform:translateY(20px)} 100%{opacity:1;transform:translateY(0)} }
        .animate-slide-up { animation: slideUp 0.5s ease-out; }
        @keyframes fadeIn { 0%{opacity:0} 100%{opacity:1} }
        .animate-fade-in { animation: fadeIn 0.4s ease-out; }
        .bar-animate { transition: width 0.8s cubic-bezier(0.4, 0, 0.2, 1); }
    </style>
</head>

<body class="bg-gray-50 dark:bg-gray-950 text-gray-900 dark:text-gray-100 font-sans min-h-screen transition-colors duration-300"
      x-data="reportsApp()" x-init="init()" :class="{ 'dark': darkMode }">

    {{-- Navigation --}}
    <nav class="bg-white/80 dark:bg-gray-900/80 glass border-b border-gray-200/60 dark:border-gray-800/60 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2.5 group">
                    <div class="w-9 h-9 bg-gradient-to-br from-brand-500 to-brand-700 rounded-xl flex items-center justify-center shadow-lg shadow-brand-500/20">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    </div>
                    <span class="text-lg font-bold bg-gradient-to-r from-brand-600 to-brand-800 dark:from-brand-400 dark:to-brand-300 bg-clip-text text-transparent">Admin Reports</span>
                </a>
                <div class="flex items-center gap-3">
                    <a href="{{ route('admin.dashboard') }}" class="hidden sm:flex items-center gap-1.5 text-sm font-medium text-gray-500 dark:text-gray-400 hover:text-brand-600 dark:hover:text-brand-400 transition-colors px-3 py-2 rounded-lg hover:bg-brand-50 dark:hover:bg-brand-900/20">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                        Back to Dashboard
                    </a>
                    <button x-on:click="darkMode = !darkMode; localStorage.setItem('darkMode', darkMode)"
                        class="p-2.5 rounded-xl bg-gray-100 dark:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700 transition-all"
                        aria-label="Toggle dark mode">
                        <svg x-show="!darkMode" class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/></svg>
                        <svg x-show="darkMode" x-cloak class="w-5 h-5 text-amber-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    {{-- Page Header --}}
    <header class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-8 pb-6">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-3xl font-extrabold tracking-tight">Compression Reports</h1>
                <p class="text-gray-500 dark:text-gray-400 mt-1">Track usage, savings, and performance metrics</p>
            </div>
            {{-- Period Selector --}}
            <div class="flex bg-white dark:bg-gray-900 rounded-xl border border-gray-200 dark:border-gray-800 p-1 gap-1">
                <template x-for="p in periods" :key="p.value">
                    <button x-on:click="period = p.value; fetchData()"
                        :class="period === p.value ? 'bg-brand-600 text-white shadow-md' : 'text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800'"
                        class="px-3 py-1.5 rounded-lg text-xs font-semibold transition-all"
                        x-text="p.label">
                    </button>
                </template>
            </div>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-16" x-cloak>

        {{-- Loading State --}}
        <div x-show="loading" class="flex items-center justify-center py-20">
            <svg class="animate-spin w-8 h-8 text-brand-600" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-20" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="3"/>
                <path class="opacity-80" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"/>
            </svg>
        </div>

        {{-- Empty State --}}
        <div x-show="!loading && data && data.summary.total_compressions === 0" class="text-center py-20 animate-fade-in">
            <div class="w-20 h-20 bg-gray-100 dark:bg-gray-800 rounded-3xl flex items-center justify-center mx-auto mb-6">
                <svg class="w-10 h-10 text-gray-300 dark:text-gray-600" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z"/></svg>
            </div>
            <h3 class="text-xl font-bold mb-2">No Data Yet</h3>
            <p class="text-gray-500 dark:text-gray-400 mb-6">Compress some images to see reports here</p>
            <a href="{{ route('home') }}" class="inline-flex items-center gap-2 bg-brand-600 hover:bg-brand-700 text-white font-semibold px-5 py-2.5 rounded-xl transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                Compress an Image
            </a>
        </div>

        {{-- Dashboard Content --}}
        <div x-show="!loading && data && data.summary.total_compressions > 0" class="space-y-6 animate-slide-up">

            {{-- Summary Cards --}}
            <div class="grid grid-cols-2 lg:grid-cols-5 gap-4">
                <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200/60 dark:border-gray-800/60 p-5 shadow-sm">
                    <div class="flex items-center gap-2 mb-3">
                        <div class="w-8 h-8 bg-brand-50 dark:bg-brand-900/30 rounded-lg flex items-center justify-center">
                            <svg class="w-4 h-4 text-brand-600 dark:text-brand-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        </div>
                        <span class="text-xs font-medium text-gray-400 dark:text-gray-500">Total Compressions</span>
                    </div>
                    <p class="text-2xl font-extrabold" x-text="data.summary.total_compressions"></p>
                </div>
                <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200/60 dark:border-gray-800/60 p-5 shadow-sm">
                    <div class="flex items-center gap-2 mb-3">
                        <div class="w-8 h-8 bg-orange-50 dark:bg-orange-900/30 rounded-lg flex items-center justify-center">
                            <svg class="w-4 h-4 text-orange-600 dark:text-orange-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/></svg>
                        </div>
                        <span class="text-xs font-medium text-gray-400 dark:text-gray-500">Total Uploaded</span>
                    </div>
                    <p class="text-2xl font-extrabold" x-text="data.summary.total_original_size"></p>
                </div>
                <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200/60 dark:border-gray-800/60 p-5 shadow-sm">
                    <div class="flex items-center gap-2 mb-3">
                        <div class="w-8 h-8 bg-accent-50 dark:bg-accent-900/30 rounded-lg flex items-center justify-center">
                            <svg class="w-4 h-4 text-accent-600 dark:text-accent-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <span class="text-xs font-medium text-gray-400 dark:text-gray-500">After Compression</span>
                    </div>
                    <p class="text-2xl font-extrabold text-accent-600 dark:text-accent-400" x-text="data.summary.total_compressed"></p>
                </div>
                <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200/60 dark:border-gray-800/60 p-5 shadow-sm">
                    <div class="flex items-center gap-2 mb-3">
                        <div class="w-8 h-8 bg-green-50 dark:bg-green-900/30 rounded-lg flex items-center justify-center">
                            <svg class="w-4 h-4 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
                        </div>
                        <span class="text-xs font-medium text-gray-400 dark:text-gray-500">Total Saved</span>
                    </div>
                    <p class="text-2xl font-extrabold text-green-600 dark:text-green-400" x-text="data.summary.total_saved"></p>
                </div>
                <div class="col-span-2 lg:col-span-1 bg-gradient-to-br from-brand-600 to-brand-700 rounded-2xl p-5 shadow-lg shadow-brand-500/20 text-white">
                    <div class="flex items-center gap-2 mb-3">
                        <div class="w-8 h-8 bg-white/20 rounded-lg flex items-center justify-center">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>
                        </div>
                        <span class="text-xs font-medium text-white/70">Avg Reduction</span>
                    </div>
                    <p class="text-2xl font-extrabold" x-text="data.summary.avg_reduction"></p>
                </div>
            </div>

            {{-- Charts Row --}}
            <div class="grid lg:grid-cols-2 gap-6">

                {{-- Daily Activity Chart (CSS only) --}}
                <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200/60 dark:border-gray-800/60 p-6 shadow-sm">
                    <h3 class="font-bold text-lg mb-4">Daily Activity</h3>
                    <div x-show="data.daily_stats.length > 0" class="space-y-2">
                        <template x-for="(day, idx) in data.daily_stats.slice(-10)" :key="idx">
                            <div class="flex items-center gap-3">
                                <span class="text-xs text-gray-400 dark:text-gray-500 w-20 flex-shrink-0 font-mono" x-text="day.date.substring(5)"></span>
                                <div class="flex-1 bg-gray-100 dark:bg-gray-800 rounded-full h-6 overflow-hidden relative">
                                    <div class="h-full rounded-full bg-gradient-to-r from-brand-400 to-brand-600 bar-animate flex items-center justify-end pr-2"
                                         :style="'width:' + Math.max(8, (day.count / Math.max(...data.daily_stats.map(d=>d.count))) * 100) + '%'">
                                        <span class="text-xs font-bold text-white" x-text="day.count"></span>
                                    </div>
                                </div>
                            </div>
                        </template>
                    </div>
                    <p x-show="data.daily_stats.length === 0" class="text-gray-400 text-sm text-center py-8">No activity in this period</p>
                </div>

                {{-- Format Distribution --}}
                <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200/60 dark:border-gray-800/60 p-6 shadow-sm">
                    <h3 class="font-bold text-lg mb-4">Format Distribution</h3>
                    <div class="grid grid-cols-2 gap-4">
                        {{-- Input Formats --}}
                        <div>
                            <p class="text-xs font-semibold text-gray-400 dark:text-gray-500 uppercase tracking-wider mb-3">Input Formats</p>
                            <div class="space-y-3">
                                <template x-for="(fmt, idx) in data.format_stats" :key="'in-'+idx">
                                    <div>
                                        <div class="flex justify-between text-sm mb-1">
                                            <span class="font-semibold text-gray-900 dark:text-gray-100" x-text="fmt.original_format.toUpperCase()"></span>
                                            <span class="text-gray-400 dark:text-gray-500" x-text="fmt.count"></span>
                                        </div>
                                        <div class="w-full bg-gray-100 dark:bg-gray-800 rounded-full h-2">
                                            <div class="h-2 rounded-full bg-brand-500 bar-animate" :style="'width:' + Math.max(5, (fmt.count / data.summary.total_compressions) * 100) + '%'"></div>
                                        </div>
                                    </div>
                                </template>
                            </div>
                        </div>
                        {{-- Output Formats --}}
                        <div>
                            <p class="text-xs font-semibold text-gray-400 dark:text-gray-500 uppercase tracking-wider mb-3">Output Formats</p>
                            <div class="space-y-3">
                                <template x-for="(fmt, idx) in data.output_format_stats" :key="'out-'+idx">
                                    <div>
                                        <div class="flex justify-between text-sm mb-1">
                                            <span class="font-semibold text-gray-900 dark:text-gray-100" x-text="fmt.output_format.toUpperCase()"></span>
                                            <span class="text-gray-400 dark:text-gray-500" x-text="fmt.count"></span>
                                        </div>
                                        <div class="w-full bg-gray-100 dark:bg-gray-800 rounded-full h-2">
                                            <div class="h-2 rounded-full bg-accent-500 bar-animate" :style="'width:' + Math.max(5, (fmt.count / data.summary.total_compressions) * 100) + '%'"></div>
                                        </div>
                                    </div>
                                </template>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Quality Distribution & Top Savings --}}
            <div class="grid lg:grid-cols-2 gap-6">
                <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200/60 dark:border-gray-800/60 p-6 shadow-sm">
                    <h3 class="font-bold text-lg mb-4">Quality Preferences</h3>
                    <div class="space-y-4">
                        <template x-for="(q, idx) in data.quality_stats" :key="'q-'+idx">
                            <div>
                                <div class="flex justify-between text-sm mb-1.5">
                                    <span class="font-medium text-gray-900 dark:text-gray-100" x-text="q.quality_range"></span>
                                    <span class="text-gray-400 dark:text-gray-500 font-semibold" x-text="q.count + ' uses'"></span>
                                </div>
                                <div class="w-full bg-gray-100 dark:bg-gray-800 rounded-full h-3">
                                    <div class="h-3 rounded-full bg-gradient-to-r from-purple-400 to-purple-600 bar-animate" :style="'width:' + Math.max(5, (q.count / data.summary.total_compressions) * 100) + '%'"></div>
                                </div>
                            </div>
                        </template>
                    </div>
                    <p x-show="data.quality_stats.length === 0" class="text-gray-400 dark:text-gray-500 text-sm text-center py-6">No data available</p>
                </div>

                <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200/60 dark:border-gray-800/60 p-6 shadow-sm">
                    <h3 class="font-bold text-lg mb-4">🏆 Top Savings</h3>
                    <div class="space-y-3">
                        <template x-for="(item, idx) in data.top_savings" :key="'top-'+idx">
                            <div class="flex items-center gap-3 p-3 bg-gray-50 dark:bg-gray-800/50 rounded-xl">
                                <div class="w-8 h-8 bg-accent-100 dark:bg-accent-900/30 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <span class="text-sm font-bold text-accent-600 dark:text-accent-400" x-text="'#' + (idx + 1)"></span>
                                </div>
                                <div class="min-w-0 flex-1">
                                    <p class="text-sm font-semibold text-gray-900 dark:text-gray-100 truncate" x-text="item.original_name"></p>
                                    <p class="text-xs text-gray-400 dark:text-gray-500" x-text="'Saved ' + item.saved + ' (' + item.reduction + ')'"></p>
                                </div>
                            </div>
                        </template>
                    </div>
                    <p x-show="data.top_savings.length === 0" class="text-gray-400 dark:text-gray-500 text-sm text-center py-6">No data available</p>
                </div>
            </div>

            {{-- Recent Compressions Table --}}
            <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200/60 dark:border-gray-800/60 shadow-sm overflow-hidden">
                <div class="px-6 py-5 border-b border-gray-100 dark:border-gray-800">
                    <h3 class="font-bold text-lg">Recent Compressions</h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead class="bg-gray-50 dark:bg-gray-800/50">
                            <tr>
                                <th class="text-left px-6 py-3 font-semibold text-gray-500 dark:text-gray-400 text-xs uppercase tracking-wider">File</th>
                                <th class="text-left px-4 py-3 font-semibold text-gray-500 dark:text-gray-400 text-xs uppercase tracking-wider">Format</th>
                                <th class="text-right px-4 py-3 font-semibold text-gray-500 dark:text-gray-400 text-xs uppercase tracking-wider">Original</th>
                                <th class="text-right px-4 py-3 font-semibold text-gray-500 dark:text-gray-400 text-xs uppercase tracking-wider">Compressed</th>
                                <th class="text-right px-4 py-3 font-semibold text-gray-500 dark:text-gray-400 text-xs uppercase tracking-wider">Saved</th>
                                <th class="text-right px-4 py-3 font-semibold text-gray-500 dark:text-gray-400 text-xs uppercase tracking-wider">Quality</th>
                                <th class="text-right px-6 py-3 font-semibold text-gray-500 dark:text-gray-400 text-xs uppercase tracking-wider">When</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                            <template x-for="(row, idx) in data.recent" :key="'row-'+idx">
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors">
                                    <td class="px-6 py-3.5">
                                        <span class="font-medium text-gray-900 dark:text-gray-100 truncate block max-w-[200px]" x-text="row.original_name"></span>
                                        <span class="text-xs text-gray-400 dark:text-gray-500" x-text="row.dimensions"></span>
                                    </td>
                                    <td class="px-4 py-3.5">
                                        <span class="text-xs font-semibold bg-gray-100 dark:bg-gray-800 text-gray-900 dark:text-gray-100 px-2 py-1 rounded" x-text="row.original_format + ' → ' + row.output_format"></span>
                                    </td>
                                    <td class="px-4 py-3.5 text-right font-mono text-gray-500 dark:text-gray-400" x-text="row.original_size"></td>
                                    <td class="px-4 py-3.5 text-right font-mono text-accent-600 dark:text-accent-400" x-text="row.compressed_size"></td>
                                    <td class="px-4 py-3.5 text-right font-bold text-green-600 dark:text-green-400" x-text="row.reduction"></td>
                                    <td class="px-4 py-3.5 text-right text-gray-500 dark:text-gray-400" x-text="row.quality"></td>
                                    <td class="px-6 py-3.5 text-right text-gray-400 dark:text-gray-500 text-xs" x-text="row.created_at" :title="row.created_date"></td>
                                </tr>
                            </template>
                        </tbody>
                    </table>
                </div>
                <p x-show="data.recent.length === 0" class="text-gray-400 dark:text-gray-500 text-sm text-center py-8">No compressions yet</p>
            </div>

        </div>
    </main>

    {{-- Footer --}}
    <footer class="bg-white dark:bg-gray-900 border-t border-gray-200/60 dark:border-gray-800/60 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-sm text-gray-400 dark:text-gray-500">
            <p>&copy; {{ date('Y') }} ImageCompressor Admin Panel · <a href="{{ route('admin.dashboard') }}" class="hover:text-brand-600 dark:hover:text-brand-400 transition-colors">Back to Dashboard</a></p>
        </div>
    </footer>

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <script>
        function reportsApp() {
            return {
                darkMode: localStorage.getItem('darkMode') === 'true',
                loading: true,
                data: null,
                period: '7d',
                periods: [
                    { value: '24h', label: '24h' },
                    { value: '7d', label: '7 Days' },
                    { value: '30d', label: '30 Days' },
                    { value: '90d', label: '90 Days' },
                    { value: 'all', label: 'All Time' },
                ],

                init() {
                    if (localStorage.getItem('darkMode') === null) {
                        this.darkMode = window.matchMedia('(prefers-color-scheme: dark)').matches;
                        localStorage.setItem('darkMode', this.darkMode);
                    }
                    this.fetchData();
                },

                async fetchData() {
                    this.loading = true;
                    try {
                        const res = await fetch('{{ route("reports.data") }}?period=' + this.period);
                        this.data = await res.json();
                    } catch (e) {
                        console.error('Failed to load reports:', e);
                    }
                    this.loading = false;
                }
            };
        }
    </script>
</body>
</html>
