@extends('layouts')

@section('content')
    <form action="{{ route('me.save') }}" method="post" class="flex flex-col py-2">
        @csrf
        @if ($errors->any())
            <div class="error">
                @foreach($errors->all() as $error)
                    <div class="text-red-500">{{ $error }}</div>
                @endforeach
            </div>
        @endif
        <h1 class="text-xl font-bold">
            {{ __('menu.me.*') }}
        </h1>
        <div class="flex flex-col w-full">
            @foreach($model::getColumns() as $column)
                <div class="w-full my-1">

                    @if($column instanceof \App\ValueObjects\Administrator\Name)
                        @php
                            $nameColumn = $column->column();
                            $nameValue  = $model->$nameColumn;
                        @endphp
                        {!! $column->input(['required' => true, 'class' => '', 'value' => $nameValue]) !!}
                    @endif

                    @if($column instanceof \App\ValueObjects\Administrator\Email)
                        @php
                            $emailColumn = $column->column();
                            $emailValue  = $model->$emailColumn;
                        @endphp
                        {!! $column->input(['required' => true, 'class' => '', 'value' => $emailValue]) !!}
                    @endif

                    @if($column instanceof \App\ValueObjects\Administrator\Password)
                        {!! $column->input(['required' => false, 'class' => '']) !!}
                        {!! $column->inputConfirm(['required' => false, 'class' => '']) !!}
                    @endif

                </div>
            @endforeach
        </div>
        <x-button.store/>
    </form>
@endsection
