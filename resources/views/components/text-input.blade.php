@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge([
    'class' => 'rounded-lg border-slate-300 px-4 py-2.5 text-sm text-slate-800 placeholder-slate-400 shadow-sm transition-colors focus:border-brand-600 focus:ring-brand-600 focus:outline-none'
]) }}>
