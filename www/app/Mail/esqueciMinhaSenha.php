<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class esqueciMinhaSenha extends Mailable
{
    use Queueable, SerializesModels;

    private $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->user = (object)$user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->subject('Esqueci Minha Senha');

        $this->from('suporte@admmoda.com.br', 'Administração Moda');

        return $this->view('mail.send.esqueci-minha-senha', [
            'user' => $this->user,
            'message' => $this
        ]);
    }
}
