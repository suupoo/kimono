@php
    $additionalClass = $attributes['class'] ?? '';
    $id = $attributes['id'] ?? '';
    $name = $attributes['name'] ?? '';
    $value = $attributes['value'] ?? '';
    $required = $attributes['required'] ?? false;
    $disable = $attributes['disable'] ?? false;
@endphp
<textarea
    class="hidden"
    id="{{ $id }}"
    name="{{ $name }}"
    @if($required)  required="required" @endif
>
    {{ old($name, request()->get($name, $value)) }}
</textarea>
<div id="editor-{{ $id }}" class="custom-wysiwyg">
    {!! old($name, request()->get($name, $value)) !!}
</div>

<script type="module">
    $(function(){
        let {{ $id }} = new Quill('#editor-{{ $id }}', {
            theme: 'snow',
        });
        {{ $id }}.on('text-change', function() {
            $('#{{ $id }}').html(
                $('#editor-{{ $id }}').find('.ql-editor').html()
            );
        });
        {{ $id }}.enable({{ $disable ? 'false' : 'true' }});
    })
</script>
