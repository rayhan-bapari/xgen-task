@props(['value'])

<span {{ $attributes->merge(['class' => 'text-danger text-sm error', 'id' => '']) }}>
    {{ $value ?? $slot }}
</span>
