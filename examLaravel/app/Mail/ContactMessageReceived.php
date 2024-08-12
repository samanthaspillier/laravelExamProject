<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMessageReceived extends Mailable
{
    use Queueable, SerializesModels;

    public $message; // Public property to hold the message object

    /**
     * Create a new message instance.
     */
    public function __construct($message)
    {
        $this->message = $message; // Assign the passed object to the property
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->view('emails.contact_message')
                    ->subject('Contact Message Received')
                    ->with([
                        'subject' => $this->message->subject, // Accessing object properties
                        'content' => $this->message->message,
                        'category' => $this->message->category, // Add category here

                    ]);
    }
}
