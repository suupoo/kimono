@extends('layouts')

@section('content')

    <h1 class="custom-headline">
        {{ $model::NAME }}
    </h1>

    @php
        $id = $model->id;
    @endphp
    <form action="{{ route($model->getTable().'.update', ['id' => $id]) }}" method="post" enctype="multipart/form-data" class="flex flex-col py-2">
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

                    @if($column instanceof \App\ValueObjects\Stock\Image)
                        @php
                            $imageColumn = $column->column();
                            $imageValue  = $model->$imageColumn;
                        @endphp
                        <div class="flex w-full space-x-2 flex-row items-center">
                            <div class="w-28 h-28 rounded-full border border-gray-200 flex justify-center items-center">
                                @if($model->image)
                                    <img src="{{ $model->image_url }}" alt="profile-icon" class="w-full h-full">
                                @else
                                    <span>{{ __('Not Upload') }}</span>
                                @endif
                            </div>

                            <div class="grow h-fit">
                                {!! $column->input(['required' => false, 'class' => '']) !!}
                            </div>
                        </div>
                    @endif

                    @if($column instanceof \App\ValueObjects\Stock\Name)
                        @php
                            $stockNameColumn = $column->column();
                            $stockNameValue  = $model->$stockNameColumn;
                        @endphp
                        {!! $column->input(['required' => true, 'class' => '', 'value' => $stockNameValue]) !!}
                    @endif

                    @if($column instanceof \App\ValueObjects\Stock\Quantity)
                        @php
                            $quantityColumn = $column->column();
                            $quantityValue  = $model->$quantityColumn;
                        @endphp
                        {!! $column->input(['required' => true, 'class' => '', 'value' => $quantityValue]) !!}
                    @endif

                    @if($column instanceof \App\ValueObjects\Stock\Price)
                        @php
                            $priceColumn = $column->column();
                            $priceValue  = $model->$priceColumn;
                        @endphp
                        {!! $column->input(['required' => true, 'class' => '', 'value' => $priceValue]) !!}
                    @endif

                    @if($column instanceof \App\ValueObjects\Stock\Tags)
                        @php
                            $tagsColumn = $column->column();
                            $tagsValue  = $model->$tagsColumn;
                        @endphp
                        <div data-tags-container="tags">
                            {!! $column->input(['required' => false, 'value' => $tagsValue]) !!}
                            <div data-tags="tags" class="flex flex-row items-center flex-wrap my-1 space-x-1">
                                @include('icons.tag', ['class' => 'w-6 h-6 p-1'])
                            </div>
                        </div>
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
