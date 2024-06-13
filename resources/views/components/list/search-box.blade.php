<div class="list-search-box bg-gray-200 p-2">
    <div class="grid grid-cols-2">
        {{ $slot }}
    </div>
    <button
        id="btn-search"
        class="bg-blue-500 w-full text-white rounded-md my-2"
    >
        検索
    </button>
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
