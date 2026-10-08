<?php

namespace Tests\Feature;

use App\Mail\NewContactMessage;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class ContactApiTest extends TestCase
{
    use RefreshDatabase;

    private function payload(array $overrides = []): array
    {
        return array_merge([
            'name' => 'Awa Ndiaye',
            'email' => 'awa@example.com',
            'subject' => 'Collaboration',
            'message' => 'Bonjour, j\'aimerais discuter d\'un projet avec vous.',
        ], $overrides);
    }

    public function test_it_stores_a_message_and_notifies_by_email(): void
    {
        Mail::fake();

        $this->postJson('/api/contact', $this->payload())
            ->assertCreated()
            ->assertJsonStructure(['message']);

        $this->assertDatabaseHas('contact_messages', ['email' => 'awa@example.com']);
        Mail::assertSent(NewContactMessage::class);
    }

    public function test_it_validates_required_fields(): void
    {
        $this->postJson('/api/contact', [])
            ->assertUnprocessable()
            ->assertJsonValidationErrors(['name', 'email', 'message']);

        $this->assertDatabaseCount('contact_messages', 0);
    }

    public function test_it_rejects_an_invalid_email(): void
    {
        $this->postJson('/api/contact', $this->payload(['email' => 'pas-un-email']))
            ->assertUnprocessable()
            ->assertJsonValidationErrors(['email']);
    }

    public function test_honeypot_silently_drops_bot_submissions(): void
    {
        Mail::fake();

        $this->postJson('/api/contact', $this->payload(['website' => 'http://spam.example']))
            ->assertCreated();

        $this->assertDatabaseCount('contact_messages', 0);
        Mail::assertNothingSent();
    }

    public function test_it_is_rate_limited(): void
    {
        Mail::fake();

        for ($i = 0; $i < 3; $i++) {
            $this->postJson('/api/contact', $this->payload())->assertCreated();
        }

        $this->postJson('/api/contact', $this->payload())->assertStatus(429);
    }
}