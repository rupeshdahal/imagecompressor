# Dynamic Blog Seeding System

This document explains how the new dynamic blog seeding system works and how to manage blogs.

## Overview

The blog system is now fully dynamic and database-driven. All blog metadata is stored in `config/blogs.php` and can be easily updated without touching code.

## System Components

### 1. **Blog Configuration** (`config/blogs.php`)
Contains metadata for all blog posts:
- `slug` - URL-friendly identifier
- `title` - Full SEO title (meta title)
- `meta_title` - Short meta title
- `meta_description` - SEO description
- `excerpt` - Short preview text
- `published_at` - Publication timestamp
- `status` - 'published' or 'draft'
- `author_id` - Optional author reference

### 2. **Blog Model** (`app/Models/BlogPost`)
Eloquent model managing blog database records with:
- Full relationship support to users
- Timestamps and state casting
- Mass assignable fields

### 3. **Blog Seeder** (`database/seeders/BlogSeeder.php`)
Seeds database from config:
- Creates or updates blog posts
- Handles date parsing
- Provides detailed output/feedback
- Safe to run multiple times (idempotent)

### 4. **BlogPost Factory** (`database/factories/BlogPostFactory.php`)
For testing and development:
- Generates fake blog posts
- Supports draft/published states
- Useful for feature development

### 5. **Sync Command** (`app/Console/Commands/SyncBlogs.php`)
CLI tool for managing blogs:
- Sync blogs from config to database
- Optional `--fresh` flag to delete all existing blogs
- Optional `--only-new` flag to skip updates
- Progress bar with summary

## Usage Guide

### Initial Setup

1. **Seed all blogs:**
   ```bash
   php artisan db:seed --class=BlogSeeder
   # or run full database seed
   php artisan db:seed
   ```

2. **Verify seeding:**
   ```bash
   php artisan tinker
   >>> App\Models\BlogPost::count()
   => 10
   ```

### Adding/Updating Blogs

1. **Edit config:**
   ```php
   // config/blogs.php
   'posts' => [
       // ... existing blogs
       [
           'slug'              => 'my-new-blog',
           'title'             => 'My New Blog Post | CompresslyPro',
           'meta_title'        => 'My New Blog Post',
           'meta_description'  => 'A great blog about image compression...',
           'excerpt'           => 'Short preview...',
           'published_at'      => '2026-04-12 10:00:00',
           'status'            => 'published',
       ],
   ]
   ```

2. **Sync to database:**
   ```bash
   php artisan blogs:sync
   # Output will show what was created/updated
   ```

3. **Create corresponding Blade view:**
   ```bash
   # Create: resources/views/blog/my-new-blog.blade.php
   # Copy from another blog post and update metadata
   ```

### Management Commands

**Sync all blogs (create/update):**
```bash
php artisan blogs:sync
```

**Sync only new blogs (skip existing):**
```bash
php artisan blogs:sync --only-new
```

**Reset all blogs and resync:**
```bash
php artisan blogs:sync --fresh
# This will prompt for confirmation before deleting
```

**Full database seed (including blogs):**
```bash
php artisan db:seed
```

**Seed only blogs (with artisan call):**
```bash
php artisan seed:blog
```

## Database Schema

The `blog_posts` table structure:
```sql
CREATE TABLE blog_posts (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    author_id BIGINT NULLABLE,
    title VARCHAR(255) NOT NULL,
    slug VARCHAR(255) UNIQUE NOT NULL,
    meta_title VARCHAR(255) NULLABLE,
    meta_description TEXT NULLABLE,
    excerpt TEXT NULLABLE,
    featured_image_path VARCHAR(255) NULLABLE,
    content LONGTEXT NOT NULL,
    status VARCHAR(50) DEFAULT 'draft',
    published_at TIMESTAMP NULLABLE,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    FOREIGN KEY (author_id) REFERENCES users(id) ON DELETE SET NULL
)
```

## Best Practices

### 1. **SEO Optimization**
- Use descriptive, keyword-rich titles
- Write compelling meta descriptions (150-160 chars)
- Keep slugs short and meaningful

### 2. **Status Management**
- Set `status: 'draft'` for work-in-progress
- Use `status: 'published'` and set `published_at` for live posts
- Never publish without a date

### 3. **Content Organization**
- Maintain consistent date format: `YYYY-MM-DD HH:MM:SS`
- Group related blogs in config
- Use meaningful excerpts

### 4. **Blade Views**
- Match slug to blade filename
- Always extend `layouts.page`
- Include full SEO metadata sections
- Add JSON-LD structured data

### 5. **Author Attribution**
- Link to admin user via `author_id` (optional)
- Leave null if using system-wide authorship

## Dynamic Routes

Blog routes automatically use:
- Database for canonical blog existence
- Blade views for rendering
- Config for initial seeding

Routes are still hardcoded in `routes/web.php` for now. To make fully dynamic:

```php
// Future: Make routes dynamic from database
Route::get('/blog/{slug}', function (string $slug) {
    $blog = BlogPost::where('slug', $slug)->published()->firstOrFail();
    return view('blog.' . $slug, compact('blog'));
})->name('blog.show');
```

## Testing

Create test blogs easily:
```php
// Single blog
$blog = BlogPost::factory()->create();

// Multiple blogs
$blogs = BlogPost::factory()->count(5)->create();

// Draft blogs
$draft = BlogPost::factory()->draft()->create();
```

## Troubleshooting

**Command not found:**
```bash
# Clear cache and run
php artisan cache:clear
php artisan config:cache
php artisan blogs:sync
```

**Blogs not syncing:**
- Check `config/blogs.php` exists
- Verify config syntax (valid PHP array)
- Check database connection
- Ensure migrations have run: `php artisan migrate`

**Dates parsing wrong:**
- Verify format: `YYYY-MM-DD HH:MM:SS`
- Check timezone in `.env`
- Use `Carbon` for complex date logic

## Future Enhancements

1. **Database-driven routes** - Remove hardcoded slugs
2. **Admin panel** - Create/edit blogs via Filament
3. **Content extraction** - Auto-extract content from Blade views
4. **Featured images** - Auto-upload and link images
5. **Tags/Categories** - Add taxonomy support
6. **Search** - Full-text search across blogs
7. **Comments** - Reader engagement system
8. **Analytics** - Track blog views and engagement

