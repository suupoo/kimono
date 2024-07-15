<aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-gray-800 border-r border-gray-200 sm:translate-x-0" aria-label="Sidebar">
    <div class="h-full px-3 pb-4 overflow-y-auto bg-gray-800">
        <ul class="space-y-2 font-medium text-white">
            @foreach($menuList as $menuItem)
                @if(array_key_exists('items', $menuItem))
                @php $open = array_key_exists('active', $menuItem) && $menuItem['active'] == true @endphp
                <li class="">
                    <button type="button"
                            class="flex items-center w-full p-2 group hover:bg-gray-400 @if($menuItem['active']) bg-gray-500 @endif"
                            aria-controls="dropdown-{{ $menuItem['group'] }}"
                            data-collapse-toggle="dropdown-{{ $menuItem['group'] }}"
                            aria-expanded="{{ ($open) ? 'true' : 'false' }}"
                    >
                        @includeIf("icons.{$menuItem['icon']}", ['class' => 'w-6 h-6'])
                        <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">{{ $menuItem['text'] }}</span>
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                        </svg>
                    </button>
                    <ul id="dropdown-{{ $menuItem['group'] }}" class="{{ ($open) ? '' : 'hidden' }} py-2 space-y-2">
                        @foreach($menuItem['items'] as $subMenuItem)
                            @include('components.menu.sideMenuItem', ['menuItem' => $subMenuItem])
                        @endforeach
                    </ul>
                </li>
                @else
                    @include('components.menu.sideMenuItem', ['menuItem' => $menuItem])
                @endif
            @endforeach
        </ul>
    </div>
</aside>
