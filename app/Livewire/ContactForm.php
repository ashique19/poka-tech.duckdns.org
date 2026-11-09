<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Mail\ContactSubmitted;
use App\Models\ContactSubmission;
use App\Support\Portfolio;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\RateLimiter;
use Livewire\Component;

class ContactForm extends Component
{
    public string $name = '';

    public string $email = '';

    public string $company = '';

    public string $message = '';

    public string $website = '';

    public string $project = '';

    public bool $sent = false;

    public function mount(): void
    {
        $project = request()->query('project');
        $intent = request()->query('intent');

        if (is_string($project) && $project !== '') {
            $study = Portfolio::findCaseStudy($project);
            if ($study !== null) {
                $this->project = $project;
                $this->message = __('portfolio.form.demo_prefill', [
                    'project' => Portfolio::text($study['name']),
                ]);

                return;
            }

            $sample = Portfolio::findSample($project);
            if ($sample !== null) {
                $this->project = $project;
                $this->message = __('portfolio.form.sample_prefill', [
                    'kind' => Portfolio::text($sample['kind']),
                ]);

                return;
            }
        }

        if ($intent === 'quote') {
            $this->message = __('portfolio.form.quote_prefill');
        }
    }

    public function submit(): void
    {
        $key = self::rateLimitKey();

        if (RateLimiter::tooManyAttempts($key, 5)) {
            $this->addError('form', __('portfolio.form.throttled'));

            return;
        }

        RateLimiter::hit($key, 60);

        if (trim($this->website) !== '') {
            $this->reset(['name', 'email', 'company', 'message', 'website', 'project']);
            $this->sent = true;

            return;
        }

        $validated = $this->validate($this->rules(), $this->messages());

        $submission = ContactSubmission::query()->create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'company' => $validated['company'] !== '' ? $validated['company'] : null,
            'message' => $validated['message'],
            'locale' => app()->getLocale(),
            'project' => $this->project !== '' ? $this->project : null,
        ]);

        $to = Portfolio::contactEmail();

        if ($to !== null) {
            try {
                Mail::to($to)->send(new ContactSubmitted($submission));
            } catch (\Throwable $exception) {
                report($exception);
            }
        }

        $this->reset(['name', 'email', 'company', 'message', 'website', 'project']);
        $this->sent = true;
    }

    public static function rateLimitKey(): string
    {
        return 'contact-form|'.request()->ip();
    }

    /**
     * @return array<string, list<string>>
     */
    protected function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'string', 'email', 'max:160'],
            'company' => ['nullable', 'string', 'max:160'],
            'message' => ['required', 'string', 'min:10', 'max:5000'],
        ];
    }

    /**
     * @return array<string, string>
     */
    protected function messages(): array
    {
        return [
            'name.required' => __('portfolio.validation.required', ['field' => __('portfolio.form.name')]),
            'name.max' => __('portfolio.validation.max', ['field' => __('portfolio.form.name'), 'max' => 120]),
            'email.required' => __('portfolio.validation.required', ['field' => __('portfolio.form.email')]),
            'email.email' => __('portfolio.validation.email'),
            'email.max' => __('portfolio.validation.max', ['field' => __('portfolio.form.email'), 'max' => 160]),
            'company.max' => __('portfolio.validation.max', ['field' => __('portfolio.form.company'), 'max' => 160]),
            'message.required' => __('portfolio.validation.required', ['field' => __('portfolio.form.message')]),
            'message.min' => __('portfolio.validation.min', ['field' => __('portfolio.form.message'), 'min' => 10]),
            'message.max' => __('portfolio.validation.max', ['field' => __('portfolio.form.message'), 'max' => 5000]),
        ];
    }

    public function render(): View
    {
        return view('livewire.contact-form');
    }
}
