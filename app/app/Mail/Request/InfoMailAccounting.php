<?php

namespace App\Mail\Request;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InfoMailAccounting extends Mailable
{
    use Queueable, SerializesModels;

    public $searchQuery;
    public $requestId;
    public $accounting;
    public $creator;
    public $executive;
    public $link;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($searchQuery, $requestId, $accounting, $creator, $executive)
    {
        $this->searchQuery = 'http://127.0.0.1:8000/request/segmented/' . $searchQuery;
        $this->requestId = $requestId;
        $this->accounting = $accounting;
        $this->creator = $creator;
        $this->executive = $executive;
        $this->link = 'http://127.0.0.1:8000/request/' . $requestId . '/detail';
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject("Antrag #" . $this->requestId . " wurde genehmigt! 🗄")
        ->markdown('request.mails.accounting.info');
    }
}
