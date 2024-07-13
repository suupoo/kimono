@extends('layouts')

@section('content')
    <form action="{{ route('system.saveFunction') }}" method="post" class="flex flex-col py-2">
        @csrf
        @if ($errors->any())
            <div class="error">
                @foreach($errors->all() as $error)
                    <div class="text-red-500">{{ $error }}</div>
                @endforeach
            </div>
        @endif
        <h1 class="text-xl font-bold">
            {{ $model::NAME }}
        </h1>
        <div class="flex flex-col w-full">
            @php
                $key = new \App\ValueObjects\M_Function\Key;
                $name = new \App\ValueObjects\M_Function\Name;
                $enable = new \App\ValueObjects\M_Function\Enable;
            @endphp
            @foreach($items as $item)
                <div class="w-full my-1">

                    @php
                        $id = 'functions_' . $item->key;
                        $valueColumn = ($enable->column());
                        $value = $item->$valueColumn;
                        $labelColumn = $name->column();
                        $label = $item->$labelColumn;
                    @endphp
                    <input
                        type="checkbox"
                        id="{{ $id }}"
                        name="functions[{{ $item->key }}]"
                        @checked(old($id, request()->get($id, $value)))
                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500"
                    >
                    <label
                        for="{{ $id }}"
                        class="ms-2 text-sm font-medium text-gray-900"
                    >
                        {{ $label }}
                    </label>
                </div>
            @endforeach
        </div>
        <x-button.store />
    </form>
@endsection
