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

                    @if($column instanceof \App\ValueObjects\Column\Master\Administrator\Name)
                        @php
                            $nameColumn = $column->column();
                            $nameValue  = $model->$nameColumn;
                        @endphp
                        {!! $column->input(['required' => true, 'disable' => true, 'class' => '', 'value' => $nameValue]) !!}
                    @endif

                    @if($column instanceof \App\ValueObjects\Column\Master\Administrator\Email)
                        @php
                            $emailColumn = $column->column();
                            $emailValue  = $model->$emailColumn;
                        @endphp
                        {!! $column->input(['required' => true, 'disable' => true, 'class' => '', 'value' => $emailValue]) !!}
                    @endif

                    @if($column instanceof \App\ValueObjects\Column\Master\Administrator\EmailVerifiedAt)
                        @php
                            $emailVerifiedAtColumn = $column->column();
                            $emailVerifiedAtValue  = $model->$emailVerifiedAtColumn;
                        @endphp
                        {!! $column->input(['required' => false, 'disable' => true, 'class' => '', 'value' => $emailVerifiedAtValue]) !!}
                    @endif

                    @if($column instanceof \App\ValueObjects\Column\Master\Administrator\Role)
                        @php
                            $roleColumn = $column->column();
                            $roleValue  = $model->$roleColumn;
                        @endphp
                        {!! $column->input(['required' => true, 'disable' => true, 'class' => '', 'value' => $roleValue?->value]) !!}
                    @endif

                    @if($column instanceof \App\ValueObjects\Column\Master\Administrator\StartAt)
                        @php
                            $startAtColumn = $column->column();
                            $startAtValue  = $model->$startAtColumn;
                        @endphp
                        {!! $column->input(['required' => false, 'disable' => true, 'class' => '', 'value' => $startAtValue]) !!}
                    @endif

                    @if($column instanceof \App\ValueObjects\Master\Administrator\EmdAt)
                        @php
                            $endAtColumn = $column->column();
                            $endAtValue  = $model->$endAtColumn;
                        @endphp
                        {!! $column->input(['required' => false, 'disable' => true, 'class' => '', 'value' => $endAtValue]) !!}
                    @endif

                </div>
            @endforeach
        </div>
    </div>
@endsection
