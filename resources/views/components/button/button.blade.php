@php
    $type = $attributes->get('type', 'button');
    match ($type) {
        'submit' => (function () use (&$attributes) {
            // ボタンがsubmitの場合
            $attributes = $attributes->merge(['type' => 'submit']);
        })(),
        'button' => (function () use (&$attributes) {
            // ボタンがbuttonの場合
            $attributes = $attributes->merge(['type' => 'button']);
        })(),
        'link' => (function () use (&$attributes) {
            // ボタンがlinkの場合
            $attributes = $attributes->merge([
                'type' => 'button',
            ]);
            if ($attributes->has('href')) {
                // hrefがあればonclick属性でリンクを実行する
                $attributes = $attributes->merge([
                    'onclick' => "location.href='{$attributes['href']}'",
                ]);
            }
        })(),
    };
@endphp
<button {{ $attributes->merge(['class' => 'custom-btn']) }}>
    {{ $slot }}
</button>
