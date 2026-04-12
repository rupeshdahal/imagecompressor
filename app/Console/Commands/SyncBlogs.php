<?php

namespace App\Console\Commands;

use App\Models\BlogPost;
use Carbon\Carbon;
use Illuminate\Console\Command;

class SyncBlogs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'blogs:sync
                            {--fresh : Remove all existing blogs before syncing}
                            {--only-new : Only sync new blogs, skip updates}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync all blogs from config/blogs.php to database. Dynamic blog management made easy.';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $this->info('Starting blog synchronization...');
        $this->newLine();

        $fresh = $this->option('fresh');
        $onlyNew = $this->option('only-new');

        // Optional: Remove all existing blogs
        if ($fresh) {
            if ($this->confirm('Remove all existing blogs before syncing?', false)) {
                $count = BlogPost::count();
                BlogPost::truncate();
                $this->warn("Deleted {$count} existing blog posts.");
            }
        }

        // Get blog posts configuration
        $blogPosts = config('blogs.posts', []);

        if (empty($blogPosts)) {
            $this->error('No blog posts found in config/blogs.php');
            return self::FAILURE;
        }

        $created = 0;
        $updated = 0;
        $skipped = 0;

        $this->withProgressBar($blogPosts, function ($blogData) use (&$created, &$updated, &$skipped, $onlyNew) {
            try {
                $slug = $blogData['slug'];

                // Check if blog exists
                $existingBlog = BlogPost::where('slug', $slug)->first();

                if ($existingBlog && $onlyNew) {
                    $skipped++;
                    return;
                }

                // Prepare published_at timestamp
                $publishedAt = isset($blogData['published_at'])
                    ? Carbon::createFromFormat('Y-m-d H:i:s', $blogData['published_at'])
                    : now();

                // Update or create blog post
                $blog = BlogPost::updateOrCreate(
                    ['slug' => $slug],
                    [
                        'title'              => $blogData['title'] ?? null,
                        'meta_title'         => $blogData['meta_title'] ?? $blogData['title'] ?? null,
                        'meta_description'   => $blogData['meta_description'] ?? null,
                        'excerpt'            => $blogData['excerpt'] ?? null,
                        'featured_image_path' => $blogData['featured_image_path'] ?? null,
                        'content'            => $blogData['content'] ?? '',
                        'status'             => $blogData['status'] ?? 'draft',
                        'published_at'       => $publishedAt,
                        'author_id'          => $blogData['author_id'] ?? null,
                    ]
                );

                if ($blog->wasRecentlyCreated) {
                    $created++;
                } else {
                    $updated++;
                }
            } catch (\Exception $e) {
                $skipped++;
                $this->error("\nError processing {$blogData['slug']}: {$e->getMessage()}");
            }
        });

        $this->newLine(2);

        // Summary output
        $this->info('Blog Synchronization Complete!');
        $this->line("  <fg=green>✓ Created:</>  {$created}");
        if ($updated > 0) {
            $this->line("  <fg=yellow>↻ Updated:</>  {$updated}");
        }
        if ($skipped > 0) {
            $this->line("  <fg=red>✗ Skipped:</>  {$skipped}");
        }

        $totalBlogs = BlogPost::count();
        $publishedBlogs = BlogPost::where('status', 'published')->count();

        $this->newLine();
        $this->info("Database Summary:");
        $this->line("  Total blogs:     {$totalBlogs}");
        $this->line("  Published:       {$publishedBlogs}");
        $this->line("  Draft/Other:     " . ($totalBlogs - $publishedBlogs));

        return self::SUCCESS;
    }
}
