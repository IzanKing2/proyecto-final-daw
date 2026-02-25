<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->comment('Cargando productos...');

        try {
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            Product::truncate();
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');

            Product::factory()->count(10)->create();

            $this->command->info('🌱 OK: Productos cargados exitósamente');
        } catch (\Throwable $e) {
            $this->command->error('❌ ERROR: Fallo crítico al cargar productos:');
            $this->command->error($e->getMessage());
            throw $e;
        }
    }
}
