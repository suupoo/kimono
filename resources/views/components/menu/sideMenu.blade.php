<div id="hs-header-base-offcanvas" class="hs-overlay hs-overlay-open:translate-x-0 hidden -translate-x-full fixed top-0 start-0 transition-all duration-300 transform h-full max-w-xs w-full z-[80] bg-white border-e dark:bg-neutral-800 dark:border-neutral-700" role="dialog" tabindex="-1" aria-labelledby="hs-header-base-offcanvas-label">
    <div class="flex justify-between items-center py-3 px-4 border-b dark:border-neutral-700">
        <h3 id="hs-header-base-offcanvas-label" class="font-bold text-gray-800 dark:text-white">
            {{ __('Features') }}
        </h3>
        <button type="button" class="size-8 inline-flex justify-center items-center gap-x-2 rounded-full border border-transparent bg-gray-100 text-gray-800 hover:bg-gray-200 focus:outline-none focus:bg-gray-200 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-700 dark:hover:bg-neutral-600 dark:text-neutral-400 dark:focus:bg-neutral-600" aria-label="Close" data-hs-overlay="#hs-header-base-offcanvas">
            <span class="sr-only">Close</span>
            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
        </button>
    </div>
    <div class="p-4">
        <p class="text-gray-800 dark:text-neutral-400">
            <x-button-group.up-down>
                @foreach($menuList as $menuItem)
                    @php $active = array_key_exists('active', $menuItem) && $menuItem['active'] == true @endphp
                    <div class="flex space-x-1 items-center">
                        <div class="w-4 text-custom-red">
                        @if($active)
                            @includeIf('icons.lucide.circle-dot', ['class' => 'w-4 h-4'])
                        @endif
                        </div>
                        <x-button.color type="link" class="bg-transparent text-black dark:text-white" href="{{ $menuItem['link'] }}">
                            @if(array_key_exists('icon', $menuItem))
                                @includeIf("icons.{$menuItem['icon']}", ['class' => 'w-6 h-6'])
                            @endif
                            <span class="flex-1 ms-3 whitespace-nowrap">
                                {{ $menuItem['text'] }}
                            </span>
                        </x-button.color>
                    </div>
                @endforeach
            </x-button-group.up-down>
        </p>
    </div>
</div>
