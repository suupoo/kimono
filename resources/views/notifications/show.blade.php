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

                    @if($column instanceof \App\ValueObjects\Notification\Title)
                        @php
                            $titleColumn = $column->column();
                            $titleValue  = $model->$titleColumn;
                        @endphp
                        {!! $column->input(['disable' => true, 'class' => '', 'value' => $titleValue]) !!}
                    @endif

                    @if($column instanceof \App\ValueObjects\Notification\Type)
                        @php
                            $typeColumn = $column->column();
                            $typeValue  = $model->$typeColumn;
                        @endphp
                        {!! $column->input(['disable' => true, 'class' => '', 'value' => $typeValue]) !!}
                    @endif

                    @if($column instanceof \App\ValueObjects\Notification\Content)
                        @php
                            $contentColumn = $column->column();
                            $contentValue  = $model->$contentColumn;
                        @endphp
                        {!! $column->input(['disable' => true, 'class' => '', 'value' => $contentValue])!!}
                    @endif

                    @if($column instanceof \App\ValueObjects\Notification\Status)
                        @php
                            $statusColumn = $column->column();
                            $statusValue  = $model->$statusColumn;
                        @endphp
                        {!! $column->input(['disable' => true, 'class' => '', 'value' => $statusValue]) !!}
                    @endif

                    @if($column instanceof \App\ValueObjects\Notification\PublishAt)
                        @php
                            $publishAtColumn = $column->column();
                            $publishAtValue  = $model->$publishAtColumn;
                        @endphp
                        {!! $column->input(['disable' => true, 'class' => '', 'value' => $publishAtValue]) !!}
                    @endif

                </div>
            @endforeach
        </div>
    </div>
@endsection
