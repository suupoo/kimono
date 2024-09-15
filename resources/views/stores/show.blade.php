@extends('layouts')

@section('content')

    <div class="w-20">
        <x-button.back href="{{ route($model->getTable().'.index') }}" />
    </div>

    <h1 class="custom-headline">
        {{ $model::NAME }}
    </h1>

    <div class="flex flex-col py-2">
        @csrf
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

                    @if($column instanceof \App\ValueObjects\Column\Store\Name)
                        @php
                            $storeNameColumn = $column->column();
                            $storeNameValue  = $model->$storeNameColumn;
                        @endphp
                        {!! $column->input(['required' => true, 'disable' => true,'class' => '', 'value' => $storeNameValue]) !!}
                    @endif

                    @if($column instanceof \App\ValueObjects\Column\Store\Code)
                        @php
                            $codeColumn = $column->column();
                            $codeValue  = $model->$codeColumn;
                        @endphp
                        {!! $column->input(['required' => true, 'disable' => true, 'class' => '', 'value' => $codeValue]) !!}
                    @endif

                    @if($column instanceof \App\ValueObjects\Column\Store\PostCode)
                        @php
                            $postCodeColumn = $column->column();
                            $postCodeValue  = $model->$postCodeColumn;
                        @endphp
                        {!! $column->input(['required' => false, 'disable' => true, 'class' => '', 'value' => $postCodeValue]) !!}
                    @endif

                    @if($column instanceof \App\ValueObjects\Column\Store\Prefecture)
                        @php
                            $prefectureColumn = $column->column();
                            $prefectureValue  = $model->$prefectureColumn;
                        @endphp
                        {!! $column->input(['required' => false, 'disable' => true, 'class' => '', 'value' => $prefectureValue?->value]) !!}
                    @endif

                    @if($column instanceof \App\ValueObjects\Column\Store\Address1)
                        @php
                            $address1Column = $column->column();
                            $address1Value  = $model->$address1Column;
                        @endphp
                        {!! $column->input(['required' => false, 'disable' => true, 'class' => '', 'value' => $address1Value]) !!}
                    @endif

                    @if($column instanceof \App\ValueObjects\Column\Store\Address2)
                        @php
                            $address2Column = $column->column();
                            $address2Value  = $model->$address2Column;
                        @endphp
                        {!! $column->input(['required' => false, 'disable' => true, 'class' => '', 'value' => $address2Value]) !!}
                    @endif

                    @if($column instanceof \App\ValueObjects\Column\Store\Tags)
                        @php
                            $tagsColumn = $column->column();
                            $tagsValue  = $model->$tagsColumn;
                        @endphp
                        <div data-tags-container="tags">
                            {!! $column->input(['required' => false, 'disable' => true, 'value' => $tagsValue]) !!}
                            <div data-tags="tags" class="flex flex-row items-center flex-wrap my-1 space-x-1">
                                @include('icons.tag', ['class' => 'w-6 h-6 p-1'])
                            </div>
                        </div>
                    @endif

                </div>
            @endforeach
        </div>
    </div>
@endsection

@section('page-script')
    @includeIf('scripts.tags')
@endsection
