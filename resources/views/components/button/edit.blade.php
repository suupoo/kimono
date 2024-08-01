<x-button.link {{ $attributes->merge(['class' => 'bg-custom-blue text-white hover:bg-white hover:text-custom-blue']) }}>
    <span class="inline sm:hidden">
        @includeIf('icons.edit', ['class' => 'w-4 h-4'])
    </span>
    <span class="hidden sm:inline">{{ __('resource.edit') }}</span>
</x-button.link>

