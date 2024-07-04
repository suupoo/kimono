@php
    $attributes = $attributes ?? [];
    $class = $attributes['class'] ?? '';
    $required = $attributes['required'] ?? false;
    $value = $attributes['value'] ?? '';
@endphp
<label
    for="{{ $column->id() }}"
>
    {{ $column->label() }}
    @if($required)
        <span class="text-sm text-red-500">※必須</span>
    @endif
</label>

<select
    id="{{ $column->id() }}"
    name="{{ $column->id() }}"
    class="w-full h-full text-sm border border-gray-300 rounded-md pl-2"
    @if($required)  required="required" @endif
>
    @foreach($column->options() as $case)
    <option
        value="{{ $case->value }}"
        @if(old($column->id(), request()->get($column->id(), $value)) == $case->value) selected @endif
    >
        {{ $case->label() }}
    </option>
    @endforeach
</select>
