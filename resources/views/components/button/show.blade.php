<x-button.color-gray {{ $attributes->merge(['class' => 'break-keep']) }}>
    <span class="inline">
        @includeIf('icons.3dot', ['class' => 'w-3.5 h-3.5'])
    </span>
    <span class="hidden sm:inline">{{ __('resource.show') }}</span>
</x-button.color-gray>
