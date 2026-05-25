<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-1 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="text-lg font-medium text-slate-900">
                    Artículos
                </h2>
            </div>
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