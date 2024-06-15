@extends('layouts')

@section('content')
<form action="{{ route($model->getTable().'.store') }}" method="post" class="flex flex-col  px-12 py-2">
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

            @if($column instanceof \App\ValueObjects\Customer\CustomerName)
            {!! $column->input(['required' => true, 'class' => ''])?->render() !!}
            @endif

            @if($column instanceof \App\ValueObjects\Customer\Prefecture)
            {!! $column->input(['required' => false, 'class' => ''])?->render() !!}
            @endif

            @if($column instanceof \App\ValueObjects\Customer\Address1)
            {!! $column->input(['required' => false, 'class' => ''])?->render() !!}
            @endif

            @if($column instanceof \App\ValueObjects\Customer\Address2)
            {!! $column->input(['required' => false, 'class' => ''])?->render() !!}
            @endif

            @if($column instanceof \App\ValueObjects\Customer\PostCode)
            {!! $column->input(['required' => false, 'class' => ''])?->render() !!}
            @endif

        </div>
        @endforeach
    </div>
    <input
        type="submit"
        class="w-full bg-green-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
        value="作成"
    />
</form>
@endsection
