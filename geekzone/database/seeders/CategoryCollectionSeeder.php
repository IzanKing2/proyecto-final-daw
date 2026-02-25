<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Collection;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryCollectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $map = [
            'Marvel'    => ['X-Men', 'Vengadores', 'Spider-Man'],
            'K-pop'     => ['StrayKids', 'BLACKPINK', 'BTS'],
            'Futbol'    => ['La Liga 23/24', 'La Liga 24/25', 'Real Madrid CF 2024']
        ];

        try {
            foreach ($map as $categoryName => $collectionNames) {
                $category = Category::where('name', $categoryName)->first();

                if (!$category) {
                    $this->command->warn("⚠️ Categoría no encontrada: $categoryName. Saltando...");
                    continue;
                }

                foreach ($collectionNames as $collectionName) {
                    $collection = Collection::where('name', $collectionName)->first();
                    $category->collections()->attach($collection->id);
                }
            }
            $this->command->info('🔗 OK: Categorías y colecciones vinculadas exitosamente');

        } catch (\Throwable $e) {
            $this->command->error('❌ ERROR: Fallo crítico al vincular categorias y colecciones:');
            $this->command->error($e->getMessage());
            throw $e;
        }
    }
}
