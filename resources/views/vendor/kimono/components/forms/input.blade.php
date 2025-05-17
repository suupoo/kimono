@php
    $class = $class ?? '';
    $type = $type ?? 'text';
    $name = $name ?? '';
    $id = $id ?? '';
    $placeholder = $placeholder ?? '';
    $value = $value ?? '';
    $required = $required ?? false;
    $disabled = $disabled ?? false;
    $checked = $checked ?? false;
    $readonly = $readonly ?? false;
    $autofocus = $autofocus ?? false;
    $autocomplete = $autocomplete ?? '';
    $min = $min ?? '';
    $max = $max ?? '';
    $step = $step ?? '';
    $pattern = $pattern ?? '';
    $size = $size ?? '';
    $maxlength = $maxlength ?? '';
    $minlength = $minlength ?? '';
    $multiple = $multiple ?? false;
    $accept = $accept ?? '';
    $onchange = $onchange ?? '';
    $oninput = $oninput ?? '';
    $onkeydown = $onkeydown ?? '';
@endphp

<input
    type="{{ $type }}"
    name="{{ $name }}"
    id="{{ $id }}"
    class="kimono__input h-[35px] p-2 w-full bg-white rounded-lg border border-[var(--color-gray)] {{ $class }}"
    placeholder="{{ $placeholder }}"
    @if ($value) value="{{ $value }}" @endif
    @if ($required) required @endif
    @if ($disabled) disabled @endif
    @if ($checked) checked @endif
    @if ($readonly) readonly @endif
    @if ($autofocus) autofocus @endif
    @if ($autocomplete) autocomplete="{{ $autocomplete }}" @endif
    @if ($min) min="{{ $min }}" @endif
    @if ($max) max="{{ $max }}" @endif
    @if ($step) step="{{ $step }}" @endif
    @if ($pattern) pattern="{{ $pattern }}" @endif
    @if ($size) size="{{ $size }}" @endif
    @if ($maxlength) maxlength="{{ $maxlength }}" @endif
    @if ($minlength) minlength="{{ $minlength }}" @endif
    @if ($multiple) multiple @endif
    @if ($accept) accept="{{ $accept }}" @endif
/>
