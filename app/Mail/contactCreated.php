<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class contactCreated extends Mailable
{

  // public $this->messageBody = $messageBody;

    use Queueable, SerializesModels;

    public $formdata;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($formdata)
    {
        $this->formdata = $formdata;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
          ->subject('Nieuw bericht via formulier BruineVlootBemanning.nl')
          ->markdown('emails.contacts.Created');

    }
}
