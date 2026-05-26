<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="text-lg font-medium text-slate-900">
                    Editar artículo
                </h2>
            </div>

            <a href="{{ route('items.show', $item) }}"
               class="inline-flex items-center justify-center rounded-lg border border-slate-300 bg-white px-4 py-2 text-sm font-medium text-slate-700 transition hover:bg-slate-50">
                Volver al detalle
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">
            <div class="rounded-2xl border border-slate-200 bg-white p-6">
                <form method="POST" action="{{ route('items.update', $item) }}" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div class="grid gap-6 md:grid-cols-2">
                        <div>
                            <x-input-label for="sku" value="SKU" />
                            <x-text-input
                                id="sku"
                                name="sku"
                                type="text"
                                class="mt-1 block w-full"
                                value="{{ old('sku', $item->sku) }}"
                                required
                            />
                            <x-input-error :messages="$errors->get('sku')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="name" value="Nombre" />
                            <x-text-input
                                id="name"
                                name="name"
                                type="text"
                                class="mt-1 block w-full"
                                value="{{ old('name', $item->name) }}"
                                required
                            />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>
                    </div>

                    <div>
                        <x-input-label for="description" value="Descripción" />
                        <textarea
                            id="description"
                            name="description"
                            rows="4"
                            class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-marca-600 focus:ring-marca-600"
                        >{{ old('description', $item->description) }}</textarea>
                        <x-input-error :messages="$errors->get('description')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="category_id" value="Categoría" />
                        <select
                            id="category_id"
                            name="category_id"
                            class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-marca-600 focus:ring-marca-600"
                            required
                        >
                            <option value="">Selecciona una categoría</option>

                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" @selected(old('category_id', $item->category_id) == $category->id)>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
                    </div>

                    <div class="grid gap-6 md:grid-cols-2">
                        <div>
                            <x-input-label for="stock" value="Stock actual" />
                            <x-text-input
                                id="stock"
                                type="number"
                                class="mt-1 block w-full bg-slate-100 text-slate-500"
                                value="{{ $item->stock }}"
                                disabled
                            />
                            <p class="mt-2 text-xs text-slate-500">
                                El stock se modifica mediante movimientos de entrada o salida.
                            </p>
                        </div>

                        <div>
                            <x-input-label for="min_stock" value="Stock mínimo" />
                            <x-text-input
                                id="min_stock"
                                name="min_stock"
                                type="number"
                                min="0"
                                class="mt-1 block w-full"
                                value="{{ old('min_stock', $item->min_stock) }}"
                                required
                            />
                            <x-input-error :messages="$errors->get('min_stock')" class="mt-2" />
                        </div>
                    </div>

                    <div class="flex items-center justify-end gap-3 border-t border-slate-200 pt-6">
                        <a href="{{ route('items.show', $item) }}"
                           class="rounded-lg border border-slate-300 bg-white px-4 py-2 text-sm font-medium text-slate-700 transition hover:bg-slate-50">
                            Cancelar
                        </a>

                        <button type="submit"
                                class="rounded-lg bg-marca-600 px-4 py-2 text-sm font-medium text-white transition hover:bg-marca-700">
                            Guardar cambios
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>