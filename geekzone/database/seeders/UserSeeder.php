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
        $userRole  = Role::where('name', 'User')->first();

        // Definimos los usuarios a crear como un array para poder recorrerlos con la barra de progreso
        $usuarios = [
            [
                'name'     => 'Admin',
                'surname'  => 'GeekZone',
                'email'    => 'admin@geekzone.test',
                'password' => Hash::make('admin123'),
                'role_id'  => $adminRole->id,
            ],
            [
                'name'     => 'User',
                'surname'  => 'GeekZone',
                'email'    => 'user@geekzone.test',
                'password' => Hash::make('user123'),
                'role_id'  => $userRole->id,
            ],
        ];

        $this->command->comment('Cargando usuarios...');

        try {
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            User::truncate();
            Cart::truncate();
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');

            $this->command->withProgressBar($usuarios, function (array $datos) {
                $usuario = User::create($datos);
                // Creamos el carrito vinculado al usuario recién creado
                Cart::create(['user_id' => $usuario->id]);
            });

            $this->command->newLine();
            $this->command->info('🌱 OK: Usuarios cargados exitósamente');

        } catch (\Throwable $e) {
            $this->command->error('❌ ERROR: Fallo crítico al cargar usuarios:');
            $this->command->error($e->getMessage());
            throw $e;
        }
    }
}
