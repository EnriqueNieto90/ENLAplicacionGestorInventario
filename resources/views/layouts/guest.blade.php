<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Gestor de Inventario') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-slate-700 antialiased">
    <div class="flex min-h-screen flex-col items-center justify-center bg-slate-100 px-4 py-10">

        {{-- Marca: logo + nombre de la aplicación --}}
        <div class="mb-8 flex flex-col items-center gap-3">
            <div class="flex h-16 w-16 items-center justify-center rounded-2xl bg-marca-600 text-marca-50 shadow-sm">
                <x-application-logo class="h-9 w-9" />
            </div>
            <span class="text-lg font-medium tracking-tight text-slate-900">
                Gestor de Inventario
            </span>
        </div>

        {{-- Tarjeta que contiene el formulario (login o registro) --}}
        <div class="w-full max-w-md rounded-2xl border border-slate-200 bg-white px-8 py-9 shadow-sm">
            {{ $slot }}
        </div>
    </div>
</body>
</html>
