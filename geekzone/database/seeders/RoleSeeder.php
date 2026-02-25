<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->comment('Cargando roles...');

        try {
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            Role::truncate();
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');

            Role::insert([
                ['name' => 'Admin'],
                ['name' => 'User']
            ]);

            $this->command->info('🌱 OK: Roles cargados exitósamente');

        } catch (\Throwable $e) {
            $this->command->error('❌ ERROR: Fallo crítico al cargar roles:');
            $this->command->error($e->getMessage());
            throw $e;
        }
    }
}
