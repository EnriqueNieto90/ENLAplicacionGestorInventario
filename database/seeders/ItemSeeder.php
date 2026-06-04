<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Item;
use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    public function run(): void
    {
        $manuales = Category::where('name', 'Herramientas manuales')->firstOrFail();
        $electricas = Category::where('name', 'Herramientas eléctricas')->firstOrFail();
        $tornilleria = Category::where('name', 'Tornillería y fijaciones')->firstOrFail();
        $pintura = Category::where('name', 'Pintura y tratamiento')->firstOrFail();
        $fontaneria = Category::where('name', 'Fontanería')->firstOrFail();
        $electricidad = Category::where('name', 'Electricidad')->firstOrFail();
        $jardin = Category::where('name', 'Jardín y exterior')->firstOrFail();

        $items = [
            // Herramientas manuales
            [
                'sku' => 'HER-MAN-001',
                'name' => 'Martillo de carpintero 500 g',
                'description' => 'Martillo con mango ergonómico para trabajos generales de carpintería.',
                'category_id' => $manuales->id,
                'stock' => 20,
                'min_stock' => 6,
                'is_active' => true,
            ],
            [
                'sku' => 'HER-MAN-002',
                'name' => 'Destornillador plano 6 mm',
                'description' => 'Destornillador plano con punta imantada y mango antideslizante.',
                'category_id' => $manuales->id,
                'stock' => 4,
                'min_stock' => 8,
                'is_active' => true,
            ],
            [
                'sku' => 'HER-MAN-003',
                'name' => 'Llave inglesa 250 mm',
                'description' => 'Llave ajustable de acero para trabajos de mecánica y mantenimiento.',
                'category_id' => $manuales->id,
                'stock' => 11,
                'min_stock' => 5,
                'is_active' => true,
            ],
            [
                'sku' => 'HER-MAN-004',
                'name' => 'Alicates universales 180 mm',
                'description' => 'Alicates para corte, sujeción y trabajos de electricidad básica.',
                'category_id' => $manuales->id,
                'stock' => 0,
                'min_stock' => 4,
                'is_active' => true,
            ],
            [
                'sku' => 'HER-MAN-005',
                'name' => 'Serrucho de poda manual',
                'description' => 'Serrucho manual para poda y corte de ramas pequeñas.',
                'category_id' => $manuales->id,
                'stock' => 2,
                'min_stock' => 3,
                'is_active' => false,
            ],

            // Herramientas eléctricas
            [
                'sku' => 'HER-ELE-001',
                'name' => 'Taladro percutor 750 W',
                'description' => 'Taladro percutor con velocidad variable para obra y bricolaje.',
                'category_id' => $electricas->id,
                'stock' => 7,
                'min_stock' => 3,
                'is_active' => true,
            ],
            [
                'sku' => 'HER-ELE-002',
                'name' => 'Amoladora angular 115 mm',
                'description' => 'Amoladora compacta para corte y desbaste de metal y piedra.',
                'category_id' => $electricas->id,
                'stock' => 3,
                'min_stock' => 4,
                'is_active' => true,
            ],
            [
                'sku' => 'HER-ELE-003',
                'name' => 'Lijadora orbital 300 W',
                'description' => 'Lijadora para madera, paredes y preparación de superficies.',
                'category_id' => $electricas->id,
                'stock' => 6,
                'min_stock' => 2,
                'is_active' => true,
            ],
            [
                'sku' => 'HER-ELE-004',
                'name' => 'Atornillador eléctrico 12 V',
                'description' => 'Atornillador inalámbrico para montaje de muebles y trabajos ligeros.',
                'category_id' => $electricas->id,
                'stock' => 0,
                'min_stock' => 3,
                'is_active' => true,
            ],
            [
                'sku' => 'HER-ELE-005',
                'name' => 'Sierra de calar 500 W',
                'description' => 'Sierra de calar para cortes curvos y rectos en madera.',
                'category_id' => $electricas->id,
                'stock' => 1,
                'min_stock' => 2,
                'is_active' => false,
            ],

            // Tornillería y fijaciones
            [
                'sku' => 'TOR-001',
                'name' => 'Caja de tornillos zincados 4x40',
                'description' => 'Caja de tornillos universales zincados para madera y tacos.',
                'category_id' => $tornilleria->id,
                'stock' => 55,
                'min_stock' => 20,
                'is_active' => true,
            ],
            [
                'sku' => 'TOR-002',
                'name' => 'Tacos de nylon 6 mm',
                'description' => 'Bolsa de tacos de nylon para fijación en pared.',
                'category_id' => $tornilleria->id,
                'stock' => 18,
                'min_stock' => 25,
                'is_active' => true,
            ],
            [
                'sku' => 'TOR-003',
                'name' => 'Arandelas planas M8',
                'description' => 'Caja de arandelas planas metálicas M8.',
                'category_id' => $tornilleria->id,
                'stock' => 0,
                'min_stock' => 15,
                'is_active' => true,
            ],
            [
                'sku' => 'TOR-004',
                'name' => 'Tuercas hexagonales M10',
                'description' => 'Caja de tuercas hexagonales de acero M10.',
                'category_id' => $tornilleria->id,
                'stock' => 35,
                'min_stock' => 10,
                'is_active' => true,
            ],
            [
                'sku' => 'TOR-005',
                'name' => 'Bridas negras 200 mm',
                'description' => 'Bolsa de bridas negras para sujeción de cables y elementos ligeros.',
                'category_id' => $tornilleria->id,
                'stock' => 9,
                'min_stock' => 12,
                'is_active' => true,
            ],

            // Pintura y tratamiento
            [
                'sku' => 'PIN-001',
                'name' => 'Pintura plástica blanca 15 L',
                'description' => 'Pintura plástica blanca mate para interior.',
                'category_id' => $pintura->id,
                'stock' => 12,
                'min_stock' => 4,
                'is_active' => true,
            ],
            [
                'sku' => 'PIN-002',
                'name' => 'Esmalte sintético negro 750 ml',
                'description' => 'Esmalte brillante para metal y madera.',
                'category_id' => $pintura->id,
                'stock' => 3,
                'min_stock' => 5,
                'is_active' => true,
            ],
            [
                'sku' => 'PIN-003',
                'name' => 'Rodillo antigoteo 22 cm',
                'description' => 'Rodillo para paredes lisas y pintura plástica.',
                'category_id' => $pintura->id,
                'stock' => 0,
                'min_stock' => 6,
                'is_active' => true,
            ],
            [
                'sku' => 'PIN-004',
                'name' => 'Brocha plana 50 mm',
                'description' => 'Brocha plana para esmaltes, barnices y pinturas.',
                'category_id' => $pintura->id,
                'stock' => 16,
                'min_stock' => 8,
                'is_active' => true,
            ],
            [
                'sku' => 'PIN-005',
                'name' => 'Cinta de carrocero 48 mm',
                'description' => 'Cinta de enmascarar para trabajos de pintura.',
                'category_id' => $pintura->id,
                'stock' => 5,
                'min_stock' => 10,
                'is_active' => true,
            ],

            // Fontanería
            [
                'sku' => 'FON-001',
                'name' => 'Cinta de teflón 12 mm',
                'description' => 'Rollo de cinta de teflón para sellado de roscas.',
                'category_id' => $fontaneria->id,
                'stock' => 40,
                'min_stock' => 12,
                'is_active' => true,
            ],
            [
                'sku' => 'FON-002',
                'name' => 'Sifón extensible PVC',
                'description' => 'Sifón flexible para lavabo y fregadero.',
                'category_id' => $fontaneria->id,
                'stock' => 6,
                'min_stock' => 6,
                'is_active' => true,
            ],
            [
                'sku' => 'FON-003',
                'name' => 'Latiguillo flexible 1/2"',
                'description' => 'Latiguillo flexible para conexión de grifería.',
                'category_id' => $fontaneria->id,
                'stock' => 2,
                'min_stock' => 8,
                'is_active' => true,
            ],
            [
                'sku' => 'FON-004',
                'name' => 'Válvula de escuadra',
                'description' => 'Válvula de corte para instalación doméstica de agua.',
                'category_id' => $fontaneria->id,
                'stock' => 0,
                'min_stock' => 5,
                'is_active' => true,
            ],
            [
                'sku' => 'FON-005',
                'name' => 'Racor de latón 3/4"',
                'description' => 'Racor de latón para unión de tuberías y mangueras.',
                'category_id' => $fontaneria->id,
                'stock' => 14,
                'min_stock' => 7,
                'is_active' => true,
            ],

            // Electricidad
            [
                'sku' => 'ELE-001',
                'name' => 'Cable eléctrico 2,5 mm',
                'description' => 'Rollo de cable unipolar para instalación eléctrica.',
                'category_id' => $electricidad->id,
                'stock' => 22,
                'min_stock' => 10,
                'is_active' => true,
            ],
            [
                'sku' => 'ELE-002',
                'name' => 'Base enchufe superficie',
                'description' => 'Base de enchufe para instalación en superficie.',
                'category_id' => $electricidad->id,
                'stock' => 8,
                'min_stock' => 10,
                'is_active' => true,
            ],
            [
                'sku' => 'ELE-003',
                'name' => 'Interruptor empotrable blanco',
                'description' => 'Interruptor sencillo para caja universal.',
                'category_id' => $electricidad->id,
                'stock' => 0,
                'min_stock' => 8,
                'is_active' => true,
            ],
            [
                'sku' => 'ELE-004',
                'name' => 'Bombilla LED E27 10 W',
                'description' => 'Bombilla LED de bajo consumo con casquillo E27.',
                'category_id' => $electricidad->id,
                'stock' => 28,
                'min_stock' => 15,
                'is_active' => true,
            ],
            [
                'sku' => 'ELE-005',
                'name' => 'Regleta 4 tomas con interruptor',
                'description' => 'Regleta eléctrica con cuatro tomas y protección básica.',
                'category_id' => $electricidad->id,
                'stock' => 5,
                'min_stock' => 5,
                'is_active' => true,
            ],

            // Jardín y exterior
            [
                'sku' => 'JAR-001',
                'name' => 'Manguera jardín 25 m',
                'description' => 'Manguera flexible para riego doméstico.',
                'category_id' => $jardin->id,
                'stock' => 9,
                'min_stock' => 4,
                'is_active' => true,
            ],
            [
                'sku' => 'JAR-002',
                'name' => 'Pistola de riego regulable',
                'description' => 'Pistola de riego con varios modos de salida.',
                'category_id' => $jardin->id,
                'stock' => 3,
                'min_stock' => 6,
                'is_active' => true,
            ],
            [
                'sku' => 'JAR-003',
                'name' => 'Guantes de trabajo reforzados',
                'description' => 'Guantes resistentes para jardinería y obra ligera.',
                'category_id' => $jardin->id,
                'stock' => 25,
                'min_stock' => 10,
                'is_active' => true,
            ],
            [
                'sku' => 'JAR-004',
                'name' => 'Azada pequeña',
                'description' => 'Herramienta manual para trabajos de huerto y jardín.',
                'category_id' => $jardin->id,
                'stock' => 0,
                'min_stock' => 3,
                'is_active' => true,
            ],
            [
                'sku' => 'JAR-005',
                'name' => 'Rastrillo metálico',
                'description' => 'Rastrillo para limpieza y nivelado de tierra.',
                'category_id' => $jardin->id,
                'stock' => 4,
                'min_stock' => 4,
                'is_active' => true,
            ],
        ];

        foreach ($items as $item) {
            Item::create($item);
        }
    }
}
