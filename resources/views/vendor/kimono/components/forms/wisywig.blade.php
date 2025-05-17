@php
    $class = $class ?? '';
    $type = $type ?? 'text';
    $name = $name ?? '';
    $placeholder = $placeholder ?? '';
    $value = $value ?? '';
    $required = $required ?? false;
    $disabled = $disabled ?? false;
    $readonly = $readonly ?? false;
    $rows = $rows ?? 10;
@endphp
<textarea
    name="{{ $name }}"
    id="{{ $name }}"
    class="kimono__textarea h-[300px] p-2 w-full bg-white rounded-lg border border-[var(--color-gray)] {{ $class }}"
    placeholder="{{ $placeholder }}"
    @if ($required) required @endif
    @if ($disabled) disabled @endif
    @if ($readonly) readonly @endif
    @if ($rows) rows="{{ $rows }}" @endif
>
    {{ $value }}
</textarea>
