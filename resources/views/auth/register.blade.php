<x-guest-layout>
    <div class="mb-7">
        <h1 class="text-xl font-medium text-slate-900 text-center">
            Crear cuenta de acceso
        </h1>
    </div>

    <form method="POST" action="{{ route('register') }}" class="flex flex-col gap-5">
        @csrf

        {{-- Nombre completo --}}
        <div class="flex flex-col gap-1.5">
            <x-input-label for="name" :value="'Nombre completo'" />
            <x-text-input id="name" class="w-full"
                type="text" name="name" :value="old('name')"
                required autofocus autocomplete="name"
                placeholder="Nombre y apellidos" />
            <x-input-error :messages="$errors->get('name')" />
        </div>

        {{-- Correo electrónico --}}
        <div class="flex flex-col gap-1.5">
            <x-input-label for="email" :value="'Correo electrónico'" />
            <x-text-input id="email" class="w-full"
                type="email" name="email" :value="old('email')"
                required autocomplete="username"
                placeholder="usuario@empresa.com" />
            <x-input-error :messages="$errors->get('email')" />
        </div>

        {{-- Contraseña --}}
        <div class="flex flex-col gap-1.5">
            <x-input-label for="password" :value="'Contraseña'" />
            <x-text-input id="password" class="w-full"
                type="password" name="password"
                required autocomplete="new-password"
                placeholder="Mínimo 8 caracteres" />
            <x-input-error :messages="$errors->get('password')" />
        </div>

        {{-- Confirmación de contraseña --}}
        <div class="flex flex-col gap-1.5">
            <x-input-label for="password_confirmation" :value="'Confirmar contraseña'" />
            <x-text-input id="password_confirmation" class="w-full"
                type="password" name="password_confirmation"
                required autocomplete="new-password"
                placeholder="Repite la contraseña" />
            <x-input-error :messages="$errors->get('password_confirmation')" />
        </div>

        <button type="submit"
            class="w-full rounded-lg bg-marca-600 px-4 py-2.5 text-sm font-medium text-white
                   transition-colors hover:bg-marca-700 focus:outline-none focus:ring-2
                   focus:ring-marca-600 focus:ring-offset-2">
            Crear cuenta
        </button>

        <p class="text-center text-sm text-slate-500">
            ¿Ya tienes una cuenta?
            <a href="{{ route('login') }}"
               class="font-medium text-marca-700 hover:text-marca-900 transition-colors">
                Inicia sesión
            </a>
        </p>
    </form>
</x-guest-layout>