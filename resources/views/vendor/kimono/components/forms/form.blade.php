@props(['columns', 'model', 'mode' => 'write'])

{{-- フォームの設定 --}}
{{-- 入力フォーム --}}
<div class="contents__form flex flex-col">
    @foreach($columns as $column)
        @if(
          //スキップルール
          (\Illuminate\Support\Arr::has($column, 'form.name') && $column['form']['name'] === null) // nameが未指定の場合はスキップ
        )
            @continue
        @endif
    @php
        $formName = $column['form']['name'];
        $formId = $column['form']['id'] ?? $formName;
        $formLabel = $column['form']['label'] ?? '不明なラベル';
        $formType = $column['form']['type'] ?? 'text';
        $formPlaceholder = $column['form']['placeholder'] ?? '';
        $formRequired = $column['form']['required'] ?? false;
        $formDefault = $column['form']['default'] ?? null;
        /** 優先順
        1. old バリデーション前の値
        2. model DBから取得した値
        3. default スキーマに設定しているdefault値
        4. null 値が無い場合はnullを表示
        */
        $currentValue = $model?->{$formName} ?? $formDefault ?? null;
        $value = (is_array($currentValue))
            ? old($formName, json_encode($model->{$formName}, JSON_UNESCAPED_UNICODE))
            : old($formName, $currentValue);
    @endphp
    <div class="contents__form-item-item">
        <div class="w-full flex flex-col  md:flex-row">
        {{-- 必須ラベル --}}
        @if($formRequired)
        <span class="text-[var(--color-error)]">
            ※
        </span>
        @endif

        {{-- フォーム --}}
        @if(in_array($formType,['text','radio','email','number','password','tel','url','search','color','date','datetime-local','month','week','time']))
            <x-kimono::forms.label
                for="{{ $formId }}"
                class="contents__form-item__label-{{ $formType }}"
            >
                {{ $formLabel }}
            </x-kimono::forms.label>
            <x-kimono::forms.input
                class="contents__form-item__input-{{ $formType }}"
                type="{{ $formType }}"
                name="{{ $formName }}"
                id="{{ $formId }}"
                placeholder="{{ $formPlaceholder }}"
                value="{{ $value }}"
                :readonly="$mode === 'read'"
                :disabled="$mode === 'read'"
                :required="$formRequired"
            />
        @elseif($formType === 'datetime-local')
            <x-kimono::forms.label
                for="{{ $formId }}"
                class="contents__form-item__label-{{ $formType }}"
            >
                {{ $formLabel }}
            </x-kimono::forms.label>
            <x-kimono::forms.input
                class="contents__form-item__input-{{ $formType }}"
                type="{{ $formType }}"
                name="{{ $formName }}"
                id="{{ $formId }}"
                placeholder="{{ $formPlaceholder }}"
                value="{{ $value->format('Y-m-d\TH:i') }}"
                :readonly="$mode === 'read'"
                :disabled="$mode === 'read'"
                :required="$formRequired"
            />
        @elseif($formType === 'file')
            <x-kimono::forms.label
                for="{{ $formId }}"
                class="contents__form-item__label-{{ $formType }}"
            >
                {{ $formLabel }}
            </x-kimono::forms.label>
            <div class="w-full flex flex-col md:max-w-1/2">
                @php
                    $filePathArray = explode('/',$value);
                    $fileNameKey = array_key_last($filePathArray);
                @endphp
                <x-kimono::forms.input
                    class="contents__form-item__input-{{ $formType }}"
                    type="{{ $formType }}"
                    name="{{ $formName }}"
                    id="{{ $formId }}"
                    placeholder="{{ $formPlaceholder }}"
                    :readonly="$mode === 'read'"
                    :disabled="$mode === 'read'"
                    :required="$formRequired"
                />
            </div>
        @elseif($formType === 'checkbox')
            <x-kimono::forms.label
                class="contents__form-item__label"
                for="{{ $formId }}"
            >
                {{ $formLabel }}
            </x-kimono::forms.label>
            <x-kimono::forms.checkbox
                class="contents__form-item__input-checkbox"
                id="{{ $formId }}"
                type="{{ $formType }}"
                name="{{ $formName }}"
                checked="{{ $value }}"
                :readonly="$mode === 'read'"
                :disabled="$mode === 'read'"
                :required="$formRequired"
            />
        @elseif($formType === 'select')
            <x-kimono::forms.label
                for="{{ $formId }}"
                class="contents__form-item__label-{{ $formType }}"
            >
                {{ $formLabel }}
            </x-kimono::forms.label>
            <x-kimono::forms.select
                class="contents__form-item__select"
                id="{{ $formId }}"
                name="{{ $formName }}"
                :readonly="$mode === 'read'"
                :disabled="$mode === 'read'"
                :required="$formRequired"
            >
                @foreach($column['options'] as $value => $label)
                    <x-kimono::forms.option
                        class="contents__form-item__option"
                        value="{{ $value }}"
                    >
                        {{ $label }}
                    </x-kimono::forms.option>
                @endforeach
            </x-kimono::forms.select>
        @elseif($formType === 'wisywig')
            <x-kimono::forms.label
                class="contents__form-item__label-wisywig"
                for="{{ $formId }}"
            >
                {{ $formLabel }}
            </x-kimono::forms.label>
            <x-kimono::forms.wisywig
                class="contents__form-item__input-wisywig"
                name="{{ $formName }}"
                placeholder="{{ $formPlaceholder }}"
                value="{{ $value }}"
                :readonly="$mode === 'read'"
                :disabled="$mode === 'read'"
                :required="$formRequired"
            >
                {{ $value ?? '' }}
            </x-kimono::forms.wisywig>
        @elseif($formType === 'json')
            <div class="w-full flex flex-col">
                <x-kimono::forms.label
                    class="contents__form-item__label-json"
                    for="{{ $formId }}"
                >
                    {{ $formLabel }}
                </x-kimono::forms.label>
                <x-kimono::forms.json
                    class="contents__form-item__input-json"
                    name="{{ $formName }}"
                    placeholder="{{ $formPlaceholder }}"
                    :value="$value"
                    :readonly="$mode === 'read'"
                    :disabled="$mode === 'read'"
                    :required="$formRequired"
                />
            </div>
        @elseif($formType === 'hidden')
            <x-kimono::forms.input
                class="contents__form-item__input-hidden"
                type="{{ $formType }}"
                name="{{ $formName }}"
                id="{{ $formId }}"
                value="{{ $value }}"
                :readonly="$mode === 'read'"
                :disabled="$mode === 'read'"
            />
        @endif
        </div>
        {{-- バリデーションエラー --}}
        @if($errors->has($formName))
            <div class="text-[var(--color-error)]">
                {{ $errors->first($formName) }}
            </div>
        @endif
    </div>
    @endforeach

    @if($mode === 'write')
    {{-- 送信ボタン --}}
    <button type="submit"
           name="submit-button"
           class="bg-[var(--color-success)] text-[var(--color-white)] rounded rounded-lg py-2 my-4 w-full"
           onclick="this.disabled=true; this.form.submit();"
    >
        {{ __('kimono::admin.save') }}
            </button>
    @endif
</div>

