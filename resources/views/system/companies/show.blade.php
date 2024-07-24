@extends('layouts')

@section('content')
    <div class="flex flex-col py-2">
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
            @foreach($model::getColumns() as $column)
                <div class="w-full my-1">

                    @if($column instanceof \App\ValueObjects\Master\Company\Name)
                        @php
                            $nameColumn = $column->column();
                            $nameValue  = $model->$nameColumn;
                        @endphp
                        {!! $column->input(['required' => true, 'disable' => true, 'value' => $nameValue]) !!}
                    @endif

                    @if($column instanceof \App\ValueObjects\Master\Company\Uuid)
                        @php
                            $uuidColumn = $column->column();
                            $uuidValue  = $model->$uuidColumn;
                        @endphp
                        {!! $column->input(['required' => false, 'disable' => true, 'value' => $uuidValue]) !!}
                    @endif

                </div>
            @endforeach
        </div>
    </div>
@endsection
