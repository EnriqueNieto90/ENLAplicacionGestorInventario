<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="text-lg font-medium text-slate-900">
                    Detalle del artículo
                </h2>
            </div>

            <div class="flex flex-wrap gap-3">
                @if (auth()->user()->isAdmin())
                    <a href="{{ route('items.edit', $item) }}"
                    class="inline-flex items-center justify-center rounded-lg bg-marca-600 px-4 py-2 text-sm font-medium text-white transition hover:bg-marca-700">
                        Editar artículo
                    </a>

                    <form method="POST" action="{{ route('items.destroy', $item) }}"
                        onsubmit="return confirm('¿Seguro que quieres dar de baja este artículo?');">
                        @csrf
                        @method('DELETE')

                        <button type="submit"
                                class="inline-flex items-center justify-center rounded-lg border border-red-300 bg-white px-4 py-2 text-sm font-medium text-red-700 transition hover:bg-red-50">
                            Dar de baja
                        </button>
                    </form>
                @endif

                <a href="{{ route('items.index') }}"
                class="inline-flex items-center justify-center rounded-lg border border-slate-300 bg-white px-4 py-2 text-sm font-medium text-slate-700 transition hover:bg-slate-50">
                    Volver al listado
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-7xl space-y-6 px-4 sm:px-6 lg:px-8">

            {{-- Resumen principal del artículo --}}
            <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white">
                <div class="border-b border-slate-200 px-6 py-5">
                    <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">
                        <div>
                            <p class="text-sm font-medium text-slate-500">
                                {{ $item->sku }}
                            </p>

                            <h3 class="mt-1 text-2xl font-semibold text-slate-900">
                                {{ $item->name }}
                            </h3>

                            @if ($item->description)
                                <p class="mt-2 max-w-3xl text-sm text-slate-600">
                                    {{ $item->description }}
                                </p>
                            @endif
                        </div>

                        <div>
                            @if ($item->status === 'disponible')
                                <span class="inline-flex rounded-full bg-emerald-50 px-3 py-1.5 text-sm font-medium text-emerald-700 ring-1 ring-emerald-200">
                                    Disponible
                                </span>
                            @elseif ($item->status === 'bajo stock')
                                <span class="inline-flex rounded-full bg-amber-50 px-3 py-1.5 text-sm font-medium text-amber-700 ring-1 ring-amber-200">
                                    Bajo stock
                                </span>
                            @else
                                <span class="inline-flex rounded-full bg-red-50 px-3 py-1.5 text-sm font-medium text-red-700 ring-1 ring-red-200">
                                    Agotado
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Datos principales --}}
                <div class="grid gap-0 divide-y divide-slate-200 md:grid-cols-2 md:divide-x md:divide-y-0">
                    <div class="p-6">
                        <h4 class="text-sm font-medium text-slate-900">
                            Clasificación
                        </h4>

                        <dl class="mt-4 space-y-4">
                            <div>
                                <dt class="text-sm text-slate-500">Categoría</dt>
                                <dd class="mt-1 text-sm font-medium text-slate-900">
                                    {{ $item->category->name }}
                                </dd>
                            </div>

                            <div>
                                <dt class="text-sm text-slate-500">Estado de actividad</dt>
                                <dd class="mt-1 text-sm font-medium text-slate-900">
                                    {{ $item->is_active ? 'Activo' : 'Inactivo' }}
                                </dd>
                            </div>
                        </dl>
                    </div>

                    <div class="p-6">
                        <h4 class="text-sm font-medium text-slate-900">
                            Control de stock
                        </h4>

                        <dl class="mt-4 grid grid-cols-2 gap-4">
                            <div class="rounded-xl bg-slate-50 p-4">
                                <dt class="text-sm text-slate-500">Stock actual</dt>
                                <dd class="mt-2 text-2xl font-semibold text-slate-900">
                                    {{ $item->stock }}
                                </dd>
                            </div>

                            <div class="rounded-xl bg-slate-50 p-4">
                                <dt class="text-sm text-slate-500">Stock mínimo</dt>
                                <dd class="mt-2 text-2xl font-semibold text-slate-900">
                                    {{ $item->min_stock }}
                                </dd>
                            </div>
                        </dl>
                    </div>
                </div>
            </div>

            {{-- Bloque para acciones e historial --}}
            <div class="grid gap-6 lg:grid-cols-2">
                <div class="rounded-2xl border border-slate-200 bg-white p-6">
                    <h3 class="text-sm font-medium text-slate-900">
                        Gestión de stock
                    </h3>

                    @if (auth()->user()->isAdmin())
                        <form method="POST" action="{{ route('items.stock-movements.store', $item) }}" class="mt-5 space-y-5">
                            @csrf

                            <div>
                                <x-input-label for="type" value="Tipo de movimiento" />
                                <select
                                    id="type"
                                    name="type"
                                    class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-marca-600 focus:ring-marca-600"
                                    required
                                >
                                    <option value="in" @selected(old('type') === 'in')>Entrada de stock</option>
                                    <option value="out" @selected(old('type') === 'out')>Salida de stock</option>
                                </select>
                                <x-input-error :messages="$errors->get('type')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="quantity" value="Cantidad" />
                                <x-text-input
                                    id="quantity"
                                    name="quantity"
                                    type="number"
                                    min="1"
                                    class="mt-1 block w-full"
                                    value="{{ old('quantity') }}"
                                    required
                                />
                                <x-input-error :messages="$errors->get('quantity')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="notes" value="Notas" />
                                <textarea
                                    id="notes"
                                    name="notes"
                                    rows="3"
                                    class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-marca-600 focus:ring-marca-600"
                                    placeholder="Motivo del movimiento o comentario opcional"
                                >{{ old('notes') }}</textarea>
                                <x-input-error :messages="$errors->get('notes')" class="mt-2" />
                            </div>

                            <button type="submit"
                                    class="rounded-lg bg-marca-600 px-4 py-2 text-sm font-medium text-white transition hover:bg-marca-700">
                                Registrar movimiento
                            </button>
                        </form>
                    @else
                        <p class="mt-2 text-sm text-slate-500">
                            Solo los administradores pueden registrar entradas o salidas de stock.
                        </p>
                    @endif
                </div>

                <div class="rounded-2xl border border-slate-200 bg-white p-6">
                    <h3 class="text-sm font-medium text-slate-900">
                        Historial de movimientos
                    </h3>

                    <div class="mt-5 space-y-3">
                        @forelse ($movements as $movement)
                            <div class="rounded-xl border border-slate-200 p-4">
                                <div class="flex items-start justify-between gap-4">
                                    <div>
                                        <p class="text-sm font-medium text-slate-900">
                                            {{ $movement->type === 'in' ? 'Entrada' : 'Salida' }}
                                            de {{ $movement->quantity }} unidades
                                        </p>

                                        <p class="mt-1 text-xs text-slate-500">
                                            Stock: {{ $movement->stock_before }} → {{ $movement->stock_after }}
                                        </p>

                                        @if ($movement->notes)
                                            <p class="mt-2 text-sm text-slate-600">
                                                {{ $movement->notes }}
                                            </p>
                                        @endif
                                    </div>

                                    <div class="text-right text-xs text-slate-500">
                                        <p>{{ $movement->created_at->format('d/m/Y H:i') }}</p>
                                        <p>{{ $movement->user->name }}</p>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p class="text-sm text-slate-500">
                                Todavía no hay movimientos registrados para este artículo.
                            </p>
                        @endforelse
                    </div>

                    @if ($movements->hasPages())
                        <div class="mt-5">
                            {{ $movements->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>