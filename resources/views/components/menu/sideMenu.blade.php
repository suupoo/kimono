<div class="sidebar pt-2 pb-0 px-2 w-full h-fit min-h-screen flex flex-col flex-wrap space-y-4"
     data-hs-accordion-always-open>
    <div class="space-y-1">
        @foreach($menuList as $menuGroupName => $menuGroupItems)
        <div class="sidebar-menu">
            @php
                $isGroup = count($menuGroupItems) > 1;
                $isActiveGroup = $isGroup && collect($menuGroupItems)->contains('active', true)
            @endphp
            <div class="{{ $isGroup ? 'hs-accordion' : ''}}
                        {{ $isActiveGroup ? 'active' : ''}}"
                 @if($isGroup) id="hs-basic-collapse-{{$menuGroupName}}"@endif
            >
                @if($isGroup)
                <button
                    class="hs-accordion-toggle {{ $isActiveGroup ? 'text-[var(--color-primary)]': '' }} py-3 px-2 inline-flex items-center justify-between gap-x-3 w-full text-start rounded-lg disabled:opacity-50 disabled:pointer-events-none"
                    aria-expanded="{{ $isActiveGroup ? 'true' : 'false'}}"
                    aria-controls="hs-basic-collapse-{{$menuGroupName}}"
                >
                    {{ __('menu.sidebar.'.$menuGroupName) }}
                    <svg class="hs-accordion-active:hidden block size-4" xmlns="http://www.w3.org/2000/svg"
                         width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="m6 9 6 6 6-6"></path>
                    </svg>
                    <svg class="hs-accordion-active:block hidden size-4" xmlns="http://www.w3.org/2000/svg"
                         width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="m18 15-6-6-6 6"></path>
                    </svg>
                </button>
                @endif
                <div
                    id="{{ $isGroup ? "hs-basic-collapse-$menuGroupName" : ""}}"
                    @if($isGroup)
                    {{-- グループ化 --}}
                    class="hs-accordion-content {{ $isActiveGroup ? '' : 'hidden'}} w-full overflow-hidden transition-[height] duration-300"
                    role="region" aria-labelledby="hs-basic-collapse-{{$menuGroupName}}"
                    @else
                    {{-- シングルメニュー --}}
                    @endif
                >
                    @foreach($menuGroupItems as $menuName => $menuItem)
                        @php $isActive = \Illuminate\Support\Facades\Route::is($menuItem['group'])  @endphp
                        <div class="w-full">
                            <x-button.color type="link"
                                            class="sidebar-menu-item {{ Route::is($menuItem['group']) ? 'current' : '' }} {{($menuItem['active']) ? 'active' : ''}}"
                                            {{--                                                class="sidebar-menu-item {{($menuItem['active']) ? 'text-[var(--primary)]' : 'text-[var(--white)]'}}"--}}
                                            href="{{ $menuItem['link'] }}"
                            >
                                @if(array_key_exists('icon', $menuItem))
                                    @includeIf("icons.{$menuItem['icon']}", ['class' => 'w-4 h-4'])
                                @endif
                                <span class="flex-1 ms-3 whitespace-nowrap">
                                {{ $menuItem['text'] }}
                            </span>
                            </x-button.color>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
