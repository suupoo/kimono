@extends('layouts')

@section('content')
    @php
        $routePrefix = $prefix ?? $model->getTable()
    @endphp

    <div class="w-20">
        <x-button.back href="{{ route($routePrefix.'.index') }}" />
    </div>

    <form action="{{ route($routePrefix.'.store') }}" method="post" enctype="multipart/form-data"
          class="flex flex-col py-2">
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

                    @if($column instanceof \App\ValueObjects\Column\Master\Holiday\Name)
                        @php
                            $nameColumn = $column->column();
                            $nameValue  = $model->$nameColumn;
                        @endphp
                        {!! $column->input(['required' => true, 'value' => $nameValue]) !!}
                    @endif

                    @if($column instanceof \App\ValueObjects\Column\Master\Holiday\Locale)
                        @php
                            $localeColumn = $column->column();
                            $localeValue  = $model->$localeColumn;
                        @endphp
                        {!! $column->input(['required' => true, 'value' => $localeValue]) !!}
                    @endif

                    @if($column instanceof \App\ValueObjects\Column\Master\Holiday\Date)
                        @php
                            $dateColumn = $column->column();
                            $dateValue  = $model->$dateColumn;
                        @endphp
                        {!! $column->input(['required' => true, 'value' => $dateValue]) !!}
                    @endif

                </div>
            @endforeach
        </div>
        <x-button.store/>
    </form>
@endsection
