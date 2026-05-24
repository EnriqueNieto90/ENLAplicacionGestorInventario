<x-guest-layout>
    {{-- Encabezado de la pantalla --}}
    <div class="mb-7">
        <h1 class="text-xl font-medium text-slate-900 text-center">
            Acceso al sistema
        </h1>
    </div>

    {{-- Mensaje de estado (p. ej. tras recuperar contraseña) --}}
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="flex flex-col gap-5">
        @csrf

        {{-- Correo electrónico --}}
        <div class="flex flex-col gap-1.5">
            <x-input-label for="email" :value="'Correo electrónico'" />
            <x-text-input id="email" class="w-full"
                type="email" name="email" :value="old('email')"
                required autofocus autocomplete="username"
                placeholder="usuario@empresa.com" />
            <x-input-error :messages="$errors->get('email')" />
        </div>

        {{-- Contraseña --}}
        <div class="flex flex-col gap-1.5">
            <x-input-label for="password" :value="'Contraseña'" />
            <x-text-input id="password" class="w-full"
                type="password" name="password"
                required autocomplete="current-password"
                placeholder="Introduce tu contraseña" />
            <x-input-error :messages="$errors->get('password')" />
        </div>

        {{-- Recordar sesión + recuperar contraseña --}}
        <div class="flex items-center justify-between">
            <label for="remember_me" class="flex items-center">
                <input id="remember_me" type="checkbox" name="remember"
                    class="rounded border-slate-300 text-marca-600 focus:ring-marca-600">
                <span class="ms-2 text-sm text-slate-600">Recordar sesión</span>
            </label>

            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}"
                   class="text-sm font-medium text-marca-700 hover:text-marca-900 transition-colors">
                    ¿Olvidaste tu contraseña?
                </a>
            @endif
        </div>

        {{-- Botón principal --}}
        <button type="submit"
            class="w-full rounded-lg bg-marca-600 px-4 py-2.5 text-sm font-medium text-white
                   transition-colors hover:bg-marca-700 focus:outline-none focus:ring-2
                   focus:ring-marca-600 focus:ring-offset-2">
            Entrar
        </button>

        @if (Route::has('register'))
            <p class="text-center text-sm text-slate-500">
                ¿No tienes acceso?
                <a href="{{ route('register') }}"
                   class="font-medium text-marca-700 hover:text-marca-900 transition-colors">
                    Crear una cuenta
                </a>
            </p>
        @endif
    </form>
</x-guest-layout>
