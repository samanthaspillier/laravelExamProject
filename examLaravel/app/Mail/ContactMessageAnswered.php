<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;

use Illuminate\Queue\SerializesModels;

class ContactMessageAnswered extends Mailable
{
    use Queueable, SerializesModels;
    public $message;
    public $answer;

    /**
     * Create a new message instance.
     */
    public function __construct($message, $answer)
    {
        $this->message = $message;
        $this->answer = $answer;
    }


    

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    
    public function build()
    {
        return $this->view('emails.contact_message_answered')
                    ->subject('Your Contact Message Has Been Answered')
                    ->with([
                        'subject' => $this->message->subject,
                        'originalMessage' => $this->message->message,
                        'answer' => $this->answer,
                    ]);
    }

    public function attachments(): array
    {
        return [];
    }

}
