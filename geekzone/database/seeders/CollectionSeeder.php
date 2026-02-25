<?php

namespace Database\Seeders;

use App\Models\Collection;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CollectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $collections = [
            // Marvel
            'X-Men',
            'Vengadores',
            'Spider-Man',
            // K-pop
            'StrayKids',
            'BLACKPINK',
            'BTS',
            // Futbol
            'La Liga 23/24',
            'La Liga 24/25',
            'Real Madrid CF 2024'
        ];

        $this->command->comment('Cargando colecciones...');

        try {
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            Collection::truncate();
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');

            $this->command->withProgressBar($collections, function (string $name) {
                Collection::create(['name' => $name]);
            });

            $this->command->newLine();
            $this->command->info('🌱 OK: Colecciones cargadas exitosamente');

        } catch (\Throwable $e) {
            $this->command->error('❌ ERROR: Fallo crítico al cargar colecciones:');
            $this->command->error($e->getMessage());
            throw $e;
        }
    }
}
