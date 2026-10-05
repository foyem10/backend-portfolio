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

    public function test_it_returns_french_content_by_default(): void
    {
        $this->makeProject(['title_en' => 'English title', 'summary_en' => 'English summary.']);

        $this->getJson('/api/projects')
            ->assertOk()
            ->assertJsonPath('data.0.title', 'Projet test')
            ->assertJsonPath('data.0.summary', 'Un résumé.');
    }

    public function test_it_returns_english_content_when_requested(): void
    {
        $this->makeProject(['title_en' => 'English title', 'summary_en' => 'English summary.']);

        $this->getJson('/api/projects?lang=en')
            ->assertOk()
            ->assertJsonPath('data.0.title', 'English title')
            ->assertJsonPath('data.0.summary', 'English summary.');
    }

    public function test_it_falls_back_to_french_when_english_is_missing(): void
    {
        $this->makeProject();

        $this->getJson('/api/projects?lang=en')
            ->assertOk()
            ->assertJsonPath('data.0.title', 'Projet test');
    }

    public function test_it_ignores_unknown_languages(): void
    {
        $this->makeProject(['title_en' => 'English title']);

        $this->getJson('/api/projects?lang=de')
            ->assertOk()
            ->assertJsonPath('data.0.title', 'Projet test');
    }

    public function test_projects_can_be_cached_by_the_browser(): void
    {
        $this->makeProject();

        $header = $this->getJson('/api/projects')->headers->get('Cache-Control');

        $this->assertStringContainsString('public', $header);
        $this->assertStringContainsString('max-age=60', $header);
    }
}