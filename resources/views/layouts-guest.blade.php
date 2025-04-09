<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @if(config('app.no_index'))
        <meta name="robots" content="noindex, nofollow">
        @endif
        <meta name="description" content="利用用途に合わせてご自由にいただける登録型の管理システムです。顧客・在庫・店舗といった利用者様のニーズが高いを機能をご準備していますので運用に合わせ自由にお使いいただけます。" />
        <title>{{ config('app.name') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <link rel="shortcut icon" href="{{ asset('/favicon.ico') }}">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="guest-layout" data-theme='default'>
    <main class="flex w-full">
        <div class="content w-full">
            @yield('content')
        </div>
    </main>
    </body>
</html>
