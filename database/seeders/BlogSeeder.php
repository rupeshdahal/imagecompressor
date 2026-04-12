<?php

namespace Database\Seeders;

use App\Models\BlogPost;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class BlogSeeder extends Seeder
{
    /**
     * Seed the blog posts table with data from config/blogs.php
     */
    public function run(): void
    {
        // Get blog posts configuration
        $blogPosts = config('blogs.posts', []);

        if (empty($blogPosts)) {
            $this->command->warn('No blog posts found in config/blogs.php');
            return;
        }

        // Clear existing blog posts (optional - remove if you want to preserve)
        // BlogPost::truncate();

        $created = 0;
        $updated = 0;
        $skipped = 0;

        foreach ($blogPosts as $blogData) {
            try {
                // Prepare published_at timestamp
                $publishedAt = isset($blogData['published_at']) 
                    ? Carbon::createFromFormat('Y-m-d H:i:s', $blogData['published_at'])
                    : now();

                // Update or create blog post
                $blog = BlogPost::updateOrCreate(
                    ['slug' => $blogData['slug']],
                    [
                        'title'              => $blogData['title'] ?? null,
                        'meta_title'         => $blogData['meta_title'] ?? $blogData['title'] ?? null,
                        'meta_description'   => $blogData['meta_description'] ?? null,
                        'excerpt'            => $blogData['excerpt'] ?? null,
                        'featured_image_path' => $blogData['featured_image_path'] ?? null,
                        'content'            => $blogData['content'] ?? '', // Empty content for now
                        'status'             => $blogData['status'] ?? 'draft',
                        'published_at'       => $publishedAt,
                        'author_id'          => $blogData['author_id'] ?? null,
                    ]
                );

                // Check if created or updated
                if ($blog->wasRecentlyCreated) {
                    $created++;
                    $this->command->line("✓ Created: {$blogData['slug']}");
                } else {
                    $updated++;
                    $this->command->line("↻ Updated: {$blogData['slug']}");
                }
            } catch (\Exception $e) {
                $skipped++;
                $this->command->error("✗ Error processing {$blogData['slug']}: {$e->getMessage()}");
            }
        }

        // Summary output
        $this->command->newLine();
        $this->command->info("Blog Seeding Summary:");
        $this->command->info("  Created: {$created}");
        $this->command->info("  Updated: {$updated}");
        if ($skipped > 0) {
            $this->command->warn("  Skipped: {$skipped}");
        }
        $this->command->newLine();
        $this->command->info("Total blog posts in database: " . BlogPost::count());
    }
}
