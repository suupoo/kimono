@extends('layouts')

@section('content')
    <form action="{{ route($model->getTable().'.store') }}" method="post" class="flex flex-col py-2">
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

                    @if($column instanceof \App\ValueObjects\Customer\CustomerName)
                        @php
                            $customerNameColumn = $column->column();
                            $customerNameValue  = $model->$customerNameColumn;
                        @endphp
                        {!! $column->input(['required' => true, 'value' => $customerNameValue]) !!}
                    @endif

                    @if($column instanceof \App\ValueObjects\Customer\PostCode)
                        @php
                            $postCodeColumn = $column->column();
                            $postCodeValue  = $model->$postCodeColumn;
                        @endphp
                        {!! $column->input(['required' => false, 'value' => $postCodeValue]) !!}
                    @endif

                    @if($column instanceof \App\ValueObjects\Customer\Prefecture)
                        @php
                            $prefectureColumn = $column->column();
                            $prefectureValue  = $model->$prefectureColumn;
                        @endphp
                        {!! $column->input(['required' => false, 'value' => $prefectureValue?->value]) !!}
                    @endif

                    @if($column instanceof \App\ValueObjects\Customer\Address1)
                        @php
                            $address1Column = $column->column();
                            $address1Value  = $model->$address1Column;
                        @endphp
                        {!! $column->input(['required' => false, 'value' => $address1Value]) !!}
                    @endif

                    @if($column instanceof \App\ValueObjects\Customer\Address2)
                        @php
                            $address2Column = $column->column();
                            $address2Value  = $model->$address2Column;
                        @endphp
                        {!! $column->input(['required' => false, 'value' => $address2Value]) !!}
                    @endif

                    @if($column instanceof \App\ValueObjects\Customer\Note)
                        @php
                            $noteColumn = $column->column();
                            $noteValue  = $model->$noteColumn;
                        @endphp
                        {!! $column->input(['required' => false, 'value' => $noteValue]) !!}
                    @endif

                    @if($column instanceof \App\ValueObjects\Customer\Tags)
                        @php
                            $tagsColumn = $column->column();
                            $tagsValue  = $model->$tagsColumn;
                        @endphp
                        {!! $column->input(['required' => false, 'value' => $tagsValue]) !!}
                    @endif

                </div>
            @endforeach
        </div>
        <x-button.store />
    </form>
@endsection
