<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\User;

class UsuarioCreado extends Mailable
{
    use Queueable, SerializesModels;

    public $usuario;
    public $passwordTemporal;

    /**
     * Create a new message instance.
     *
     * @param User $usuario
     * @param string $passwordTemporal
     */
    public function __construct(User $usuario, $passwordTemporal)
    {
        $this->usuario = $usuario;
        $this->passwordTemporal = $passwordTemporal;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
// UsuarioCreado.php
public function build()
{
    return $this->view('emails.usuario_creado')
                ->subject('Tu cuenta ha sido creada')
                ->with([
                    'name' => $this->usuario->name,
                    'email' => $this->usuario->email,
                    'passwordTemporal' => $this->passwordTemporal,
                    'codigoUsuario' => $this->usuario->user_code,
                ]);
}

}
