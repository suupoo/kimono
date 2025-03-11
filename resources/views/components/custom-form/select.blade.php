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
        @if($case instanceof UnitEnum)
        {{-- Enumの場合 --}}
        <option
            value="{{ $case->value }}"
            @if(old($name, request()->get($name, $value)) === (string)$case->value) selected @endif
        >
            {{ $case->label() }}
        </option>
        @else if(is_array($case))
        {{-- 配列の場合 --}}
        <option
            value="{{ $case['value'] }}"
            @if(old($name, request()->get($name, $value)) === (string)$case['value']) selected @endif
        >
            {{ $case['label'] }}
        </option>
        @endif
    @endforeach
</select>
