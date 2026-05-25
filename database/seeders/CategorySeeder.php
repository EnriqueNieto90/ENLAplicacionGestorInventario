<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Categorías de prueba para el inventario
        $categories = [
            [
                'name' => 'Informática',
                'description' => 'Equipos, periféricos y material informático.',
            ],
            [
                'name' => 'Limpieza',
                'description' => 'Material destinado a limpieza y mantenimiento.',
            ],
            [
                'name' => 'Oficina',
                'description' => 'Material de papelería y uso administrativo.',
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
