<x-button.color {{
    $attributes->merge([
      'type' => 'link',
      'class' => 'break-keep w-full text-left bg-transport text-custom-blue hover:bg-white border border-blue-600',
    ])
}}
>
    {{ $slot }}
</x-button.color>
