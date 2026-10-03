<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'summary' => $this->summary,
            'description' => $this->description,
            'result' => $this->result,
            'stack' => $this->stack,
            'image_url' => $this->image_url,
            'github_url' => $this->github_url,
            'demo_url' => $this->demo_url,
            'featured' => $this->featured,
        ];
    }
}