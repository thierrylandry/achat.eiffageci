<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;

class Demande_proforma_mail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $demande_mail;
    public function __construct($demande_mail)
    {
        //
        $this->demande_mail=$demande_mail;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        $from = sprintf("%s", Auth::user()->login);

        $demande_mail = $this->demande_mail;

        //dd(view("mail.proforma", compact("piece"))->render());
        return $this->from($from)
            ->view('mail.mail', compact("demande_mail"))
            ->subject($this->demande_mail->objet);


    }

}
