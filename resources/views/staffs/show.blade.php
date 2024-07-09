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

                    @if($column instanceof \App\ValueObjects\Staff\Name)
                        @php
                            $staffNameColumn = $column->column();
                            $staffNameValue  = $model->$staffNameColumn;
                        @endphp
                        {!! $column->input(['required' => true, 'disable' => true, 'class' => '', 'value' => $staffNameValue])?->render() !!}
                    @endif

                    @if($column instanceof \App\ValueObjects\Staff\Code)
                        @php
                            $codeColumn = $column->column();
                            $codeValue  = $model->$codeColumn;
                        @endphp
                        {!! $column->input(['required' => false, 'disable' => true, 'class' => '', 'value' => $codeValue])?->render() !!}
                    @endif

                    @if($column instanceof \App\ValueObjects\Staff\Tel)
                        @php
                            $telColumn = $column->column();
                            $telValue  = $model->$telColumn;
                        @endphp
                        {!! $column->input(['required' => false, 'disable' => true, 'class' => '', 'value' => $telValue])?->render() !!}
                    @endif

                    @if($column instanceof \App\ValueObjects\Staff\StaffPosition)
                        @php
                            $positionColumn = $column->column();
                            $positionValue  = $model->$positionColumn;
                        @endphp
                        {!! $column->input(['required' => false, 'disable' => true, 'class' => '', 'value' => $positionValue?->value])?->render() !!}
                    @endif

                    @if($column instanceof \App\ValueObjects\Staff\JoinDate)
                        @php
                            $joinDateColumn = $column->column();
                            $joinDateValue  = $model->$joinDateColumn;
                        @endphp
                        {!! $column->input(['required' => false, 'disable' => true, 'class' => '', 'value' => $joinDateValue])?->render() !!}
                    @endif

                    @if($column instanceof \App\ValueObjects\Staff\QuitDate)
                        @php
                            $quitDateColumn = $column->column();
                            $quitDateValue  = $model->$quitDateColumn;
                        @endphp
                        {!! $column->input(['required' => false, 'disable' => true, 'class' => '', 'value' => $quitDateValue])?->render() !!}
                    @endif

                </div>
            @endforeach
        </div>
    </div>
@endsection
