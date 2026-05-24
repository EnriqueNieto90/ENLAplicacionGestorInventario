<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Gestor de Inventario') }}</title>
    
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-slate-700 antialiased bg-slate-100 flex min-h-screen flex-col items-center justify-center p-4 sm:p-6">
    
    <div class="w-full max-w-md bg-white rounded-2xl shadow-sm border border-slate-200 p-8 sm:p-10 text-center flex flex-col items-center">
        
        {{-- Logo de la marca --}}
        <div class="flex h-20 w-20 items-center justify-center rounded-2xl bg-marca-600 text-marca-50 shadow-sm mb-6">
            <x-application-logo class="h-10 w-10" />
        </div>

        <h1 class="text-2xl font-semibold text-slate-900 mb-2">Gestor de Inventario</h1>
        <p class="text-sm text-slate-500 mb-8">Acceso restringido. Identifícate para acceder al sistema.</p>

        {{-- Botones de acción --}}
        <div class="flex flex-col gap-3 w-full">
            @auth
                <a href="{{ url('/dashboard') }}" 
                   class="w-full rounded-lg bg-marca-600 px-4 py-2.5 text-sm font-medium text-white transition-colors hover:bg-marca-700 focus:outline-none focus:ring-2 focus:ring-marca-600 focus:ring-offset-2">
                    Ir al Panel de control
                </a>
            @else
                <a href="{{ route('login') }}" 
                   class="w-full rounded-lg bg-marca-600 px-4 py-2.5 text-sm font-medium text-white transition-colors hover:bg-marca-700 focus:outline-none focus:ring-2 focus:ring-marca-600 focus:ring-offset-2">
                    Iniciar sesión
                </a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}" 
                       class="w-full rounded-lg bg-white px-4 py-2.5 text-sm font-medium text-slate-700 transition-colors border border-slate-300 hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-slate-200 focus:ring-offset-2">
                        Solicitar cuenta
                    </a>
                @endif
            @endauth
        </div>
    </div>

    <p class="mt-8 text-xs text-slate-400">
        &copy; {{ date('Y') }} Sistema de Inventario. Todos los derechos reservados.
    </p>

</body>
</html>
