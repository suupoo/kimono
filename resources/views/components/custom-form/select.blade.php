@php
    $additionalClass = $attributes['class'] ?? '';
    $id = $attributes['id'] ?? '';
    $name = $attributes['name'] ?? '';
    $value = $attributes['value'] ?? '';
    $required = $attributes['required'] ?? false;
    $disable = $attributes['disable'] ?? false;
@endphp

<select
    id="{{ $id }}"
    name="{{ $name }}"
    class="custom-select {{ $additionalClass }}"
    @if($required) required="required" @endif
    @if($disable) disabled="disabled" @endif
>
    @foreach($options as $case)
    <option
        value="{{ $case->value }}"
        @if(old($name, request()->get($name, $value)) === $case->value) selected @endif
    >
        {{ $case->label() }}
    </option>
    @endforeach
</select>
