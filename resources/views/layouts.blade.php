<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name') }}</title>

        <link rel="stylesheet" href="https://unpkg.com/modern-css-reset/dist/reset.min.css" />
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <script src="https://cdn.tailwindcss.com"></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css"  rel="stylesheet" />

        <script
            src="https://code.jquery.com/jquery-3.7.1.slim.min.js"
            integrity="sha256-kmHvs0B+OpCW5GVHUNjv9rOmY0IvSIRcf7zGUDTDQM8="
            crossorigin="anonymous"></script>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-gray-50 text-black">
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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
    </body>
</html>
