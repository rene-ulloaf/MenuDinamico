<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Modelos\Usuario;

class UsuarioCreadoMail extends Mailable {
    use Queueable, SerializesModels;

    public $usuario;

    public function __construct(Usuario $usuario) {
        $this->usuario = $usuario;
    }

    public function build() {
        return $this->view('email.UsuarioCreadoMail')
                ->from('no-reply@esqueleto.tecnobot.cl')
                ->subject('Bienvenido!');
    }
}