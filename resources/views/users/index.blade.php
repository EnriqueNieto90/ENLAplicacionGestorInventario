<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="text-lg font-medium text-slate-900">
                    Usuarios
                </h2>
                <p class="text-sm text-slate-500">
                    Consulta de usuarios registrados en el sistema.
                </p>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white">
                <div class="border-b border-slate-200 px-6 py-5">
                    <h3 class="text-sm font-medium text-slate-900">
                        Listado de usuarios
                    </h3>
                    <p class="mt-1 text-sm text-slate-500">
                        Desde este módulo se gestionarán las cuentas internas de administradores y empleados.
                    </p>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-200">
                        <thead class="bg-slate-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-slate-500">
                                    Usuario
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-slate-500">
                                    Correo electrónico
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-slate-500">
                                    Rol
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-slate-500">
                                    Alta
                                </th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-slate-200 bg-white">
                            @forelse ($users as $user)
                                <tr>
                                    <td class="whitespace-nowrap px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <div class="flex h-9 w-9 items-center justify-center rounded-full bg-slate-100 text-sm font-semibold uppercase text-slate-700 ring-1 ring-slate-200">
                                                {{ mb_substr($user->name, 0, 1) }}
                                            </div>

                                            <div>
                                                <p class="text-sm font-medium text-slate-900">
                                                    {{ $user->name }}
                                                </p>

                                                @if (auth()->id() === $user->id)
                                                    <p class="text-xs text-slate-500">
                                                        Usuario actual
                                                    </p>
                                                @endif
                                            </div>
                                        </div>
                                    </td>

                                    <td class="whitespace-nowrap px-6 py-4 text-sm text-slate-600">
                                        {{ $user->email }}
                                    </td>

                                    <td class="whitespace-nowrap px-6 py-4">
                                        @if ($user->isAdmin())
                                            <span class="inline-flex rounded-full bg-marca-50 px-2.5 py-1 text-xs font-medium text-marca-700 ring-1 ring-marca-200">
                                                Administrador
                                            </span>
                                        @else
                                            <span class="inline-flex rounded-full bg-slate-100 px-2.5 py-1 text-xs font-medium text-slate-700 ring-1 ring-slate-200">
                                                Empleado
                                            </span>
                                        @endif
                                    </td>

                                    <td class="whitespace-nowrap px-6 py-4 text-sm text-slate-500">
                                        {{ $user->created_at->format('d/m/Y') }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-8 text-center text-sm text-slate-500">
                                        No hay usuarios registrados.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if ($users->hasPages())
                    <div class="border-t border-slate-200 px-6 py-4">
                        {{ $users->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>