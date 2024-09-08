@php
    $id = $attributes->get('data-id', null);
@endphp

<x-button.button
    {{ $attributes->merge([
        'class' => 'bg-custom-red text-white hover:bg-white hover:text-custom-red',
        'aria-haspopup' => 'dialog',
        'aria-controls' => 'delete-popup-modal-' . $id,
        'data-hs-overlay' => '#delete-popup-modal-' . $id,
    ]) }}>
    <span class="inline sm:hidden">
        @includeIf('icons.trash-bin', ['class' => 'w-4 h-4'])
    </span>
    <span class="hidden sm:inline">
        {{ __('resource.delete') }}
    </span>
</x-button.button>

{{-- 削除用ポップアップ--}}
@include('components.modal.delete', ['id' => $id, 'href' => $attributes['href']])
