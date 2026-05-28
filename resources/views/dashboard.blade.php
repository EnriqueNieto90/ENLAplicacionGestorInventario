<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="text-xl font-semibold leading-tight text-slate-800">
                Panel de control
            </h2>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="mx-auto max-w-7xl space-y-6 px-4 sm:px-6 lg:px-8">

            <div class="grid gap-4 md:grid-cols-2 xl:grid-cols-4">
                <div class="rounded-2xl border border-slate-200 bg-white p-6">
                    <p class="text-sm font-medium text-slate-500">Artículos activos</p>
                    <p class="mt-3 text-3xl font-semibold text-slate-900">{{ $totalItems }}</p>
                </div>

                <div class="rounded-2xl border border-emerald-200 bg-emerald-50 p-6">
                    <p class="text-sm font-medium text-emerald-700">Disponibles</p>
                    <p class="mt-3 text-3xl font-semibold text-emerald-900">{{ $availableItems }}</p>
                </div>

                <div class="rounded-2xl border border-amber-200 bg-amber-50 p-6">
                    <p class="text-sm font-medium text-amber-700">Bajo stock</p>
                    <p class="mt-3 text-3xl font-semibold text-amber-900">{{ $lowStockItems }}</p>
                </div>

                <div class="rounded-2xl border border-red-200 bg-red-50 p-6">
                    <p class="text-sm font-medium text-red-700">Agotados</p>
                    <p class="mt-3 text-3xl font-semibold text-red-900">{{ $outOfStockItems }}</p>
                </div>
            </div>

            <div class="grid gap-6 lg:grid-cols-3">
                <div class="rounded-2xl border border-slate-200 bg-white p-6 lg:col-span-2">
                    <div class="flex items-center justify-between gap-4">
                        <div>
                            <h3 class="text-base font-semibold text-slate-900">
                                Últimos movimientos de stock
                            </h3>
                            <p class="mt-1 text-sm text-slate-500">
                                Entradas y salidas más recientes registradas en el sistema.
                            </p>
                        </div>

                        <a href="{{ route('items.index') }}"
                           class="rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm font-medium text-slate-700 transition hover:bg-slate-50">
                            Ver inventario
                        </a>
                    </div>

                    <div class="mt-6 space-y-3">
                        @forelse ($latestMovements as $movement)
                            <div class="flex items-start justify-between gap-4 rounded-xl border border-slate-200 p-4">
                                <div>
                                    <p class="text-sm font-medium text-slate-900">
                                        {{ $movement->type === 'in' ? 'Entrada' : 'Salida' }}
                                        de {{ $movement->quantity }} unidades
                                    </p>

                                    <p class="mt-1 text-sm text-slate-600">
                                        {{ $movement->item->name }}
                                    </p>

                                    <p class="mt-1 text-xs text-slate-500">
                                        Stock: {{ $movement->stock_before }} → {{ $movement->stock_after }}
                                    </p>
                                </div>

                                <div class="text-right text-xs text-slate-500">
                                    <p>{{ $movement->created_at->format('d/m/Y H:i') }}</p>
                                    <p>{{ $movement->user->name }}</p>
                                </div>
                            </div>
                        @empty
                            <p class="rounded-xl border border-dashed border-slate-300 p-6 text-sm text-slate-500">
                                Todavía no hay movimientos de stock registrados.
                            </p>
                        @endforelse
                    </div>
                </div>

                <div class="rounded-2xl border border-slate-200 bg-white p-6">
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <h3 class="text-base font-semibold text-slate-900">
                                Artículos que requieren atención
                            </h3>
                            <p class="mt-1 text-sm text-slate-500">
                                Artículos agotados o por debajo del stock mínimo.
                            </p>
                        </div>
                    </div>

                    <div class="mt-5 space-y-3">
                        @forelse ($criticalItems as $item)
                            <a href="{{ route('items.show', $item) }}"
                            class="block rounded-xl border border-slate-200 p-4 transition hover:bg-slate-50">
                                <div class="flex items-start justify-between gap-3">
                                    <div>
                                        <p class="text-sm font-medium text-slate-900">
                                            {{ $item->name }}
                                        </p>
                                        <p class="mt-1 text-xs text-slate-500">
                                            {{ $item->sku }} · {{ $item->category->name }}
                                        </p>
                                    </div>

                                    @if ($item->status === 'agotado')
                                        <span class="shrink-0 rounded-full bg-red-50 px-2.5 py-1 text-xs font-medium text-red-700 ring-1 ring-red-200">
                                            Agotado
                                        </span>
                                    @else
                                        <span class="shrink-0 rounded-full bg-amber-50 px-2.5 py-1 text-xs font-medium text-amber-700 ring-1 ring-amber-200">
                                            Bajo stock
                                        </span>
                                    @endif
                                </div>

                                <div class="mt-3 flex items-center justify-between text-xs text-slate-500">
                                    <span>Stock actual: {{ $item->stock }}</span>
                                    <span>Mínimo: {{ $item->min_stock }}</span>
                                </div>
                            </a>
                        @empty
                            <div class="rounded-xl border border-dashed border-slate-300 p-5">
                                <p class="text-sm font-medium text-slate-800">
                                    Sin alertas de stock
                                </p>
                                <p class="mt-1 text-sm text-slate-500">
                                    No hay artículos agotados ni por debajo del stock mínimo.
                                </p>
                            </div>
                        @endforelse
                    </div>

                    <div class="mt-5 flex flex-wrap gap-3">
                        <a href="{{ route('items.index', ['status' => 'bajo_stock']) }}"
                        class="text-sm font-medium text-marca-700 hover:text-marca-900 hover:underline">
                            Ver bajo stock
                        </a>

                        <a href="{{ route('items.index', ['status' => 'agotado']) }}"
                        class="text-sm font-medium text-red-700 hover:text-red-900 hover:underline">
                            Ver agotados
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
