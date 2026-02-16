<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Compression Reports – Admin Panel</title>
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
    
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>

    <style>
        [x-cloak] { display: none !important; }
        .glass { backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px); }
        @keyframes slideUp { 0%{opacity:0;transform:translateY(20px)} 100%{opacity:1;transform:translateY(0)} }
        .animate-slide-up { animation: slideUp 0.5s ease-out; }
        @keyframes pulse-subtle { 0%, 100% { opacity: 1; } 50% { opacity: 0.8; } }
        .animate-pulse-subtle { animation: pulse-subtle 2s cubic-bezier(0.4, 0, 0.6, 1) infinite; }
    </style>
</head>

<body class="bg-gray-50 dark:bg-gray-950 text-gray-900 dark:text-gray-100 font-sans min-h-screen transition-colors duration-300"
      x-data="reportsApp()" 
      x-init="$watch('darkMode', val => localStorage.setItem('darkMode', val)); loadData()"
      :class="{ 'dark': darkMode }">

    {{-- Navigation --}}
    <nav class="bg-white/80 dark:bg-gray-900/80 glass border-b border-gray-200/60 dark:border-gray-800/60 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <div class="flex items-center gap-4">
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2.5 group">
                        <div class="w-9 h-9 bg-gradient-to-br from-brand-500 to-brand-700 rounded-xl flex items-center justify-center shadow-lg shadow-brand-500/20">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                        </div>
                        <span class="text-lg font-bold bg-gradient-to-r from-brand-600 to-brand-800 dark:from-brand-400 dark:to-brand-300 bg-clip-text text-transparent">Compression Reports</span>
                    </a>
                </div>
                <div class="flex items-center gap-3">
                    <a href="{{ route('admin.dashboard') }}" class="hidden sm:flex items-center gap-1.5 text-sm font-medium text-gray-500 dark:text-gray-400 hover:text-brand-600 dark:hover:text-brand-400 transition-colors px-3 py-2 rounded-lg hover:bg-brand-50 dark:hover:bg-brand-900/20">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                        Back to Dashboard
                    </a>
                    <button x-on:click="darkMode = !darkMode"
                        class="p-2.5 rounded-xl bg-gray-100 dark:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700 transition-all"
                        aria-label="Toggle dark mode">
                        <svg x-show="!darkMode" class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/></svg>
                        <svg x-show="darkMode" x-cloak class="w-5 h-5 text-amber-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        
        {{-- Period Filter --}}
        <div class="mb-6 flex flex-wrap items-center gap-3">
            <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Time Period:</span>
            <template x-for="option in periodOptions" :key="option.value">
                <button 
                    x-on:click="period = option.value; loadData()"
                    :class="period === option.value ? 'bg-brand-600 text-white' : 'bg-white dark:bg-gray-900 text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-800'"
                    class="px-4 py-2 rounded-lg text-sm font-medium transition-all border border-gray-200 dark:border-gray-700"
                    x-text="option.label">
                </button>
            </template>
            <div x-show="loading" x-cloak class="ml-auto">
                <div class="flex items-center gap-2 text-sm text-gray-500 dark:text-gray-400">
                    <svg class="animate-spin h-4 w-4" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    Loading...
                </div>
            </div>
        </div>

        {{-- Summary Cards --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4 mb-8 animate-slide-up">
            <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200/60 dark:border-gray-800/60 p-5">
                <div class="flex items-center justify-between mb-2">
                    <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Compressions</h3>
                    <div class="w-8 h-8 bg-brand-100 dark:bg-brand-900/30 rounded-lg flex items-center justify-center">
                        <svg class="w-4 h-4 text-brand-600 dark:text-brand-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/></svg>
                    </div>
                </div>
                <p class="text-2xl font-bold text-gray-900 dark:text-gray-100" x-text="data.summary?.total_compressions || 0"></p>
            </div>

            <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200/60 dark:border-gray-800/60 p-5">
                <div class="flex items-center justify-between mb-2">
                    <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Original Size</h3>
                    <div class="w-8 h-8 bg-purple-100 dark:bg-purple-900/30 rounded-lg flex items-center justify-center">
                        <svg class="w-4 h-4 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4"/></svg>
                    </div>
                </div>
                <p class="text-2xl font-bold text-gray-900 dark:text-gray-100" x-text="data.summary?.total_original_size || '0 B'"></p>
            </div>

            <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200/60 dark:border-gray-800/60 p-5">
                <div class="flex items-center justify-between mb-2">
                    <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Compressed</h3>
                    <div class="w-8 h-8 bg-blue-100 dark:bg-blue-900/30 rounded-lg flex items-center justify-center">
                        <svg class="w-4 h-4 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                    </div>
                </div>
                <p class="text-2xl font-bold text-gray-900 dark:text-gray-100" x-text="data.summary?.total_compressed || '0 B'"></p>
            </div>

            <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200/60 dark:border-gray-800/60 p-5">
                <div class="flex items-center justify-between mb-2">
                    <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Space Saved</h3>
                    <div class="w-8 h-8 bg-green-100 dark:bg-green-900/30 rounded-lg flex items-center justify-center">
                        <svg class="w-4 h-4 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                    </div>
                </div>
                <p class="text-2xl font-bold text-green-600 dark:text-green-400" x-text="data.summary?.total_saved || '0 B'"></p>
            </div>

            <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200/60 dark:border-gray-800/60 p-5">
                <div class="flex items-center justify-between mb-2">
                    <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Avg Reduction</h3>
                    <div class="w-8 h-8 bg-amber-100 dark:bg-amber-900/30 rounded-lg flex items-center justify-center">
                        <svg class="w-4 h-4 text-amber-600 dark:text-amber-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
                    </div>
                </div>
                <p class="text-2xl font-bold text-amber-600 dark:text-amber-400" x-text="data.summary?.avg_reduction || '0%'"></p>
            </div>
        </div>

        <div class="grid lg:grid-cols-2 gap-6 mb-6">
            {{-- Compressions Over Time Chart --}}
            <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200/60 dark:border-gray-800/60 p-6">
                <h3 class="text-lg font-bold mb-4 text-gray-900 dark:text-gray-100">Compressions Over Time</h3>
                <canvas id="dailyChart" height="250"></canvas>
            </div>

            {{-- Format Distribution --}}
            <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200/60 dark:border-gray-800/60 p-6">
                <h3 class="text-lg font-bold mb-4 text-gray-900 dark:text-gray-100">Format Distribution</h3>
                <canvas id="formatChart" height="250"></canvas>
            </div>
        </div>

        {{-- Recent Compressions Table --}}
        <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200/60 dark:border-gray-800/60 overflow-hidden">
            <div class="p-6 border-b border-gray-200 dark:border-gray-800">
                <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100">Recent Compressions</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Latest 20 compression activities</p>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 dark:bg-gray-800/50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wider">Image</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wider">Format</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wider">Original</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wider">Compressed</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wider">Reduction</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wider">Quality</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wider">Date</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-800">
                        <template x-if="!data.recent || data.recent.length === 0">
                            <tr>
                                <td colspan="7" class="px-6 py-12 text-center text-gray-500 dark:text-gray-400">
                                    <div class="flex flex-col items-center gap-2">
                                        <svg class="w-12 h-12 text-gray-300 dark:text-gray-700" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z"/></svg>
                                        <p>No compression reports yet</p>
                                        <a href="{{ route('home') }}" class="text-brand-600 dark:text-brand-400 text-sm hover:underline">Compress your first image</a>
                                    </div>
                                </td>
                            </tr>
                        </template>
                        <template x-for="report in data.recent" :key="report.id">
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors">
                                <td class="px-6 py-4 text-sm font-medium text-gray-900 dark:text-gray-100" x-text="report.original_name"></td>
                                <td class="px-6 py-4 text-sm">
                                    <span class="inline-flex items-center gap-1">
                                        <span class="px-2 py-0.5 bg-brand-100 dark:bg-brand-900/30 text-brand-700 dark:text-brand-300 rounded font-medium text-xs" x-text="report.original_format"></span>
                                        <svg class="w-3 h-3 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                                        <span class="px-2 py-0.5 bg-accent-100 dark:bg-accent-900/30 text-accent-700 dark:text-accent-300 rounded font-medium text-xs" x-text="report.output_format"></span>
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-400" x-text="report.original_size"></td>
                                <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-400" x-text="report.compressed_size"></td>
                                <td class="px-6 py-4 text-sm">
                                    <span class="inline-flex items-center gap-1 px-2 py-0.5 bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-300 rounded-full font-semibold" x-text="report.reduction"></span>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-400" x-text="report.quality"></td>
                                <td class="px-6 py-4 text-sm text-gray-500 dark:text-gray-400" x-text="report.created_at" :title="report.created_date"></td>
                            </tr>
                        </template>
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script>
        function reportsApp() {
            return {
                darkMode: localStorage.getItem('darkMode') === 'true' || window.matchMedia('(prefers-color-scheme: dark)').matches,
                period: '7d',
                periodOptions: [
                    { value: '24h', label: 'Last 24 Hours' },
                    { value: '7d', label: 'Last 7 Days' },
                    { value: '30d', label: 'Last 30 Days' },
                    { value: '90d', label: 'Last 90 Days' },
                    { value: 'all', label: 'All Time' }
                ],
                loading: false,
                data: {
                    summary: {},
                    daily_stats: [],
                    format_stats: [],
                    recent: []
                },
                dailyChart: null,
                formatChart: null,

                init() {
                    // Watch dark mode changes and update charts
                    this.$watch('darkMode', () => {
                        if (this.dailyChart || this.formatChart) {
                            setTimeout(() => {
                                this.updateDailyChart();
                                this.updateFormatChart();
                            }, 100);
                        }
                    });
                },

                async loadData() {
                    this.loading = true;
                    try {
                        const response = await fetch(`{{ route('reports.data') }}?period=${this.period}`);
                        const json = await response.json();
                        this.data = json;
                        
                        // Update charts
                        this.$nextTick(() => {
                            this.updateDailyChart();
                            this.updateFormatChart();
                        });
                    } catch (error) {
                        console.error('Failed to load data:', error);
                    } finally {
                        this.loading = false;
                    }
                },

                updateDailyChart() {
                    const ctx = document.getElementById('dailyChart');
                    if (!ctx) return;

                    const isDark = this.darkMode;
                    const textColor = isDark ? '#9ca3af' : '#6b7280';
                    const gridColor = isDark ? '#374151' : '#e5e7eb';

                    if (this.dailyChart) {
                        this.dailyChart.destroy();
                    }

                    const labels = this.data.daily_stats.map(d => d.date);
                    const counts = this.data.daily_stats.map(d => d.count);

                    this.dailyChart = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: labels,
                            datasets: [{
                                label: 'Compressions',
                                data: counts,
                                borderColor: '#6366f1',
                                backgroundColor: 'rgba(99, 102, 241, 0.1)',
                                fill: true,
                                tension: 0.4
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: { display: false }
                            },
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    ticks: { color: textColor },
                                    grid: { color: gridColor }
                                },
                                x: {
                                    ticks: { color: textColor },
                                    grid: { color: gridColor }
                                }
                            }
                        }
                    });
                },

                updateFormatChart() {
                    const ctx = document.getElementById('formatChart');
                    if (!ctx) return;

                    const isDark = this.darkMode;
                    const textColor = isDark ? '#9ca3af' : '#6b7280';

                    if (this.formatChart) {
                        this.formatChart.destroy();
                    }

                    const labels = this.data.format_stats.map(f => f.original_format.toUpperCase());
                    const counts = this.data.format_stats.map(f => f.count);
                    const colors = ['#6366f1', '#10b981', '#f59e0b', '#ef4444', '#8b5cf6'];

                    this.formatChart = new Chart(ctx, {
                        type: 'doughnut',
                        data: {
                            labels: labels,
                            datasets: [{
                                data: counts,
                                backgroundColor: colors.slice(0, labels.length),
                                borderWidth: 2,
                                borderColor: isDark ? '#1f2937' : '#ffffff'
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: {
                                    position: 'bottom',
                                    labels: { color: textColor, padding: 15 }
                                }
                            }
                        }
                    });
                }
            };
        }
    </script>
</body>
</html>
