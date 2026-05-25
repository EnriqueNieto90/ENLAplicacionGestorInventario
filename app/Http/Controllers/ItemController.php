<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\View\View;

class ItemController extends Controller
{
    public function index(): View
    {
        // Carga los artículos activos junto con su categoría y los pagina.
        $items = Item::with('category')
            ->where('is_active', true)
            ->orderBy('name')
            ->paginate(10);

        return view('items.index', compact('items'));
    }
}
