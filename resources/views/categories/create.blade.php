<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="text-lg font-medium text-slate-900">
                    Nueva categoría
                </h2>
            </div>

            <a href="{{ route('categories.index') }}"
               class="inline-flex items-center justify-center rounded-lg border border-slate-300 bg-white px-4 py-2 text-sm font-medium text-slate-700 transition hover:bg-slate-50">
                Volver a categorías
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">
            <div class="rounded-2xl border border-slate-200 bg-white p-6">
                <form method="POST" action="{{ route('categories.store') }}" class="space-y-6">
                    @csrf

                    <div>
                        <x-input-label for="name" value="Nombre" />
                        <x-text-input
                            id="name"
                            name="name"
                            type="text"
                            class="mt-1 block w-full"
                            value="{{ old('name') }}"
                            required
                            placeholder="Ej. Herramientas"
                        />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="description" value="Descripción" />
                        <textarea
                            id="description"
                            name="description"
                            rows="4"
                            class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-marca-600 focus:ring-marca-600"
                            placeholder="Descripción opcional de la categoría"
                        >{{ old('description') }}</textarea>
                        <x-input-error :messages="$errors->get('description')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-end gap-3 border-t border-slate-200 pt-6">
                        <a href="{{ route('categories.index') }}"
                           class="rounded-lg border border-slate-300 bg-white px-4 py-2 text-sm font-medium text-slate-700 transition hover:bg-slate-50">
                            Cancelar
                        </a>

                        <button type="submit"
                                class="rounded-lg bg-marca-600 px-4 py-2 text-sm font-medium text-white transition hover:bg-marca-700">
                            Guardar categoría
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>