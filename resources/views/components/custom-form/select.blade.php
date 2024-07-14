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
    class="w-full h-full text-sm border border-gray-300 rounded-md pl-2 {{ $additionalClass }}"
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
