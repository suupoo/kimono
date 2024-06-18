@php
    $attributes = $attributes ?? [];
    $class = $attributes['class'] ?? '';
    $required = $attributes['required'] ?? false;
    $value = $attributes['value'] ?? '';
@endphp
<label
    for="{{ $column->id() }}_confirmation"
>
    {{ $column->label() . "（" . __('confirm') . "）" }}
    @if($required)
        <span class="text-sm text-red-500">※{{ __('required') }}</span>
    @endif
</label>
<input
    class="w-full border border-gray-300 rounded-md pl-2 h-8 {{$class}}"
    id="{{ $column->id() }}_confirmation"
    name="{{ $column->id() }}_confirmation"
    type="{{ $column->inputType() }}"
    value=""
    @if($column->maxLength()) maxlength="{{ $column->maxLength() }}" @endif
    @if($column->minLength()) minlength="{{ $column->minLength() }}" @endif
    @if($required)  required="required" @endif
/>

