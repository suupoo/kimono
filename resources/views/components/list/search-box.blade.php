<div id="search-box"
     class="w-full bg-gray-700"
     data-accordion="collapse"
     data-active-classes="bg-gray-400 text-gray-600"
     data-inacvite-classes="bg-gray-700 text-gray-600"
>
    <h2 id="accordion-search-box" class="w-full">
        <button type="button"
                class="flex items-center justify-between w-full p-2 font-medium rtl:text-right text-gray-500 hover:bg-gray-400 gap-3"
                data-accordion-target="#accordion-search-box-body"
                aria-expanded="false"
                aria-controls="accordion-search-box-body"
        >
            <div class="flex justify-center items-center gap-1 text-white">
                @includeIf('icons.search', ['class' => 'w-[16px] h-[16px]'])
                検索
            </div>
            @includeIf('icons.accordion-arrow', ['class' => 'w-3 h-3 rotate-180 shrink-0 text-white'])
        </button>
    </h2>
    <div id="accordion-search-box-body" class="hidden" aria-labelledby="accordion-search-box">
        <div class="w-full bg-white border border-b-0 border-gray-200 ">
            <div class="list-search-box p-3 w-full h-full border bg-white">
                <h2 class="text-xl font-bold mb-2">{{ __('resource.search_condition') }}</h2>
                <div class="grid grid-cols-2 gap-2">
                    {{ $slot }}
                </div>

                <button
                    id="btn-search"
                    class="bg-blue-500 w-full text-white rounded-md mt-4 py-2"
                >
                    {{ __('resource.search') }}
                </button>
            </div>
        </div>
    </div>
</div>

<script type="module">
    $(function() {
        const url = new URL(window.location.href);
        const searchParams = url.searchParams;

        $('.list-search-box>#btn-search').on('click', function() {
            // ページネーションのクエリパラメータを引き継ぐ
            const url = new URL(window.location.href);
            const redirectUrl = new URL(url.origin + url.pathname);
            const searchParams = url.searchParams;

            const page = searchParams.get('page');
            if (page) {
                redirectUrl.searchParams.set('page', page);
            }
            const sort = searchParams.get('sort');
            if (sort) {
                redirectUrl.searchParams.set('sort', sort);
            }
            const order = searchParams.get('order');
            if (order) {
                redirectUrl.searchParams.set('order', order);
            }

            // URLパラメータを設定してリダイレクトさせる
            const params = new URLSearchParams();
            $('.list-search-box input,select').each(function() {
                const name = $(this).attr('name');
                const value = $(this).val();
                if (value) {
                    if($(this).is('select')){
                        // selectの場合
                        // 未選択00の場合は、パラメータをセットしない
                        if(value !== '00'){
                            redirectUrl.searchParams.set(name, value);
                        }
                    }else{
                        // 常に値をセットする
                        redirectUrl.searchParams.set(name, value);
                    }
                }
            });

            // リダイレクト
            location.href = redirectUrl;
        });
    });
</script>
