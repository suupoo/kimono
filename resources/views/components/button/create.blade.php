<x-button.color-green {{ $attributes->merge(['class' => 'break-keep']) }}>
    <span class="inline">
        @includeIf('icons.plus', ['class' => 'w-3.5 h-3.5'])
    </span>
    <span class="hidden sm:inline">{{ __('resource.create') }}</span>
</x-button.color-green>
