<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Project extends Model
{
    protected $fillable = [
        'title', 'slug', 'summary', 'description', 'result', 'stack',
        'image_url', 'github_url', 'demo_url',
        'featured', 'is_published', 'position',
    ];

    protected function casts(): array
    {
        return [
            'stack' => 'array',
            'featured' => 'boolean',
            'is_published' => 'boolean',
        ];
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('is_published', true);
    }
}
