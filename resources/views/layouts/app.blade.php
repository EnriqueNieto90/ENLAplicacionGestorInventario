<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Gestor de Inventario') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <body class="font-sans antialiased text-slate-800">
        <div class="flex min-h-screen flex-col bg-slate-100">
            @include('layouts.navigation')

            @isset($header)
                <header class="border-b border-slate-200 bg-white">
                    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <main class="flex-1">
                @if (session('success'))
                    <div class="mx-auto mt-6 max-w-7xl px-4 sm:px-6 lg:px-8">
                        <div class="rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700">
                            {{ session('success') }}
                        </div>
                    </div>
                @endif

                @if (session('error'))
                    <div class="mx-auto mt-6 max-w-7xl px-4 sm:px-6 lg:px-8">
                        <div class="rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
                            {{ session('error') }}
                        </div>
                    </div>
                @endif

                {{ $slot }}
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
