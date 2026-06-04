<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Gestor de Inventario') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-slate-700 antialiased">
    <div class="flex min-h-screen flex-col bg-slate-100">
        <header class="border-b border-slate-200 bg-white">
            <div class="mx-auto flex h-16 max-w-7xl items-center justify-between px-4 sm:px-6 lg:px-8">
                <a href="{{ url('/') }}" class="flex items-center gap-3">
                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-marca-600 text-marca-50 shadow-sm">
                        <x-application-logo class="h-6 w-6" />
                    </div>

                    <div class="leading-tight">
                        <p class="text-sm font-semibold text-slate-900">
                            Gestor de Inventario
                        </p>
                        <p class="text-xs font-medium uppercase tracking-wide text-slate-500">
                            Control de stock
                        </p>
                    </div>
                </a>

                <a href="{{ url('/') }}"
                   class="rounded-lg border border-slate-300 bg-white px-4 py-2 text-sm font-medium text-slate-700 transition hover:bg-slate-50">
                    Volver al inicio
                </a>
            </div>
        </header>

        <main class="flex flex-1 items-center justify-center px-4 py-10">
            <div class="w-full max-w-md">
                <div class="mb-8 flex flex-col items-center gap-3 text-center">
                    <div class="flex h-16 w-16 items-center justify-center rounded-2xl bg-marca-600 text-marca-50 shadow-sm">
                        <x-application-logo class="h-9 w-9" />
                    </div>

                    <div>
                        <h1 class="text-xl font-semibold tracking-tight text-slate-900">
                            Gestor de Inventario
                        </h1>
                        <p class="mt-1 text-sm text-slate-500">
                            Acceso privado al sistema de gestión.
                        </p>
                    </div>
                </div>

                <div class="rounded-2xl border border-slate-200 bg-white px-8 py-9 shadow-sm">
                    {{ $slot }}
                </div>
            </div>
        </main>

        <footer class="border-t border-slate-200 bg-white">
            <div class="mx-auto flex max-w-7xl flex-col gap-4 px-4 py-6 text-sm text-slate-500 sm:px-6 lg:flex-row lg:items-center lg:justify-between lg:px-8">
                <div>
                    <p class="font-medium text-slate-700">
                        Sistema de Gestión de Inventario
                    </p>
                    <p class="mt-1">
                        Proyecto final de Desarrollo de Aplicaciones Web · IES Los Sauces · 2025/2026
                    </p>
                </div>

                <div class="flex flex-wrap items-center gap-3">
                    <span>Enrique Nieto Lorenzo</span>

                    <span class="hidden text-slate-300 sm:inline">|</span>

                    <a href="https://github.com/EnriqueNieto90/ENLAplicacionGestorInventario"
                       target="_blank"
                       rel="noopener noreferrer"
                       class="font-medium text-marca-700 hover:text-marca-900 hover:underline">
                        GitHub
                    </a>
                </div>
            </div>
        </footer>
    </div>
</body>
</html>
