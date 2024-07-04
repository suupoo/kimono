<aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-gray-800 border-r border-gray-200 sm:translate-x-0" aria-label="Sidebar">
    <div class="h-full px-3 pb-4 overflow-y-auto bg-gray-800">
        <ul class="space-y-2 font-medium">
            @foreach($menuList as $menuItem)
                <li class="hover:bg-gray-400 @if($menuItem['active']) bg-gray-500 @endif">
                    <a href="{{ $menuItem['link'] }}"
                       class="flex items-center p-2 text-white rounded-lg  group"
                    >
                        @if(array_key_exists('icon', $menuItem))
                            @includeIf("components.menu.icons.{$menuItem['icon']}")
                        @endif
                        <span class="flex-1 ms-3 whitespace-nowrap">
                            {{ $menuItem['text'] }}
                        </span>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</aside>
