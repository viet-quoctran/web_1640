<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Contribution;

class ContributionSubmittedMail extends Mailable
{
    use Queueable, SerializesModels;

    public  $contribution;

    /**
     * Create a new message instance.
     */
    public function __construct(Contribution $contribution)
    {
        $this->contribution = $contribution;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Contribution Submitted Mail',
        );
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $wordFiles = $this->contribution->words->map(function ($word) {
            return $word->path;
        });
        
        $imageFiles = $this->contribution->images->map(function ($image) {
            return $image->path;
        });
        
        return $this->view('emails.contributionSubmitted')
                    ->with([
                        'wordFiles' => $wordFiles,
                        'imageFiles' => $imageFiles,
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
