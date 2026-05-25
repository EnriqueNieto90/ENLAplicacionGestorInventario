<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Item;
use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $informatica = Category::where('name', 'Informática')->first();
        $limpieza = Category::where('name', 'Limpieza')->first();
        $oficina = Category::where('name', 'Oficina')->first();

        // Artículos con distintos niveles de stock para probar los estados
        $items = [
            [
                'sku' => 'INF-001',
                'name' => 'Ratón inalámbrico',
                'description' => 'Ratón óptico inalámbrico para equipos de oficina.',
                'category_id' => $informatica->id,
                'stock' => 18,
                'min_stock' => 5,
                'is_active' => true,
            ],
            [
                'sku' => 'INF-002',
                'name' => 'Teclado USB',
                'description' => 'Teclado estándar con conexión USB.',
                'category_id' => $informatica->id,
                'stock' => 4,
                'min_stock' => 5,
                'is_active' => true,
            ],
            [
                'sku' => 'INF-003',
                'name' => 'Monitor 24 pulgadas',
                'description' => 'Monitor LED de 24 pulgadas para puesto de trabajo.',
                'category_id' => $informatica->id,
                'stock' => 0,
                'min_stock' => 2,
                'is_active' => true,
            ],
            [
                'sku' => 'LIM-001',
                'name' => 'Gel hidroalcohólico',
                'description' => 'Bote de gel hidroalcohólico de 500 ml.',
                'category_id' => $limpieza->id,
                'stock' => 30,
                'min_stock' => 10,
                'is_active' => true,
            ],
            [
                'sku' => 'LIM-002',
                'name' => 'Bolsas de basura',
                'description' => 'Rollo de bolsas de basura industriales.',
                'category_id' => $limpieza->id,
                'stock' => 8,
                'min_stock' => 10,
                'is_active' => true,
            ],
            [
                'sku' => 'LIM-003',
                'name' => 'Limpiador multiusos',
                'description' => 'Producto de limpieza para superficies.',
                'category_id' => $limpieza->id,
                'stock' => 0,
                'min_stock' => 6,
                'is_active' => true,
            ],
            [
                'sku' => 'OFI-001',
                'name' => 'Paquete de folios A4',
                'description' => 'Paquete de 500 folios tamaño A4.',
                'category_id' => $oficina->id,
                'stock' => 25,
                'min_stock' => 8,
                'is_active' => true,
            ],
            [
                'sku' => 'OFI-002',
                'name' => 'Bolígrafos azules',
                'description' => 'Caja de bolígrafos de tinta azul.',
                'category_id' => $oficina->id,
                'stock' => 6,
                'min_stock' => 10,
                'is_active' => true,
            ],
            [
                'sku' => 'OFI-003',
                'name' => 'Archivadores',
                'description' => 'Archivadores de cartón para documentación.',
                'category_id' => $oficina->id,
                'stock' => 0,
                'min_stock' => 4,
                'is_active' => true,
            ],
        ];

        foreach ($items as $item) {
            Item::create($item);
        }
    }
}
