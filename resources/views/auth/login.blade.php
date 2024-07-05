@extends('layouts-no-auth')

@section('content')
    <form action="{{ route('login.auth') }}" method="post"
          class="flex flex-col justify-center items-center space-y-2 h-screen w-full px-4 py-2"
    >
        <div class="w-full max-w-xl">
            @csrf
            @if ($errors->any())
                <div class="error">
                    @foreach($errors->all() as $error)
                        <div class="text-red-500">{{ $error }}</div>
                    @endforeach
                </div>
            @endif
            <h1 class="text-xl text-center font-bold">
                {{ __('Login') }}
            </h1>
            <div class="flex flex-col w-full mb-2">
                @foreach($model::getColumns() as $column)
                    <div class="w-full my-1">

                        @if($column instanceof \App\ValueObjects\Administrator\Email)
                            {!! $column->input(['required' => true, 'required_hidden' => true, 'class' => ''])?->render() !!}
                        @endif

                        @if($column instanceof \App\ValueObjects\Administrator\Password)
                            {!! $column->input(['required' => true, 'required_hidden' => true, 'class' => ''])?->render() !!}
                        @endif

                    </div>
                @endforeach
            </div>
            <x-auth.login-submit/>
        </div>
    </form>
@endsection
