<?php

namespace App\Console\Commands;

use App\Models\CompressionReport;
use Carbon\Carbon;
use Illuminate\Console\Command;

class ReportsDataCheck extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'reports:data-check
                            {--days=1 : Records older than this many days are matched}
                            {--delete : Delete matched records}
                            {--dry-run : Preview matched records without deleting}';

    /**
     * The console command description.
     */
    protected $description = 'Check report records older than N days and optionally delete them';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $days = max(1, (int) $this->option('days'));
        $delete = (bool) $this->option('delete');
        $dryRun = (bool) $this->option('dry-run');

        $cutoff = Carbon::now()->subDays($days);

        $total = CompressionReport::count();
        $oldQuery = CompressionReport::where('created_at', '<', $cutoff);
        $oldCount = (clone $oldQuery)->count();

        $this->info('Report data check');
        $this->line('Cutoff: ' . $cutoff->toDateTimeString());
        $this->line('Total records: ' . $total);
        $this->line("Records older than {$days} day(s): {$oldCount}");

        if ($oldCount > 0) {
            $oldest = (clone $oldQuery)->orderBy('created_at')->value('created_at');
            $latest = (clone $oldQuery)->orderByDesc('created_at')->value('created_at');

            $this->line('Oldest matched: ' . ($oldest ? Carbon::parse($oldest)->toDateTimeString() : '-'));
            $this->line('Latest matched: ' . ($latest ? Carbon::parse($latest)->toDateTimeString() : '-'));
        }

        if (!$delete) {
            $this->comment('Check-only mode. Use --delete to remove matched records.');
            return self::SUCCESS;
        }

        if ($dryRun) {
            $this->warn("[DRY RUN] Would delete {$oldCount} record(s) older than {$days} day(s).");
            return self::SUCCESS;
        }

        $deleted = 0;
        (clone $oldQuery)
            ->orderBy('id')
            ->chunkById(500, function ($rows) use (&$deleted) {
                $ids = $rows->pluck('id')->all();
                if (empty($ids)) {
                    return;
                }

                $deleted += CompressionReport::whereIn('id', $ids)->delete();
            });

        $this->info("Deleted {$deleted} record(s) older than {$days} day(s).");

        return self::SUCCESS;
    }
}
