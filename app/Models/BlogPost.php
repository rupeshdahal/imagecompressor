<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class BlogPost extends Model
{
    protected $fillable = [
        'title', 'slug', 'excerpt', 'content',
        'meta_title', 'meta_description', 'meta_keywords',
        'og_title', 'og_description',
        'category', 'tags',
        'read_time', 'word_count', 'schema_keywords',
        'date_published', 'date_modified',
        'is_published', 'is_featured', 'sort_order',
    ];

    protected $casts = [
        'tags'          => 'array',
        'is_published'  => 'boolean',
        'is_featured'   => 'boolean',
        'date_published' => 'date',
        'date_modified'  => 'date',
    ];

    // Route model binding via slug
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    // ── Scopes ────────────────────────────────────────────────
    public function scopePublished(Builder $query): Builder
    {
        return $query->where('is_published', true);
    }

    public function scopeFeatured(Builder $query): Builder
    {
        return $query->where('is_featured', true);
    }

    public function scopeLatest(Builder $query): Builder
    {
        return $query->orderByDesc('date_published');
    }

    // ── Accessors ─────────────────────────────────────────────
    public function getFormattedDateAttribute(): string
    {
        return $this->date_published->format('F j, Y');
    }

    public function getShortDateAttribute(): string
    {
        return $this->date_published->format('M j, Y');
    }

    public function getIso8601PublishedAttribute(): string
    {
        return $this->date_published->toIso8601String();
    }

    public function getIso8601ModifiedAttribute(): string
    {
        return $this->date_modified->toIso8601String();
    }

    /** Resolved meta title — falls back to title */
    public function resolvedMetaTitle(): string
    {
        return $this->meta_title ?: $this->title . ' | CompresslyPro';
    }

    /** Related posts — same category, excluding current, max 2 */
    public function related(int $limit = 2)
    {
        return static::published()
            ->where('category', $this->category)
            ->where('id', '!=', $this->id)
            ->latest()
            ->limit($limit)
            ->get();
    }

    /** Tag badge color class map */
    public static function categoryColor(string $category): string
    {
        return match ($category) {
            'Compression'   => 'bg-brand-100 text-brand-700',
            'Formats'       => 'bg-purple-100 text-purple-700',
            'SEO'           => 'bg-green-100 text-green-700',
            'Performance'   => 'bg-pink-100 text-pink-700',
            'Email'         => 'bg-blue-100 text-blue-700',
            'Workflow'      => 'bg-orange-100 text-orange-700',
            'Social Media'  => 'bg-yellow-100 text-yellow-700',
            'Watermark'     => 'bg-teal-100 text-teal-700',
            'WordPress'     => 'bg-indigo-100 text-indigo-700',
            'PDF'           => 'bg-red-100 text-red-700',
            default         => 'bg-gray-100 text-gray-700',
        };
    }
}
