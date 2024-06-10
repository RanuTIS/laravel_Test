<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class UninstallAppMail extends Mailable
{
    use Queueable, SerializesModels;
    public $userData;
    /**
     * Create a new message instance.
     */
    public function __construct($userData)
    {
        $this->userData = $userData;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Uh ho! Your App is lacking something essential.',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        
        return new Content(
            view: 'emails.appUninstall',
        );
    
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
