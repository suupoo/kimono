<x-button.link {{ $attributes->merge(['class' => 'bg-custom-gray text-white hover:bg-white hover:text-custom-gray']) }}>
    <span class="inline sm:hidden">
        @includeIf('icons.3dot', ['class' => 'w-4 h-4'])
    </span>
    <span class="hidden sm:inline">{{ __('resource.show') }}</span>
</x-button.link>


