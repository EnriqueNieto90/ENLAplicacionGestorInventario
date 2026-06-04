<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="text-lg font-medium text-slate-900">
                    Editar usuario
                </h2>
                <p class="text-sm text-slate-500">
                    Modifica los datos principales de la cuenta.
                </p>
            </div>

            <a href="{{ route('users.index') }}"
               class="inline-flex items-center justify-center rounded-lg border border-slate-300 bg-white px-4 py-2 text-sm font-medium text-slate-700 transition hover:bg-slate-50">
                Volver a usuarios
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">
            <div class="rounded-2xl border border-slate-200 bg-white p-6">
                <form method="POST" action="{{ route('users.update', $user) }}" class="space-y-6" novalidate>
                    @csrf
                    @method('PUT')

                    <div class="grid gap-6 md:grid-cols-2">
                        <div>
                            <x-input-label for="name" value="Nombre" :required="true" />
                            <x-text-input
                                id="name"
                                name="name"
                                type="text"
                                class="mt-1 block w-full"
                                value="{{ old('name', $user->name) }}"
                                required
                                autofocus
                            />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="email" value="Correo electrónico" :required="true" />
                            <x-text-input
                                id="email"
                                name="email"
                                type="email"
                                class="mt-1 block w-full"
                                value="{{ old('email', $user->email) }}"
                                required
                            />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>
                    </div>

                    <div>
                        <x-input-label for="role" value="Rol" :required="true" />
                        <select
                            id="role"
                            name="role"
                            class="mt-1 block w-full rounded-md border-slate-300 bg-yellow-50 shadow-sm focus:border-marca-600 focus:ring-marca-600"
                            required
                        >
                            <option value="">Selecciona un rol</option>
                            <option value="employee" @selected(old('role', $user->role) === 'employee')>
                                Empleado
                            </option>
                            <option value="admin" @selected(old('role', $user->role) === 'admin')>
                                Administrador
                            </option>
                        </select>
                        <x-input-error :messages="$errors->get('role')" class="mt-2" />

                        <p class="mt-2 text-xs text-slate-500">
                            Cambiar el rol modifica los permisos disponibles para este usuario.
                        </p>
                    </div>

                    <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
                        <h3 class="text-sm font-medium text-slate-900">
                            Cambiar contraseña
                        </h3>
                        <p class="mt-1 text-xs text-slate-500">
                            Deja estos campos vacíos si no quieres modificar la contraseña actual.
                        </p>

                        <div class="mt-4 grid gap-6 md:grid-cols-2">
                            <div>
                                <x-input-label for="password" value="Nueva contraseña" />
                                <x-text-input
                                    id="password"
                                    name="password"
                                    type="password"
                                    class="mt-1 block w-full bg-white"
                                    autocomplete="new-password"
                                />
                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="password_confirmation" value="Confirmar nueva contraseña" />
                                <x-text-input
                                    id="password_confirmation"
                                    name="password_confirmation"
                                    type="password"
                                    class="mt-1 block w-full bg-white"
                                    autocomplete="new-password"
                                />
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center justify-end gap-3 border-t border-slate-200 pt-6">
                        <a href="{{ route('users.index') }}"
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