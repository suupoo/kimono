@php
    $attributes = $attributes ?? [];
    $class = $attributes['class'] ?? '';
    $required = $attributes['required'] ?? false;
    if(array_key_exists('required_hidden', $attributes) && $attributes['required_hidden']){
      $requiredHidden = true;
    }
    $value = $attributes['value'] ?? '';
@endphp
<label
    for="{{ $column->id() }}"
>
    {{ $column->label() }}
    @if($required && !isset($requiredHidden))
        <span class="text-sm text-red-500">※{{ __('required') }}</span>
    @endif
</label>

<textarea
    class="hidden"
    id="{{ $column->id() }}"
    name="{{ $column->id() }}"
    @if($required)  required="required" @endif
>
    {{ old($column->id(), request()->get($column->id(), $value)) }}
</textarea>
<div id="editor-{{ $column->id() }}" class="h-[100px]">
    {!! old($column->id(), request()->get($column->id(), $value)) !!}
</div>

<script type="module">
    $(function(){
        new Quill('#editor-{{ $column->id() }}', {
            theme: 'snow',
        }).on('text-change', function() {
            $('#{{ $column->id() }}').html(
                $('#editor-{{ $column->id() }}').find('.ql-editor').html()
            );
        });
    })
</script>
