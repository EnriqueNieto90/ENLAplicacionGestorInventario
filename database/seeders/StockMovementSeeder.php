<?php

namespace Database\Seeders;

use App\Models\Item;
use App\Models\StockMovement;
use App\Models\User;
use Illuminate\Database\Seeder;

class StockMovementSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::where('email', 'admin@ferreteria.test')->firstOrFail();
        $almacen = User::where('email', 'almacen@ferreteria.test')->firstOrFail();
        $ventas = User::where('email', 'ventas@ferreteria.test')->firstOrFail();

        $movementPlans = [
            'HER-MAN-001' => [
                ['type' => 'in', 'quantity' => 25, 'user' => $almacen->id, 'notes' => 'Entrada inicial de proveedor.'],
                ['type' => 'out', 'quantity' => 4, 'user' => $ventas->id, 'notes' => 'Venta en mostrador.'],
                ['type' => 'adjustment', 'quantity' => 20, 'user' => $admin->id, 'notes' => 'Ajuste por recuento físico.'],
            ],
            'HER-MAN-002' => [
                ['type' => 'in', 'quantity' => 15, 'user' => $almacen->id, 'notes' => 'Reposición inicial de destornilladores.'],
                ['type' => 'out', 'quantity' => 11, 'user' => $ventas->id, 'notes' => 'Ventas acumuladas de la semana.'],
            ],
            'HER-MAN-004' => [
                ['type' => 'in', 'quantity' => 8, 'user' => $almacen->id, 'notes' => 'Entrada inicial.'],
                ['type' => 'out', 'quantity' => 8, 'user' => $ventas->id, 'notes' => 'Producto agotado por ventas.'],
            ],
            'HER-ELE-002' => [
                ['type' => 'in', 'quantity' => 6, 'user' => $almacen->id, 'notes' => 'Entrada de herramientas eléctricas.'],
                ['type' => 'out', 'quantity' => 3, 'user' => $ventas->id, 'notes' => 'Ventas a cliente profesional.'],
            ],
            'HER-ELE-004' => [
                ['type' => 'in', 'quantity' => 5, 'user' => $almacen->id, 'notes' => 'Entrada inicial.'],
                ['type' => 'out', 'quantity' => 5, 'user' => $ventas->id, 'notes' => 'Agotado tras campaña promocional.'],
            ],
            'TOR-001' => [
                ['type' => 'in', 'quantity' => 70, 'user' => $almacen->id, 'notes' => 'Entrada inicial de tornillería.'],
                ['type' => 'out', 'quantity' => 15, 'user' => $ventas->id, 'notes' => 'Ventas en mostrador.'],
            ],
            'TOR-002' => [
                ['type' => 'in', 'quantity' => 30, 'user' => $almacen->id, 'notes' => 'Entrada inicial de tacos.'],
                ['type' => 'out', 'quantity' => 12, 'user' => $ventas->id, 'notes' => 'Ventas acumuladas.'],
            ],
            'TOR-003' => [
                ['type' => 'in', 'quantity' => 20, 'user' => $almacen->id, 'notes' => 'Entrada inicial.'],
                ['type' => 'adjustment', 'quantity' => 0, 'user' => $admin->id, 'notes' => 'Ajuste por pérdida detectada en recuento.'],
            ],
            'PIN-001' => [
                ['type' => 'in', 'quantity' => 16, 'user' => $almacen->id, 'notes' => 'Entrada inicial de pintura.'],
                ['type' => 'out', 'quantity' => 4, 'user' => $ventas->id, 'notes' => 'Ventas de pintura blanca.'],
            ],
            'PIN-003' => [
                ['type' => 'in', 'quantity' => 10, 'user' => $almacen->id, 'notes' => 'Entrada inicial de rodillos.'],
                ['type' => 'out', 'quantity' => 10, 'user' => $ventas->id, 'notes' => 'Producto agotado por ventas.'],
            ],
            'FON-002' => [
                ['type' => 'in', 'quantity' => 10, 'user' => $almacen->id, 'notes' => 'Entrada inicial de fontanería.'],
                ['type' => 'out', 'quantity' => 4, 'user' => $ventas->id, 'notes' => 'Venta de sifones.'],
            ],
            'FON-004' => [
                ['type' => 'in', 'quantity' => 6, 'user' => $almacen->id, 'notes' => 'Entrada inicial.'],
                ['type' => 'out', 'quantity' => 6, 'user' => $ventas->id, 'notes' => 'Producto agotado.'],
            ],
            'ELE-001' => [
                ['type' => 'in', 'quantity' => 30, 'user' => $almacen->id, 'notes' => 'Entrada inicial de cable eléctrico.'],
                ['type' => 'out', 'quantity' => 8, 'user' => $ventas->id, 'notes' => 'Venta por metros.'],
            ],
            'ELE-003' => [
                ['type' => 'in', 'quantity' => 12, 'user' => $almacen->id, 'notes' => 'Entrada inicial.'],
                ['type' => 'adjustment', 'quantity' => 0, 'user' => $admin->id, 'notes' => 'Ajuste por rotura de unidades en almacén.'],
            ],
            'JAR-002' => [
                ['type' => 'in', 'quantity' => 10, 'user' => $almacen->id, 'notes' => 'Entrada inicial de riego.'],
                ['type' => 'out', 'quantity' => 7, 'user' => $ventas->id, 'notes' => 'Ventas de temporada.'],
            ],
            'JAR-004' => [
                ['type' => 'in', 'quantity' => 5, 'user' => $almacen->id, 'notes' => 'Entrada inicial.'],
                ['type' => 'out', 'quantity' => 5, 'user' => $ventas->id, 'notes' => 'Producto agotado.'],
            ],
        ];

        foreach ($movementPlans as $sku => $movements) {
            $item = Item::where('sku', $sku)->firstOrFail();

            $currentStock = 0;

            foreach ($movements as $index => $movement) {
                $stockBefore = $currentStock;

                $stockAfter = match ($movement['type']) {
                    'in' => $stockBefore + $movement['quantity'],
                    'out' => $stockBefore - $movement['quantity'],
                    'adjustment' => $movement['quantity'],
                };

                StockMovement::create([
                    'item_id' => $item->id,
                    'user_id' => $movement['user'],
                    'type' => $movement['type'],
                    'quantity' => $movement['quantity'],
                    'stock_before' => $stockBefore,
                    'stock_after' => $stockAfter,
                    'notes' => $movement['notes'],
                    'created_at' => now()->subDays(count($movements) - $index),
                ]);

                $currentStock = $stockAfter;
            }
        }
    }
}
