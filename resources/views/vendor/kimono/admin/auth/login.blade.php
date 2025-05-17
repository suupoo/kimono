@extends('kimono::layout')

@section('contents')
<form action="{{ route('kimono.admin.login') }}" method="post" class="w-full min-h-screen flex flex-col justify-center items-center">
    @csrf


    <div class="my-2 w-full text-center">
        <label for="email" class="inline-block w-[250px] text-left md:text-right">{{ __('kimono::admin.email') }}</label>
        <input type="email" id="email" name="email" class="w-full md:w-1/2 max-w-[250px]" />
    </div>

    <div class="my-2 w-full text-center">
        <label for="password" class="inline-block w-[250px] text-left md:text-right">{{ __('kimono::admin.password') }}</label>
        <input type="password" id="password" name="password" class="w-full md:w-1/2 max-w-[250px]" />
    </div>

    <div class="my-2 w-full text-center">
        <button type="submit" class="bg-white text-black w-[100px] p-2 border border-gray-200 rounded-full">
            {{ __('kimono::admin.login') }}
        </button>
    </div>
    <div>
        <span class="text-red-500">
            @if ($errors->any())
                {{ $errors->first() }}
            @endif
        </span>
    </div>
</form>

@endsection
