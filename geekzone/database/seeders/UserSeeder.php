<?php

namespace Database\Seeders;

use App\Models\Cart;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRole = Role::where('name', 'Admin')->first();
        $userRole = Role::where('name', 'User')->first();

        $this->command->comment('Cargando usuarios...');

        try {
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            User::truncate();
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');

            // Credenciales de Admin
            $admin = User::create([
                'name'      => 'Admin',
                'surname'   => 'GeekZone',
                'email'     => 'admin@geekzone.test',
                'password'  => Hash::make('admin123'),
                'role_id'   => $adminRole->id
            ]);
            Cart::create(['user_id' => $admin->id]);

            // Credenciales de user
            $user = User::create([
                'name'      => 'User',
                'surname'   => 'GeekZone',
                'email'     => 'user@geekzone.test',
                'password'  => Hash::make('user123'),
                'role_id'   => $userRole->id
            ]);
            Cart::create(['user_id' => $user->id]);

            $this->command->info('🌱 OK: Usuarios cargados exitósamente');

        } catch (\Throwable $e) {
            $this->command->error('❌ ERROR: Fallo crítico al cargar usuarios:');
            $this->command->error($e->getMessage());
            throw $e;
        }
    }
}
