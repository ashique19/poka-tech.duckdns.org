<?php

namespace Tests\Feature;

use App\Livewire\ContactForm;
use App\Mail\ContactSubmitted;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\RateLimiter;
use Livewire\Livewire;
use Tests\TestCase;

class ContactFormTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        RateLimiter::clear(ContactForm::rateLimitKey());
    }

    public function test_validation_errors(): void
    {
        Livewire::test(ContactForm::class)
            ->set('name', '')
            ->set('email', 'not-an-email')
            ->set('message', 'short')
            ->call('submit')
            ->assertHasErrors(['name' => 'required', 'email' => 'email', 'message' => 'min']);

        $this->assertDatabaseCount('contact_submissions', 0);
    }

    public function test_submission_is_stored_and_mailed(): void
    {
        Mail::fake();

        Livewire::test(ContactForm::class)
            ->set('name', 'Ada Lovelace')
            ->set('email', 'ada@example.com')
            ->set('company', 'Sample company')
            ->set('message', 'I would like to talk about a Laravel application.')
            ->call('submit')
            ->assertHasNoErrors()
            ->assertSet('sent', true);

        $this->assertDatabaseHas('contact_submissions', [
            'email' => 'ada@example.com',
            'company' => 'Sample company',
            'locale' => 'en',
        ]);

        Mail::assertSent(ContactSubmitted::class, function (ContactSubmitted $mail): bool {
            return $mail->hasTo('ashique19@gmail.com');
        });
    }

    public function test_honeypot_is_not_stored(): void
    {
        Mail::fake();

        Livewire::test(ContactForm::class)
            ->set('name', 'Bot')
            ->set('email', 'bot@example.com')
            ->set('message', 'This is a long enough spam message.')
            ->set('website', 'https://spam.example')
            ->call('submit')
            ->assertSet('sent', true);

        $this->assertDatabaseCount('contact_submissions', 0);
        Mail::assertNothingSent();
    }

    public function test_rate_limit(): void
    {
        $component = Livewire::test(ContactForm::class)->set('name', '');

        for ($i = 0; $i < 5; $i++) {
            $component->call('submit');
        }

        $component->call('submit')->assertHasErrors('form');
    }

    public function test_demo_request_prefills_the_message(): void
    {
        $this->get('/en?project=zatca-e-invoicing')
            ->assertOk()
            ->assertSee('I would like a demo of ZATCA e-invoicing.', false);

        $this->get('/ar?project=academia-training')
            ->assertOk()
            ->assertSee('أود عرضًا توضيحيًا لمشروع Academia Training.', false);
    }
}
