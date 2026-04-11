<x-filament-widgets::widget>
    <x-filament::section>
        <div class="grid gap-4 lg:grid-cols-3">
            <a href="{{ url('/admin/reports') }}" class="group rounded-2xl border border-gray-200 bg-white p-5 shadow-sm transition hover:-translate-y-0.5 hover:border-indigo-300 hover:shadow-md dark:border-gray-800 dark:bg-gray-950">
                <div class="flex items-center gap-4">
                    <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-indigo-50 text-indigo-600 dark:bg-indigo-500/10 dark:text-indigo-300">
                        <x-heroicon-o-chart-bar-square class="h-6 w-6" />
                    </div>
                    <div>
                        <p class="font-semibold text-gray-900 dark:text-gray-100">View Reports</p>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Detailed analytics and charts</p>
                    </div>
                </div>
            </a>

            <a href="{{ url('/') }}" target="_blank" class="group rounded-2xl border border-gray-200 bg-white p-5 shadow-sm transition hover:-translate-y-0.5 hover:border-emerald-300 hover:shadow-md dark:border-gray-800 dark:bg-gray-950">
                <div class="flex items-center gap-4">
                    <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600 dark:bg-emerald-500/10 dark:text-emerald-300">
                        <x-heroicon-o-arrow-top-right-on-square class="h-6 w-6" />
                    </div>
                    <div>
                        <p class="font-semibold text-gray-900 dark:text-gray-100">Visit Site</p>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Open the public compressor</p>
                    </div>
                </div>
            </a>

            <a href="{{ url('/admin/blog') }}" class="group rounded-2xl border border-gray-200 bg-white p-5 shadow-sm transition hover:-translate-y-0.5 hover:border-amber-300 hover:shadow-md dark:border-gray-800 dark:bg-gray-950">
                <div class="flex items-center gap-4">
                    <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-amber-50 text-amber-600 dark:bg-amber-500/10 dark:text-amber-300">
                        <x-heroicon-o-document-text class="h-6 w-6" />
                    </div>
                    <div>
                        <p class="font-semibold text-gray-900 dark:text-gray-100">Manage Blog</p>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Create and edit posts</p>
                    </div>
                </div>
            </a>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>