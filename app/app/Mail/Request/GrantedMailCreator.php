<?php

namespace App\Mail\Request;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class GrantedMailCreator extends Mailable
{
    use Queueable, SerializesModels;

    public $ics;
    public $creator;
    public $requestId;
    public $google;
    public $link;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($creator, $ics, $google, $requestId)
    {
        $this->ics = $ics;
        $this->google = $google;
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
        return $this->subject("Antrag Freigegeben! ✔️")
        ->markdown('request.mails.creator.granted');
    }
}
