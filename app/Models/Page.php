<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $guarded = ['id'];

    protected $casts = [
        'schema_markup' => 'array',
        'related_tools' => 'array',
        'related_posts' => 'array',
        'published_at'  => 'date',
        'is_featured'   => 'boolean',
        'is_active'     => 'boolean',
        'sort_order'    => 'integer',
    ];

    /* ── Scopes ──────────────────────────────────────────── */

    public function scopeActive(Builder $q): Builder
    {
        return $q->where('is_active', true);
    }

    public function scopeOfType(Builder $q, string $type): Builder
    {
        return $q->where('type', $type);
    }

    public function scopeTools(Builder $q): Builder
    {
        return $q->ofType('tool')->active()->orderBy('sort_order');
    }

    public function scopeBlogs(Builder $q): Builder
    {
        return $q->ofType('blog')->active()->orderByDesc('published_at');
    }

    public function scopePages(Builder $q): Builder
    {
        return $q->ofType('page')->active()->orderBy('sort_order');
    }

    /* ── Accessors ───────────────────────────────────────── */

    public function getUrlAttribute(): string
    {
        return match ($this->type) {
            'tool' => "/tools/{$this->slug}",
            'blog' => "/blog/{$this->slug}",
            default => "/{$this->slug}",
        };
    }

    public function getCanonicalUrlAttribute(): string
    {
        return url($this->canonical_path ?? $this->url);
    }
}
