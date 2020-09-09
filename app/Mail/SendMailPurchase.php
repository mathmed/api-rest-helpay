<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMailPurchase extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($url)
    {
        $this->purchaseXmlUrl = $url;
    }

    /**
     * Build the message.
     * @return $this
     */
    public function build()
    {
        return $this->subject("Nova venda realizada")
            ->view('emails.purchase')
            ->with(['xmlUrl' => $this->purchaseXmlUrl]);
    }
}
