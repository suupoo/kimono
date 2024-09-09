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

                    @if($column instanceof \App\ValueObjects\Column\Master\Banner\Image)
                        @php
                            $imageColumn = $column->column();
                            $imageValue  = $model->$imageColumn;
                        @endphp
                        <div class="flex w-full space-x-2 flex-row items-center">
                            <div class="w-[300px] h-[200px] rounded-lg border border-gray-200 flex justify-center items-center">
                                @if($model->image)
                                    <img src="{{ $model->image_url }}" alt="profile-icon" class="w-full h-full">
                                @else
                                    <span>{{ __('Not Upload') }}</span>
                                @endif
                            </div>
                        </div>
                    @endif

                    @if($column instanceof \App\ValueObjects\Column\Master\Banner\Text)
                        @php
                            $textColumn = $column->column();
                            $textValue  = $model->$textColumn;
                        @endphp
                        {!! $column->input(['required' => true, 'disable' => true, 'value' => $textValue]) !!}
                    @endif

                    @if($column instanceof \App\ValueObjects\Column\Master\Banner\Url)
                        @php
                            $urlColumn = $column->column();
                            $urlValue  = $model->$urlColumn;
                        @endphp
                        {!! $column->input(['required' => false, 'disable' => true, 'value' => $urlValue]) !!}
                    @endif

                    @if($column instanceof \App\ValueObjects\Column\Master\Banner\Priority)
                        @php
                            $priorityColumn = $column->column();
                            $priorityValue  = $model->$priorityColumn;
                        @endphp
                        {!! $column->input(['required' => true, 'disable' => true, 'value' => $priorityValue]) !!}
                    @endif

                </div>
            @endforeach
        </div>
    </div>
@endsection
