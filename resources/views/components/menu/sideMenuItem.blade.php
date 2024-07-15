<li class="hover:bg-gray-400 @if($menuItem['active']) bg-gray-500 @endif">
    <a href="{{ $menuItem['link'] }}"
       class="flex items-center p-2 rounded-lg  group"
    >
        @if(array_key_exists('icon', $menuItem))
            @includeIf("icons.{$menuItem['icon']}", ['class' => 'w-6 h-6'])
        @endif
        <span class="flex-1 ms-3 whitespace-nowrap">
            {{ $menuItem['text'] }}
        </span>
    </a>
</li>
