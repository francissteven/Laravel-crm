<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewCompany extends Mailable
{
    use Queueable, SerializesModels;

    public $company;
    
    public function __construct($company)
    {
        $this->company = $company;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New Company Added',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.companies',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
