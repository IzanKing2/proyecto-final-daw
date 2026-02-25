<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = ['Admin', 'User'];

        $this->command->comment('Cargando roles...');

        try {
            Schema::disableForeignKeyConstraints();
            Role::truncate();
            Schema::enableForeignKeyConstraints();

            $this->command->withProgressBar($roles, function (string $name) {
                Role::create(['name' => $name]);
            });

            $this->command->newLine();
            $this->command->info('🌱 OK: Roles cargados exitósamente');

        } catch (\Throwable $e) {
            $this->command->error('❌ ERROR: Fallo crítico al cargar roles:');
            $this->command->error($e->getMessage());
            throw $e;
        }
    }
}
