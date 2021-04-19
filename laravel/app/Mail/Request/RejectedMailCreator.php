<?php

namespace App\Mail\Request;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RejectedMailCreator extends Mailable
{
    use Queueable, SerializesModels;

    public $creator;
    public $requestId;
    public $link;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($creator, $requestId)
    {
        $this->creator = $creator;
        $this->requestId = $requestId;
        $this->link = 'http://127.0.0.1:8000/request/' . $requestId . '/detail';
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject("Antrag Abgelehnt ❌")
        ->markdown('request.mails.creator.rejected');
    }
}
