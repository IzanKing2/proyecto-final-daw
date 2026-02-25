<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->command->alert('🌱 Iniciando creación de datos');

        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            CategorySeeder::class,
            CollectionSeeder::class,
            CategoryCollectionSeeder::class,
            ProductSeeder::class,
            ImageSeeder::class
        ]);

        $this->command->info('✅ Proceso de seeder completado correctamente');
    }
}
