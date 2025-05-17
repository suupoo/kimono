@php
    $class = $class ?? '';
    $type = $type ?? 'text';
    $name = $name ?? '';
    $placeholder = $placeholder ?? '';
    $value = $value ?? (object)[];
    $required = $required ?? false;
    $disabled = $disabled ?? false;
    $readonly = $readonly ?? false;
    $height = $height ?? '400px';

    $jsonEditorName = 'editor_' . $name;
    $jsonEditorMode = $disabled || $readonly
        ? 'preview'
        : 'code';
@endphp

<!-- 隠しフィールドにJSONデータを格納 -->
<input
    type="hidden"
    id="{{ $name }}"
    name="{{ $name }}"
    value="@json($value)"
    @required($required)
/>
<div
    id="{{ $jsonEditorName }}"
    class="kimono__json-editor h-[300px] md:h-[700px] w-full {{ $class }}"
>
</div>

<script type="module">
    const {{ $jsonEditorName }} = new JSONEditor(document.getElementById('{{ $jsonEditorName }}'), {
        mode: '{{ $jsonEditorMode }}',
        theme: 'tailwind',
        onChangeText: function() {
            // エディタの値が変更されるたびに隠しフィールドを更新
            document.getElementById('{{ $name }}').value = JSON.stringify({{ $jsonEditorName }}.get());
        },
    });
    {{ $jsonEditorName }}.set(JSON.parse(@json($value)));
</script>
