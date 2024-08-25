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
    $fileAccept = $attributes['fileAccept'] ?? '';
    if ($type == 'file') {
        $additionalClass = $additionalClass." file:bg-gray-50 file:border-0 file:me-4 file:py-3 file:px-4";
    }
@endphp
<input
    class="{{ $w }} {{ $h }} py-2 px-3 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 {{ $additionalClass }}"
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
    @if($type === 'file' && $fileAccept) accept="{{ $fileAccept }}" @endif
/>

