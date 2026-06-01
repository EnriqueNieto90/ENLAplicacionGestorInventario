<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\StockMovement;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class StockMovementController extends Controller
{
    public function store(Request $request, Item $item): RedirectResponse
    {
        // Valida el tipo de movimiento, la cantidad y las notas opcionales
        $validated = $request->validate([
            'type' => ['required', 'in:in,out'],
            'quantity' => ['required', 'integer', 'min:1'],
            'notes' => ['nullable', 'string', 'max:500'],
        ]);

        DB::transaction(function () use ($validated, $item): void {
            // Bloquea el artículo para evitar inconsistencias si hay operaciones simultáneas
            $item = Item::whereKey($item->id)
                ->lockForUpdate()
                ->firstOrFail();

            $stockBefore = $item->stock;
            $quantity = (int) $validated['quantity'];

            // Regla de negocio por la que no se puede sacar más stock del disponible
            if ($validated['type'] === 'out' && $quantity > $stockBefore) {
                throw ValidationException::withMessages([
                    'quantity' => 'No se puede registrar una salida superior al stock disponible.',
                ]);
            }

            $stockAfter = $validated['type'] === 'in'
                ? $stockBefore + $quantity
                : $stockBefore - $quantity;

            // Registra el movimiento con trazabilidad completa (tipo, cantidad, stock antes/después, usuario, notas)
            StockMovement::create([
                'item_id' => $item->id,
                'user_id' => auth()->id(),
                'type' => $validated['type'],
                'quantity' => $quantity,
                'stock_before' => $stockBefore,
                'stock_after' => $stockAfter,
                'notes' => $validated['notes'] ?? null,
            ]);

            // Actualiza el stock actual del artículo
            $item->update([
                'stock' => $stockAfter,
            ]);
        });

        return redirect()
            ->route('items.show', $item)
            ->with('success', 'Movimiento de stock registrado correctamente.');
    }

    public function index(Request $request): View
    {
        // Consulta base del historial, cargando artículo y usuario relacionados
        $query = StockMovement::with(['item.category', 'user']);

        // Filtro por texto en nombre o SKU del artículo
        if ($request->filled('search')) {
            $search = $request->input('search');

            $query->whereHas('item', function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                    ->orWhere('sku', 'like', '%' . $search . '%');
            });
        }

        // Filtro por tipo de movimiento: entrada o salida
        if ($request->filled('type')) {
            $query->where('type', $request->input('type'));
        }

        $movements = $query->latest('created_at')
            ->paginate(10)
            ->withQueryString();

        return view('stock-movements.index', compact('movements'));
    }

}
