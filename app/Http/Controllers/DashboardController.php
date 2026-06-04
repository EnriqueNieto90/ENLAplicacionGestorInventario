<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\StockMovement;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        // Indicadores principales del inventario
        $totalItems = Item::where('is_active', true)->count();

        $availableItems = Item::where('is_active', true)
            ->whereColumn('stock', '>', 'min_stock')
            ->count();

        $lowStockItems = Item::where('is_active', true)
            ->where('stock', '>', 0)
            ->whereColumn('stock', '<=', 'min_stock')
            ->count();

        $outOfStockItems = Item::where('is_active', true)
            ->where('stock', 0)
            ->count();

        // Últimos movimientos registrados, con artículo y usuario asociados
        $latestMovements = StockMovement::with(['item', 'user'])
            ->latest('created_at')
            ->take(5)
            ->get();

        $criticalItems = Item::with('category')
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
            ->take(6)
            ->get();

        return view('dashboard', compact(
            'totalItems',
            'availableItems',
            'lowStockItems',
            'outOfStockItems',
            'latestMovements',
            'criticalItems'
        ));
    }
}
