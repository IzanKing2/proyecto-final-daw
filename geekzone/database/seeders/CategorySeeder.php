<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = ['Marvel', 'K-pop', 'Futbol'];

        $this->command->comment('Cargando categorías...');

        try {
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            Category::truncate();
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');

            foreach ($categories as $name) {
                Category::create(['name' => $name]);
            }

            $this->command->info('🌱 OK: Categorias cargadas exitosamente');

        } catch (\Throwable $e) {
            $this->command->error('❌ ERROR: Fallo crítico al cargar categorias:');
            $this->command->error($e->getMessage());
            throw $e;
        }
    }
}
