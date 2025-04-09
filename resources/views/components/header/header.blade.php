<nav class="header h-full w-full mx-auto px-8 sm:flex sm:items-center sm:justify-between shadow-sm">
    <div class="header-menu justify-between items-center h-full flex ">
        <div class="w-full">
            <a class="logo text-xl font-bold" href="{{ route('home') }}" aria-label="logo">
                {{ config('app.name') }}
            </a>
        </div>
        @auth
        <div class="md:hidden mx-2">
            <button id="toggle-side-menu-bar" type="button" class="whitespace-nowrap h-full p-2 text-xs flex justify-center items-center rounded-lg border border-gray-200 bg-white text-black shadow-xl">
                {{ __('Menu') }}
            </button>
        </div>
        <div class="sm:hidden">
            <button type="button" class="hs-collapse-toggle relative size-9 flex justify-center items-center gap-x-2 rounded-lg border border-gray-200 bg-white text-gray-800 hover:bg-gray-50 focus:outline-hidden focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-transparent dark:border-neutral-700 dark:text-white dark:hover:bg-white/10 dark:focus:bg-white/10 shadow-xl" id="hs-navbar-example-collapse" aria-expanded="false" aria-controls="hs-navbar-example" aria-label="Toggle navigation" data-hs-collapse="#hs-navbar-example">
                <svg class="hs-collapse-open:hidden shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="3" x2="21" y1="6" y2="6"/><line x1="3" x2="21" y1="12" y2="12"/><line x1="3" x2="21" y1="18" y2="18"/></svg>
                <svg class="hs-collapse-open:block hidden shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
                <span class="sr-only">Toggle navigation</span>
            </button>
        </div>
        @endauth

    </div>
    @auth
    <div id="hs-navbar-example" class="header-menu-mobile hidden md:m-0 md:w-full w-[100vw] ml-[-2rem] hs-collapse overflow-hidden transition-all duration-300 basis-full grow sm:block" aria-labelledby="hs-navbar-example-collapse">
        <div class="flex flex-col md:flex-row md:bg-transparent mt-0 items-center justify-end md:ps-5">
            <div class="flex justify-start items-center w-full px-2 mb-4">
                <div class="flex items-center space-x-1 grow w-full my-3 md:my-0">
                    <div class="bg-white flex w-full md:max-w-[300px] items-center justify-center space-x-1 px-2 rounded-full shadow-md">
                        @includeIf('icons.search', ['class' => 'mx-1 w-4 h-4'])
                        @include('components.form.input', [
                          'attributes' => ['type' => 'string', 'name' => 'search', 'placeholder' => __('Input search keywords'), 'class' => 'w-full my-1 max-w-full md:max-w-[300px] rounded-full border-0 focus:border-0 focus:ring-0 focus:outline-none rounded-full']
                        ])
                    </div>
                </div>
            </div>
            <div class="flex justify-end items-center w-full md:w-auto gap-4">

                <button class="button-notification hidden md:inline-block">
                    @includeIf('icons.lucide.notification', ['class' => 'w-3.5 h-3.5'])
                </button>

                <div class="hs-dropdown w-full [--strategy:static] sm:[--strategy:fixed] [--adaptive:none] ">
                    <button id="hs-header-base-dropdown" type="button" class="hidden sm:block hs-dropdown-toggle w-full flex items-center text-sm rounded-lg " aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
                    <span class="flex items-center justify-center w-9 h-9 border border-gray-300 rounded-full">
                        @auth
                            {{--                                @if(auth()->user()?->image_url)--}}
                            {{--                                    <img src="{{ auth()->user()->image_url }}" class="w-6 h-6 rounded-full" alt="icon">--}}
                            {{--                                @else--}}
                            {{ mb_substr(auth()->user()->name, 0, 1)}}
                            {{--                                @endif--}}
                        @endauth
                        @guest
                            {{ __('Account') }}
                        @endguest
                    </span>
                    </button>

                    <div class="sm:hidden flex flex-wrap items-center justify-between space-y-3 w-full mb-4">
                        <a href="{{ route('mypage.index') }}" class="w-full py-1 px-3 bg-[var(--color-primary)] text-[var(--color-white)]">
                            <div class="flex flex-col text-sm justify-center rounded-full py-1 space-y-1 items-center shadow-md">
                                @includeIf('icons.lucide.home', ['class' => 'w-6 h-6'])
                                <span>{{ __('menu.mypage.*') }}</span>
                            </div>
                        </a>

                        <a href="{{ route('me.list') }}" class="w-1/2 py-1 px-3 bg-[var(--color-primary)] text-[var(--color-white)]">
                            <div class="flex flex-col text-sm justify-center rounded-full py-1 space-y-1 items-center shadow-md">
                                @includeIf('icons.lucide.cog', ['class' => 'w-6 h-6'])
                                <span>{{ __('menu.me.*') }}</span>
                            </div>
                        </a>

                        <a href="{{ route('me.company.index') }}" class="w-1/2 py-1 px-3 bg-[var(--color-primary)] text-[var(--color-white)]">
                            <div class="flex flex-col text-sm justify-center rounded-full py-1 space-y-1 items-center shadow-md">
                                @includeIf('icons.lucide.company', ['class' => 'w-6 h-6'])
                                <span>{{ __('menu.me.company') }}</span>
                            </div>
                        </a>

                        <a href="{{ route('logout') }}" class="w-full py-1 px-3 bg-[var(--color-primary)] text-[var(--color-white)]">
                            <div class="flex flex-col text-sm justify-center rounded-full py-1 space-y-1 items-center shadow-md">
                                @includeIf('icons.lucide.logout', ['class' => 'w-6 h-6'])
                                <span>{{ __('Logout') }}</span>
                            </div>
                        </a>
                    </div>

                    <div class="hs-dropdown-menu transition-[opacity,margin] duration-[0.1ms] md:duration-[150ms] hs-dropdown-open:opacity-100 opacity-0 relative w-full md:w-52 hidden z-10 top-full ps-7 md:ps-0 md:bg-white md:rounded-lg md:shadow-md before:absolute before:-top-4 before:start-0 before:w-full before:h-5 md:after:hidden after:absolute after:top-1 after:start-[18px] after:w-0.5 after:h-[calc(100%-0.25rem)] after:bg-gray-100 dark:md:bg-neutral-800 dark:after:bg-neutral-700" role="menu" aria-orientation="vertical" aria-labelledby="hs-header-base-dropdown">
                        <div class="py-1 md:px-1 space-y-0.5">

                            <x-header.header-item href="{{ route('mypage.index') }}">
                                {{ __('menu.mypage.*') }}
                            </x-header.header-item>

                            <x-header.header-item href="{{ route('me.list') }}">
                                {{ __('menu.me.*') }}
                            </x-header.header-item>

                            <x-header.header-item href="{{ route('me.company.index') }}">
                                {{ __('menu.me.company') }}
                            </x-header.header-item>

                            <x-header.header-item href="{{ route('logout') }}">
                                {{ __('Logout') }}
                            </x-header.header-item>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endauth
</nav>

{{--<nav class="relative max-w-[85rem] w-full mx-auto flex items-center justify-between gap-3 py-2 px-4 sm:px-6 lg:px-8">--}}

{{--    <a class="flex-none font-semibold text-xl text-black focus:outline-none focus:opacity-80 dark:text-white" href="{{ route('home') }}" aria-label="Brand">--}}
{{--        <img src="{{ Vite::asset('resources/images/logo.png') }}" class="h-6 md:h-8 me-3" alt="Logo">--}}
{{--    </a>--}}
{{--    <div class="md:order-3 flex justify-end items-center gap-x-1">--}}
{{--        @auth--}}
{{--            <!-- Collapse Button -->--}}
{{--            <button type="button" class="hs-collapse-toggle md:hidden relative p-2 flex items-center font-medium text-[12px] rounded-lg border border-gray-200 text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:text-white dark:border-neutral-700 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700" id="hs-header-base-collapse" aria-haspopup="dialog" aria-expanded="false" aria-controls="hs-header-base" aria-label="Toggle navigation" data-hs-overlay="#hs-header-base"  >--}}
{{--                {{ __('Menu') }}--}}
{{--                <svg class="shrink-0 size-4 ms-1" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="1"/><circle cx="12" cy="5" r="1"/><circle cx="12" cy="19" r="1"/></svg>--}}
{{--            </button>--}}
{{--            <!-- End Collapse Button -->--}}

{{--            <div class="hidden md:inline-block md:me-2">--}}
{{--                <div class="w-px h-4 bg-gray-300 dark:bg-neutral-700"></div>--}}
{{--            </div>--}}

{{--            <!-- Offcanvas Toggle -->--}}
{{--            <button type="button" class="relative size-9 flex justify-center items-center text-sm font-semibold rounded-lg border border-transparent text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:text-white dark:border-transparent dark:hover:bg-neutral-700 dark:focus:bg-neutral-700" aria-haspopup="dialog" aria-expanded="false" aria-controls="hs-header-base-offcanvas" aria-label="Toggle navigation" data-hs-overlay="#hs-header-base-offcanvas">--}}
{{--                @include('icons.lucide.menu')--}}
{{--                <span class="sr-only">Toggle navigation</span>--}}
{{--            </button>--}}
{{--            <!-- End Offcanvas Toggle -->--}}

{{--            --}}{{-- side-nav --}}
{{--            <x-menu.sideMenu />--}}
{{--        @elseauth--}}
{{--            <x-header.header-item href="{{ route('logout') }}">--}}
{{--                {{ __('Logout') }}--}}
{{--            </x-header.header-item>--}}
{{--        @endauth--}}
{{--    </div>--}}

{{--    @auth--}}
{{--    <!-- Collapse -->--}}
{{--    <div id="hs-header-base" class="hs-overlay hs-overlay-open:translate-x-0 -translate-x-full fixed top-0 start-0 transition-all duration-300 transform h-full max-w-xs w-full z-[60] bg-white border-e basis-full grow md:order-2 md:static md:block md:h-auto md:max-w-none md:w-auto md:border-e-transparent md:transition-none md:translate-x-0 md:z-40 md:basis-auto dark:bg-neutral-800 dark:border-e-gray-700 md:dark:border-e-transparent hidden " role="dialog" tabindex="-1" aria-label="Sidebar" data-hs-overlay-close-on-resize  >--}}
{{--        <div class="overflow-hidden overflow-y-auto max-h-[75vh] [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-gray-300 dark:[&::-webkit-scrollbar-track]:bg-neutral-700 dark:[&::-webkit-scrollbar-thumb]:bg-neutral-500">--}}
{{--            <div class="py-2 md:py-0 px-2 md:px-0 flex flex-col md:flex-row md:items-center gap-0.5 md:gap-1">--}}
{{--                <!-- Offcanvas Header -->--}}
{{--                <div class="md:hidden p-2 flex justify-between items-center">--}}
{{--                    <h3 id="hs-header-base-label" class="font-bold text-gray-800 dark:text-white">--}}
{{--                        {{ __('Menu') }}--}}
{{--                    </h3>--}}
{{--                    <button type="button" class="size-8 inline-flex justify-center items-center gap-x-2 rounded-full border border-transparent bg-gray-100 text-gray-800 hover:bg-gray-200 focus:outline-none focus:bg-gray-200 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-700 dark:hover:bg-neutral-600 dark:text-neutral-400 dark:focus:bg-neutral-600" aria-label="Close" data-hs-overlay="#hs-header-base">--}}
{{--                        <span class="sr-only">Close</span>--}}
{{--                        <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>--}}
{{--                    </button>--}}
{{--                </div>--}}
{{--                <!-- End Offcanvas Header -->--}}
{{--                <div class="grow">--}}
{{--                    <div class="flex flex-col md:flex-row md:justify-end md:items-center gap-0.5 md:gap-1">--}}

{{--                        --}}{{-- ログイン --}}
{{--                        <div class="hs-dropdown [--strategy:static] md:[--strategy:fixed] [--adaptive:none] [--is-collapse:true] md:[--is-collapse:false] ">--}}
{{--                            <button id="hs-header-base-dropdown" type="button" class="hs-dropdown-toggle w-full p-2 flex items-center text-sm text-gray-800 hover:bg-gray-100 rounded-lg focus:outline-none focus:bg-gray-100 dark:text-neutral-200 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700" aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">--}}
{{--                                <svg class="shrink-0 size-4 me-3 md:me-2 block md:hidden" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m3 10 2.5-2.5L3 5"/><path d="m3 19 2.5-2.5L3 14"/><path d="M10 6h11"/><path d="M10 12h11"/><path d="M10 18h11"/></svg>--}}
{{--                                <span class="ml-2">{{ __('Account') }}</span>--}}
{{--                                <svg class="hs-dropdown-open:-rotate-180 md:hs-dropdown-open:rotate-0 duration-300 shrink-0 size-4 ms-auto md:ms-1" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>--}}
{{--                            </button>--}}

{{--                            <div class="hs-dropdown-menu transition-[opacity,margin] duration-[0.1ms] md:duration-[150ms] hs-dropdown-open:opacity-100 opacity-0 relative w-full md:w-52 hidden z-10 top-full ps-7 md:ps-0 md:bg-white md:rounded-lg md:shadow-md before:absolute before:-top-4 before:start-0 before:w-full before:h-5 md:after:hidden after:absolute after:top-1 after:start-[18px] after:w-0.5 after:h-[calc(100%-0.25rem)] after:bg-gray-100 dark:md:bg-neutral-800 dark:after:bg-neutral-700" role="menu" aria-orientation="vertical" aria-labelledby="hs-header-base-dropdown">--}}
{{--                                <div class="py-1 md:px-1 space-y-0.5">--}}

{{--                                    <x-header.header-item href="{{ route('mypage.index') }}">--}}
{{--                                        {{ __('menu.mypage.*') }}--}}
{{--                                    </x-header.header-item>--}}

{{--                                    <x-header.header-item href="{{ route('me.list') }}">--}}
{{--                                        {{ __('menu.me.*') }}--}}
{{--                                    </x-header.header-item>--}}

{{--                                    <x-header.header-item href="{{ route('me.company.index') }}">--}}
{{--                                        {{ __('menu.me.company') }}--}}
{{--                                    </x-header.header-item>--}}

{{--                                    <x-header.header-item href="{{ route('logout') }}">--}}
{{--                                        {{ __('Logout') }}--}}
{{--                                    </x-header.header-item>--}}

{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    @endauth--}}
{{--    <!-- End Collapse -->--}}
{{--</nav>--}}
