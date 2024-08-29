@php
    $attributes = $attributes ?? [];
    $class = $attributes['class'] ?? '';
    $required = $attributes['required'] ?? false;
    if(array_key_exists('required_hidden', $attributes) && $attributes['required_hidden']){
      $requiredHidden = true;
    }
    $value = $attributes['value'] ?? '';
    $placeholder = $attributes['placeholder'] ?? '';
    $disable = $attributes['disable'] ?? false;
    $fileAccept = $attributes['fileAccept'] ?? '';
    $onclick = $attributes['onclick'] ?? null;
@endphp
<label
    for="{{ $column->id() }}"
>
    {{ $column->label() }}
    @if($required && !isset($requiredHidden))
        <span class="text-sm text-red-500">※{{ __('required') }}</span>
    @endif
</label>
<input
    class="w-full h-full min-h-8 text-sm border border-gray-300 rounded-md pl-2 {{$class}}"
    id="{{ $column->id() }}"
    name="{{ $column->id() }}"
    type="{{ $column->inputType() }}"
    value="{{ old($column->id(), request()->get($column->id(), $value)) }}"
    @if($column->maxLength()) maxlength="{{ $column->maxLength() }}" @endif
    @if($column->minLength()) minlength="{{ $column->minLength() }}" @endif
    @if($required)  required="required" @endif
    @if($placeholder) placeholder="{{ $placeholder }}" @endif
    @if($disable) disabled="disabled" @endif
    @if($fileAccept) accept="{{ $fileAccept }}" @endif
    @if($onclick) onclick="{{ $onclick }}" @endif
/>

