<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'title', 'title_en',
        'slug',
        'summary', 'summary_en',
        'description', 'description_en',
        'result', 'result_en',
        'stack', 'image_url', 'github_url', 'demo_url',
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

    /** Renvoie la version anglaise d'un champ si elle existe, sinon la version française. */
    public function localized(string $field, bool $english): ?string
    {
        if ($english && filled($this->{$field.'_en'})) {
            return $this->{$field.'_en'};
        }

        return $this->{$field};
    }
}