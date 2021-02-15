<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CorreoInformativo extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *s
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.informativo')
            ->subject('Correo informativo')
            ->with(['nombre' => $this->nombre]);
        //return $this->view('view.name');
    }
}
