@php
    $for = $attributes['for'] ?? '';
    $label = $attributes['label'] ?? '';
    $required = $attributes['required'] ?? false;
@endphp
<label
    for="{{ $for }}"
    class="block text-sm font-medium mb-2 dark:text-white"
>
    {{ $label }}
    @if($required)
        <span class="text-sm text-red-500">※{{ __('required') }}</span>
    @endif
</label>
