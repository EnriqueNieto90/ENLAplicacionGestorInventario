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

            {{-- Bloque reservado para futuras acciones e historial --}}
            <div class="grid gap-6 lg:grid-cols-2">
                <div class="rounded-2xl border border-dashed border-slate-300 bg-white p-6">
                    <h3 class="text-sm font-medium text-slate-900">
                        Gestión de stock
                    </h3>
                </div>

                <div class="rounded-2xl border border-dashed border-slate-300 bg-white p-6">
                    <h3 class="text-sm font-medium text-slate-900">
                        Historial de movimientos
                    </h3>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>