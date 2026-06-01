<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="text-lg font-medium text-slate-900">
                Categorías
            </h2>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid gap-6 md:grid-cols-3">
                @forelse ($categories as $category)
                    <div class="rounded-2xl border border-slate-200 bg-white p-6">
                        <div class="flex items-start justify-between gap-4">
                            <div>
                                <h3 class="text-base font-semibold text-slate-900">
                                    {{ $category->name }}
                                </h3>

                                @if ($category->description)
                                    <p class="mt-2 text-sm text-slate-500">
                                        {{ $category->description }}
                                    </p>
                                @endif
                            </div>
                        </div>

                        <div class="mt-6 space-y-3">
                            <div class="flex items-center justify-between rounded-xl bg-slate-50 px-4 py-3">
                                <span class="text-sm text-slate-600">Artículos activos</span>
                                <span class="text-sm font-semibold text-slate-900">
                                    {{ $category->active_items_count }}
                                </span>
                            </div>

                            <div class="flex items-center justify-between rounded-xl bg-amber-50 px-4 py-3">
                                <span class="text-sm text-amber-700">Bajo stock</span>
                                <span class="text-sm font-semibold text-amber-900">
                                    {{ $category->low_stock_items_count }}
                                </span>
                            </div>

                            <div class="flex items-center justify-between rounded-xl bg-red-50 px-4 py-3">
                                <span class="text-sm text-red-700">Agotados</span>
                                <span class="text-sm font-semibold text-red-900">
                                    {{ $category->out_of_stock_items_count }}
                                </span>
                            </div>
                        </div>

                        <div class="mt-6">
                            <a href="{{ route('items.index', ['category_id' => $category->id]) }}"
                               class="text-sm font-medium text-marca-700 hover:text-marca-900 hover:underline">
                                Ver artículos de esta categoría
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="rounded-2xl border border-dashed border-slate-300 bg-white p-8 text-center md:col-span-3">
                        <p class="text-sm text-slate-500">
                            No hay categorías registradas.
                        </p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>