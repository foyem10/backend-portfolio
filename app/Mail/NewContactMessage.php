<?php

namespace App\Mail;

use App\Models\ContactMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewContactMessage extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public ContactMessage $contact)
    {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            // "Répondre" dans ta boîte mail écrit directement au visiteur.
            replyTo: [new Address($this->contact->email, $this->contact->name)],
            subject: '[Portfolio] Nouveau message de '.$this->contact->name,
        );
    }

    public function content(): Content
    {
        return new Content(view: 'emails.contact');
    }
}