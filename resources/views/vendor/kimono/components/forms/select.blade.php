@php
    $class = $class ?? '';
    $type = $type ?? 'text';
    $name = $name ?? '';
    $id = $id ?? '';
    $placeholder = $placeholder ?? '';
    $value = $value ?? '';
    $required = $required ?? false;
    $disabled = $disabled ?? false;
    $readonly = $readonly ?? false;
    $multiple = $multiple ?? false;
@endphp
<select
    name="{{ $name }}"
    id="{{ $id }}"
    class="kimono__select p-2 w-full md:max-w-1/2 bg-white rounded-lg border border-[var(--color-gray)] {{ $class }}"
    @if ($required) required @endif
    @if ($disabled) disabled @endif
    @if ($readonly) readonly @endif
    @if ($multiple) multiple @endif
>
    {{ $slot }}
</select>

