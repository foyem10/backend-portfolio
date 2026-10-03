<?php

namespace Tests\Feature;

use App\Models\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProjectApiTest extends TestCase
{
    use RefreshDatabase;

    private function makeProject(array $overrides = []): Project
    {
        return Project::create(array_merge([
            'title' => 'Projet test',
            'slug' => 'projet-test',
            'summary' => 'Un résumé.',
            'stack' => ['React', 'Laravel'],
            'is_published' => true,
        ], $overrides));
    }

    public function test_it_lists_only_published_projects(): void
    {
        $this->makeProject();
        $this->makeProject(['slug' => 'brouillon', 'title' => 'Brouillon', 'is_published' => false]);

        $this->getJson('/api/projects')
            ->assertOk()
            ->assertJsonCount(1, 'data')
            ->assertJsonPath('data.0.slug', 'projet-test')
            ->assertJsonPath('data.0.stack', ['React', 'Laravel']);
    }

    public function test_it_shows_a_project_by_slug(): void
    {
        $this->makeProject();

        $this->getJson('/api/projects/projet-test')
            ->assertOk()
            ->assertJsonPath('data.title', 'Projet test');
    }

    public function test_it_hides_unpublished_projects(): void
    {
        $this->makeProject(['slug' => 'brouillon', 'is_published' => false]);

        $this->getJson('/api/projects/brouillon')->assertNotFound();
    }
}