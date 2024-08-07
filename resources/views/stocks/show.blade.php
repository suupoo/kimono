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

                    @if($column instanceof \App\ValueObjects\Stock\Image)
                        @php
                            $imageColumn = $column->column();
                            $imageValue  = $model->$imageColumn;
                        @endphp
                        <div class="flex w-full space-x-2 flex-row items-center">
                            <div class="w-40 h-40 rounded-full border border-gray-200 flex justify-center items-center">
                                @if($model->image)
                                    <img src="{{ $model->image_url }}" alt="profile-icon" class="w-full h-full">
                                @else
                                    <span>{{ __('Not Upload') }}</span>
                                @endif
                            </div>

                            <div class="grow h-fit">
                                {!! $column->input(['required' => false, 'disable' => true, 'class' => '']) !!}
                            </div>
                        </div>
                    @endif

                    @if($column instanceof \App\ValueObjects\Stock\Name)
                        @php
                            $stockNameColumn = $column->column();
                            $stockNameValue  = $model->$stockNameColumn;
                        @endphp
                        {!! $column->input(['required' => true, 'disable' => true, 'class' => '', 'value' => $stockNameValue])?->render() !!}
                    @endif

                    @if($column instanceof \App\ValueObjects\Stock\Quantity)
                        @php
                            $quantityColumn = $column->column();
                            $quantityValue  = $model->$quantityColumn;
                        @endphp
                        {!! $column->input(['required' => false, 'disable' => true, 'class' => '', 'value' => $quantityValue])?->render() !!}
                    @endif

                    @if($column instanceof \App\ValueObjects\Stock\Price)
                        @php
                            $priceColumn = $column->column();
                            $priceValue  = $model->$priceColumn;
                        @endphp
                        {!! $column->input(['required' => false, 'disable' => true, 'class' => '', 'value' => $priceValue])?->render() !!}
                    @endif

                </div>
            @endforeach
        </div>
    </div>
@endsection
