<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = ['Marvel', 'K-pop', 'Futbol'];

        $this->command->comment('Cargando categorías...');

        try {
            Schema::disableForeignKeyConstraints();
            // Vaciamos la tabla pivote (no tiene Modelo, se accede por nombre de tabla)
            DB::table('category_collection')->truncate();
            Category::truncate();
            Schema::enableForeignKeyConstraints();

            // withProgressBar recorre el array y muestra una barra de progreso automáticamente.
            // El segundo argumento es la función a ejecutar por cada elemento.
            $this->command->withProgressBar($categories, function (string $name) {
                Category::create(['name' => $name]);
            });

            // Salto de línea necesario después de la barra de progreso
            $this->command->newLine();
            $this->command->info('🌱 OK: Categorias cargadas exitosamente');

        } catch (\Throwable $e) {
            $this->command->error('❌ ERROR: Fallo crítico al cargar categorias:');
            $this->command->error($e->getMessage());
            throw $e;
        }
    }
}
