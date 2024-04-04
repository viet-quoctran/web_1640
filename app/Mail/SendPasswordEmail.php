<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendPasswordEmail extends Mailable
{
    use Queueable, SerializesModels;
    public $password;
    public $fromEmail;
    /**
     * Create a new message instance.
     */
    public function __construct($fromEmail, $password)
    {
        $this->password = $password;
        $this->fromEmail = $fromEmail;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Send Password Email',
        );
    }

    /**
     * Get the message content definition.
     */
    public function build()
    {
        return $this->from($this->fromEmail)
                    ->view('emails.sendPassword')
                    ->with([
                        'password' => $this->password,
                    ]);
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
