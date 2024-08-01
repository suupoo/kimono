@php
    $class = $attributes['class'] ?? '';
@endphp

<ul class="w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 {{ $class }}">
    {{ $slot }}
</ul>
