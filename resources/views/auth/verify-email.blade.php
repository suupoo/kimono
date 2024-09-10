@extends('layouts')

@section('content')
<div class="flex flex-col justify-center items-center space-y-2 h-[80vh] w-full px-4 py-2">
    <div class="w-full max-w-xl text-center">
        <h1 class="text-3xl font-bold">
            {{ __('Email is Verified.') }}
        </h1>
        <div class="flex flex-col w-full my-4 text-xl">
            <x-button.color-blue type="link" href="{{ route('login') }}">
                {{ __('Login') }}
            </x-button.color-blue>
        </div>
    </div>
</div>
@endsection
