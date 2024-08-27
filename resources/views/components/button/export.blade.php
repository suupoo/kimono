<x-button.link {{ $attributes->merge(['class' => 'bg-transport text-black hover:bg-custom-light-gray hover:text-black']) }}>
    {{ $slot }}
    <span class="inline sm:hidden">
        @includeIf('icons.lucide.download', ['class' => 'w-4 h-4'])
    </span>
    <span class="hidden sm:inline">{{ __('resource.export') }}</span>
</x-button.link>
