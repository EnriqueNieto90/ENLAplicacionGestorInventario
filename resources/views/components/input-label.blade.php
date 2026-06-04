@props([
    'value',
    'required' => false,
])

<label {{ $attributes->merge(['class' => 'block text-sm font-medium text-slate-700']) }}>
    {{ $value ?? $slot }}

    @if ($required)
        <span class="ml-1 text-red-600">*</span>
        <span class="sr-only">obligatorio</span>
    @endif
</label>