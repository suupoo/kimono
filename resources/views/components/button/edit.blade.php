<x-button.color-blue {{ $attributes->merge(['class' => 'break-keep']) }}>
    <span class="inline">
        @includeIf('icons.edit', ['class' => 'w-3.5 h-3.5'])
    </span>
    <span class="hidden sm:inline">{{ __('resource.edit') }}</span>
</x-button.color-blue>

