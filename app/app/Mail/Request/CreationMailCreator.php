<?php

namespace App\Mail\Request;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CreationMailCreator extends Mailable
{
    use Queueable, SerializesModels;

    public $recipient;
    public $requestId;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $requestId)
    {
        $this->recipient = $name;
        $this->requestId = $requestId;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject("Bald geht's in Urlaub!")
        ->view('request.mails.creator.creation');
    }
}
