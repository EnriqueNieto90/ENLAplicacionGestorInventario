<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="text-lg font-medium text-slate-900">
                Historial de movimientos
            </h2>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white">

                <div class="border-b border-slate-200 px-6 py-4">
                    <h3 class="text-sm font-medium text-slate-800">
                        Movimientos registrados
                    </h3>
                </div>

                <form method="GET" action="{{ route('stock-movements.index') }}" class="border-b border-slate-200 px-6 py-4">
                    <div class="grid gap-4 md:grid-cols-3">
                        <div class="md:col-span-2">
                            <x-input-label for="search" value="Buscar artículo" />
                            <x-text-input
                                id="search"
                                name="search"
                                type="text"
                                class="mt-1 block w-full"
                                value="{{ request('search') }}"
                                placeholder="Buscar por nombre o SKU"
                            />
                        </div>

                        <div>
                            <x-input-label for="type" value="Tipo" />
                            <select
                                id="type"
                                name="type"
                                class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-marca-600 focus:ring-marca-600"
                            >
                                <option value="">Todos los movimientos</option>
                                <option value="in" @selected(request('type') === 'in')>
                                    Entradas
                                </option>
                                <option value="out" @selected(request('type') === 'out')>
                                    Salidas
                                </option>
                                <option value="adjustment" @selected(request('type') === 'adjustment')>
                                    Ajustes
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="mt-4 flex flex-wrap items-center gap-3">
                        <button type="submit"
                                class="rounded-lg bg-marca-600 px-4 py-2 text-sm font-medium text-white transition hover:bg-marca-700">
                            Aplicar filtros
                        </button>

                        <a href="{{ route('stock-movements.index') }}"
                           class="rounded-lg border border-slate-300 bg-white px-4 py-2 text-sm font-medium text-slate-700 transition hover:bg-slate-50">
                            Limpiar filtros
                        </a>
                    </div>
                </form>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-200">
                        <thead class="bg-slate-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-slate-500">
                                    Fecha
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-slate-500">
                                    Tipo
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-slate-500">
                                    Artículo
                                </th>
                                <th class="px-6 py-3 text-right text-xs font-medium uppercase tracking-wider text-slate-500">
                                    Cantidad
                                </th>
                                <th class="px-6 py-3 text-right text-xs font-medium uppercase tracking-wider text-slate-500">
                                    Stock
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-slate-500">
                                    Usuario
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-slate-500">
                                    Notas
                                </th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-slate-100 bg-white">
                            @forelse ($movements as $movement)
                                <tr class="hover:bg-slate-50">
                                    <td class="whitespace-nowrap px-6 py-4 text-sm text-slate-600">
                                        {{ $movement->created_at->format('d/m/Y H:i') }}
                                    </td>

                                    <td class="whitespace-nowrap px-6 py-4 text-sm">
                                        @if ($movement->type === 'in')
                                            <span class="inline-flex rounded-full bg-emerald-50 px-2.5 py-1 text-xs font-medium text-emerald-700 ring-1 ring-emerald-200">
                                                Entrada
                                            </span>
                                        @elseif ($movement->type === 'out')
                                            <span class="inline-flex rounded-full bg-red-50 px-2.5 py-1 text-xs font-medium text-red-700 ring-1 ring-red-200">
                                                Salida
                                            </span>
                                        @else
                                            <span class="inline-flex rounded-full bg-blue-50 px-2.5 py-1 text-xs font-medium text-blue-700 ring-1 ring-blue-200">
                                                Ajuste
                                            </span>
                                        @endif
                                    </td>

                                    <td class="px-6 py-4 text-sm">
                                        <a href="{{ route('items.show', $movement->item) }}"
                                           class="font-medium text-marca-700 hover:text-marca-900 hover:underline">
                                            {{ $movement->item->name }}
                                        </a>
                                        <p class="mt-1 text-xs text-slate-500">
                                            {{ $movement->item->sku }} · {{ $movement->item->category->name }}
                                        </p>
                                    </td>

                                    <td class="whitespace-nowrap px-6 py-4 text-right text-sm text-slate-700">
                                        @if ($movement->type === 'adjustment')
                                            Stock real: {{ $movement->stock_after }}
                                        @else
                                            {{ $movement->quantity }}
                                        @endif
                                    </td>

                                    <td class="whitespace-nowrap px-6 py-4 text-right text-sm text-slate-700">
                                        {{ $movement->stock_before }} → {{ $movement->stock_after }}
                                    </td>

                                    <td class="whitespace-nowrap px-6 py-4 text-sm text-slate-600">
                                        {{ $movement->user->name }}
                                    </td>

                                    <td class="px-6 py-4 text-sm text-slate-600">
                                        {{ $movement->notes ?: '—' }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-10 text-center text-sm text-slate-500">
                                        No hay movimientos registrados.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if ($movements->hasPages())
                    <div class="border-t border-slate-200 px-6 py-4">
                        {{ $movements->links() }}
                    </div>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>