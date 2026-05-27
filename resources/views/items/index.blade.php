<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-1 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="text-lg font-medium text-slate-900">
                    Artículos
                </h2>
            </div>
            @if (auth()->user()->isAdmin())
                <a href="{{ route('items.create') }}"
                class="inline-flex items-center justify-center rounded-lg bg-marca-600 px-4 py-2 text-sm font-medium text-white transition hover:bg-marca-700">
                    Nuevo artículo
                </a>
            @endif
        </div>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white">

                <div class="border-b border-slate-200 px-6 py-4">
                    <h3 class="text-sm font-medium text-slate-800">
                        Inventario actual
                    </h3>
                </div>

                <form method="GET" action="{{ route('items.index') }}" class="border-b border-slate-200 px-6 py-4">
                    <div class="grid gap-4 lg:grid-cols-4">
                        <div class="lg:col-span-2">
                            <x-input-label for="search" value="Buscar artículo" />
                            <x-text-input
                                id="search"
                                name="search"
                                type="text"
                                class="mt-1 block w-full"
                                value="{{ request('search') }}"
                                placeholder="Buscar por nombre, SKU o descripción"
                            />
                        </div>

                        <div>
                            <x-input-label for="category_id" value="Categoría" />
                            <select
                                id="category_id"
                                name="category_id"
                                class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-marca-600 focus:ring-marca-600"
                            >
                                <option value="">Todas las categorías</option>

                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" @selected(request('category_id') == $category->id)>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <x-input-label for="status" value="Estado" />
                            <select
                                id="status"
                                name="status"
                                class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-marca-600 focus:ring-marca-600"
                            >
                                <option value="">Todos los estados</option>
                                <option value="disponible" @selected(request('status') === 'disponible')>
                                    Disponible
                                </option>
                                <option value="bajo_stock" @selected(request('status') === 'bajo_stock')>
                                    Bajo stock
                                </option>
                                <option value="agotado" @selected(request('status') === 'agotado')>
                                    Agotado
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="mt-4 flex flex-wrap items-center gap-3">
                        <button type="submit"
                                class="rounded-lg bg-marca-600 px-4 py-2 text-sm font-medium text-white transition hover:bg-marca-700">
                            Aplicar filtros
                        </button>

                        <a href="{{ route('items.index') }}"
                        class="rounded-lg border border-slate-300 bg-white px-4 py-2 text-sm font-medium text-slate-700 transition hover:bg-slate-50">
                            Limpiar filtros
                        </a>
                    </div>
                </form>

                @if (request()->hasAny(['search', 'category_id', 'status']))
                    <div class="border-b border-slate-200 bg-slate-50 px-6 py-3 text-sm text-slate-600">
                        Filtros aplicados.

                        @if (request('search'))
                            <span class="ml-2 inline-flex rounded-full bg-white px-2.5 py-1 text-xs font-medium text-slate-700 ring-1 ring-slate-200">
                                Búsqueda: {{ request('search') }}
                            </span>
                        @endif

                        @if (request('status'))
                            <span class="ml-2 inline-flex rounded-full bg-white px-2.5 py-1 text-xs font-medium text-slate-700 ring-1 ring-slate-200">
                                Estado: {{ str_replace('_', ' ', request('status')) }}
                            </span>
                        @endif
                    </div>
                @endif

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-200">
                        <thead class="bg-slate-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-slate-500">
                                    SKU
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-slate-500">
                                    Artículo
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-slate-500">
                                    Categoría
                                </th>
                                <th class="px-6 py-3 text-right text-xs font-medium uppercase tracking-wider text-slate-500">
                                    Stock
                                </th>
                                <th class="px-6 py-3 text-right text-xs font-medium uppercase tracking-wider text-slate-500">
                                    Stock mínimo
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-slate-500">
                                    Estado
                                </th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-slate-100 bg-white">
                            @forelse ($items as $item)
                                <tr class="hover:bg-slate-50">
                                    <td class="whitespace-nowrap px-6 py-4 text-sm font-medium text-slate-900">
                                        {{ $item->sku }}
                                    </td>

                                    <td class="px-6 py-4 text-sm text-slate-700">
                                        <a href="{{ route('items.show', $item) }}"
                                        class="font-medium text-marca-700 hover:text-marca-900 hover:underline">
                                            {{ $item->name }}
                                        </a>
                                        @if ($item->description)
                                            <div class="mt-1 text-xs text-slate-500">
                                                {{ $item->description }}
                                            </div>
                                        @endif
                                    </td>

                                    <td class="whitespace-nowrap px-6 py-4 text-sm text-slate-600">
                                        {{ $item->category->name }}
                                    </td>

                                    <td class="whitespace-nowrap px-6 py-4 text-right text-sm text-slate-700">
                                        {{ $item->stock }}
                                    </td>

                                    <td class="whitespace-nowrap px-6 py-4 text-right text-sm text-slate-700">
                                        {{ $item->min_stock }}
                                    </td>

                                    <td class="whitespace-nowrap px-6 py-4 text-sm">
                                        @if ($item->status === 'disponible')
                                            <span class="inline-flex rounded-full bg-emerald-50 px-2.5 py-1 text-xs font-medium text-emerald-700 ring-1 ring-emerald-200">
                                                Disponible
                                            </span>
                                        @elseif ($item->status === 'bajo stock')
                                            <span class="inline-flex rounded-full bg-amber-50 px-2.5 py-1 text-xs font-medium text-amber-700 ring-1 ring-amber-200">
                                                Bajo stock
                                            </span>
                                        @else
                                            <span class="inline-flex rounded-full bg-red-50 px-2.5 py-1 text-xs font-medium text-red-700 ring-1 ring-red-200">
                                                Agotado
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-10 text-center text-sm text-slate-500">
                                        No hay artículos registrados en el inventario.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if ($items->hasPages())
                    <div class="border-t border-slate-200 px-6 py-4">
                        {{ $items->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>