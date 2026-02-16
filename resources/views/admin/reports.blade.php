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
                    fontFamily: { sans: ['Inter', 'system-ui', '-apple-system', 'sans-serif'] },
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
    </style>
</head>

<body class="min-h-screen font-sans transition-colors duration-300"
      x-data="reportsPage()"
      x-init="initApp()"
      :class="darkMode ? 'dark bg-gray-950 text-gray-100' : 'bg-gray-50 text-gray-900'">

    <div class="flex min-h-screen" x-data="{ sidebarOpen: false }">

        {{-- Mobile Overlay --}}
        <div x-show="sidebarOpen" x-cloak x-on:click="sidebarOpen = false"
             class="fixed inset-0 bg-black/50 z-40 lg:hidden" x-transition.opacity></div>

        {{-- Sidebar --}}
        <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
               class="fixed inset-y-0 left-0 z-50 w-64 bg-white dark:bg-gray-900 border-r border-gray-200 dark:border-gray-800 transition-transform duration-200 lg:translate-x-0 lg:static lg:inset-auto flex flex-col">

            <div class="p-6 border-b border-gray-200 dark:border-gray-800">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-brand-500 to-brand-700 rounded-xl flex items-center justify-center shadow-lg shadow-brand-500/20">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    </div>
                    <div>
                        <p class="font-bold text-gray-900 dark:text-gray-100 text-sm">ImageCompressor</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">Admin Panel</p>
                    </div>
                </a>
            </div>

            <nav class="flex-1 p-4 space-y-1">
                <a href="{{ route('admin.dashboard') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors font-medium text-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                    Dashboard
                </a>
                <a href="{{ route('reports') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl bg-brand-50 dark:bg-brand-900/20 text-brand-700 dark:text-brand-300 font-semibold text-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                    Reports
                </a>
                <a href="{{ route('home') }}" target="_blank"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors font-medium text-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                    Visit Site
                </a>
            </nav>

            <div class="p-4 border-t border-gray-200 dark:border-gray-800">
                <div class="flex items-center gap-3 mb-3 px-2">
                    <div class="w-9 h-9 bg-brand-100 dark:bg-brand-900/30 rounded-full flex items-center justify-center">
                        <span class="text-sm font-bold text-brand-700 dark:text-brand-300">{{ substr(Auth::user()->name ?? 'A', 0, 1) }}</span>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-semibold text-gray-900 dark:text-gray-100 truncate">{{ Auth::user()->name ?? 'Admin' }}</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400 truncate">{{ Auth::user()->email ?? '' }}</p>
                    </div>
                </div>
                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full flex items-center gap-2 px-4 py-2.5 rounded-xl text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors text-sm font-medium">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                        Logout
                    </button>
                </form>
            </div>
        </aside>

        {{-- Main Content --}}
        <div class="flex-1 flex flex-col min-w-0">

            <header class="h-16 bg-white dark:bg-gray-900 border-b border-gray-200 dark:border-gray-800 flex items-center justify-between px-4 lg:px-8 sticky top-0 z-30">
                <div class="flex items-center gap-4">
                    <button x-on:click="sidebarOpen = !sidebarOpen" class="lg:hidden p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors">
                        <svg class="w-6 h-6 text-gray-600 dark:text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/></svg>
                    </button>
                    <h1 class="text-xl font-bold text-gray-900 dark:text-gray-100">Compression Reports</h1>
                </div>
                <div class="flex items-center gap-3">
                    <div x-show="loading" x-cloak class="flex items-center gap-2 text-sm text-gray-500 dark:text-gray-400">
                        <svg class="animate-spin h-4 w-4" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        Loading...
                    </div>
                    <button x-on:click="darkMode = !darkMode"
                        class="p-2.5 rounded-xl bg-gray-100 dark:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700 transition-all"
                        aria-label="Toggle dark mode">
                        <svg x-show="!darkMode" class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/></svg>
                        <svg x-show="darkMode" x-cloak class="w-5 h-5 text-amber-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                    </button>
                </div>
            </header>

            <main class="flex-1 p-4 lg:p-8">
                <div class="animate-slide-up">

                    {{-- Period Filter --}}
                    <div class="mb-6 flex flex-wrap items-center gap-2">
                        <template x-for="opt in periodOptions" :key="opt.value">
                            <button x-on:click="period = opt.value; loadData()"
                                    :class="period === opt.value ? 'bg-brand-600 text-white border-brand-600' : 'bg-white dark:bg-gray-900 text-gray-700 dark:text-gray-300 border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-800'"
                                    class="px-4 py-2 rounded-lg text-sm font-medium transition-all border"
                                    x-text="opt.label">
                            </button>
                        </template>
                    </div>

                    {{-- Summary Cards --}}
                    <div class="grid grid-cols-2 lg:grid-cols-5 gap-3 mb-6">
                        <div class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-xl p-4">
                            <p class="text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Total Compressions</p>
                            <p class="text-xl font-bold text-gray-900 dark:text-gray-100" x-text="data.summary?.total_compressions ?? 0"></p>
                        </div>
                        <div class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-xl p-4">
                            <p class="text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Original Size</p>
                            <p class="text-xl font-bold text-gray-900 dark:text-gray-100" x-text="data.summary?.total_original_size ?? '0 B'"></p>
                        </div>
                        <div class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-xl p-4">
                            <p class="text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Compressed</p>
                            <p class="text-xl font-bold text-gray-900 dark:text-gray-100" x-text="data.summary?.total_compressed ?? '0 B'"></p>
                        </div>
                        <div class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-xl p-4">
                            <p class="text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Space Saved</p>
                            <p class="text-xl font-bold text-green-600 dark:text-green-400" x-text="data.summary?.total_saved ?? '0 B'"></p>
                        </div>
                        <div class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-xl p-4">
                            <p class="text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Avg Reduction</p>
                            <p class="text-xl font-bold text-amber-600 dark:text-amber-400" x-text="data.summary?.avg_reduction ?? '0%'"></p>
                        </div>
                    </div>

                    {{-- Charts --}}
                    <div class="grid lg:grid-cols-2 gap-4 mb-6">
                        <div class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-xl p-5">
                            <h3 class="text-sm font-bold text-gray-900 dark:text-gray-100 mb-3">Compressions Over Time</h3>
                            <div class="h-60">
                                <canvas id="dailyChart"></canvas>
                            </div>
                        </div>
                        <div class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-xl p-5">
                            <h3 class="text-sm font-bold text-gray-900 dark:text-gray-100 mb-3">Format Distribution</h3>
                            <div class="h-60">
                                <canvas id="formatChart"></canvas>
                            </div>
                        </div>
                    </div>

                    {{-- Recent Table --}}
                    <div class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-xl overflow-hidden">
                        <div class="px-5 py-4 border-b border-gray-200 dark:border-gray-800">
                            <h3 class="font-bold text-gray-900 dark:text-gray-100">Recent Compressions</h3>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full text-sm">
                                <thead class="bg-gray-50 dark:bg-gray-800/50">
                                    <tr>
                                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase">Image</th>
                                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase">Format</th>
                                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase">Original</th>
                                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase">Compressed</th>
                                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase">Reduction</th>
                                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase">Quality</th>
                                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase">Date</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 dark:divide-gray-800">
                                    <template x-if="!data.recent || data.recent.length === 0">
                                        <tr>
                                            <td colspan="7" class="px-5 py-12 text-center text-gray-500 dark:text-gray-400">
                                                <svg class="w-10 h-10 mx-auto mb-2 text-gray-300 dark:text-gray-700" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z"/></svg>
                                                <p>No reports for this period</p>
                                            </td>
                                        </tr>
                                    </template>
                                    <template x-for="r in (data.recent || [])" :key="r.id">
                                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors">
                                            <td class="px-5 py-3 font-medium text-gray-900 dark:text-gray-100 max-w-[200px] truncate" x-text="r.original_name"></td>
                                            <td class="px-5 py-3">
                                                <span class="inline-flex items-center gap-1">
                                                    <span class="px-1.5 py-0.5 bg-brand-100 dark:bg-brand-900/30 text-brand-700 dark:text-brand-300 rounded text-xs font-medium" x-text="r.original_format"></span>
                                                    <svg class="w-3 h-3 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                                                    <span class="px-1.5 py-0.5 bg-accent-100 dark:bg-accent-900/30 text-accent-700 dark:text-accent-300 rounded text-xs font-medium" x-text="r.output_format"></span>
                                                </span>
                                            </td>
                                            <td class="px-5 py-3 text-gray-600 dark:text-gray-400" x-text="r.original_size"></td>
                                            <td class="px-5 py-3 text-gray-600 dark:text-gray-400" x-text="r.compressed_size"></td>
                                            <td class="px-5 py-3">
                                                <span class="px-2 py-0.5 bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-300 rounded-full text-xs font-semibold" x-text="r.reduction"></span>
                                            </td>
                                            <td class="px-5 py-3 text-gray-600 dark:text-gray-400" x-text="r.quality"></td>
                                            <td class="px-5 py-3 text-gray-500 dark:text-gray-400" x-text="r.created_at" :title="r.created_date"></td>
                                        </tr>
                                    </template>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </main>
        </div>
    </div>

    <script>
        function reportsPage() {
            return {
                darkMode: localStorage.getItem('darkMode') === 'true' || (!localStorage.getItem('darkMode') && window.matchMedia('(prefers-color-scheme: dark)').matches),
                period: 'all',
                periodOptions: [
                    { value: '24h', label: '24 Hours' },
                    { value: '7d', label: '7 Days' },
                    { value: '30d', label: '30 Days' },
                    { value: '90d', label: '90 Days' },
                    { value: 'all', label: 'All Time' }
                ],
                loading: false,
                data: { summary: {}, daily_stats: [], format_stats: [], recent: [] },
                dailyChartInstance: null,
                formatChartInstance: null,

                initApp() {
                    this.$watch('darkMode', val => {
                        localStorage.setItem('darkMode', val);
                        this.renderCharts();
                    });
                    this.loadData();
                },

                async loadData() {
                    this.loading = true;
                    try {
                        const res = await fetch(`/admin/api/reports?period=${this.period}`, {
                            credentials: 'same-origin',
                            headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' }
                        });
                        if (!res.ok) throw new Error('Failed to load');
                        this.data = await res.json();
                        this.$nextTick(() => this.renderCharts());
                    } catch (e) {
                        console.error('Reports load error:', e);
                    } finally {
                        this.loading = false;
                    }
                },

                renderCharts() {
                    this.renderDailyChart();
                    this.renderFormatChart();
                },

                renderDailyChart() {
                    const el = document.getElementById('dailyChart');
                    if (!el) return;
                    if (this.dailyChartInstance) this.dailyChartInstance.destroy();

                    const isDark = this.darkMode;
                    const labels = (this.data.daily_stats || []).map(d => d.date);
                    const counts = (this.data.daily_stats || []).map(d => d.count);

                    this.dailyChartInstance = new Chart(el, {
                        type: 'bar',
                        data: {
                            labels,
                            datasets: [{
                                label: 'Compressions',
                                data: counts,
                                backgroundColor: isDark ? 'rgba(129,140,248,0.6)' : 'rgba(99,102,241,0.7)',
                                borderRadius: 6,
                                borderSkipped: false,
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: { legend: { display: false } },
                            scales: {
                                y: { beginAtZero: true, ticks: { color: isDark ? '#9ca3af' : '#6b7280', stepSize: 1 }, grid: { color: isDark ? '#1f2937' : '#f3f4f6' } },
                                x: { ticks: { color: isDark ? '#9ca3af' : '#6b7280' }, grid: { display: false } }
                            }
                        }
                    });
                },

                renderFormatChart() {
                    const el = document.getElementById('formatChart');
                    if (!el) return;
                    if (this.formatChartInstance) this.formatChartInstance.destroy();

                    const isDark = this.darkMode;
                    const stats = this.data.format_stats || [];
                    if (stats.length === 0) return;

                    const labels = stats.map(f => (f.original_format || '').toUpperCase());
                    const counts = stats.map(f => f.count);
                    const colors = ['#6366f1', '#10b981', '#f59e0b', '#ef4444', '#8b5cf6'];

                    this.formatChartInstance = new Chart(el, {
                        type: 'doughnut',
                        data: {
                            labels,
                            datasets: [{ data: counts, backgroundColor: colors.slice(0, labels.length), borderWidth: 3, borderColor: isDark ? '#111827' : '#ffffff' }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: { legend: { position: 'bottom', labels: { color: isDark ? '#9ca3af' : '#6b7280', padding: 16, usePointStyle: true, pointStyleWidth: 10 } } }
                        }
                    });
                }
            };
        }
    </script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</body>
</html>
