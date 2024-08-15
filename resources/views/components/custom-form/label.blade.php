@php
    $for = $attributes['for'] ?? '';
    $label = $attributes['label'] ?? '';
    $required = $attributes['required'] ?? false;
@endphp
<label
    for="{{ $for }}"
>
    {{ $label }}
    @if($required)
        <span class="text-sm text-red-500">※{{ __('required') }}</span>
    @endif
</label>
