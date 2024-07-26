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

                    @if($column instanceof \App\ValueObjects\Master\Administrator\Name)
                        @php
                            $nameColumn = $column->column();
                            $nameValue  = $model->$nameColumn;
                        @endphp
                        {!! $column->input(['required' => true, 'disable' => true, 'class' => '', 'value' => $nameValue])?->render() !!}
                    @endif

                    @if($column instanceof \App\ValueObjects\Master\Administrator\Email)
                        @php
                            $emailColumn = $column->column();
                            $emailValue  = $model->$emailColumn;
                        @endphp
                        {!! $column->input(['required' => false, 'disable' => true, 'class' => '', 'value' => $emailValue])?->render() !!}
                    @endif

                    @if($column instanceof \App\ValueObjects\Master\Administrator\EmailVerifiedAt)
                        @php
                            $emailVerifiedAtColumn = $column->column();
                            $emailVerifiedAtValue  = $model->$emailVerifiedAtColumn;
                        @endphp
                        {!! $column->input(['required' => false, 'disable' => true, 'class' => '', 'value' => $emailVerifiedAtValue])?->render() !!}
                    @endif

                    @if($column instanceof \App\ValueObjects\Master\Administrator\Role)
                        @php
                            $roleColumn = $column->column();
                            $roleValue  = $model->$roleColumn;
                        @endphp
                        {!! $column->input(['required' => true, 'disable' => true, 'class' => '', 'value' => $roleValue?->value])?->render() !!}
                    @endif

                </div>
            @endforeach
        </div>
    </div>
@endsection
