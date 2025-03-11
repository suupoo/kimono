@extends('layouts')

@section('content')

    <div class="w-20">
        <x-button.back href="{{ route($model->getTable().'.index') }}" />
    </div>

    <h1 class="custom-headline">
        {{ $model::NAME }}
    </h1>

    @php
        $id = $model->id;
    @endphp
    <form action="{{ route($model->getTable().'.update', ['id' => $id]) }}" method="post" enctype="multipart/form-data"
          class="flex flex-col py-2">
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
        <div class="flex flex-col w-full">
            @foreach($model::getColumns() as $column)
                <div class="w-full my-1">

                    @if($column instanceof \App\ValueObjects\Column\Attendance\StaffId)
                        @php
                            $staffIdColumn = $column->column();
                            $staffIdValue  = $model->$staffIdColumn;
                        @endphp
                        {!! $column->input(['required' => true, 'value' => $staffIdValue]) !!}
                    @endif

                    @if($column instanceof \App\ValueObjects\Column\Attendance\StartDate)
                        @php
                            $startDateColumn = $column->column();
                            $startDateValue  = $model->$startDateColumn;
                        @endphp
                        {!! $column->input(['required' => true, 'value' => $startDateValue]) !!}
                    @endif

                    @if($column instanceof \App\ValueObjects\Column\Attendance\StartTime)
                        @php
                            $startTimeColumn = $column->column();
                            $startTimeValue  = $model->$startTimeColumn;
                        @endphp
                        {!! $column->input(['required' => true, 'value' => $startTimeValue]) !!}
                    @endif

                    @if($column instanceof \App\ValueObjects\Column\Attendance\EndDate)
                        @php
                            $endDateColumn = $column->column();
                            $endDateValue  = $model->$endDateColumn;
                        @endphp
                        {!! $column->input(['required' => true, 'value' => $endDateValue]) !!}
                    @endif

                    @if($column instanceof \App\ValueObjects\Column\Attendance\EndTime)
                        @php
                            $endTimeColumn = $column->column();
                            $endTimeValue  = $model->$endTimeColumn;
                        @endphp
                        {!! $column->input(['required' => true, 'value' => $endTimeValue]) !!}
                    @endif

                </div>
            @endforeach
        </div>
        <x-button.update/>
    </form>
@endsection

@section('page-script')
    @includeIf('scripts.tags')
@endsection
