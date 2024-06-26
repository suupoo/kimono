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
                        {!! $column->input(['required' => true, 'class' => ''])?->render() !!}
                    @endif

                    @if($column instanceof \App\ValueObjects\Store\Code)
                        {!! $column->input(['required' => true, 'class' => ''])?->render() !!}
                    @endif

                    @if($column instanceof \App\ValueObjects\Store\Prefecture)
                        {!! $column->input(['required' => false, 'class' => ''])?->render() !!}
                    @endif

                    @if($column instanceof \App\ValueObjects\Store\Address1)
                        {!! $column->input(['required' => false, 'class' => ''])?->render() !!}
                    @endif

                    @if($column instanceof \App\ValueObjects\Store\Address2)
                        {!! $column->input(['required' => false, 'class' => ''])?->render() !!}
                    @endif

                    @if($column instanceof \App\ValueObjects\Store\PostCode)
                        {!! $column->input(['required' => false, 'class' => ''])?->render() !!}
                    @endif

                </div>
            @endforeach
        </div>
        <x-button.create-button/>
    </form>
@endsection
