<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Compression Reports – CompresslyPro Admin</title>
    <meta name="robots" content="noindex, nofollow">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('logo.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

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
                <a href="{{ route('admin.dashboard') }}" class="block">
                    <img src="{{ asset('logo.png') }}" alt="CompresslyPro" class="h-10 w-auto dark:brightness-0 dark:invert transition-all">
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Admin Panel</p>
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
                    {{-- CSV Export Button --}}
                          <a :href="exportUrl()"
                       class="flex items-center gap-2 px-4 py-2 bg-accent-600 hover:bg-accent-700 text-white text-sm font-semibold rounded-xl transition-all shadow-sm hover:shadow-md"
                       title="Export CSV">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        <span class="hidden sm:inline">Export CSV</span>
                    </a>
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

                    {{-- Filters --}}
                    <div class="mb-6 space-y-3">
                        <div class="flex flex-wrap items-center gap-2">
                        <template x-for="opt in periodOptions" :key="opt.value">
                            <button x-on:click="period = opt.value; applyFilters()"
                                    :class="period === opt.value ? 'bg-brand-600 text-white border-brand-600' : 'bg-white dark:bg-gray-900 text-gray-700 dark:text-gray-300 border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-800'"
                                    class="px-4 py-2 rounded-lg text-sm font-medium transition-all border"
                                    x-text="opt.label">
                            </button>
                        </template>
                        </div>

                        <div class="flex flex-wrap items-center gap-2">
                            <select x-model="actionFilter" x-on:change="applyFilters()"
                                    class="px-3 py-2 rounded-lg text-sm bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 text-gray-700 dark:text-gray-200">
                                <option value="all">All Actions</option>
                                <template x-for="action in (data.filters?.available_actions || [])" :key="`action-${action}`">
                                    <option :value="action" x-text="action.charAt(0).toUpperCase() + action.slice(1)"></option>
                                </template>
                            </select>

                            <select x-model="formatFilter" x-on:change="applyFilters()"
                                    class="px-3 py-2 rounded-lg text-sm bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 text-gray-700 dark:text-gray-200">
                                <option value="all">All Formats</option>
                                <template x-for="format in (data.filters?.available_formats || [])" :key="`format-${format}`">
                                    <option :value="format" x-text="format.toUpperCase()"></option>
                                </template>
                            </select>

                            <button x-on:click="resetFilters()"
                                    class="px-3 py-2 rounded-lg text-sm font-medium border border-gray-200 dark:border-gray-700 text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors">
                                Reset Filters
                            </button>
                        </div>
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

                    {{-- Daily Overview --}}
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 mb-6">
                        <div class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-xl p-4">
                            <p class="text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Today</p>
                            <p class="text-lg font-bold text-gray-900 dark:text-gray-100" x-text="(data.daily_overview?.today_count ?? 0) + ' ops'"></p>
                            <p class="text-xs text-green-600 dark:text-green-400 mt-1" x-text="'Saved ' + (data.daily_overview?.today_saved ?? '0 B')"></p>
                        </div>
                        <div class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-xl p-4">
                            <p class="text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Yesterday</p>
                            <p class="text-lg font-bold text-gray-900 dark:text-gray-100" x-text="(data.daily_overview?.yesterday_count ?? 0) + ' ops'"></p>
                            <p class="text-xs text-green-600 dark:text-green-400 mt-1" x-text="'Saved ' + (data.daily_overview?.yesterday_saved ?? '0 B')"></p>
                        </div>
                        <div class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-xl p-4">
                            <p class="text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">7-Day Daily Avg</p>
                            <p class="text-lg font-bold text-gray-900 dark:text-gray-100" x-text="(data.daily_overview?.avg_daily_count_last_7d ?? 0) + ' ops/day'"></p>
                            <p class="text-xs text-green-600 dark:text-green-400 mt-1" x-text="'Saved ' + (data.daily_overview?.avg_daily_saved_last_7d ?? '0 B') + '/day'"></p>
                        </div>
                    </div>

                    {{-- Audience & Network Stats --}}
                    <div class="grid grid-cols-1 lg:grid-cols-4 gap-3 mb-6">
                        <div class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-xl p-4">
                            <p class="text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Unique Users (IP)</p>
                            <p class="text-lg font-bold text-gray-900 dark:text-gray-100" x-text="data.audience?.unique_users ?? 0"></p>
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Distinct IPs in selected period</p>
                        </div>
                        <div class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-xl p-4">
                            <p class="text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Unique Clients</p>
                            <p class="text-lg font-bold text-gray-900 dark:text-gray-100" x-text="data.audience?.unique_clients ?? 0"></p>
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Unique IP + browser fingerprints</p>
                        </div>
                        <div class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-xl p-4">
                            <p class="text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Today Unique Users</p>
                            <p class="text-lg font-bold text-gray-900 dark:text-gray-100" x-text="data.daily_overview?.today_unique_users ?? 0"></p>
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Distinct IPs today</p>
                        </div>
                        <div class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-xl p-4">
                            <p class="text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Countries</p>
                            <p class="text-lg font-bold text-gray-900 dark:text-gray-100" x-text="data.audience?.unique_countries ?? 0"></p>
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Unique countries in selected period</p>
                        </div>
                    </div>

                    {{-- Charts --}}
                    <div class="grid lg:grid-cols-2 gap-4 mb-4">
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

                    <div class="grid lg:grid-cols-3 gap-4 mb-6">
                        <div class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-xl p-5">
                            <h3 class="text-sm font-bold text-gray-900 dark:text-gray-100 mb-3">Action Distribution</h3>
                            <div class="h-60">
                                <canvas id="actionChart"></canvas>
                            </div>
                        </div>
                        <div class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-xl p-5">
                            <h3 class="text-sm font-bold text-gray-900 dark:text-gray-100 mb-3">Average Reduction Trend</h3>
                            <div class="h-60">
                                <canvas id="reductionTrendChart"></canvas>
                            </div>
                        </div>
                        <div class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-xl p-5">
                            <h3 class="text-sm font-bold text-gray-900 dark:text-gray-100 mb-3">Country Distribution</h3>
                            <div class="h-60">
                                <canvas id="countryChart"></canvas>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-xl p-5 mb-6">
                        <h3 class="text-sm font-bold text-gray-900 dark:text-gray-100 mb-3">Top IP Activity</h3>
                        <div class="overflow-x-auto">
                            <table class="w-full text-sm">
                                <thead class="bg-gray-50 dark:bg-gray-800/50">
                                    <tr>
                                        <th class="px-4 py-2.5 text-left text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase">IP</th>
                                        <th class="px-4 py-2.5 text-left text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase">Operations</th>
                                        <th class="px-4 py-2.5 text-left text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase">Avg Reduction</th>
                                        <th class="px-4 py-2.5 text-left text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase">Saved</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 dark:divide-gray-800">
                                    <template x-if="!data.ip_stats || data.ip_stats.length === 0">
                                        <tr>
                                            <td colspan="4" class="px-4 py-6 text-center text-gray-500 dark:text-gray-400">No IP activity data</td>
                                        </tr>
                                    </template>
                                    <template x-for="(ip, idx) in (data.ip_stats || [])" :key="`ip-${idx}`">
                                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors">
                                            <td class="px-4 py-2.5 font-medium text-gray-900 dark:text-gray-100" x-text="ip.ip_address"></td>
                                            <td class="px-4 py-2.5 text-gray-600 dark:text-gray-400" x-text="ip.count"></td>
                                            <td class="px-4 py-2.5 text-green-600 dark:text-green-400" x-text="ip.avg_reduction"></td>
                                            <td class="px-4 py-2.5 text-gray-600 dark:text-gray-400" x-text="ip.saved"></td>
                                        </tr>
                                    </template>
                                </tbody>
                            </table>
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
                                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase">Preview</th>
                                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase">Action</th>
                                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase">Format</th>
                                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase">Original</th>
                                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase">Compressed</th>
                                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase">Reduction</th>
                                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase">Quality</th>
                                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase">User IP</th>
                                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase">Country</th>
                                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase">Date</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 dark:divide-gray-800">
                                    <template x-if="!data.recent || data.recent.length === 0">
                                        <tr>
                                            <td colspan="10" class="px-5 py-12 text-center text-gray-500 dark:text-gray-400">
                                                <svg class="w-10 h-10 mx-auto mb-2 text-gray-300 dark:text-gray-700" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z"/></svg>
                                                <p>No reports for this period</p>
                                            </td>
                                        </tr>
                                    </template>
                                    <template x-for="r in (data.recent || [])" :key="r.id">
                                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors">
                                            <td class="px-5 py-3">
                                                <div class="flex items-center gap-3 min-w-0">
                                                    <template x-if="r.preview_url">
                                                        <button type="button" x-on:click="openPreview(r.preview_url, r.original_name)" title="Open preview image" class="flex-shrink-0">
                                                            <img :src="r.preview_url"
                                                                 :alt="'Preview of ' + r.original_name"
                                                                 class="w-16 h-16 rounded-lg object-cover border border-gray-200 dark:border-gray-700 shadow-sm">
                                                        </button>
                                                    </template>
                                                    <template x-if="!r.preview_url">
                                                        <div class="w-16 h-16 rounded-lg bg-gray-100 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 flex items-center justify-center text-xs font-bold text-gray-500 dark:text-gray-400 flex-shrink-0"
                                                             x-text="(r.original_format || '?').slice(0, 3)">
                                                        </div>
                                                    </template>
                                                    <div class="min-w-0">
                                                        <template x-if="r.preview_url">
                                                            <button type="button" x-on:click="openPreview(r.preview_url, r.original_name)" class="hover:text-brand-600 dark:hover:text-brand-400 inline-flex items-center gap-1.5 group font-medium text-gray-900 dark:text-gray-100 max-w-[180px]" title="View Image">
                                                                <span x-text="r.original_name" class="truncate"></span>
                                                                <svg class="w-3.5 h-3.5 opacity-0 group-hover:opacity-100 transition-opacity flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                                            </button>
                                                        </template>
                                                        <template x-if="!r.preview_url">
                                                            <span class="font-medium text-gray-900 dark:text-gray-100 truncate block max-w-[180px]" x-text="r.original_name"></span>
                                                        </template>
                                                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5" x-text="r.dimensions"></p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-5 py-3">
                                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-semibold"
                                                      :class="{
                                                          'bg-brand-100 dark:bg-brand-900/30 text-brand-700 dark:text-brand-300': r.action === 'compress',
                                                          'bg-purple-100 dark:bg-purple-900/30 text-purple-700 dark:text-purple-300': r.action === 'convert',
                                                          'bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300': r.action === 'batch',
                                                          'bg-orange-100 dark:bg-orange-900/30 text-orange-700 dark:text-orange-300': r.action === 'resize',
                                                          'bg-pink-100 dark:bg-pink-900/30 text-pink-700 dark:text-pink-300': r.action === 'watermark',
                                                          'bg-teal-100 dark:bg-teal-900/30 text-teal-700 dark:text-teal-300': r.action === 'url_compress',
                                                          'bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300': !['compress','convert','batch','resize','watermark','url_compress'].includes(r.action),
                                                      }"
                                                      x-text="r.action || 'compress'">
                                                </span>
                                            </td>
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
                                            <td class="px-5 py-3 text-gray-600 dark:text-gray-400 font-mono text-xs" x-text="r.ip_address || '—'"></td>
                                            <td class="px-5 py-3 text-gray-600 dark:text-gray-400 font-semibold text-xs" x-text="r.country || 'ZZ'"></td>
                                            <td class="px-5 py-3 text-gray-500 dark:text-gray-400" x-text="r.created_at" :title="r.created_date"></td>
                                        </tr>
                                    </template>
                                </tbody>
                            </table>
                        </div>
                        <div class="px-5 py-4 border-t border-gray-200 dark:border-gray-800 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                            <p class="text-xs text-gray-500 dark:text-gray-400"
                               x-text="`Showing ${data.recent_pagination?.from || 0}-${data.recent_pagination?.to || 0} of ${data.recent_pagination?.total || 0}`">
                            </p>

                            <div class="flex items-center gap-2">
                                <label class="text-xs text-gray-500 dark:text-gray-400">Rows</label>
                                <select x-model.number="perPage" x-on:change="changePerPage(perPage)"
                                        class="px-2 py-1.5 rounded-md text-xs bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 text-gray-700 dark:text-gray-200">
                                    <template x-for="size in perPageOptions" :key="`size-${size}`">
                                        <option :value="size" x-text="size"></option>
                                    </template>
                                </select>

                                <button type="button"
                                        x-on:click="changePage((data.recent_pagination?.current_page || 1) - 1)"
                                        :disabled="(data.recent_pagination?.current_page || 1) <= 1"
                                        class="px-2.5 py-1.5 rounded-md border border-gray-200 dark:border-gray-700 text-xs font-medium text-gray-600 dark:text-gray-300 disabled:opacity-40 disabled:cursor-not-allowed hover:bg-gray-50 dark:hover:bg-gray-800">
                                    Prev
                                </button>

                                <span class="text-xs text-gray-500 dark:text-gray-400"
                                      x-text="`Page ${data.recent_pagination?.current_page || 1} / ${data.recent_pagination?.last_page || 1}`">
                                </span>

                                <button type="button"
                                        x-on:click="changePage((data.recent_pagination?.current_page || 1) + 1)"
                                        :disabled="(data.recent_pagination?.current_page || 1) >= (data.recent_pagination?.last_page || 1)"
                                        class="px-2.5 py-1.5 rounded-md border border-gray-200 dark:border-gray-700 text-xs font-medium text-gray-600 dark:text-gray-300 disabled:opacity-40 disabled:cursor-not-allowed hover:bg-gray-50 dark:hover:bg-gray-800">
                                    Next
                                </button>
                            </div>
                        </div>
                    </div>

                </div>
            </main>
        </div>
    </div>

    {{-- Image Preview Modal --}}
    <div x-show="previewModalOpen" x-cloak x-on:keydown.escape.window="closePreview()" class="fixed inset-0 z-[70] flex items-center justify-center p-4 sm:p-6">
        <div class="absolute inset-0 bg-black/70" x-on:click="closePreview()"></div>
        <div class="relative w-full max-w-5xl max-h-[90vh] bg-white dark:bg-gray-900 rounded-2xl overflow-hidden shadow-2xl border border-gray-200 dark:border-gray-800">
            <div class="flex items-center justify-between px-4 sm:px-5 py-3 border-b border-gray-200 dark:border-gray-800">
                <h4 class="text-sm sm:text-base font-semibold text-gray-900 dark:text-gray-100 truncate pr-4" x-text="previewImageName || 'Image Preview'"></h4>
                <button type="button" x-on:click="closePreview()" class="p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800 text-gray-500 dark:text-gray-400" aria-label="Close preview">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
            <div class="p-3 sm:p-4 flex items-center justify-center bg-gray-50 dark:bg-gray-950 max-h-[calc(90vh-70px)] overflow-auto">
                <img :src="previewImageUrl" :alt="previewImageName || 'Preview image'" class="max-w-full max-h-[calc(90vh-110px)] object-contain rounded-lg">
            </div>
        </div>
    </div>

    <script>
        function reportsPage() {
            return {
                darkMode: localStorage.getItem('darkMode') === 'true',
                period: 'all',
                actionFilter: 'all',
                formatFilter: 'all',
                currentPage: 1,
                perPage: 15,
                perPageOptions: [10, 15, 20, 30, 50],
                previewModalOpen: false,
                previewImageUrl: '',
                previewImageName: '',
                periodOptions: [
                    { value: '24h', label: '24 Hours' },
                    { value: '7d', label: '7 Days' },
                    { value: '30d', label: '30 Days' },
                    { value: '90d', label: '90 Days' },
                    { value: 'all', label: 'All Time' }
                ],
                loading: false,
                data: {
                    summary: {},
                    daily_overview: {},
                    daily_stats: [],
                    format_stats: [],
                    output_format_stats: [],
                    quality_stats: [],
                    action_stats: [],
                    country_stats: [],
                    ip_stats: [],
                    audience: { unique_users: 0, unique_clients: 0, unique_countries: 0 },
                    filters: { available_actions: [], available_formats: [] },
                    recent: [],
                    recent_pagination: { current_page: 1, last_page: 1, per_page: 15, total: 0, from: 0, to: 0 }
                },
                dailyChartInstance: null,
                formatChartInstance: null,
                actionChartInstance: null,
                reductionTrendChartInstance: null,
                countryChartInstance: null,

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
                        const params = new URLSearchParams({
                            period: this.period,
                            action: this.actionFilter,
                            format: this.formatFilter,
                            page: this.currentPage,
                            per_page: this.perPage,
                        });

                        const res = await fetch(`/admin/api/reports?${params.toString()}`, {
                            credentials: 'same-origin',
                            headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' }
                        });
                        if (!res.ok) throw new Error('Failed to load');
                        this.data = await res.json();

                        this.actionFilter = this.data.filters?.selected?.action || this.actionFilter;
                        this.formatFilter = this.data.filters?.selected?.format || this.formatFilter;
                        this.currentPage = this.data.recent_pagination?.current_page || this.currentPage;
                        this.perPage = this.data.recent_pagination?.per_page || this.perPage;

                        this.$nextTick(() => this.renderCharts());
                    } catch (e) {
                        console.error('Reports load error:', e);
                    } finally {
                        this.loading = false;
                    }
                },

                applyFilters() {
                    this.currentPage = 1;
                    this.loadData();
                },

                resetFilters() {
                    this.period = 'all';
                    this.actionFilter = 'all';
                    this.formatFilter = 'all';
                    this.currentPage = 1;
                    this.perPage = 15;
                    this.loadData();
                },

                changePage(page) {
                    const maxPage = this.data.recent_pagination?.last_page || 1;
                    const nextPage = Math.max(1, Math.min(page, maxPage));
                    if (nextPage === this.currentPage) return;
                    this.currentPage = nextPage;
                    this.loadData();
                },

                changePerPage(size) {
                    this.perPage = size;
                    this.currentPage = 1;
                    this.loadData();
                },

                exportUrl() {
                    const params = new URLSearchParams({
                        period: this.period,
                        action: this.actionFilter,
                        format: this.formatFilter,
                    });

                    return `/admin/export?${params.toString()}`;
                },

                openPreview(imageUrl, imageName = 'Image Preview') {
                    if (!imageUrl) return;
                    this.previewImageUrl = imageUrl;
                    this.previewImageName = imageName;
                    this.previewModalOpen = true;
                },

                closePreview() {
                    this.previewModalOpen = false;
                    this.previewImageUrl = '';
                    this.previewImageName = '';
                },

                renderCharts() {
                    this.renderDailyChart();
                    this.renderFormatChart();
                    this.renderActionChart();
                    this.renderReductionTrendChart();
                    this.renderCountryChart();
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
                },

                renderActionChart() {
                    const el = document.getElementById('actionChart');
                    if (!el) return;
                    if (this.actionChartInstance) this.actionChartInstance.destroy();

                    const isDark = this.darkMode;
                    const stats = this.data.action_stats || [];
                    if (stats.length === 0) return;

                    const labels = stats.map(item => item.action || 'compress');
                    const counts = stats.map(item => item.count);

                    this.actionChartInstance = new Chart(el, {
                        type: 'bar',
                        data: {
                            labels,
                            datasets: [{
                                label: 'Operations',
                                data: counts,
                                backgroundColor: ['#6366f1', '#10b981', '#f59e0b', '#3b82f6', '#ec4899', '#14b8a6', '#94a3b8'],
                                borderRadius: 6,
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

                renderReductionTrendChart() {
                    const el = document.getElementById('reductionTrendChart');
                    if (!el) return;
                    if (this.reductionTrendChartInstance) this.reductionTrendChartInstance.destroy();

                    const isDark = this.darkMode;
                    const stats = this.data.daily_stats || [];
                    if (stats.length === 0) return;

                    const labels = stats.map(d => d.date);
                    const avgReduction = stats.map(d => Number(d.avg_reduction || 0).toFixed(1));

                    this.reductionTrendChartInstance = new Chart(el, {
                        type: 'line',
                        data: {
                            labels,
                            datasets: [{
                                label: 'Avg Reduction %',
                                data: avgReduction,
                                borderColor: '#10b981',
                                backgroundColor: isDark ? 'rgba(16,185,129,0.15)' : 'rgba(16,185,129,0.12)',
                                fill: true,
                                tension: 0.35,
                                pointRadius: 2.5,
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: { legend: { display: false } },
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    max: 100,
                                    ticks: {
                                        color: isDark ? '#9ca3af' : '#6b7280',
                                        callback: (value) => `${value}%`
                                    },
                                    grid: { color: isDark ? '#1f2937' : '#f3f4f6' }
                                },
                                x: { ticks: { color: isDark ? '#9ca3af' : '#6b7280' }, grid: { display: false } }
                            }
                        }
                    });
                },

                renderCountryChart() {
                    const el = document.getElementById('countryChart');
                    if (!el) return;
                    if (this.countryChartInstance) this.countryChartInstance.destroy();

                    const isDark = this.darkMode;
                    const stats = this.data.country_stats || [];
                    if (stats.length === 0) return;

                    const labels = stats.map(item => item.country || 'ZZ');
                    const counts = stats.map(item => item.count);

                    this.countryChartInstance = new Chart(el, {
                        type: 'doughnut',
                        data: {
                            labels,
                            datasets: [{
                                data: counts,
                                backgroundColor: ['#6366f1', '#10b981', '#f59e0b', '#ef4444', '#3b82f6', '#ec4899', '#14b8a6', '#8b5cf6', '#f97316', '#22c55e'],
                                borderWidth: 3,
                                borderColor: isDark ? '#111827' : '#ffffff'
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: {
                                    position: 'bottom',
                                    labels: {
                                        color: isDark ? '#9ca3af' : '#6b7280',
                                        padding: 12,
                                        usePointStyle: true,
                                        pointStyleWidth: 10,
                                    }
                                }
                            }
                        }
                    });
                }
            };
        }
    </script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</body>
</html>
