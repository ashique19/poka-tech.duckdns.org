<?php

declare(strict_types=1);

namespace App\Mail;

use App\Models\ContactSubmission;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactSubmitted extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public ContactSubmission $submission) {}

    public function envelope(): Envelope
    {
        $name = str_replace(["\r", "\n"], ' ', $this->submission->name);

        return new Envelope(
            subject: 'Poka Tech contact: '.$name,
            replyTo: [new Address($this->submission->email, $name)],
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'mail.contact-submitted',
        );
    }
}
