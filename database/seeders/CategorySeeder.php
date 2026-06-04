<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Herramientas manuales',
                'description' => 'Herramientas de uso manual para trabajos de reparación, montaje y mantenimiento.',
            ],
            [
                'name' => 'Herramientas eléctricas',
                'description' => 'Máquinas eléctricas portátiles para taladrado, corte, lijado y trabajos profesionales.',
            ],
            [
                'name' => 'Tornillería y fijaciones',
                'description' => 'Tornillos, tacos, arandelas, tuercas y elementos de fijación.',
            ],
            [
                'name' => 'Pintura y tratamiento',
                'description' => 'Pinturas, barnices, brochas, rodillos y productos para preparación de superficies.',
            ],
            [
                'name' => 'Fontanería',
                'description' => 'Material para instalaciones de agua, desagües, grifería y reparaciones domésticas.',
            ],
            [
                'name' => 'Electricidad',
                'description' => 'Material eléctrico básico, cables, enchufes, bases, bombillas y accesorios.',
            ],
            [
                'name' => 'Jardín y exterior',
                'description' => 'Productos para riego, jardinería, protección y trabajos de exterior.',
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
