@extends('layouts')

@section('content')

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

                    @if($column instanceof \App\ValueObjects\Notification\Title)
                        @php
                            $titleColumn = $column->column();
                            $titleValue  = $model->$titleColumn;
                        @endphp
                        {!! $column->input(['required' => true, 'class' => '', 'value' => $titleValue]) !!}
                    @endif

                    @if($column instanceof \App\ValueObjects\Notification\Type)
                        @php
                            $typeColumn = $column->column();
                            $typeValue  = $model->$typeColumn;
                        @endphp
                        {!! $column->input(['required' => true, 'class' => '', 'value' => $typeValue]) !!}
                    @endif

                    @if($column instanceof \App\ValueObjects\Notification\Content)
                        @php
                            $contentColumn = $column->column();
                            $contentValue  = $model->$contentColumn;
                        @endphp
                        {!! $column->input(['required' => true, 'class' => '', 'value' => $contentValue])!!}
                    @endif

                    @if($column instanceof \App\ValueObjects\Notification\Status)
                        @php
                            $statusColumn = $column->column();
                            $statusValue  = $model->$statusColumn;
                        @endphp
                        {!! $column->input(['required' => true, 'class' => '', 'value' => $statusValue]) !!}
                    @endif

                    @if($column instanceof \App\ValueObjects\Notification\PublishAt)
                        @php
                            $publishAtColumn = $column->column();
                            $publishAtValue  = $model->$publishAtColumn;
                        @endphp
                        {!! $column->input(['required' => false, 'class' => '', 'value' => $publishAtValue]) !!}
                    @endif

                    @if($column instanceof \App\ValueObjects\Notification\Tags)
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
