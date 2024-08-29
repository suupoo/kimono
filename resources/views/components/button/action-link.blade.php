<x-button.link {{ $attributes->merge(['class' => 'bg-transport text-black hover:bg-custom-light-gray hover:text-black']) }}>
    <span class="">
        {{ $slot }}
    </span>
</x-button.link>
