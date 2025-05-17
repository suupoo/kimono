@php
    $class = $class ?? '';
    $for = $for ?? '';
@endphp

<label
    for="{{ $for }}"
    class="kimono__label h-[35px] p-2 w-full md:max-w-1/2 {{ $class }}"
>
    {{ $slot }}
</label>
