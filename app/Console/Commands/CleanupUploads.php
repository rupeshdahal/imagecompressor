<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;

class CleanupUploads extends Command
{
    /**
     * The name and signature of the console command.
     *
     * --minutes  : Age threshold; files/dirs older than this are deleted (default 30).
     * --dry-run  : List what would be deleted without actually deleting anything.
     */
    protected $signature = 'uploads:cleanup
                            {--minutes=30 : Minutes after which files are deleted}
                            {--dry-run    : Preview deletions without removing anything}';

    /**
     * The console command description.
     */
    protected $description = 'Delete processed uploads and orphaned temp chunks older than N minutes';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $minutes   = (int) $this->option('minutes');
        $dryRun    = (bool) $this->option('dry-run');
        $cutoff    = Carbon::now()->subMinutes($minutes);
        $deleted   = 0;
        $skipped   = 0;

        if ($dryRun) {
            $this->warn('[DRY RUN] No files will be deleted.');
        }

        // ── 1. Clean processed output files ─────────────────────────────────
        $uploadsDir = storage_path('app/public/uploads');

        if (File::isDirectory($uploadsDir)) {
            foreach (File::files($uploadsDir) as $file) {
                // Never touch hidden files (.gitkeep, .gitignore, etc.)
                if (str_starts_with($file->getFilename(), '.')) {
                    $skipped++;
                    continue;
                }

                $lastModified = Carbon::createFromTimestamp($file->getMTime());

                if ($lastModified->lt($cutoff)) {
                    if ($dryRun) {
                        $this->line('  [would delete] ' . $file->getPathname());
                    } else {
                        File::delete($file->getPathname());
                    }
                    $deleted++;
                }
            }
        } else {
            $this->warn('Uploads directory does not exist: ' . $uploadsDir);
        }

        // ── 2. Clean orphaned temp chunk directories ─────────────────────────
        $tempDir = storage_path('app/temp-uploads');

        if (File::isDirectory($tempDir)) {
            foreach (File::directories($tempDir) as $dir) {
                // Determine age: use directory mtime (updated when last chunk written)
                $mtime = @filemtime($dir);
                if ($mtime === false) {
                    continue;
                }

                $lastModified = Carbon::createFromTimestamp($mtime);

                if ($lastModified->lt($cutoff)) {
                    if ($dryRun) {
                        $this->line('  [would delete dir] ' . $dir);
                    } else {
                        File::deleteDirectory($dir);
                    }
                    $deleted++;
                }
            }
        }

        $label = $dryRun ? 'Would delete' : 'Deleted';
        $this->info("{$label} {$deleted} item(s) older than {$minutes} minute(s). Skipped {$skipped} protected file(s).");

        return self::SUCCESS;
    }
}
