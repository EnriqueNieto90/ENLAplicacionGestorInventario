<section>
    <header>
        <h2 class="text-lg font-medium text-slate-900">
            Datos de la cuenta
        </h2>

        <p class="mt-1 text-sm text-slate-500">
            Actualiza tu nombre y correo electrónico asociados al sistema.
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6" novalidate>
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" value="Nombre" :required="true" />
            <x-text-input
                id="name"
                name="name"
                type="text"
                class="mt-1 block w-full"
                :value="old('name', $user->name)"
                required
                autofocus
                autocomplete="name"
            />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" value="Correo electrónico" :required="true" />
            <x-text-input
                id="email"
                name="email"
                type="email"
                class="mt-1 block w-full"
                :value="old('email', $user->email)"
                required
                autocomplete="username"
            />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-3 rounded-lg border border-amber-200 bg-amber-50 px-4 py-3 text-sm text-amber-800">
                    <p>
                        Tu dirección de correo electrónico no está verificada.
                    </p>

                    <button form="send-verification"
                            class="mt-2 font-medium text-amber-900 underline hover:text-amber-950">
                        Reenviar correo de verificación
                    </button>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-emerald-700">
                            Se ha enviado un nuevo enlace de verificación a tu correo electrónico.
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div>
            <x-input-label value="Rol de usuario" />
            <p class="mt-1 rounded-lg border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm font-medium text-slate-700">
                {{ $user->isAdmin() ? 'Administrador' : 'Empleado' }}
            </p>
            <p class="mt-2 text-xs text-slate-500">
                El rol determina los permisos disponibles dentro del gestor de inventario.
            </p>
        </div>

        <div class="flex items-center gap-4">
            <button type="submit"
                    class="rounded-lg bg-marca-600 px-4 py-2 text-sm font-medium text-white transition hover:bg-marca-700">
                Guardar cambios
            </button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-slate-500"
                >
                    Cambios guardados.
                </p>
            @endif
        </div>
    </form>
</section>
