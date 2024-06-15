<aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-gray-800 border-r border-gray-200 sm:translate-x-0" aria-label="Sidebar">
    <div class="h-full px-3 pb-4 overflow-y-auto bg-gray-800">
        <ul class="space-y-2 font-medium">
            @foreach($menuList as $menuItem)
            <li>
                {{--  通常メニュー --}}
                <a href="{{ $menuItem[ \App\View\Components\Menu\SideMenu::LINK ] }}"
                   class="flex items-center p-2 text-white rounded-lg  group"
                >
                    @if(array_key_exists(\App\View\Components\Menu\SideMenu::ICON, $menuItem))
                        @if($menuItem[\App\View\Components\Menu\SideMenu::ICON] === 'list')
                            @include('components.menu.icons.list')
                        @endif
                    @endif
                    <span class="flex-1 ms-3 whitespace-nowrap">
                        {{ $menuItem[\App\View\Components\Menu\SideMenu::TEXT] }}
                    </span>
                </a>
            </li>
            @endforeach
        </ul>
    </div>
</aside>
