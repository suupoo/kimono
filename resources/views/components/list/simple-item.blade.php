@php
    $class = $attributes['class'] ?? '';
@endphp

<li class="w-full px-4 py-2 border-b border-gray-200 {{ $class }}">
    {{ $slot }}
</li>
