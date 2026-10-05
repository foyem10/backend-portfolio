<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProjectResource;
use App\Models\Project;
use Illuminate\Http\JsonResponse;

class ProjectController extends Controller
{
    public function index(): JsonResponse
    {
        $projects = Project::published()
            ->orderByDesc('featured')
            ->orderBy('position')
            ->get();

        return $this->cached(ProjectResource::collection($projects)->response());
    }

    public function show(string $slug): JsonResponse
    {
        $project = Project::published()->where('slug', $slug)->firstOrFail();

        return $this->cached((new ProjectResource($project))->response());
    }

    /** Les projets changent rarement : le navigateur peut les garder une minute. */
    private function cached(JsonResponse $response): JsonResponse
    {
        return $response->setPublic()->setMaxAge(60);
    }
}