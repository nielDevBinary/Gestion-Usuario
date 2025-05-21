<?php

namespace App\Jobs;

use App\Mail\NotificacionUsuario;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;


/**
 * Este trabajo se ejecuta en segundo plano 
 * Envía un correo a un usuario con su nombre y dirección de correo.
 */
class EnviarNotificacionUsuarioJob implements ShouldQueue
{
    use Queueable;


    public string $nombre;
    public string $email;


    /**
     * Create a new job instance.
     */
    public function __construct(string $nombre, string $email)
    {
        $this->nombre = $nombre;
        $this->email  = $email;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->email)
            ->send(new NotificacionUsuario($this->nombre, $this->email));
    }
}
