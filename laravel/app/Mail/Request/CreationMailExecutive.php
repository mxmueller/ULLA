<?php

namespace App\Mail\Request;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CreationMailExecutive extends Mailable
{
    use Queueable, SerializesModels;

    public $executive;
    public $creator;
    public $requestId;
    public $link;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($creator, $executive, $requestId)
    {
        $this->creator = $creator;
        $this->executive = $executive;
        $this->requestId = $requestId;
        $this->link = 'http://127.0.0.1:8000/request/' . $requestId . '/decision';
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject("Ein neuer Antrag wurde Ihnen zugewiesen🚦")
        ->markdown('request.mails.executive.info');
    }
}
