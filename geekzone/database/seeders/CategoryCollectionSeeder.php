<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Collection;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryCollectionSeeder extends Seeder
{
    public function run(): void
    {
        $map = [
            'Marvel'    => ['X-Men', 'Vengadores', 'Spider-Man'],
            'K-pop'     => ['StrayKids', 'BLACKPINK', 'BTS'],
            'Futbol'    => ['La Liga 23/24', 'La Liga 24/25', 'Real Madrid CF 2024']
        ];

        $this->command->comment('Vinculando categorías con colecciones...');

        try {
            // Aplanamos el mapa en pares [categoria => coleccion] para poder iterar linealmente
            // Esto nos permite mostrar la barra de progreso por cada vinculación individual
            $pares = [];
            foreach ($map as $categoriaNombre => $coleccionNombres) {
                foreach ($coleccionNombres as $coleccionNombre) {
                    $pares[] = ['categoria' => $categoriaNombre, 'coleccion' => $coleccionNombre];
                }
            }

            $this->command->withProgressBar($pares, function (array $par) {
                $category = Category::where('name', $par['categoria'])->first();

                if (!$category) {
                    $this->command->newLine();
                    $this->command->warn("⚠️ Categoría no encontrada: {$par['categoria']}. Saltando...");
                    return;
                }

                $collection = Collection::where('name', $par['coleccion'])->first();
                $category->collections()->attach($collection->id);
            });

            $this->command->newLine();
            $this->command->info('🔗 OK: Categorías y colecciones vinculadas exitosamente');

        } catch (\Throwable $e) {
            $this->command->error('❌ ERROR: Fallo crítico al vincular categorias y colecciones:');
            $this->command->error($e->getMessage());
            throw $e;
        }
    }
}
