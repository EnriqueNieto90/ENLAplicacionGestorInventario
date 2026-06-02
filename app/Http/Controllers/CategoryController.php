<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
// Importa las clases de request para validación específica
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;

class CategoryController extends Controller
{
    public function index(): View
    {
        // Carga categorías con recuentos útiles para el inventario
        $categories = Category::withCount([
            'items as active_items_count' => function ($query) {
                $query->where('is_active', true);
            },
            'items as low_stock_items_count' => function ($query) {
                $query->where('is_active', true)
                    ->where('stock', '>', 0)
                    ->whereColumn('stock', '<=', 'min_stock');
            },
            'items as out_of_stock_items_count' => function ($query) {
                $query->where('is_active', true)
                    ->where('stock', 0);
            },
        ])
            ->orderBy('name')
            ->get();

        return view('categories.index', compact('categories'));
    }

    public function create(): View
    {
        return view('categories.create');
    }

    public function store(StoreCategoryRequest $request): RedirectResponse
    {
        // Obtiene los datos ya validados por StoreCategoryRequest
        $validated = $request->validated();

        // Crea la categoría en la base de datos
        Category::create($validated);

        return redirect()
            ->route('categories.index')
            ->with('success', 'Categoría creada correctamente.');
    }

    public function edit(Category $category): View
    {
        return view('categories.edit', compact('category'));
    }

    public function update(UpdateCategoryRequest $request, Category $category): RedirectResponse
    {
        // Permite mantener el mismo nombre de la categoría actual
        $category->update($request->validated());

        return redirect()
            ->route('categories.index')
            ->with('success', 'Categoría actualizada correctamente.');
    }

    public function destroy(Category $category): RedirectResponse
    {
        // No se permite eliminar una categoría que tenga artículos asociados
        if ($category->items()->exists()) {
            return redirect()
                ->route('categories.index')
                ->with('error', 'No se puede eliminar una categoría con artículos asociados.');
        }

        $category->delete();

        return redirect()
            ->route('categories.index')
            ->with('success', 'Categoría eliminada correctamente.');
    }
}
