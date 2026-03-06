<?php

namespace Database\Seeders;

use App\Models\Collection;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CollectionSeeder extends Seeder
{
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
            Schema::disableForeignKeyConstraints();
            Collection::truncate();
            Schema::enableForeignKeyConstraints();

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
