<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Item;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Validation\Rule;

class ItemController extends Controller
{
    public function index(): View
    {
        // Carga los artículos activos junto con su categoría y los pagina.
        $items = Item::with('category')
            ->where('is_active', true)
            ->orderBy('name')
            ->paginate(5);

        return view('items.index', compact('items'));
    }

    public function show(Item $item): View
    {
        // Carga la categoría asociada al artículo antes de mostrar el detalle
        $item->load('category');

        return view('items.show', compact('item'));
    }

    public function create(): View
    {
        // Carga las categorías disponibles para el select del formulario
        $categories = Category::orderBy('name')->get();

        return view('items.create', compact('categories'));
    }

    public function store(Request $request): RedirectResponse
    {
        // Valida los datos antes de crear el artículo
        $validated = $request->validate([
            'sku' => ['required', 'string', 'max:255', 'unique:items,sku'],
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'category_id' => ['required', 'exists:categories,id'],
            'stock' => ['required', 'integer', 'min:0'],
            'min_stock' => ['required', 'integer', 'min:0'],
        ]);

        $validated['is_active'] = true;

        $item = Item::create($validated);

        return redirect()
            ->route('items.show', $item)
            ->with('success', 'Artículo creado correctamente.');
    }

    public function edit(Item $item): View
    {
        // Carga las categorías para poder cambiar la clasificación del artículo
        $categories = Category::orderBy('name')->get();

        return view('items.edit', compact('item', 'categories'));
    }

    public function update(Request $request, Item $item): RedirectResponse
    {
        // Valida los datos permitiendo mantener el mismo SKU del artículo actual
        $validated = $request->validate([
            'sku' => [
                'required',
                'string',
                'max:255',
                Rule::unique('items', 'sku')->ignore($item->id),
            ],
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'category_id' => ['required', 'exists:categories,id'],
            'min_stock' => ['required', 'integer', 'min:0'],
        ]);

        $item->update($validated);

        return redirect()
            ->route('items.show', $item)
            ->with('success', 'Artículo actualizado correctamente.');
    }

    public function destroy(Item $item): RedirectResponse
    {
        // Baja lógica: el artículo se desactiva, pero no se elimina físicamente
        $item->update([
            'is_active' => false,
        ]);

        return redirect()
            ->route('items.index')
            ->with('success', 'Artículo dado de baja correctamente.');
    }
}
