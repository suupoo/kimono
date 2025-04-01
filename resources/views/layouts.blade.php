<!DOCTYPE html>
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @if(config('app.crawler_indexing'))
        <meta name="robots" content="noindex, nofollow">
        @endif
        <meta name="description" content="利用用途に合わせてご自由にいただける登録型の管理システムです。顧客・在庫・店舗といった利用者様のニーズが高いを機能をご準備していますので運用に合わせ自由にお使いいただけます。" />
        <title>{{ config('app.name') }}</title>
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <link rel="shortcut icon" href="{{ Vite::asset('resources/images/favicon.ico') }}">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="layout" data-theme="{{ \Illuminate\Support\Facades\Cookie::get('color', 'default') }}">
        <main class="flex w-full">
            <div class="w-full h-[60px] md:h-[80px] fixed">
                <x-header.header />
            </div>
            <div class="flex w-full min-h-screen mt-[60px] md:mt-[80px]">
                <div id="side-menu-bar" class="hidden md:block border-gray-200 shadow-lg text-sm w-[250px] fixed left-0">
                    <x-menu.sideMenu />
                </div>
                <div class="content w-full h-full pt-[30px] md:pl-[calc(250px+15px)] md:pt-[20px] px-4">
                    @yield('content')
                </div>
            </div>
        </main>
        <script type="module" src="{{ asset('js/script.js') }}">
            @include('script')
        </script>
        <script type="module">
            $(document).ready(function () {
                $(document).on('click', '#toggle-side-menu-bar', function () {
                    $('#side-menu-bar').toggleClass('hidden');
                });
            });
        </script>

        @yield('page-script')
    </body>
</html>
