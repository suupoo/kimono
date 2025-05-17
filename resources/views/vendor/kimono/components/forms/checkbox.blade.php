@php
    $class = $class ?? '';
    $name = $name ?? '';
    $id = $id ?? '';
    $checked = $checked ?? false;
    $required = $required ?? false;
    $disabled = $disabled ?? false;
    $readonly = $readonly ?? false;
@endphp
<input type="hidden"
       id="{{ $id }}_off"
       class="kimono__input {{ $class }}"
       name="{{ $name }}"
       value="0"
/>
<div class="w-full flex justify-center items-center">
    <input type="checkbox"
           id="{{ $id }}"
           class="kimono__input w-5 h-5 p-2 text-center bg-white rounded-lg border border-[var(--color-gray)] {{ $class }}"
           name="{{ $name }}"
           @checked($checked)
           @if ($required) required @endif
           @if ($disabled) disabled @endif
           @if ($readonly) readonly @endif
           value="1"
    />
</div>
