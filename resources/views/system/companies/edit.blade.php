@extends('layouts')

@section('content')
    @php
        $id = $model->id;
        $routePrefix = $prefix ?? $model->getTable();
    @endphp

    <div class="w-20">
        <x-button.back href="{{ route($routePrefix.'.index') }}" />
    </div>

    <form action="{{ route($routePrefix.'.update', ['id' => $id]) }}" method="post" class="flex flex-col py-2">
        @csrf
        <input type="hidden" id="id" name="id" value="{{ $id }}"/>
        @method('PUT')
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
            @foreach($model::getColumns() as $column)
                <div class="w-full my-1">

                    @if($column instanceof \App\ValueObjects\Column\Master\Company\Name)
                        @php
                            $nameColumn = $column->column();
                            $nameValue  = $model->$nameColumn;
                        @endphp
                        {!! $column->input(['required' => true, 'value' => $nameValue]) !!}
                    @endif

                </div>
            @endforeach
        </div>
        <x-button.update/>
    </form>
@endsection
