<?php

namespace App\Mail;

use App\Models\Message;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;

class ContactMessageReceived extends Mailable
{
    use Queueable, SerializesModels;

    public $msg;

    public function __construct(Message $msg)
    {
        $this->msg = $msg;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New Portfolio Message: ' . ($this->msg->subject ?: 'No Subject'),
            replyTo: [new Address($this->msg->email, $this->msg->name)],
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.contact.received',
            with: [
                'msg' => $this->msg,
            ],
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
