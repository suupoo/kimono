<x-accordian.simple>
    @slot('title')
    <div class="flex justify-center items-center gap-1">
        {{ __('resource.search') }}
        @includeIf('icons.search', ['class' => 'w-[16px] h-[16px]'])
    </div>
    @endslot

    @slot('content')
    <div class="list-search-box p-3 w-full h-full border bg-white">
        <h2 class="text-2xl text-center py-1 mb-2">{{ __('resource.search_condition') }}</h2>
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
    @endslot
</x-accordian.simple>

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
            const rows = searchParams.get('rows');
            if (rows) {
                redirectUrl.searchParams.set('rows', rows);
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
