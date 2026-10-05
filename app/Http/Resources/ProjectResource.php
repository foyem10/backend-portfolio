<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $english = $request->query('lang') === 'en';

        return [
            'id' => $this->id,
            'title' => $this->localized('title', $english),
            'slug' => $this->slug,
            'summary' => $this->localized('summary', $english),
            'description' => $this->localized('description', $english),
            'result' => $this->localized('result', $english),
            'stack' => $this->stack,
            'image_url' => $this->image_url,
            'github_url' => $this->github_url,
            'demo_url' => $this->demo_url,
            'featured' => $this->featured,
        ];
    }
}