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

<body class="bg-slate-100 font-sans text-slate-800 antialiased">
    <div class="flex min-h-screen flex-col">

        {{-- Header público: misma estructura visual que navigation.blade.php --}}
        <header class="border-b border-slate-200 bg-white">
            <div class="mx-auto flex h-16 max-w-7xl items-center justify-between px-4 sm:px-6 lg:px-8">

                <a href="{{ url('/') }}" class="flex items-center gap-3">
                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-marca-600 text-marca-50 shadow-sm">
                        <x-application-logo class="h-6 w-6" />
                    </div>

                    <div class="hidden leading-tight sm:block">
                        <p class="text-sm font-semibold tracking-tight text-slate-900">
                            Gestor de Inventario
                        </p>
                        <p class="text-xs font-medium uppercase tracking-wide text-slate-500">
                            Control de stock
                        </p>
                    </div>
                </a>

                <div class="flex items-center gap-2">
                    <a href="https://github.com/EnriqueNieto90/ENLAplicacionGestorInventario"
                       target="_blank"
                       rel="noopener noreferrer"
                       class="hidden rounded-lg border border-slate-300 bg-white px-3 py-1.5 text-sm font-medium text-slate-700 transition hover:bg-slate-50 sm:inline-flex">
                        GitHub
                    </a>

                    @auth
                        <a href="{{ url('/dashboard') }}"
                           class="rounded-lg bg-marca-600 px-3 py-1.5 text-sm font-medium text-white transition hover:bg-marca-700">
                            Panel de control
                        </a>
                    @else
                        <a href="{{ route('login') }}"
                           class="rounded-lg bg-marca-600 px-3 py-1.5 text-sm font-medium text-white transition hover:bg-marca-700">
                            Acceder
                        </a>
                    @endauth
                </div>

            </div>
        </header>

        {{-- Contenido principal --}}
        <main class="flex-1">
            <div class="mx-auto w-full max-w-7xl space-y-6 px-4 py-8 sm:px-6 lg:px-8">

                {{-- Banda de presentación --}}
                <section class="rounded-2xl border border-slate-200 bg-white px-6 py-7 shadow-sm">
                    <div class="flex flex-col gap-5 lg:flex-row lg:items-center lg:gap-8">

                        <div class="flex h-16 w-16 shrink-0 items-center justify-center rounded-2xl bg-marca-600 text-marca-50 shadow-sm">
                            <x-application-logo class="h-9 w-9" />
                        </div>

                        <div class="flex-1">
                            <p class="text-xs font-semibold uppercase tracking-[0.2em] text-marca-700">
                                Proyecto final de Desarrollo de Aplicaciones Web
                            </p>
                            <h1 class="mt-1.5 text-2xl font-bold tracking-tight text-slate-900 sm:text-3xl">
                                Sistema de Gestión de Inventario
                            </h1>
                            <p class="mt-2 max-w-3xl text-sm leading-relaxed text-slate-600">
                                Aplicación web para el control de stock en pequeñas y medianas organizaciones.
                                Permite gestionar artículos por categorías, registrar entradas, salidas y ajustes de
                                inventario, diferenciar perfiles de acceso y consultar el estado del almacén en tiempo real.
                            </p>
                        </div>
                    </div>
                </section>

                {{-- Bloque documental + API --}}
                <section class="grid gap-6 lg:grid-cols-[1fr_340px]">

                    {{-- Documentación técnica --}}
                    <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                        <div class="border-b border-slate-200 pb-4">
                            <p class="text-xs font-semibold uppercase tracking-[0.2em] text-slate-500">
                                Documentación técnica
                            </p>
                            <h2 class="mt-1 text-lg font-semibold text-slate-900">
                                Diagramas y documentos del proyecto
                            </h2>
                        </div>

                        <div class="mt-5 grid gap-3 sm:grid-cols-2 xl:grid-cols-3">

                            <a href="{{ asset('docs/catalogo-requisitos.pdf') }}" target="_blank"
                               class="group flex min-h-28 flex-col justify-between rounded-xl border border-slate-200 bg-slate-50 p-4 transition hover:border-marca-300 hover:bg-marca-50">
                                <div>
                                    <p class="text-sm font-semibold text-slate-900 group-hover:text-marca-900">
                                        Catálogo de requisitos
                                    </p>
                                    <p class="mt-1 text-xs text-slate-500">
                                        Funcionales y técnicos
                                    </p>
                                </div>
                                <span class="mt-4 text-xs font-medium text-marca-700">
                                    Abrir PDF →
                                </span>
                            </a>

                            <a href="{{ asset('docs/casos-uso.pdf') }}" target="_blank"
                               class="group flex min-h-28 flex-col justify-between rounded-xl border border-slate-200 bg-slate-50 p-4 transition hover:border-marca-300 hover:bg-marca-50">
                                <div>
                                    <p class="text-sm font-semibold text-slate-900 group-hover:text-marca-900">
                                        Casos de uso
                                    </p>
                                    <p class="mt-1 text-xs text-slate-500">
                                        Actores y permisos
                                    </p>
                                </div>
                                <span class="mt-4 text-xs font-medium text-marca-700">
                                    Abrir PDF →
                                </span>
                            </a>

                            <a href="{{ asset('docs/arbol-navegacion.pdf') }}" target="_blank"
                               class="group flex min-h-28 flex-col justify-between rounded-xl border border-slate-200 bg-slate-50 p-4 transition hover:border-marca-300 hover:bg-marca-50">
                                <div>
                                    <p class="text-sm font-semibold text-slate-900 group-hover:text-marca-900">
                                        Árbol de navegación
                                    </p>
                                    <p class="mt-1 text-xs text-slate-500">
                                        Vistas y rutas
                                    </p>
                                </div>
                                <span class="mt-4 text-xs font-medium text-marca-700">
                                    Abrir PDF →
                                </span>
                            </a>

                            <a href="{{ asset('docs/diagrama-clases.pdf') }}" target="_blank"
                               class="group flex min-h-28 flex-col justify-between rounded-xl border border-slate-200 bg-slate-50 p-4 transition hover:border-marca-300 hover:bg-marca-50">
                                <div>
                                    <p class="text-sm font-semibold text-slate-900 group-hover:text-marca-900">
                                        Diagrama de clases
                                    </p>
                                    <p class="mt-1 text-xs text-slate-500">
                                        MVC y autorización
                                    </p>
                                </div>
                                <span class="mt-4 text-xs font-medium text-marca-700">
                                    Abrir PDF →
                                </span>
                            </a>

                            <a href="{{ asset('docs/modelo-fisico.pdf') }}" target="_blank"
                               class="group flex min-h-28 flex-col justify-between rounded-xl border border-slate-200 bg-slate-50 p-4 transition hover:border-marca-300 hover:bg-marca-50">
                                <div>
                                    <p class="text-sm font-semibold text-slate-900 group-hover:text-marca-900">
                                        Modelo físico
                                    </p>
                                    <p class="mt-1 text-xs text-slate-500">
                                        Base de datos
                                    </p>
                                </div>
                                <span class="mt-4 text-xs font-medium text-marca-700">
                                    Abrir PDF →
                                </span>
                            </a>

                            <a href="{{ asset('docs/mer.pdf') }}" target="_blank"
                               class="group flex min-h-28 flex-col justify-between rounded-xl border border-slate-200 bg-slate-50 p-4 transition hover:border-marca-300 hover:bg-marca-50">
                                <div>
                                    <p class="text-sm font-semibold text-slate-900 group-hover:text-marca-900">
                                        Modelo entidad-relación
                                    </p>
                                    <p class="mt-1 text-xs text-slate-500">
                                        Entidades principales
                                    </p>
                                </div>
                                <span class="mt-4 text-xs font-medium text-marca-700">
                                    Abrir PDF →
                                </span>
                            </a>

                        </div>
                    </div>

                    {{-- API REST --}}
                    <aside class="rounded-2xl border border-marca-200 bg-marca-50 p-6 shadow-sm">
                        <div class="border-b border-marca-200 pb-4">
                            <div class="flex items-center justify-between gap-3">
                                <div>
                                    <p class="text-xs font-semibold uppercase tracking-[0.2em] text-marca-700">
                                        API REST
                                    </p>
                                    <h2 class="mt-1 text-lg font-semibold text-slate-900">
                                        Endpoints públicos
                                    </h2>
                                </div>

                                <span class="rounded-full bg-white px-3 py-1 text-xs font-semibold text-marca-700 ring-1 ring-marca-200">
                                    JSON
                                </span>
                            </div>
                        </div>

                        <div class="mt-4 space-y-3">

                            <a href="{{ url('/api/items') }}" target="_blank"
                               class="block rounded-xl bg-white p-4 shadow-sm ring-1 ring-marca-100 transition hover:ring-marca-300">
                                <div class="flex items-center justify-between">
                                    <span class="rounded bg-emerald-100 px-2 py-0.5 text-[11px] font-bold uppercase text-emerald-800">GET</span>
                                    <span class="text-xs text-slate-400">Activos</span>
                                </div>
                                <p class="mt-3 break-all font-mono text-sm font-semibold text-slate-900">
                                    /api/items
                                </p>
                            </a>

                            <a href="{{ url('/api/items/critical') }}" target="_blank"
                               class="block rounded-xl bg-white p-4 shadow-sm ring-1 ring-marca-100 transition hover:ring-marca-300">
                                <div class="flex items-center justify-between">
                                    <span class="rounded bg-emerald-100 px-2 py-0.5 text-[11px] font-bold uppercase text-emerald-800">GET</span>
                                    <span class="text-xs text-slate-400">Críticos</span>
                                </div>
                                <p class="mt-3 break-all font-mono text-sm font-semibold text-slate-900">
                                    /api/items/critical
                                </p>
                            </a>

                            <a href="{{ url('/api/items/INF-001') }}" target="_blank"
                               class="block rounded-xl bg-white p-4 shadow-sm ring-1 ring-marca-100 transition hover:ring-marca-300">
                                <div class="flex items-center justify-between">
                                    <span class="rounded bg-emerald-100 px-2 py-0.5 text-[11px] font-bold uppercase text-emerald-800">GET</span>
                                    <span class="text-xs text-slate-400">Por SKU</span>
                                </div>
                                <p class="mt-3 break-all font-mono text-sm font-semibold text-slate-900">
                                    /api/items/INF-001
                                </p>
                            </a>

                        </div>
                        
                    </aside>

                </section>
            </div>
        </main>

        {{-- Footer --}}
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
