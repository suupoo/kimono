<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Schema Language Lines
    |--------------------------------------------------------------------------
    */

    'kimono_advertisements' => [
        'archetype' => '広告',
        'id' => [
            'column' => 'ID',
            'placeholder' => 'IDを指定します。',
        ],
        'identifier' => [
            'column' => '広告識別子',
            'placeholder' => '広告識別子を指定します。',
        ],
        'type' => [
            'column' => '広告種別',
            'placeholder' => '広告種別を指定します。',
        ],
        'description' => [
            'column' => '説明',
            'placeholder' => '説明を指定します。',
        ],
        'url' => [
            'column' => 'URL',
            'placeholder' => 'URLを指定します。',
        ],
        'image' => [
            'column' => '画像',
            'placeholder' => '画像を指定します。',
        ],
        'priority' => [
            'column' => '優先順',
            'placeholder' => '優先順を指定します。',
        ],
        'name' => [
            'column' => '広告名',
            'placeholder' => '名前を指定します。',
        ],
        'active' => [
            'column' => '有効',
            'placeholder' => '広告を有効にします。',
        ],
        'start_at' => [
            'column' => '開始日時',
            'placeholder' => '開始日時を指定してください。',
        ],
        'end_at' => [
            'column' => '終了日時',
            'placeholder' => '終了日時を指定してください。',
        ],
    ],
    'kimono_archetypes' => [
        'archetype' => 'アーキタイプ',
        'id' => [
            'column' => 'ID',
            'placeholder' => 'アーキタイプのIDを指定します。',
        ],
        'name' => [
            'column' => 'アーキタイプ名',
            'placeholder' => 'アーキタイプの名前を指定します。',
        ],
        'active' => [
            'column' => '有効',
            'placeholder' => 'アーキタイプを有効にします。',
        ],
        'start_at' => [
            'column' => '開始日時',
            'placeholder' => '開始日時を指定してください。',
        ],
        'end_at' => [
            'column' => '終了日時',
            'placeholder' => '終了日時を指定してください。',
        ],
    ],
    'kimono_configurations' => [
        'archetype' => '設定',
        'id' => [
            'column' => 'ID',
            'placeholder' => '',
        ],
        'parameters' => [
            'column' => '設定値',
            'placeholder' => '設定値をJSON形式で指定します。',
        ],
    ],
    'kimono_configuration_histories' => [
        'archetype' => '設定履歴',
        'id' => [
            'column' => 'ID',
            'placeholder' => '',
        ],
        'before' => [
            'column' => '変更前の設定値',
            'placeholder' => '',
        ],
        'after' => [
            'column' => '変更後の設定値',
            'placeholder' => '',
        ],
        'diff' => [
            'column' => '差分',
            'placeholder' => '',
        ],
        'created_at' => [
            'column' => '作成日時',
            'placeholder' => '',
        ],
    ],
];
