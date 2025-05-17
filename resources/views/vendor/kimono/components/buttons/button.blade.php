@php
  $type = $attributes->get('type', 'button');
  $name = $attributes->get('name');
  $attributes->merge(['class' => 'kimono__button']);
  $onclick = $attributes->get('onclick');
@endphp
<button
    type="{{ $type }}"
    class="{{ $attributes->get('class') }}"
    @if($name)name="{{ $name }}" @endif
    @if($onclick) onclick="{{ $onclick }}" @endif
>
    {{ $slot }}
</button>
