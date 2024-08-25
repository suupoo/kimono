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
    $defaultClass = " py-2 px-3 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 ";
    if ($type == 'file') {
        $additionalClass = $additionalClass." file:bg-gray-50 file:border-0 file:me-4 file:py-3 file:px-4";
    }else if($type == 'checkbox'){
        // チェックボックスの場合はデフォルトのクラスは適用しない
        $defaultClass = "";
        $additionalClass = $additionalClass." relative w-[3.25rem] h-7 p-px bg-gray-100 border-transparent text-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:ring-blue-600 disabled:opacity-50 disabled:pointer-events-none checked:bg-none checked:text-blue-600 checked:border-blue-600 focus:checked:border-blue-600 dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-600 before:inline-block before:size-6 before:bg-white checked:before:bg-blue-200 before:translate-x-0 checked:before:translate-x-full before:rounded-full before:shadow before:transform before:ring-0 before:transition before:ease-in-out before:duration-200 dark:before:bg-neutral-400 dark:checked:before:bg-blue-200";
    }
@endphp
<input
    class="{{ $w }} {{ $h }} {{ $defaultClass }} {{ $additionalClass }}"
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

