<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactReply extends Mailable
{
   use Queueable, SerializesModels;

    public $contact;
    public $reply;

    public function __construct($contact, $reply)
    {
        $this->contact = $contact;
        $this->reply = $reply;

    }


    public function build()
    {
        return $this->subject('Reply to your inquiry')
                    ->view('mail.contact_reply')
                    ->with(['reply' => $this->reply]);
    }

    // /**
    //  * Get the message envelope.
    //  */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Contact Reply',
            to: [
                // If you want to use the envelope method, ensure you use Mailable’s Address structure
                new \Illuminate\Mail\Mailables\Address($this->contact->email, $this->contact->name)
            ],
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.contact_reply',
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