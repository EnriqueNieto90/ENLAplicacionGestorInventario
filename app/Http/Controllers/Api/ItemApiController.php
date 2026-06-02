<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Item;
use Illuminate\Http\JsonResponse;

class ItemApiController extends Controller
{
    public function index(): JsonResponse
    {
        // Devuelve el listado de artículos activos con su categoría
        $items = Item::with('category')
            ->where('is_active', true)
            ->orderBy('name')
            ->get()
            ->map(fn (Item $item) => $this->formatItem($item));

        return response()->json([
            'data' => $items,
        ]);
    }

    public function showBySku(string $sku): JsonResponse
    {
        // Busca un artículo activo por su SKU
        $item = Item::with('category')
            ->where('is_active', true)
            ->where('sku', $sku)
            ->first();

        if (! $item) {
            return response()->json([
                'message' => 'Artículo no encontrado.',
            ], 404);
        }

        return response()->json([
            'data' => $this->formatItem($item),
        ]);
    }

    public function critical(): JsonResponse
    {
        // Devuelve artículos activos en estado bajo stock o agotado
        $items = Item::with('category')
            ->where('is_active', true)
            ->where(function ($query) {
                $query->where('stock', 0)
                    ->orWhere(function ($query) {
                        $query->where('stock', '>', 0)
                            ->whereColumn('stock', '<=', 'min_stock');
                    });
            })
            ->orderBy('stock')
            ->orderBy('name')
            ->get()
            ->map(fn (Item $item) => $this->formatItem($item));

        return response()->json([
            'data' => $items,
        ]);
    }

    private function formatItem(Item $item): array
    {
        return [
            'sku' => $item->sku,
            'name' => $item->name,
            'description' => $item->description,
            'category' => [
                'id' => $item->category->id,
                'name' => $item->category->name,
            ],
            'stock' => $item->stock,
            'min_stock' => $item->min_stock,
            'status' => $item->status,
        ];
    }
}
