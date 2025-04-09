@extends('layouts-guest')

@section('content')
<div class="flex flex-col w-full flex justify-center items-center h-screen">
    <form action="{{ route('login.auth') }}" method="post"
          class="flex flex-col w-full  max-w-[1024px] h-full justify-center items-center px-4"
    >
        @csrf
        @if ($errors->any())
        <div class="error">
            @foreach($errors->all() as $error)
            <div class="text-red-500">{{ $error }}</div>
            @endforeach
        </div>
        @endif

        <div class="bg-[var(--color-white)] text-[var(--color-primary)] text-center w-full flex justify-center items-center grow max-h-[70px] text-4xl mx-2 my-10 px-3 py-6 border rounded-lg">
            {{ config('app.name') }}
        </div>

        <div class="flex flex-col mb-8 space-y-1 w-full justify-center items-center">
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
        </div>
        <x-auth.login-submit/>
    </form>
</div>
@endsection
