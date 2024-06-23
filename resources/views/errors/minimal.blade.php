@extends('layouts-no-auth')

@section('content')
    <div class="flex flex-col justify-center items-center space-y-2 h-screen w-full px-4 py-2">
        <div class="w-full max-w-xl text-center">
            <h1 class="text-3xl font-bold">
                {{ __('errors') }}
            </h1>
            <div class="flex flex-col w-full my-4 text-xl">
                @yield('code')：@yield('message')
            </div>
        </div>
    </div>
@endsection
