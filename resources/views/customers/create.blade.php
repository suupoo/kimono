@extends('layouts')

@section('content')

    <div class="w-20">
        <x-button.back href="{{ route($model->getTable().'.index') }}" />
    </div>

    <h1 class="custom-headline">
        {{ $model::NAME }}
    </h1>

    <form action="{{ route($model->getTable().'.store') }}" method="post" class="flex flex-col py-2">
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

                    @if($column instanceof \App\ValueObjects\Column\Customer\CustomerName)
                        @php
                            $customerNameColumn = $column->column();
                            $customerNameValue  = $model->$customerNameColumn;
                        @endphp
                        {!! $column->input(['required' => true, 'value' => $customerNameValue]) !!}
                    @endif

                    @if($column instanceof \App\ValueObjects\Column\Customer\PostCode)
                    <div class="flex gap-1 items-end">
                        <div class="w-full">
                            @php
                                $postCodeColumn = $column->column();
                                $postCodeValue  = $model->$postCodeColumn;
                            @endphp
                            {!! $column->input(['required' => false, 'value' => $postCodeValue]) !!}
                        </div>
                        <div>
                            <x-button.color-blue data-trigger-click="setSearchAddress" class="w-20 h-10 p-2">{{ __('Address Search') }}</x-button.color-blue>
                        </div>
                    </div>
                    @endif

                    @if($column instanceof \App\ValueObjects\Column\Customer\Prefecture)
                        @php
                            $prefectureColumn = $column->column();
                            $prefectureValue  = $model->$prefectureColumn;
                        @endphp
                        {!! $column->input(['required' => false, 'value' => $prefectureValue?->value]) !!}
                    @endif

                    @if($column instanceof \App\ValueObjects\Column\Customer\Address1)
                        @php
                            $address1Column = $column->column();
                            $address1Value  = $model->$address1Column;
                        @endphp
                        {!! $column->input(['required' => false, 'value' => $address1Value]) !!}
                    @endif

                    @if($column instanceof \App\ValueObjects\Column\Customer\Address2)
                        @php
                            $address2Column = $column->column();
                            $address2Value  = $model->$address2Column;
                        @endphp
                        {!! $column->input(['required' => false, 'value' => $address2Value]) !!}
                    @endif

                    @if($column instanceof \App\ValueObjects\Column\Customer\Note)
                        @php
                            $noteColumn = $column->column();
                            $noteValue  = $model->$noteColumn;
                        @endphp
                        {!! $column->input(['required' => false, 'value' => $noteValue]) !!}
                    @endif

                    @if($column instanceof \App\ValueObjects\Column\Customer\Tags)
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
        <x-button.store/>
    </form>
@endsection

@section('page-script')
    @includeIf('scripts.tags')
{{--    @include('scripts.search-address', [--}}
{{--        'selectorPostCode'   => '#post_code',--}}
{{--        'selectorPrefecture' => '#prefecture',--}}
{{--        'selectorAddress1'   => '#address1',--}}
{{--        'selectorAddress2'   => '#address2',--}}
{{--    ])--}}
@endsection

