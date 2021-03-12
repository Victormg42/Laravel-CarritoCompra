<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Correo extends Mailable
{
    use Queueable, SerializesModels;
    public $gmail;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($gmail)
    {
        $this->gmail = $gmail;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Ha realizado su compra con exito!')
                    ->view('correo');
    }
}
