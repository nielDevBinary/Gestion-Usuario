<?php

namespace Database\Seeders;

use App\Http\Services\UserProfileBatchCreator;
use Illuminate\Database\Seeder;


/**
 * Seeder para crear usuarios y perfiles
 */
class OptimizedUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * 
     * Este método instancia el servicio UserProfileBatchCreator y
     * ejecuta la creación masiva de usuarios y perfiles.
     *
     * @return void
     */
    public function run(): void
    {
        $creator = new UserProfileBatchCreator();
        $creator->createUsersWithProfiles(10000, 1000);
    }
    
}
