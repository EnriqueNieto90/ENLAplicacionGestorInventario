<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Item;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
// Importa las clases de request para validación específica
use App\Http\Requests\StoreItemRequest;
use App\Http\Requests\UpdateItemRequest;

class ItemController extends Controller
{
    use AuthorizesRequests;
    
    public function index(Request $request): View
    {
        // Autoriza que el usuario pueda ver la lista de artículos según su rol
        $this->authorize('viewAny', Item::class);

        // Construye la consulta base para cargar los artículos con su categoría
        $query = Item::with('category');

        if (auth()->user()->isAdmin()) {
            match ($request->input('active', 'active')) {
                'inactive' => $query->where('is_active', false),
                'all' => null,
                default => $query->where('is_active', true),
            };
        } else {
            $query->where('is_active', true);
        }

        // Búsqueda por texto en SKU, nombre o descripción
        if ($request->filled('search')) {
            $search = $request->input('search');

            $query->where(function ($q) use ($search) {
                $q->where('sku', 'like', '%' . $search . '%')
                    ->orWhere('name', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%');
            });
        }

        // Filtro por categoría
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->input('category_id'));
        }

        // Filtro por estado calculado (disponible, bajo stock, agotado)
        if ($request->filled('status')) {
            match ($request->input('status')) {
                'disponible' => $query->whereColumn('stock', '>', 'min_stock'),
                'bajo_stock' => $query->where('stock', '>', 0)
                    ->whereColumn('stock', '<=', 'min_stock'),
                'agotado' => $query->where('stock', 0),
                default => null,
            };
        }

        $items = $query->orderBy('name')
            ->paginate(5)
            ->withQueryString();

        // Categorías necesarias para el select del filtro
        $categories = Category::orderBy('name')->get();

        return view('items.index', compact('items', 'categories'));
    }

    public function show(Item $item): View
    {
        // Autoriza que el usuario pueda ver el artículo según su rol
        $this->authorize('view', $item);

        // Carga la categoría y los movimientos recientes con su usuario
        $item->load('category');

        $movements = $item->stockMovements()
            ->with('user')
            ->latest('created_at')
            ->paginate(5);

        return view('items.show', compact('item', 'movements'));
    }

    public function create(): View
    {
        // Autoriza que el usuario pueda crear artículos según su rol
        $this->authorize('create', Item::class);

        // Carga las categorías disponibles para el select del formulario
        $categories = Category::orderBy('name')->get();

        return view('items.create', compact('categories'));
    }

    public function store(StoreItemRequest $request): RedirectResponse
    {
        // Autoriza que el usuario pueda crear artículos según su rol
        $this->authorize('create', Item::class);
        
        // Crea el artículo con los datos validados por StoreItemRequest
        $item = Item::create($request->validated());

        return redirect()
            ->route('items.show', $item)
            ->with('success', 'Artículo creado correctamente.');
    }

    public function restore(Item $item): RedirectResponse
    {
        // Autoriza que el usuario pueda rehabilitar el artículo según su rol
        $this->authorize('restore', $item);

        // Rehabilita un artículo dado de baja lógicamente
        $item->update([
            'is_active' => true,
        ]);

        return redirect()
            ->route('items.show', $item)
            ->with('success', 'Artículo rehabilitado correctamente.');
    }

    public function edit(Item $item): View
    {   
        // Autoriza que el usuario pueda modificar el artículo según su rol
        $this->authorize('update', $item);

        // Carga las categorías para poder cambiar la clasificación del artículo
        $categories = Category::orderBy('name')->get();

        return view('items.edit', compact('item', 'categories'));
    }

    public function update(UpdateItemRequest $request, Item $item): RedirectResponse
    {
        // Autoriza que el usuario pueda modificar el artículo según su rol
        $this->authorize('update', $item);

        // Actualiza la ficha del artículo con los datos validados
        $item->update($request->validated());

        return redirect()
            ->route('items.show', $item)
            ->with('success', 'Artículo actualizado correctamente.');
    }

    public function destroy(Item $item): RedirectResponse
    {
        // Autoriza que el usuario pueda dar de baja el artículo según su rol
        $this->authorize('delete', $item);

        // Baja lógica: el artículo se desactiva, pero no se elimina físicamente
        $item->update([
            'is_active' => false,
        ]);

        return redirect()
            ->route('items.index')
            ->with('success', 'Artículo dado de baja correctamente.');
    }
}
