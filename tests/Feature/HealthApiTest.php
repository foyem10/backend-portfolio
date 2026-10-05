<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HealthApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_health_endpoint_reports_a_working_database(): void
    {
        $this->getJson('/api/health')
            ->assertOk()
            ->assertExactJson(['status' => 'ok', 'database' => true]);
    }
}