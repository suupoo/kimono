@php
    $additionalClass = $attributes['class'] ?? '';
    $id = $attributes['id'] ?? '';
    $name = $attributes['name'] ?? '';
    $type = 'password';
    $value = $attributes['value'] ?? '';
    $min = $attributes['min'] ?? '';
    $max = $attributes['max'] ?? '';
    $maxLength = $attributes['maxLength'] ?? '';
    $minLength = $attributes['minLength'] ?? '';
    $required = $attributes['required'] ?? false;
    $placeholder = $attributes['placeholder'] ?? '';
    $disable = $attributes['disable'] ?? false;
    $checked = $attributes['checked'] ?? false;
    $w = ($type == 'checkbox') ? 'w-5' : 'w-full';
    $h = ($type == 'checkbox') ? 'h-5' : 'h-full';
    $fileAccept = $attributes['fileAccept'] ?? '';
    $defaultClass = " py-2 px-3 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 ";
@endphp

{{--<div class="relative">--}}
{{--    <input--}}
{{--        class="{{ $w }} {{ $h }} {{ $defaultClass }} {{ $additionalClass }}"--}}
{{--        id="{{ $id }}"--}}
{{--        name="{{ $name }}"--}}
{{--        type="{{ $type }}"--}}
{{--        value="{{ $value }}"--}}
{{--        @if($min) min="{{ $min }}" @endif--}}
{{--        @if($max) max="{{ $max }}" @endif--}}
{{--        @if($maxLength) maxlength="{{ $maxLength }}" @endif--}}
{{--        @if($minLength) minlength="{{ $minLength }}" @endif--}}
{{--        @if($required)  required="required" @endif--}}
{{--        @if($placeholder) placeholder="{{ $placeholder }}" @endif--}}
{{--        @if($disable) disabled="disabled" @endif--}}
{{--        @if($checked && $type=='checkbox') checked="checked" @endif--}}
{{--        @if($type === 'file' && $fileAccept) accept="{{ $fileAccept }}" @endif--}}
{{--    />--}}

{{--    <button type="button" data-hs-toggle-password='{--}}
{{--      "target": "#{{ $id }}"--}}
{{--    }' class="absolute inset-y-0 end-0 flex items-center pointer-events-none z-10 p-3.5">--}}
{{--        <svg class="shrink-0 text-gray-400 size-4" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">--}}
{{--            <path class="hs-password-active:hidden" d="M13.359 11.238C15.06 9.72 16 8 16 8s-3-5.5-8-5.5a7.028 7.028 0 0 0-2.79.588l.77.771A5.944 5.944 0 0 1 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.134 13.134 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755-.165.165-.337.328-.517.486l.708.709z"/>--}}
{{--            <path class="hs-password-active:hidden" d="M11.297 9.176a3.5 3.5 0 0 0-4.474-4.474l.823.823a2.5 2.5 0 0 1 2.829 2.829l.822.822zm-2.943 1.299.822.822a3.5 3.5 0 0 1-4.474-4.474l.823.823a2.5 2.5 0 0 0 2.829 2.829z"/>--}}
{{--            <path class="hs-password-active:hidden" d="M3.35 5.47c-.18.16-.353.322-.518.487A13.134 13.134 0 0 0 1.172 8l.195.288c.335.48.83 1.12 1.465 1.755C4.121 11.332 5.881 12.5 8 12.5c.716 0 1.39-.133 2.02-.36l.77.772A7.029 7.029 0 0 1 8 13.5C3 13.5 0 8 0 8s.939-1.721 2.641-3.238l.708.709zm10.296 8.884-12-12 .708-.708 12 12-.708.708z"/>--}}
{{--            <path class="hidden hs-password-active:block" d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>--}}
{{--            <path class="hidden hs-password-active:block" d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>--}}
{{--        </svg>--}}
{{--        <span class="hs-password-active:hidden">--}}
{{--            <svg class="shrink-0 text-gray-400 size-4" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">--}}
{{--                <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"></path>--}}
{{--                <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"></path>--}}
{{--            </svg>--}}
{{--        </span>--}}
{{--    </button>--}}
{{--</div>--}}



{{--<div class="w-full p-4 bg-white rounded-lg shadow-md dark:bg-neutral-800">--}}
{{--    <label for="hs-toggle-password" class="block text-sm mb-2 dark:text-white">Password</label>--}}
    <div class="relative">
        <input
            class="{{ $w }} {{ $h }} {{ $defaultClass }} {{ $additionalClass }}"
            id="{{ $id }}"
            name="{{ $name }}"
            type="{{ $type }}"
            value="{{ $value }}"
            @if($min) min="{{ $min }}" @endif
            @if($max) max="{{ $max }}" @endif
            @if($maxLength) maxlength="{{ $maxLength }}" @endif
            @if($minLength) minlength="{{ $minLength }}" @endif
            @if($required)  required="required" @endif
            @if($placeholder) placeholder="{{ $placeholder }}" @endif
            @if($disable) disabled="disabled" @endif
            @if($checked && $type=='checkbox') checked="checked" @endif
            @if($type === 'file' && $fileAccept) accept="{{ $fileAccept }}" @endif
        >
        <button type="button" data-hs-toggle-password='{
            "target": "#{{ $id }}"
        }' class="absolute inset-y-0 end-0 flex items-center z-20 px-3 cursor-pointer text-gray-400 rounded-e-md focus:outline-none focus:text-blue-600 dark:text-neutral-600 dark:focus:text-blue-500">
            <svg class="shrink-0 size-3.5" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path class="hs-password-active:hidden" d="M9.88 9.88a3 3 0 1 0 4.24 4.24"></path>
                <path class="hs-password-active:hidden" d="M10.73 5.08A10.43 10.43 0 0 1 12 5c7 0 10 7 10 7a13.16 13.16 0 0 1-1.67 2.68"></path>
                <path class="hs-password-active:hidden" d="M6.61 6.61A13.526 13.526 0 0 0 2 12s3 7 10 7a9.74 9.74 0 0 0 5.39-1.61"></path>
                <line class="hs-password-active:hidden" x1="2" x2="22" y1="2" y2="22"></line>
                <path class="hidden hs-password-active:block" d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"></path>
                <circle class="hidden hs-password-active:block" cx="12" cy="12" r="3"></circle>
            </svg>
        </button>
    </div>
{{--    <p class="hidden text-xs text-red-600 mt-2" id="password-error">8+ characters required</p>--}}
{{--</div>--}}
