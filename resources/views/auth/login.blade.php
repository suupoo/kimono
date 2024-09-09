@extends('layouts')

@section('content')
    <form action="{{ route('login.auth') }}" method="post"
          class="flex flex-col px-4 pt-20 space-y-1"
    >
        @csrf
        @if ($errors->any())
            <div class="error">
                @foreach($errors->all() as $error)
                    <div class="text-red-500">{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <h1 class="text-xl text-center font-bold mt-3">
            {{ __('Login') }}
        </h1>
        @foreach($model::getColumns() as $column)
            <div class="w-full my-1">

                @if($column instanceof \App\ValueObjects\Column\Master\Administrator\Email)
                    {!! $column->input(['required' => true, 'required_hidden' => true, 'class' => '!h-8'])!!}
                @endif

                @if($column instanceof \App\ValueObjects\Column\Master\Administrator\Password)
                    {!! $column->input(['required' => true, 'required_hidden' => true, 'class' => '!h-8']) !!}
                @endif

            </div>
        @endforeach
        <x-auth.login-submit/>
    </form>
@endsection
