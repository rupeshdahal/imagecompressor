<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard – ImageCompressor</title>
    <meta name="robots" content="noindex, nofollow">

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
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
    <style>
        [x-cloak] { display: none !important; }
        @keyframes slideUp { 0%{opacity:0;transform:translateY(20px)} 100%{opacity:1;transform:translateY(0)} }
        .animate-slide-up { animation: slideUp 0.5s ease-out; }
    </style>
</head>

<body class="min-h-screen font-sans bg-gray-50 text-gray-900">

    <div class="flex min-h-screen" x-data="{ sidebarOpen: false }">

        {{-- Mobile Overlay --}}
        <div x-show="sidebarOpen" x-cloak x-on:click="sidebarOpen = false"
             class="fixed inset-0 bg-black/50 z-40 lg:hidden" x-transition.opacity></div>

        {{-- Sidebar --}}
        <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
               class="fixed inset-y-0 left-0 z-50 w-64 bg-white border-r border-gray-200 transition-transform duration-200 lg:translate-x-0 lg:static lg:inset-auto flex flex-col">

            <div class="p-6 border-b border-gray-200">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-brand-500 to-brand-700 rounded-xl flex items-center justify-center shadow-lg shadow-brand-500/20">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    </div>
                    <div>
                        <p class="font-bold text-gray-900 text-sm">ImageCompressor</p>
                        <p class="text-xs text-gray-500">Admin Panel</p>
                    </div>
                </a>
            </div>

            <nav class="flex-1 p-4 space-y-1">
                <a href="{{ route('admin.dashboard') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl bg-brand-50 text-brand-700 font-semibold text-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                    Dashboard
                </a>
                <a href="{{ route('reports') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-600 hover:bg-gray-100 transition-colors font-medium text-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                    Reports
                </a>
                <a href="{{ route('home') }}" target="_blank"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-600 hover:bg-gray-100 transition-colors font-medium text-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                    Visit Site
                </a>
            </nav>

            <div class="p-4 border-t border-gray-200">
                <div class="flex items-center gap-3 mb-3 px-2">
                    <div class="w-9 h-9 bg-brand-100 rounded-full flex items-center justify-center">
                        <span class="text-sm font-bold text-brand-700">{{ substr(Auth::user()->name ?? 'A', 0, 1) }}</span>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-semibold text-gray-900 truncate">{{ Auth::user()->name ?? 'Admin' }}</p>
                        <p class="text-xs text-gray-500 truncate">{{ Auth::user()->email ?? '' }}</p>
                    </div>
                </div>
                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full flex items-center gap-2 px-4 py-2.5 rounded-xl text-red-600 hover:bg-red-50 transition-colors text-sm font-medium">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                        Logout
                    </button>
                </form>
            </div>
        </aside>

        {{-- Main Content --}}
        <div class="flex-1 flex flex-col min-w-0">

            <header class="h-16 bg-white border-b border-gray-200 flex items-center justify-between px-4 lg:px-8 sticky top-0 z-30">
                <div class="flex items-center gap-4">
                    <button x-on:click="sidebarOpen = !sidebarOpen" class="lg:hidden p-2 rounded-lg hover:bg-gray-100 transition-colors">
                        <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/></svg>
                    </button>
                    <h1 class="text-xl font-bold text-gray-900">Dashboard</h1>
                </div>
            </header>

            <main class="flex-1 p-4 lg:p-8">
                <div class="animate-slide-up">

                    {{-- Stats Grid --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
                        @php
                            $totalReports = \App\Models\CompressionReport::count();
                            $totalOriginal = \App\Models\CompressionReport::sum('original_size');
                            $totalCompressed = \App\Models\CompressionReport::sum('compressed_size');
                            $totalSaved = $totalOriginal - $totalCompressed;
                            $avgReduction = \App\Models\CompressionReport::avg('reduction_percent') ?? 0;
                        @endphp

                        <div class="bg-white border border-gray-200 rounded-2xl p-6">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 bg-brand-100 rounded-xl flex items-center justify-center">
                                    <svg class="w-6 h-6 text-brand-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/></svg>
                                </div>
                                <div>
                                    <p class="text-2xl font-bold text-gray-900">{{ number_format($totalReports) }}</p>
                                    <p class="text-sm text-gray-500">Total Compressions</p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white border border-gray-200 rounded-2xl p-6">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
                                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                </div>
                                <div>
                                    <p class="text-2xl font-bold text-green-600">{{ $totalSaved > 0 ? round($totalSaved / 1024 / 1024, 1) . ' MB' : '0 B' }}</p>
                                    <p class="text-sm text-gray-500">Space Saved</p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white border border-gray-200 rounded-2xl p-6">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 bg-amber-100 rounded-xl flex items-center justify-center">
                                    <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
                                </div>
                                <div>
                                    <p class="text-2xl font-bold text-amber-600">{{ round($avgReduction, 1) }}%</p>
                                    <p class="text-sm text-gray-500">Avg Reduction</p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white border border-gray-200 rounded-2xl p-6">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center">
                                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                                </div>
                                <div>
                                    <p class="text-2xl font-bold text-gray-900">Online</p>
                                    <p class="text-sm text-gray-500">System Status</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Quick Actions --}}
                    <h2 class="text-lg font-bold text-gray-900 mb-4">Quick Actions</h2>
                    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-4 mb-8">
                        <a href="{{ route('reports') }}" class="bg-white border border-gray-200 rounded-2xl p-6 hover:shadow-lg hover:border-brand-300 transition-all group">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 bg-brand-100 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
                                    <svg class="w-6 h-6 text-brand-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                                </div>
                                <div>
                                    <p class="font-bold text-gray-900">View Reports</p>
                                    <p class="text-sm text-gray-500">Detailed analytics & charts</p>
                                </div>
                            </div>
                        </a>

                        <a href="{{ route('home') }}" target="_blank" class="bg-white border border-gray-200 rounded-2xl p-6 hover:shadow-lg hover:border-accent-300 transition-all group">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 bg-accent-100 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
                                    <svg class="w-6 h-6 text-accent-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                </div>
                                <div>
                                    <p class="font-bold text-gray-900">Compress Image</p>
                                    <p class="text-sm text-gray-500">Test compression tool</p>
                                </div>
                            </div>
                        </a>

                        <div class="bg-white border border-gray-200 rounded-2xl p-6 opacity-60">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 bg-gray-100 rounded-xl flex items-center justify-center">
                                    <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                </div>
                                <div>
                                    <p class="font-semibold text-gray-500">Settings</p>
                                    <p class="text-sm text-gray-400">Coming soon</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- System Info --}}
                    <h2 class="text-lg font-bold text-gray-900 mb-4">System Information</h2>
                    <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden">
                        <table class="w-full">
                            <tbody class="divide-y divide-gray-200">
                                <tr>
                                    <td class="px-6 py-4 text-sm font-medium text-gray-500">Laravel Version</td>
                                    <td class="px-6 py-4 text-sm font-semibold text-gray-900">{{ app()->version() }}</td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-4 text-sm font-medium text-gray-500">PHP Version</td>
                                    <td class="px-6 py-4 text-sm font-semibold text-gray-900">{{ PHP_VERSION }}</td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-4 text-sm font-medium text-gray-500">Upload Limit</td>
                                    <td class="px-6 py-4 text-sm font-semibold text-gray-900">{{ ini_get('upload_max_filesize') }}</td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-4 text-sm font-medium text-gray-500">Memory Limit</td>
                                    <td class="px-6 py-4 text-sm font-semibold text-gray-900">{{ ini_get('memory_limit') }}</td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-4 text-sm font-medium text-gray-500">Database</td>
                                    <td class="px-6 py-4 text-sm font-semibold text-gray-900">{{ config('database.default') }}</td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-4 text-sm font-medium text-gray-500">Status</td>
                                    <td class="px-6 py-4">
                                        <span class="inline-flex items-center gap-1.5 text-sm font-semibold text-green-600">
                                            <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span>
                                            Online
                                        </span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</body>
</html>
