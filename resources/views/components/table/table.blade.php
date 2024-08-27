<div class="flex flex-col">
    <div class="w-full">
        {{-- 表示件数 --}}
        {!! ( new \App\ValueObjects\Custom\PaginateRow())->input([
          'class' => '',
          'value' => request()->get('rows', config('custom.paginate.default'))
        ]) !!}
        {{-- 全選択ボタン --}}
        <x-button.action-link id="select-all" class="m-2">
            {{ __('All') }}
        </x-button.action-link>
    </div>
    <div class="-m-1.5 overflow-x-auto">
        <div class="p-1.5 min-w-full inline-block align-middle">
            <div class="overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700 text-xs table">
                    <input type="hidden" name="exports" value="">
                    <thead>
                        {{ $tHead }}
                    </thead>

                    <tbody class="divide-y divide-gray-200 dark:divide-neutral-700 table-body ">
                        {{ $tBody }}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="mx-auto my-4">
        {{ $pagination }}
    </div>
</div>

<script type="module">
    $(function() {
        const url = new URL(window.location.href);
        const searchParams = url.searchParams;

        $('select#rows').on('change', function() {
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
