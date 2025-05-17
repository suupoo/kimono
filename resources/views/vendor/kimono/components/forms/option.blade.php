@php
    $class = $class ?? '';
    $value = $value ?? '';
    $selected = $selected ?? false;
@endphp

<option
    value="{{ $value }}"
    class="kimono__option {{ $class }}"
    @selected($selected)
>
    {{ $slot }}
</option>
