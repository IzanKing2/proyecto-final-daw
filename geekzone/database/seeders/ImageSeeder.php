<?php

namespace Database\Seeders;

use App\Models\Image;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ImageSeeder extends Seeder
{
    /**
     * Crea imágenes de prueba para cada producto usando el factory.
     */
    public function run(): void
    {
        $this->command->comment('Cargando imágenes de productos...');

        try {
            Schema::disableForeignKeyConstraints();
            Image::truncate();
            Schema::enableForeignKeyConstraints();

            $productos = Product::all();

            $this->command->withProgressBar($productos, function (Product $producto) {
                // Crear 1 imagen principal para el producto
                Image::factory()->main()->create([
                    'product_id' => $producto->id,
                ]);

                // Crear entre 0 y 2 imágenes secundarias
                Image::factory()->count(rand(0, 2))->create([
                    'product_id' => $producto->id,
                ]);
            });

            $this->command->newLine();
            $this->command->info('🌱 OK: Imágenes cargadas');

        } catch (\Throwable $e) {
            $this->command->error('❌ ERROR: Fallo crítico al cargar imágenes:');
            $this->command->error($e->getMessage());
            throw $e;
        }
    }
}
