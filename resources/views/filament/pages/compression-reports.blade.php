<x-filament-panels::page>
    <div
        x-data="reportsPage({
            dataUrl: @js($reportsDataUrl),
            exportUrl: @js($reportsExportUrl),
        })"
        x-init="initApp()"
        class="space-y-6"
    >
        <x-filament::section>
            <x-slot name="heading">Compression Reports</x-slot>
            <x-slot name="description">Complete analytics report with filters, charts, and detailed tables.</x-slot>

            <div class="flex flex-wrap items-center gap-2">
                <x-filament::button tag="a" href="{{ $dashboardUrl }}" color="gray" size="sm">Dashboard</x-filament::button>
                <x-filament::button tag="a" href="{{ $blogUrl }}" color="gray" size="sm">Blog</x-filament::button>
                <x-filament::button tag="a" x-bind:href="exportUrl()" color="success" size="sm">Export CSV</x-filament::button>
            </div>
        </x-filament::section>

        <x-filament::section>
            <x-slot name="heading">Filters</x-slot>
            <div class="flex flex-wrap items-center gap-2">
                <template x-for="opt in periodOptions" :key="opt.value">
                    <button
                        type="button"
                        x-on:click="period = opt.value; applyFilters()"
                        :class="period === opt.value ? 'border-indigo-600 bg-indigo-600 text-white' : 'border-gray-200 bg-white text-gray-700 hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-200 dark:hover:bg-gray-800'"
                        class="rounded-lg border px-4 py-2 text-sm font-medium transition"
                        x-text="opt.label"
                    ></button>
                </template>
            </div>

            <div class="flex flex-wrap items-center gap-2">
                <select x-model="actionFilter" x-on:change="applyFilters()" class="rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm text-gray-700 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-200">
                    <option value="all">All Actions</option>
                    <template x-for="action in (data.filters?.available_actions || [])" :key="`action-${action}`">
                        <option :value="action" x-text="action.charAt(0).toUpperCase() + action.slice(1)"></option>
                    </template>
                </select>

                <select x-model="formatFilter" x-on:change="applyFilters()" class="rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm text-gray-700 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-200">
                    <option value="all">All Formats</option>
                    <template x-for="format in (data.filters?.available_formats || [])" :key="`format-${format}`">
                        <option :value="format" x-text="format.toUpperCase()"></option>
                    </template>
                </select>

                <x-filament::button type="button" x-on:click="resetFilters()" color="gray" size="sm">Reset Filters</x-filament::button>

                <div x-show="loading" x-cloak class="flex items-center gap-2 text-sm text-gray-500 dark:text-gray-400">
                    <svg class="h-4 w-4 animate-spin" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    Loading...
                </div>
            </div>
        </x-filament::section>

        <div x-show="errorMessage" x-cloak>
            <x-filament::section>
                <div class="rounded-xl border border-danger-300 bg-danger-50 px-3 py-2 text-sm text-danger-700 dark:border-danger-700 dark:bg-danger-950/30 dark:text-danger-300" x-text="errorMessage"></div>
            </x-filament::section>
        </div>

        <div class="grid grid-cols-1 gap-3 sm:grid-cols-2 lg:grid-cols-5">
            <div class="rounded-xl border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-900">
                <p class="mb-1 text-xs font-medium text-gray-500 dark:text-gray-300">Total Compressions</p>
                <p class="text-xl font-bold text-gray-900 dark:text-gray-100" x-text="data.summary?.total_compressions ?? 0"></p>
            </div>
            <div class="rounded-xl border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-900">
                <p class="mb-1 text-xs font-medium text-gray-500 dark:text-gray-300">Original Size</p>
                <p class="text-xl font-bold text-gray-900 dark:text-gray-100" x-text="data.summary?.total_original_size ?? '0 B'"></p>
            </div>
            <div class="rounded-xl border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-900">
                <p class="mb-1 text-xs font-medium text-gray-500 dark:text-gray-300">Compressed</p>
                <p class="text-xl font-bold text-gray-900 dark:text-gray-100" x-text="data.summary?.total_compressed ?? '0 B'"></p>
            </div>
            <div class="rounded-xl border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-900">
                <p class="mb-1 text-xs font-medium text-gray-500 dark:text-gray-300">Space Saved</p>
                <p class="text-xl font-bold text-emerald-600 dark:text-emerald-400" x-text="data.summary?.total_saved ?? '0 B'"></p>
            </div>
            <div class="rounded-xl border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-900">
                <p class="mb-1 text-xs font-medium text-gray-500 dark:text-gray-300">Avg Reduction</p>
                <p class="text-xl font-bold text-amber-600 dark:text-amber-400" x-text="data.summary?.avg_reduction ?? '0%'"></p>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-3 sm:grid-cols-3">
            <div class="rounded-xl border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-900">
                <p class="mb-1 text-xs font-medium text-gray-500 dark:text-gray-300">Today</p>
                <p class="text-lg font-bold text-gray-900 dark:text-gray-100" x-text="(data.daily_overview?.today_count ?? 0) + ' ops'"></p>
                <p class="mt-1 text-xs text-emerald-600 dark:text-emerald-400" x-text="'Saved ' + (data.daily_overview?.today_saved ?? '0 B')"></p>
            </div>
            <div class="rounded-xl border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-900">
                <p class="mb-1 text-xs font-medium text-gray-500 dark:text-gray-300">Yesterday</p>
                <p class="text-lg font-bold text-gray-900 dark:text-gray-100" x-text="(data.daily_overview?.yesterday_count ?? 0) + ' ops'"></p>
                <p class="mt-1 text-xs text-emerald-600 dark:text-emerald-400" x-text="'Saved ' + (data.daily_overview?.yesterday_saved ?? '0 B')"></p>
            </div>
            <div class="rounded-xl border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-900">
                <p class="mb-1 text-xs font-medium text-gray-500 dark:text-gray-300">7-Day Daily Avg</p>
                <p class="text-lg font-bold text-gray-900 dark:text-gray-100" x-text="(data.daily_overview?.avg_daily_count_last_7d ?? 0) + ' ops/day'"></p>
                <p class="mt-1 text-xs text-emerald-600 dark:text-emerald-400" x-text="'Saved ' + (data.daily_overview?.avg_daily_saved_last_7d ?? '0 B') + '/day'"></p>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-3 sm:grid-cols-2 lg:grid-cols-4">
            <div class="rounded-xl border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-900">
                <p class="mb-1 text-xs font-medium text-gray-500 dark:text-gray-300">Unique Users (IP)</p>
                <p class="text-lg font-bold text-gray-900 dark:text-gray-100" x-text="data.audience?.unique_users ?? 0"></p>
                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Distinct IPs in selected period</p>
            </div>
            <div class="rounded-xl border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-900">
                <p class="mb-1 text-xs font-medium text-gray-500 dark:text-gray-300">Unique Clients</p>
                <p class="text-lg font-bold text-gray-900 dark:text-gray-100" x-text="data.audience?.unique_clients ?? 0"></p>
                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Unique IP + browser fingerprints</p>
            </div>
            <div class="rounded-xl border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-900">
                <p class="mb-1 text-xs font-medium text-gray-500 dark:text-gray-300">Today Unique Users</p>
                <p class="text-lg font-bold text-gray-900 dark:text-gray-100" x-text="data.daily_overview?.today_unique_users ?? 0"></p>
                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Distinct IPs today</p>
            </div>
            <div class="rounded-xl border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-900">
                <p class="mb-1 text-xs font-medium text-gray-500 dark:text-gray-300">Countries</p>
                <p class="text-lg font-bold text-gray-900 dark:text-gray-100" x-text="data.audience?.unique_countries ?? 0"></p>
                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Unique countries in selected period</p>
            </div>
        </div>

        <div class="grid gap-4 lg:grid-cols-2">
            <div class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm dark:border-gray-700 dark:bg-gray-900">
                <h3 class="mb-3 text-sm font-bold text-gray-900 dark:text-gray-100">Compressions Over Time</h3>
                <div class="h-60">
                    <canvas id="dailyChart"></canvas>
                </div>
            </div>

            <div class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm dark:border-gray-700 dark:bg-gray-900">
                <h3 class="mb-3 text-sm font-bold text-gray-900 dark:text-gray-100">Format Distribution</h3>
                <div class="h-60">
                    <canvas id="formatChart"></canvas>
                </div>
            </div>
        </div>

        <div class="grid gap-4 lg:grid-cols-3">
            <div class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm dark:border-gray-700 dark:bg-gray-900">
                <h3 class="mb-3 text-sm font-bold text-gray-900 dark:text-gray-100">Action Distribution</h3>
                <div class="h-60">
                    <canvas id="actionChart"></canvas>
                </div>
            </div>

            <div class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm dark:border-gray-700 dark:bg-gray-900">
                <h3 class="mb-3 text-sm font-bold text-gray-900 dark:text-gray-100">Average Reduction Trend</h3>
                <div class="h-60">
                    <canvas id="reductionTrendChart"></canvas>
                </div>
            </div>

            <div class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm dark:border-gray-700 dark:bg-gray-900">
                <h3 class="mb-3 text-sm font-bold text-gray-900 dark:text-gray-100">Country Distribution</h3>
                <div class="h-60">
                    <canvas id="countryChart"></canvas>
                </div>
            </div>
        </div>

        <div class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm dark:border-gray-700 dark:bg-gray-900">
            <h3 class="mb-3 text-sm font-bold text-gray-900 dark:text-gray-100">Top IP Activity</h3>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-gray-50 dark:bg-gray-800">
                        <tr>
                            <th class="px-4 py-2.5 text-left text-xs font-semibold uppercase text-gray-600 dark:text-gray-300">IP</th>
                            <th class="px-4 py-2.5 text-left text-xs font-semibold uppercase text-gray-600 dark:text-gray-300">Operations</th>
                            <th class="px-4 py-2.5 text-left text-xs font-semibold uppercase text-gray-600 dark:text-gray-300">Avg Reduction</th>
                            <th class="px-4 py-2.5 text-left text-xs font-semibold uppercase text-gray-600 dark:text-gray-300">Saved</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-800">
                        <template x-if="!data.ip_stats || data.ip_stats.length === 0">
                            <tr>
                                <td colspan="4" class="px-4 py-6 text-center text-gray-500 dark:text-gray-400">No IP activity data</td>
                            </tr>
                        </template>
                        <template x-for="(ip, idx) in (data.ip_stats || [])" :key="`ip-${idx}`">
                            <tr class="transition-colors hover:bg-gray-50 dark:hover:bg-gray-800">
                                <td class="px-4 py-2.5 font-medium text-gray-900 dark:text-gray-100" x-text="ip.ip_address"></td>
                                <td class="px-4 py-2.5 text-gray-600 dark:text-gray-300" x-text="ip.count"></td>
                                <td class="px-4 py-2.5 text-emerald-600 dark:text-emerald-400" x-text="ip.avg_reduction"></td>
                                <td class="px-4 py-2.5 text-gray-600 dark:text-gray-300" x-text="ip.saved"></td>
                            </tr>
                        </template>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm dark:border-gray-700 dark:bg-gray-900">
            <h3 class="mb-3 text-sm font-bold text-gray-900 dark:text-gray-100">Top Savings</h3>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-gray-50 dark:bg-gray-800">
                        <tr>
                            <th class="px-4 py-2.5 text-left text-xs font-semibold uppercase text-gray-600 dark:text-gray-300">File</th>
                            <th class="px-4 py-2.5 text-left text-xs font-semibold uppercase text-gray-600 dark:text-gray-300">Saved</th>
                            <th class="px-4 py-2.5 text-left text-xs font-semibold uppercase text-gray-600 dark:text-gray-300">Reduction</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-800">
                        <template x-if="!data.top_savings || data.top_savings.length === 0">
                            <tr>
                                <td colspan="3" class="px-4 py-6 text-center text-gray-500 dark:text-gray-400">No top savings data</td>
                            </tr>
                        </template>
                        <template x-for="(item, idx) in (data.top_savings || [])" :key="`saving-${idx}`">
                            <tr class="transition-colors hover:bg-gray-50 dark:hover:bg-gray-800">
                                <td class="px-4 py-2.5 font-medium text-gray-900 dark:text-gray-100" x-text="item.original_name"></td>
                                <td class="px-4 py-2.5 text-emerald-600 dark:text-emerald-400" x-text="item.saved"></td>
                                <td class="px-4 py-2.5 text-gray-600 dark:text-gray-300" x-text="item.reduction"></td>
                            </tr>
                        </template>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-900">
            <div class="border-b border-gray-200 px-5 py-4 dark:border-gray-800">
                <h3 class="font-bold text-gray-900 dark:text-gray-100">Recent Compressions</h3>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-gray-50 dark:bg-gray-800">
                        <tr>
                            <th class="px-5 py-3 text-left text-xs font-semibold uppercase text-gray-600 dark:text-gray-300">Preview</th>
                            <th class="px-5 py-3 text-left text-xs font-semibold uppercase text-gray-600 dark:text-gray-300">Action</th>
                            <th class="px-5 py-3 text-left text-xs font-semibold uppercase text-gray-600 dark:text-gray-300">Format</th>
                            <th class="px-5 py-3 text-left text-xs font-semibold uppercase text-gray-600 dark:text-gray-300">Original</th>
                            <th class="px-5 py-3 text-left text-xs font-semibold uppercase text-gray-600 dark:text-gray-300">Compressed</th>
                            <th class="px-5 py-3 text-left text-xs font-semibold uppercase text-gray-600 dark:text-gray-300">Reduction</th>
                            <th class="hidden px-5 py-3 text-left text-xs font-semibold uppercase text-gray-600 dark:text-gray-300 md:table-cell">Quality</th>
                            <th class="hidden px-5 py-3 text-left text-xs font-semibold uppercase text-gray-600 dark:text-gray-300 lg:table-cell">User IP</th>
                            <th class="hidden px-5 py-3 text-left text-xs font-semibold uppercase text-gray-600 dark:text-gray-300 lg:table-cell">Country</th>
                            <th class="hidden px-5 py-3 text-left text-xs font-semibold uppercase text-gray-600 dark:text-gray-300 md:table-cell">Date</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-800">
                        <template x-if="!data.recent || data.recent.length === 0">
                            <tr>
                                <td colspan="10" class="px-5 py-12 text-center text-gray-500 dark:text-gray-400">No reports for this period</td>
                            </tr>
                        </template>
                        <template x-for="r in (data.recent || [])" :key="r.id">
                            <tr class="transition-colors hover:bg-gray-50 dark:hover:bg-gray-800">
                                <td class="px-5 py-3">
                                    <div class="flex min-w-0 items-center gap-3">
                                        <template x-if="r.preview_url">
                                            <button type="button" x-on:click="openPreview(r.preview_url, r.original_name)" title="Open preview image" class="flex-shrink-0">
                                                <img :src="r.preview_url" :alt="'Preview of ' + r.original_name" class="h-16 w-16 rounded-lg border border-gray-200 object-cover shadow-sm dark:border-gray-600">
                                            </button>
                                        </template>
                                        <template x-if="!r.preview_url">
                                            <div class="flex h-16 w-16 flex-shrink-0 items-center justify-center rounded-lg border border-gray-200 bg-gray-100 text-xs font-bold text-gray-500 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300" x-text="(r.original_format || '?').slice(0, 3)"></div>
                                        </template>
                                        <div class="min-w-0">
                                            <template x-if="r.preview_url">
                                                <button type="button" x-on:click="openPreview(r.preview_url, r.original_name)" class="group inline-flex max-w-[180px] items-center gap-1.5 font-medium text-gray-900 hover:text-indigo-600 dark:text-gray-100 dark:hover:text-indigo-400" title="View Image">
                                                    <span x-text="r.original_name" class="truncate"></span>
                                                    <svg class="h-3.5 w-3.5 flex-shrink-0 opacity-0 transition-opacity group-hover:opacity-100" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                                </button>
                                            </template>
                                            <template x-if="!r.preview_url">
                                                <span class="block max-w-[180px] truncate font-medium text-gray-900 dark:text-gray-100" x-text="r.original_name"></span>
                                            </template>
                                            <p class="mt-0.5 text-xs text-gray-500 dark:text-gray-400" x-text="r.dimensions"></p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-5 py-3">
                                    <span class="inline-flex items-center rounded-full px-2.5 py-1 text-xs font-semibold"
                                          :class="{
                                              'bg-indigo-100 text-indigo-700 dark:bg-indigo-900/40 dark:text-indigo-300': r.action === 'compress',
                                              'bg-purple-100 text-purple-700 dark:bg-purple-900/40 dark:text-purple-300': r.action === 'convert',
                                              'bg-blue-100 text-blue-700 dark:bg-blue-900/40 dark:text-blue-300': r.action === 'batch',
                                              'bg-orange-100 text-orange-700 dark:bg-orange-900/40 dark:text-orange-300': r.action === 'resize',
                                              'bg-pink-100 text-pink-700 dark:bg-pink-900/40 dark:text-pink-300': r.action === 'watermark',
                                              'bg-teal-100 text-teal-700 dark:bg-teal-900/40 dark:text-teal-300': r.action === 'url_compress',
                                              'bg-gray-100 text-gray-700 dark:bg-gray-800 dark:text-gray-300': !['compress','convert','batch','resize','watermark','url_compress'].includes(r.action),
                                          }"
                                          x-text="r.action || 'compress'"></span>
                                </td>
                                <td class="px-5 py-3">
                                    <span class="inline-flex items-center gap-1.5">
                                        <span class="rounded bg-indigo-100 px-2 py-1 text-xs font-medium text-indigo-700 dark:bg-indigo-900/40 dark:text-indigo-300" x-text="r.original_format"></span>
                                        <svg class="h-3 w-3 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                                        <span class="rounded bg-emerald-100 px-2 py-1 text-xs font-medium text-emerald-700 dark:bg-emerald-900/40 dark:text-emerald-300" x-text="r.output_format"></span>
                                    </span>
                                </td>
                                <td class="px-5 py-3 text-gray-600 dark:text-gray-300" x-text="r.original_size"></td>
                                <td class="px-5 py-3 text-gray-600 dark:text-gray-300" x-text="r.compressed_size"></td>
                                <td class="px-5 py-3"><span class="rounded-full bg-emerald-100 px-2.5 py-1 text-xs font-semibold text-emerald-700 dark:bg-emerald-900/40 dark:text-emerald-300" x-text="r.reduction"></span></td>
                                <td class="hidden px-5 py-3 text-gray-600 dark:text-gray-300 md:table-cell" x-text="r.quality"></td>
                                <td class="hidden px-5 py-3 font-mono text-xs text-gray-600 dark:text-gray-300 lg:table-cell" x-text="r.ip_address || '—'"></td>
                                <td class="hidden px-5 py-3 text-xs font-semibold text-gray-600 dark:text-gray-300 lg:table-cell" x-text="r.country || 'ZZ'"></td>
                                <td class="hidden px-5 py-3 text-gray-500 dark:text-gray-400 md:table-cell" x-text="r.created_at" :title="r.created_date"></td>
                            </tr>
                        </template>
                    </tbody>
                </table>
            </div>

            <div class="flex flex-col gap-3 border-t border-gray-200 px-5 py-4 dark:border-gray-800 sm:flex-row sm:items-center sm:justify-between">
                <p class="text-xs text-gray-500 dark:text-gray-300" x-text="`Showing ${data.recent_pagination?.from || 0}-${data.recent_pagination?.to || 0} of ${data.recent_pagination?.total || 0}`"></p>

                <div class="flex items-center gap-2">
                    <label class="text-xs text-gray-500 dark:text-gray-300">Rows</label>
                    <select x-model.number="perPage" x-on:change="changePerPage(perPage)" class="rounded-md border border-gray-200 bg-white px-2 py-1.5 text-xs text-gray-700 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-200">
                        <template x-for="size in perPageOptions" :key="`size-${size}`">
                            <option :value="size" x-text="size"></option>
                        </template>
                    </select>

                    <button type="button" x-on:click="changePage((data.recent_pagination?.current_page || 1) - 1)" :disabled="(data.recent_pagination?.current_page || 1) <= 1" class="rounded-md border border-gray-200 px-3 py-1.5 text-xs font-medium text-gray-600 transition disabled:cursor-not-allowed disabled:opacity-50 dark:border-gray-600 dark:text-gray-300 dark:hover:bg-gray-800">Prev</button>
                    <span class="text-xs font-medium text-gray-500 dark:text-gray-300" x-text="`Page ${data.recent_pagination?.current_page || 1} / ${data.recent_pagination?.last_page || 1}`\"></span>
                    <button type="button" x-on:click="changePage((data.recent_pagination?.current_page || 1) + 1)" :disabled="(data.recent_pagination?.current_page || 1) >= (data.recent_pagination?.last_page || 1)" class="rounded-md border border-gray-200 px-3 py-1.5 text-xs font-medium text-gray-600 transition disabled:cursor-not-allowed disabled:opacity-50 dark:border-gray-600 dark:text-gray-300 dark:hover:bg-gray-800">Next</button>
                </div>
            </div>
        </div>

        <div x-show="previewModalOpen" x-cloak x-on:keydown.escape.window="closePreview()" class="fixed inset-0 z-[70] flex items-center justify-center p-4 sm:p-6">
            <div class="absolute inset-0 bg-black/70" x-on:click="closePreview()"></div>
            <div class="relative max-h-[90vh] w-full max-w-5xl overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-2xl dark:border-gray-700 dark:bg-gray-900">
                <div class="flex items-center justify-between border-b border-gray-200 px-4 py-3 dark:border-gray-800 sm:px-5">
                    <h4 class="truncate pr-4 text-sm font-semibold text-gray-900 dark:text-gray-100" x-text="previewImageName || 'Image Preview'"></h4>
                    <button type="button" x-on:click="closePreview()" class="rounded-lg p-2 text-gray-500 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-800" aria-label="Close preview">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>
                <div class="flex max-h-[calc(90vh-70px)] items-center justify-center overflow-auto bg-gray-50 p-3 dark:bg-gray-800 sm:p-4">
                    <img :src="previewImageUrl" :alt="previewImageName || 'Preview image'" class="max-h-[calc(90vh-110px)] max-w-full rounded-lg object-contain">
                </div>
            </div>
        </div>
    </div>

    @once
        <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    @endonce

    <script>
        function reportsPage(config) {
            return {
                dataUrl: config.dataUrl,
                exportBaseUrl: config.exportUrl,
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
                    { value: 'all', label: 'All Time' },
                ],
                loading: false,
                errorMessage: '',
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
                    top_savings: [],
                    recent: [],
                    recent_pagination: { current_page: 1, last_page: 1, per_page: 15, total: 0, from: 0, to: 0 },
                },
                dailyChartInstance: null,
                formatChartInstance: null,
                actionChartInstance: null,
                reductionTrendChartInstance: null,
                countryChartInstance: null,

                initApp() {
                    this.setupThemeSync();

                    this.loadData();
                },

                setupThemeSync() {
                    const html = document.documentElement;
                    const observer = new MutationObserver(() => this.renderCharts());
                    observer.observe(html, { attributes: true, attributeFilter: ['class'] });
                    this._themeObserver = observer;
                },

                isDarkTheme() {
                    return document.documentElement.classList.contains('dark');
                },

                async loadData() {
                    this.loading = true;
                    this.errorMessage = '';

                    try {
                        const params = new URLSearchParams({
                            period: this.period,
                            action: this.actionFilter,
                            format: this.formatFilter,
                            page: this.currentPage,
                            per_page: this.perPage,
                        });

                        const response = await fetch(`${this.dataUrl}?${params.toString()}`, {
                            credentials: 'same-origin',
                            headers: {
                                Accept: 'application/json',
                                'X-Requested-With': 'XMLHttpRequest',
                            },
                        });

                        if (!response.ok) {
                            throw new Error('Failed to load report data');
                        }

                        this.data = await response.json();
                        this.actionFilter = this.data.filters?.selected?.action || this.actionFilter;
                        this.formatFilter = this.data.filters?.selected?.format || this.formatFilter;
                        this.currentPage = this.data.recent_pagination?.current_page || this.currentPage;
                        this.perPage = this.data.recent_pagination?.per_page || this.perPage;

                        this.$nextTick(() => this.renderCharts());
                    } catch (error) {
                        console.error('Reports load error:', error);
                        this.errorMessage = 'Failed to load reports data. Please refresh and try again.';
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

                    if (nextPage === this.currentPage) {
                        return;
                    }

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

                    return `${this.exportBaseUrl}?${params.toString()}`;
                },

                openPreview(imageUrl, imageName = 'Image Preview') {
                    if (!imageUrl) {
                        return;
                    }

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
                    if (typeof Chart === 'undefined') {
                        this.errorMessage = 'Chart library is not available right now. Reload this page to render charts.';
                        return;
                    }

                    this.renderDailyChart();
                    this.renderFormatChart();
                    this.renderActionChart();
                    this.renderReductionTrendChart();
                    this.renderCountryChart();
                },

                renderDailyChart() {
                    const el = document.getElementById('dailyChart');
                    if (!el) {
                        return;
                    }

                    if (this.dailyChartInstance) {
                        this.dailyChartInstance.destroy();
                    }

                    const isDark = this.isDarkTheme();
                    const labels = (this.data.daily_stats || []).map(item => item.date);
                    const counts = (this.data.daily_stats || []).map(item => item.count);

                    this.dailyChartInstance = new Chart(el, {
                        type: 'bar',
                        data: {
                            labels,
                            datasets: [{
                                label: 'Compressions',
                                data: counts,
                                backgroundColor: isDark ? 'rgba(129, 140, 248, 0.6)' : 'rgba(99, 102, 241, 0.7)',
                                borderRadius: 6,
                                borderSkipped: false,
                            }],
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: { legend: { display: false } },
                            scales: {
                                y: { beginAtZero: true, ticks: { color: isDark ? '#9ca3af' : '#6b7280', stepSize: 1 }, grid: { color: isDark ? '#1f2937' : '#f3f4f6' } },
                                x: { ticks: { color: isDark ? '#9ca3af' : '#6b7280' }, grid: { display: false } },
                            },
                        },
                    });
                },

                renderFormatChart() {
                    const el = document.getElementById('formatChart');
                    if (!el) {
                        return;
                    }

                    if (this.formatChartInstance) {
                        this.formatChartInstance.destroy();
                    }

                    const isDark = this.isDarkTheme();
                    const stats = this.data.format_stats || [];

                    if (stats.length === 0) {
                        return;
                    }

                    const labels = stats.map(item => (item.original_format || '').toUpperCase());
                    const counts = stats.map(item => item.count);
                    const colors = ['#6366f1', '#10b981', '#f59e0b', '#ef4444', '#8b5cf6'];

                    this.formatChartInstance = new Chart(el, {
                        type: 'doughnut',
                        data: {
                            labels,
                            datasets: [{ data: counts, backgroundColor: colors.slice(0, labels.length), borderWidth: 3, borderColor: isDark ? '#111827' : '#ffffff' }],
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: { legend: { position: 'bottom', labels: { color: isDark ? '#9ca3af' : '#6b7280', padding: 16, usePointStyle: true, pointStyleWidth: 10 } } },
                        },
                    });
                },

                renderActionChart() {
                    const el = document.getElementById('actionChart');
                    if (!el) {
                        return;
                    }

                    if (this.actionChartInstance) {
                        this.actionChartInstance.destroy();
                    }

                    const isDark = this.isDarkTheme();
                    const stats = this.data.action_stats || [];

                    if (stats.length === 0) {
                        return;
                    }

                    const labels = stats.map(item => item.action || 'compress');
                    const counts = stats.map(item => item.count);

                    this.actionChartInstance = new Chart(el, {
                        type: 'bar',
                        data: {
                            labels,
                            datasets: [{ label: 'Operations', data: counts, backgroundColor: ['#6366f1', '#10b981', '#f59e0b', '#3b82f6', '#ec4899', '#14b8a6', '#94a3b8'], borderRadius: 6 }],
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: { legend: { display: false } },
                            scales: {
                                y: { beginAtZero: true, ticks: { color: isDark ? '#9ca3af' : '#6b7280', stepSize: 1 }, grid: { color: isDark ? '#1f2937' : '#f3f4f6' } },
                                x: { ticks: { color: isDark ? '#9ca3af' : '#6b7280' }, grid: { display: false } },
                            },
                        },
                    });
                },

                renderReductionTrendChart() {
                    const el = document.getElementById('reductionTrendChart');
                    if (!el) {
                        return;
                    }

                    if (this.reductionTrendChartInstance) {
                        this.reductionTrendChartInstance.destroy();
                    }

                    const isDark = this.isDarkTheme();
                    const stats = this.data.daily_stats || [];

                    if (stats.length === 0) {
                        return;
                    }

                    const labels = stats.map(item => item.date);
                    const avgReduction = stats.map(item => Number(item.avg_reduction || 0).toFixed(1));

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
                            }],
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: { legend: { display: false } },
                            scales: {
                                y: { beginAtZero: true, max: 100, ticks: { color: isDark ? '#9ca3af' : '#6b7280', callback: value => `${value}%` }, grid: { color: isDark ? '#1f2937' : '#f3f4f6' } },
                                x: { ticks: { color: isDark ? '#9ca3af' : '#6b7280' }, grid: { display: false } },
                            },
                        },
                    });
                },

                renderCountryChart() {
                    const el = document.getElementById('countryChart');
                    if (!el) {
                        return;
                    }

                    if (this.countryChartInstance) {
                        this.countryChartInstance.destroy();
                    }

                    const isDark = this.isDarkTheme();
                    const stats = this.data.country_stats || [];

                    if (stats.length === 0) {
                        return;
                    }

                    const labels = stats.map(item => item.country || 'ZZ');
                    const counts = stats.map(item => item.count);

                    this.countryChartInstance = new Chart(el, {
                        type: 'doughnut',
                        data: {
                            labels,
                            datasets: [{ data: counts, backgroundColor: ['#6366f1', '#10b981', '#f59e0b', '#ef4444', '#3b82f6', '#ec4899', '#14b8a6', '#8b5cf6', '#f97316', '#22c55e'], borderWidth: 3, borderColor: isDark ? '#111827' : '#ffffff' }],
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: {
                                    position: 'bottom',
                                    labels: { color: isDark ? '#9ca3af' : '#6b7280', padding: 12, usePointStyle: true, pointStyleWidth: 10 },
                                },
                            },
                        },
                    });
                },
            };
        }
    </script>
</x-filament-panels::page>