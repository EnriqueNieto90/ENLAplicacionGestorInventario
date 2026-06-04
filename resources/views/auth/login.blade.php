<x-guest-layout>
    <div class="mb-7 text-center">
        <h1 class="text-xl font-semibold text-slate-900">
            Acceso al sistema
        </h1>
        <p class="mt-1 text-sm text-slate-500">
            Introduce tus credenciales para acceder al inventario.
        </p>
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="flex flex-col gap-5" novalidate>
        @csrf

        <div class="flex flex-col gap-1.5">
            <x-input-label for="email" value="Correo electrónico" :required="true" />
            <x-text-input
                id="email"
                class="w-full"
                type="email"
                name="email"
                :value="old('email')"
                required
                autofocus
                autocomplete="username"
                placeholder="usuario@empresa.com"
            />
            <x-input-error :messages="$errors->get('email')" />
        </div>

        <div class="flex flex-col gap-1.5">
            <x-input-label for="password" value="Contraseña" :required="true" />
            <x-text-input
                id="password"
                class="w-full"
                type="password"
                name="password"
                required
                autocomplete="current-password"
                placeholder="Introduce tu contraseña"
            />
            <x-input-error :messages="$errors->get('password')" />
        </div>

        <div class="flex items-center justify-between">
            <label for="remember_me" class="flex items-center">
                <input
                    id="remember_me"
                    type="checkbox"
                    name="remember"
                    class="rounded border-slate-300 text-marca-600 focus:ring-marca-600"
                >
                <span class="ms-2 text-sm text-slate-600">
                    Recordar sesión
                </span>
            </label>
        </div>

        <button type="submit"
                class="w-full rounded-lg bg-marca-600 px-4 py-2.5 text-sm font-medium text-white transition hover:bg-marca-700 focus:outline-none focus:ring-2 focus:ring-marca-600 focus:ring-offset-2">
            Entrar
        </button>
    </form>
</x-guest-layout>
