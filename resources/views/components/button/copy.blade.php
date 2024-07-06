<x-button.link {{ $attributes->merge(['class' => 'bg-custom-green text-white hover:bg-white hover:text-custom-green']) }}>
    <span class="inline sm:hidden">
        @includeIf('icons.copy', ['class' => 'w-4 h-4'])
    </span>
    <span class="hidden sm:inline">{{ __('resource.copy') }}</span>
</x-button.link>

