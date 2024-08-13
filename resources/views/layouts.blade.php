<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name') }}</title>
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <link rel="shortcut icon" href="{{ Vite::asset('resources/images/favicon.ico') }}">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-noto-jp antialiased bg-gray-50 text-black">
        <div class="min-h-screen">
            <x-menu.topMenu/>
            <x-menu.sideMenu/>
            <div class="p-4 sm:ml-64 min-h-screen">
                <div class="p-1 md:px-4 mt-14">
                    <div class="flex flex-col h-full mb-4 rounded">
                        @breadcrumbs
                        {{-- ぱんくずリストを使用する/しない(デフォルト:True） --}}
                        {{-- .env CUSTOM_BREADCRUMBS_USEで設定可能とする --}}
                        <div class="my-2">
                           {{ Breadcrumbs::render(\Illuminate\Support\Facades\Route::currentRouteName()) }}
                        </div>
                        @endbreadcrumbs

                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
        <div class="fixed right-0 z-50 w-full min-h-20 bottom-0 bg-gray-400 bg-opacity-20" data-ad="banner">
            <div class="relative">
                <button class="absolute right-0 ad-close">
                    @includeIf('icons.close', ['class' => 'w-6 h-6 p-1'])
                </button>
                <div class="flex flex-wrap justify-between">
                    <img src="" class="object-fill w-full md:w-1/2 h-[60px]" alt="広告バナー1">
                    <img src="" class="object-fill w-full md:w-1/2 h-[60px]" alt="広告バナー2">
                </div>
            </div>
        </div>
        @include('script')
    </body>
</html>
