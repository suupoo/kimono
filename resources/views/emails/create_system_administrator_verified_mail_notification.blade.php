<x-mail::message>
# {{ __('Hello!') }} {{ $entity->name }} {{ __('Honorific-title') }}
{{ __('Please click the button below to verify your email address.') }}

<x-mail::button :url="$url">
    {{ __('confirm') }}
</x-mail::button>

{{ __('If you did not create an account, no further action is required.') }}
</x-mail::message>
