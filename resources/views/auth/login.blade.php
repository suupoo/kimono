@extends('layouts-no-auth')

@section('content')
    <form action="{{ route('login.auth') }}" method="post"
          class="flex flex-col justify-center items-center space-y-2 h-screen w-full px-4 py-2"
    >
        <div class="w-full max-w-xl flex flex-col justify-center items-center">
            @csrf
            @if ($errors->any())
                <div class="error">
                    @foreach($errors->all() as $error)
                        <div class="text-red-500">{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <img src="{{ Vite::asset('resources/images/logo.svg') }}" class="h-24 bg-red-200 my-2">

            <h1 class="text-xl text-center font-bold mt-3">
                {{ __('Login') }}
            </h1>
            <div class="flex flex-col w-full gap-2">
                @foreach($model::getColumns() as $column)
                    <div class="w-full my-1">

                        @if($column instanceof \App\ValueObjects\Administrator\Email)
                            {!! $column->input(['required' => true, 'required_hidden' => true, 'class' => ''])!!}
                        @endif

                        @if($column instanceof \App\ValueObjects\Administrator\Password)
                            {!! $column->input(['required' => true, 'required_hidden' => true, 'class' => '']) !!}
                        @endif

                    </div>
                @endforeach
            </div>
            <x-auth.login-submit/>
        </div>
    </form>
@endsection
