<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Definimos cuántos productos queremos crear
        $cantidad = 10;

        $this->command->comment('Cargando productos...');

        try {
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            Product::truncate();
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');

            // range(1, $cantidad) genera el array [1, 2, 3, ..., 10]
            // La barra de progreso avanza una vez por cada número del array
            $this->command->withProgressBar(range(1, $cantidad), function () {
                Product::factory()->create();
            });

            $this->command->newLine();
            $this->command->info('🌱 OK: Productos cargados exitósamente');

        } catch (\Throwable $e) {
            $this->command->error('❌ ERROR: Fallo crítico al cargar productos:');
            $this->command->error($e->getMessage());
            throw $e;
        }
    }
}
