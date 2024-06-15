<div id="search-box"
     class="w-full"
     data-accordion="collapse"
     data-active-classes="bg-gray-100 dark:bg-gray-800 text-gray-600 dark:text-white"
>
    <h2 id="accordion-search-box" class="w-full">
        <button type="button"
                class="flex items-center justify-between w-full p-2 font-medium rtl:text-right text-gray-500 border border-gray-200 rounded-t-md bg-gray-600 hover:bg-gray-500 gap-3"
                data-accordion-target="#accordion-search-box-body"
                aria-expanded="false"
                aria-controls="accordion-search-box-body"
        >
            <div class="flex justify-center items-center gap-1 text-white">
                <svg class="w-[16px] h-[16px] text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                  <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="m21 21-3.5-3.5M17 10a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z"/>
                </svg>
                検索
            </div>
            <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5"/>
            </svg>
        </button>
    </h2>
    <div id="accordion-search-box-body" class="hidden" aria-labelledby="accordion-search-box">
        <div class="w-full bg-white border border-b-0 border-gray-200 dark:border-gray-700 dark:bg-gray-900">
            <div class="list-search-box p-3 w-full h-full border bg-gray-white">
                <h2 class="text-xl font-bold mb-2">検索条件</h2>
                <div class="grid grid-cols-2 gap-2">
                    {{ $slot }}
                </div>

                <button
                    id="btn-search"
                    class="bg-blue-500 w-full text-white rounded-md mt-4 py-2"
                >
                    検索
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    $(function() {
        const url = new URL(window.location.href);
        const searchParams = url.searchParams;
        // 検索条件が未指定の場合は、idソートにリダイレクトさせる
        if (!searchParams.get('sort') && !searchParams.get('order')) {
            url.searchParams.set('sort', 'id');
            url.searchParams.set('order', 'asc');
            location.href = url;
        }

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
