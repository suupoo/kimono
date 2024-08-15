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

            @if($column instanceof \App\ValueObjects\User\Name)
                @php
                  $nameColumn = $column->column();
                  $nameValue  = $model->$nameColumn;
                @endphp
                {!! $column->input(['required' => true, 'disable' => true, 'class' => '', 'value' => $nameValue])!!}
            @endif

            @if($column instanceof \App\ValueObjects\User\Email)
                @php
                    $emailColumn = $column->column();
                    $emailValue  = $model->$emailColumn;
                @endphp
                {!! $column->input(['required' => true, 'disable' => true, 'class' => '', 'value' => $emailValue])!!}
            @endif

            @if($column instanceof \App\ValueObjects\User\EmailVerifiedAt)
                @php
                    $emailVerifiedAtColumn = $column->column();
                    $emailVerifiedAtValue  = $model->$emailVerifiedAtColumn;
                @endphp
                {!! $column->input(['required' => false, 'disable' => true, 'class' => '', 'value' => $emailVerifiedAtValue])!!}
            @endif

            @if($column instanceof \App\ValueObjects\User\Tags)
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
</div>
@endsection

@section('page-script')
    @includeIf('scripts.tags')
@endsection
