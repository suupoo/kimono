<x-button.color {{ $attributes->merge(['type' => 'link', 'class' => 'bg-transport text-black hover:bg-custom-light-gray hover:text-black']) }}>
    <span class="inline">
        @includeIf('icons.lucide.download', ['class' => 'w-3.5 h-3.5'])
    </span>
    <span class="hidden sm:inline">
        {{ ($attributes['export-type'] ?? '') .__('resource.export') }}
    </span>
</x-button.color>
