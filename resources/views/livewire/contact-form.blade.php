<div>
    @if ($sent)
        <p role="status" tabindex="-1" class="mb-4 border border-accent px-4 py-3">{{ __('portfolio.form.sent') }}</p>
    @endif

    @error('form')
        <p role="alert" class="mb-4 border border-ink px-4 py-3">{{ $message }}</p>
    @enderror

    <form wire:submit="submit" class="grid gap-4" novalidate>
        <div class="honeypot" aria-hidden="true">
            <label>
                {{ __('portfolio.form.honeypot') }}
                <input wire:model="website" type="text" tabindex="-1" autocomplete="off">
            </label>
        </div>

        <div class="grid gap-1">
            <label for="contact-name" class="font-semibold">{{ __('portfolio.form.name') }}</label>
            <input id="contact-name" wire:model="name" type="text" name="name" autocomplete="name" required maxlength="120" class="min-h-11 border border-line bg-white px-3" @error('name') aria-invalid="true" aria-describedby="contact-name-error" @enderror>
            @error('name')
                <p id="contact-name-error" role="alert" class="text-sm">{{ $message }}</p>
            @enderror
        </div>

        <div class="grid gap-1">
            <label for="contact-email" class="font-semibold">{{ __('portfolio.form.email') }}</label>
            <input id="contact-email" wire:model="email" type="email" name="email" autocomplete="email" required maxlength="160" class="min-h-11 border border-line bg-white px-3" @error('email') aria-invalid="true" aria-describedby="contact-email-error" @enderror>
            @error('email')
                <p id="contact-email-error" role="alert" class="text-sm">{{ $message }}</p>
            @enderror
        </div>

        <div class="grid gap-1">
            <label for="contact-company" class="font-semibold">{{ __('portfolio.form.company') }} <span class="font-normal text-muted">({{ __('portfolio.form.optional') }})</span></label>
            <input id="contact-company" wire:model="company" type="text" name="company" autocomplete="organization" maxlength="160" class="min-h-11 border border-line bg-white px-3" @error('company') aria-invalid="true" aria-describedby="contact-company-error" @enderror>
            @error('company')
                <p id="contact-company-error" role="alert" class="text-sm">{{ $message }}</p>
            @enderror
        </div>

        <div class="grid gap-1">
            <label for="contact-message" class="font-semibold">{{ __('portfolio.form.message') }}</label>
            <textarea id="contact-message" wire:model="message" name="message" required minlength="10" maxlength="5000" rows="6" class="border border-line bg-white px-3 py-2" @error('message') aria-invalid="true" aria-describedby="contact-message-error" @enderror>{{ $message }}</textarea>
            @error('message')
                <p id="contact-message-error" role="alert" class="text-sm">{{ $message }}</p>
            @enderror
        </div>

        <p class="text-sm text-muted">{{ __('portfolio.form.privacy') }}</p>

        <button type="submit" class="inline-flex min-h-11 w-fit items-center bg-accent px-5 font-semibold text-white" wire:loading.attr="disabled" wire:target="submit">
            <span wire:loading.remove wire:target="submit">{{ __('portfolio.form.submit') }}</span>
            <span wire:loading wire:target="submit">{{ __('portfolio.form.sending') }}</span>
        </button>
    </form>
</div>
