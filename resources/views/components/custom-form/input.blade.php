@php
    $additionalClass = $attributes['class'] ?? '';
    $id = $attributes['id'] ?? '';
    $name = $attributes['name'] ?? '';
    $type = $attributes['type'] ?? '';
    $value = $attributes['value'] ?? '';
    $min = $attributes['min'] ?? '';
    $max = $attributes['max'] ?? '';
    $maxLength = $attributes['maxLength'] ?? '';
    $minLength = $attributes['minLength'] ?? '';
    $required = $attributes['required'] ?? false;
    $placeholder = $attributes['placeholder'] ?? '';
    $disable = $attributes['disable'] ?? false;
    $checked = $attributes['checked'] ?? false;
    $w = ($type == 'checkbox') ? 'w-5' : 'w-full';
    $h = ($type == 'checkbox') ? 'h-5' : 'h-full';
@endphp
<input
    class="{{ $w }} {{ $h }} text-sm border border-gray-300 rounded-md pl-2 {{ $additionalClass }}"
    id="{{ $id }}"
    name="{{ $name }}"
    type="{{ $type }}"
    value="{{ $value }}"
    @if($min) min="{{ $min }}" @endif
    @if($max) max="{{ $max }}" @endif
    @if($maxLength) maxlength="{{ $maxLength }}" @endif
    @if($minLength) minlength="{{ $minLength }}" @endif
    @if($required)  required="required" @endif
    @if($placeholder) placeholder="{{ $placeholder }}" @endif
    @if($disable) disabled="disabled" @endif
    @if($checked && $type=='checkbox') checked="checked" @endif
/>

