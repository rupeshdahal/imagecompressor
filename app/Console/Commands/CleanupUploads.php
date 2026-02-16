<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;

class CleanupUploads extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'uploads:cleanup {--minutes=30 : Minutes after which files are deleted}';

    /**
     * The console command description.
     */
    protected $description = 'Delete uploaded compressed images older than the specified minutes';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $minutes = (int) $this->option('minutes');
        $directory = storage_path('app/public/uploads');

        if (!File::isDirectory($directory)) {
            $this->info('Uploads directory does not exist. Nothing to clean.');
            return self::SUCCESS;
        }

        $files = File::files($directory);
        $cutoff = Carbon::now()->subMinutes($minutes);
        $deleted = 0;

        foreach ($files as $file) {
            // Skip .gitignore or hidden files
            if (str_starts_with($file->getFilename(), '.')) {
                continue;
            }

            $lastModified = Carbon::createFromTimestamp($file->getMTime());

            if ($lastModified->lt($cutoff)) {
                File::delete($file->getPathname());
                $deleted++;
            }
        }

        $this->info("Cleanup complete. Deleted {$deleted} file(s) older than {$minutes} minutes.");

        return self::SUCCESS;
    }
}
