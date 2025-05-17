<form class="kimono__search-bar" id="search-bar">
    <div class="w-full flex flex-wrap">
    @foreach($columns as $columnName => $column)
        @if(in_array($columnName, $searchable))
            @php
                $formName = $column['form']['name'];
                $formId = $column['form']['id'] ?? $formName;
                $formLabel = $column['form']['label'] ?? '不明なラベル';
                $formType = $column['form']['searchType'] ?? $column['form']['type'] ?? 'text';
                $formPlaceholder = $column['form']['placeholder'] ?? '';
                $formRequired = $column['form']['required'] ?? false;
                $formDefault = $column['form']['default'] ?? null;
                $formValue = request()->get($columnName);
            @endphp

            <div class="contents__search-bar-item w-full md:w-1/2 ">
                <div class="w-full flex flex-col md:flex-row">

                    {{-- フォーム --}}
                    @if(in_array($formType,['text','email','number','tel','url','search','color','date','datetime-local','month','week','time']))
                        <x-kimono::forms.label
                            for="{{ $formId }}"
                            class="contents__search-bar__label-{{ $formType }}"
                        >
                            {{ $formLabel }}
                        </x-kimono::forms.label>
                        <x-kimono::forms.input
                            class="contents__search-bar__input-{{ $formType }}"
                            type="{{ $formType }}"
                            name="{{ $formName }}"
                            id="{{ $formId }}"
                            placeholder="{{ $formPlaceholder }}"
                            value="{{ $formValue }}"
                        />
                    @elseif(in_array($formType,['checkbox','select','radio']))
                        <x-kimono::forms.label
                            for="{{ $formId }}"
                            class="contents__form-item__label-{{ $formType }}"
                        >
                            {{ $formLabel }}
                        </x-kimono::forms.label>
                        <x-kimono::forms.select
                            class="contents__search-bar__select"
                            id="{{ $formId }}"
                            name="{{ $formName }}"
                        >
                            {{-- 未選択 --}}
                            <x-kimono::forms.option
                                class="contents__search-bar__option"
                                value=""
                            >
                                {{ __('kimono::admin.unselected') }}
                            </x-kimono::forms.option>

                            {{-- 正しいオプション --}}
                            @foreach($column['options'] as $value => $label)
                            <x-kimono::forms.option
                                class="contents__search-bar__option"
                                value="{{ $value }}"
                                selected="{{ (string)$value === (string)$formValue }}"
                            >
                                {{ $label }}
                            </x-kimono::forms.option>
                            @endforeach
                        </x-kimono::forms.select>
                    @endif
                </div>
            </div>
        @endif
    @endforeach
    </div>

    <div class="w-full">
        <button type="submit"
                name="submit-button"
                class="bg-[var(--color-active)] text-[var(--color-black)] border border-[var(--color-gray)] rounded rounded-lg py-2 my-4 w-full"
                onclick="this.disabled=true; submitSearch();"
        >
            {{ __('kimono::admin.search') }}
        </button>
    </div>
</form>

<script>
    function submitSearch() {
        const searchBar = document.getElementById('search-bar');
        if(!searchBar) {
            return;
        }

        const baseUrl = location.origin + location.pathname;
        const currentParams = new URLSearchParams(window.location.search);

        Array.from(searchBar.elements).forEach(el => {
            if (el.name) {
                if (el.value !== '') {
                    currentParams.set(el.name, el.value); // 入力があれば上書き
                } else {
                    currentParams.delete(el.name);        // 空なら消す
                }
            }
        });

        // 遷移させる（パラメータつけて）
        location.href = `${baseUrl}?${currentParams.toString()}`;
    }
</script>

