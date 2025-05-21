<?php

namespace App\Console\Commands;

use App\Jobs\EnviarNotificacionUsuarioJob;
use App\Models\User;
use Illuminate\Console\Command;

/**
 * este comando selecciona un numero determinado de user al azar
 * para enviarles un correo
 */
class EncolarNotificacionesUsuarios extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'usuarios:encolar-notificaciones';


    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Encola un Job de notificación por correo para cada usuario existente (p. ej., 10k registros)';


    /**
     * Execute the console command.
     * @return int Código de salida del comando
     */
    public function handle():int
    {
        // cant. de user aleatoriamente 
        $limite = 500;

        $this->info("🔄 Seleccionando {$limite} usuarios aleatorios...");

        // coleccion de user al azar
        $usuarios = User::inRandomOrder()->limit($limite)->get();
        $this->info("🎯 {$usuarios->count()} usuarios seleccionados aleatoriamente.");

        foreach ($usuarios as $index => $user) {
            // Encola un Job 
            EnviarNotificacionUsuarioJob::dispatch($user->name, $user->email);
            $this->info("📨 [" . ($index + 1) . "/{$limite}] Notificación encolada para: {$user->email}");
        }

        $this->info("✅ Se encolaron correos de bienvenida para {$usuarios->count()} usuarios aleatorios.");

        return self::SUCCESS;
    }
}
