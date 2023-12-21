<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;

class PaymentAcknowledgement extends Mailable
{
    use Queueable, SerializesModels;

    public string $note;
    public string $id;

    /**
     * Create a new message instance.
     */
    public function __construct(string $note, string $id)
    {
        //
        $this->note = $note;
        $this->id = $id;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Payment Acknowledgement',
            from: new Address('shop@satomisuzuki.info', 'satomi suzuki'),
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.payment',
            with: [
                'note' => $this->note,
                'id' => $this->id,
            ],
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
