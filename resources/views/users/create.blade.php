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

                    @if($column instanceof \App\ValueObjects\Column\User\Name)
                        @php
                            $nameColumn = $column->column();
                            $nameValue  = $model->$nameColumn;
                        @endphp
                        {!! $column->input(['required' => true, 'class' => '', 'value' => $nameValue])!!}
                    @endif

                    @if($column instanceof \App\ValueObjects\Column\User\Email)
                        @php
                            $emailColumn = $column->column();
                            $emailValue  = $model->$emailColumn;
                        @endphp
                        {!! $column->input(['required' => true, 'class' => '', 'value' => $emailValue])!!}
                    @endif

                    @if($column instanceof \App\ValueObjects\Column\User\Password)
                        {!! $column->input(['required' => true, 'class' => ''])!!}
                        {!! $column->inputConfirm(['required' => true, 'class' => ''])!!}
                    @endif

                    @if($column instanceof \App\ValueObjects\Column\User\Tags)
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
@endsection
