@php
    $id = $attributes->get('data-id', null);
@endphp

<x-button.color-red
    {{ $attributes->merge([
        'aria-haspopup' => 'dialog',
        'aria-controls' => 'delete-popup-modal-' . $id,
        'data-hs-overlay' => '#delete-popup-modal-' . $id,
    ]) }}>
    <span class="inline">
        @includeIf('icons.trash-bin', ['class' => 'w-3.5 h-3.5'])
    </span>
    <span class="hidden sm:inline">
        {{ __('resource.delete') }}
    </span>
</x-button.color-red>

{{-- 削除用ポップアップ--}}
@include('components.modal.delete', ['id' => $id, 'href' => $attributes['href']])
