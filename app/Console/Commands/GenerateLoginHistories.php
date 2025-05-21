<?php

namespace App\Console\Commands;

use App\Models\LoginHistory;
use App\Models\User;
use Illuminate\Console\Command;

/**
 * GenerateLoginHistories
 * genera registros ficticios de LoginHistory
 * asociados a usuarios 
 * 
 * genera entre 0 y 10 registros de historial de inicio de sesión
 */
class GenerateLoginHistories extends Command
{
    // Nombre y firma del comando para usar en consola
    protected $signature = 'generate:login-histories';

    
    protected $description = 'Genera registros de LoginHistory para usuarios en batches';
    
    /**
     * handle
     *
     * @return void
     */
    public function handle(): void
    {
        $batchSize = 2000;
        $this->info("Iniciando generación de LoginHistory por lotes de {$batchSize} usuarios...");

        // totaol de usuarios
        $totalUsers = User::count();
        $this->info("Total de usuarios: {$totalUsers}");

         // Crea una barra de progreso
        $bar = $this->output->createProgressBar($totalUsers);

        // Procesar usuarios en lotes
        User::chunk($batchSize, function ($users) use ($bar) {
            // Iterar sobre cada usuario del lote actual
            foreach ($users as $user) {
                // Nª aleatorio
                $count = random_int(0, 10);
                if ($count > 0) {
                    //crear múltiples registros de LoginHistory vinculados al usuario
                    LoginHistory::factory($count)->create([
                        'user_id' => $user->id,
                    ]);
                }
                // Avanza la barra de progreso
                $bar->advance();
            }
        });

        // Finaliza la barra de progreso
        $bar->finish();
        $this->info("\nGeneración finalizada.");
    }
}
