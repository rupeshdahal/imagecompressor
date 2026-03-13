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
        'published_at' => 'date',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
    ];

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function scopeOfType(Builder $query, string $type): Builder
    {
        return $query->where('type', $type);
    }

    public function scopeTools(Builder $query): Builder
    {
        return $query->where('type', 'tool');
    }

    public function scopeBlogs(Builder $query): Builder
    {
        return $query->where('type', 'blog');
    }

    public function scopePages(Builder $query): Builder
    {
        return $query->where('type', 'page');
    }

    public function getUrlAttribute(): string
    {
        return match($this->type) {
            'tool' => url('/tools/' . $this->slug),
            'blog' => url('/blog/' . $this->slug),
            default => url('/' . $this->slug),
        };
    }
}
