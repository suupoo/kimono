@php
  $attributes = $attributes->merge([
    'class' => 'kimono__text-scroller
     p-4 bg-[var(--color-white)] border border-[var(--color-gray)] rounded-lg overflow-y-scroll text-xs md:text-sm max-h-[250px] md:max-h-[500px] mx-2 md:mx-4'
  ]);
@endphp
<div class="{{ $attributes->get('class') }}" >
    {!! $slot !!}
</div>
