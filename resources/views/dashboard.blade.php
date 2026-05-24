<x-app-layout>
    <x-slot name="header">
        <h2 class="text-lg font-medium text-slate-900">
            Panel de control
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            
            {{-- Indicadores principales --}}
            <div class="grid gap-4 sm:grid-cols-3">
                <div class="rounded-xl border border-slate-200 bg-white p-5">
                    <p class="text-sm text-slate-500">Artículos activos</p>
                    <p class="mt-2 text-2xl font-medium text-slate-900">—</p>
                </div>
                <div class="rounded-xl border border-slate-200 bg-white p-5 border-l-4 border-l-amber-500">
                    <p class="text-sm text-slate-500">Bajo stock</p>
                    <p class="mt-2 text-2xl font-medium text-slate-900">—</p>
                </div>
                <div class="rounded-xl border border-slate-200 bg-white p-5 border-l-4 border-l-red-500">
                    <p class="text-sm text-slate-500">Agotados</p>
                    <p class="mt-2 text-2xl font-medium text-slate-900">—</p>
                </div>
            </div>

            {{-- Aquí irá la tabla de últimos movimientos u otra vista de datos --}}
            <div class="mt-6 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                 <p class="text-sm text-slate-500 text-center py-8">No hay movimientos recientes.</p>
            </div>

        </div>
    </div>
</x-app-layout>
