@props(['disabled' => false])

@php
    $isRequired = $attributes->has('required');

    $baseClass = 'rounded-lg border-slate-300 px-4 py-2.5 text-sm text-slate-800 placeholder-slate-400 shadow-sm transition-colors focus:border-brand-600 focus:ring-brand-600 focus:outline-none';

    $requiredClass = $isRequired
        ? 'bg-yellow-50'
        : 'bg-white';
@endphp

<input
    @disabled($disabled)
    {{ $attributes->merge([
        'class' => $baseClass . ' ' . $requiredClass,
    ]) }}
>
