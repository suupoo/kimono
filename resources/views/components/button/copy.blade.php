<x-button.color-green {{ $attributes->merge(['class' => 'break-keep']) }}>
    <span class="inline">
        @includeIf('icons.copy', ['class' => 'w-3.5 h-3.5'])
    </span>
    <span class="hidden sm:inline">{{ __('resource.copy') }}</span>
</x-button.color-green>
