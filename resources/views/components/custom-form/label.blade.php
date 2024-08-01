@php
    $id = $attributes['id'] ?? '';
    $label = $attributes['label'] ?? '';
    $required = $attributes['required'] ?? false;
@endphp
<label
    for="{{ $id }}"
>
    {{ $label }}
    @if($required)
        <span class="text-sm text-red-500">※{{ __('required') }}</span>
    @endif
</label>
