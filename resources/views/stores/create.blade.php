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

                    @if($column instanceof \App\ValueObjects\Store\Name)
                        @php
                            $storeNameColumn = $column->column();
                            $storeNameValue  = $model->$storeNameColumn;
                        @endphp
                        {!! $column->input(['required' => true, 'class' => '', 'value' => $storeNameValue])?->render() !!}
                    @endif

                    @if($column instanceof \App\ValueObjects\Store\Code)
                        @php
                            $codeColumn = $column->column();
                            $codeValue  = $model->$codeColumn;
                        @endphp
                        {!! $column->input(['required' => true, 'class' => '', 'value' => $codeValue])?->render() !!}
                    @endif

                    @if($column instanceof \App\ValueObjects\Store\PostCode)
                        @php
                            $postCodeColumn = $column->column();
                            $postCodeValue  = $model->$postCodeColumn;
                        @endphp
                        {!! $column->input(['required' => false, 'class' => '', 'value' => $postCodeValue])?->render() !!}
                    @endif

                    @if($column instanceof \App\ValueObjects\Store\Prefecture)
                        @php
                            $prefectureColumn = $column->column();
                            $prefectureValue  = $model->$prefectureColumn;
                        @endphp
                        {!! $column->input(['required' => false, 'class' => '', 'value' => $prefectureValue?->value])?->render() !!}
                    @endif

                    @if($column instanceof \App\ValueObjects\Store\Address1)
                        @php
                            $address1Column = $column->column();
                            $address1Value  = $model->$address1Column;
                        @endphp
                        {!! $column->input(['required' => false, 'class' => '', 'value' => $address1Value])?->render() !!}
                    @endif

                    @if($column instanceof \App\ValueObjects\Store\Address2)
                        @php
                            $address2Column = $column->column();
                            $address2Value  = $model->$address2Column;
                        @endphp
                        {!! $column->input(['required' => false, 'class' => '', 'value' => $address2Value])?->render() !!}
                    @endif

                    @if($column instanceof \App\ValueObjects\Store\Tags)
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
        <x-button.store />
    </form>
@endsection

@section('page-script')
    @includeIf('scripts.tags')
@endsection

