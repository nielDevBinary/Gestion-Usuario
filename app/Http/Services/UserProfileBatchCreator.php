<?php

namespace App\Http\Services;

use App\Models\User;
use App\Models\Profile;
use Illuminate\Support\Facades\DB;

/**
 * Servicio para crear usuarios y perfiles en lotes
 * UserProfileBatchCreator
 */
class UserProfileBatchCreator
{    
    /**
     * createUsersWithProfiles
     * @param  int $total usuarios a crear
     * @param  int $batchSize Cant. de usuarios a crear en cada lote
     * @return void
     */
    public function createUsersWithProfiles(int $total, int $batchSize = 1000): void
    {
        DB::disableQueryLog();

        $iterations = intdiv($total, $batchSize);

        for ($i = 1; $i <= $iterations; $i++) {

            // se genera un lote de usuarios utilizando el factory
            $users = User::factory()->count($batchSize)->create();

            // genera un arreglo de perfiles asociados a usuarios
            $profiles = $this->buildProfilesForUsers($users);

            // Insertar todos los perfiles
            DB::table('profiles')->insert($profiles);

            echo "Lote $i: insertados " . ($i * $batchSize) . " usuarios y perfiles\n";
        }
    }
    
    /**
     * Construye un array de datos para crear perfiles asociados
     *
     * @param  mixed $users coleccion de model user
     * @return array un array de datos para insertar a mi tabla profile
     */
    protected function buildProfilesForUsers($users): array
    {
        $profiles = [];

        foreach ($users as $user) {
            $profiles[] = Profile::factory()->make([
                'user_id' => $user->id,
            ])->toArray();
        }

        return $profiles;
    }
}
