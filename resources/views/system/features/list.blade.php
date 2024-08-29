@extends('layouts')

@section('content')
    <form action="{{ route('system.saveFeature') }}" method="post" class="flex flex-col py-2">
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
            @php
                $key = new \App\ValueObjects\Master\Feature\Key;
                $name = new \App\ValueObjects\Master\Feature\Name;
                $enable = new \App\ValueObjects\Master\Feature\Enable;
            @endphp
            @foreach($items as $item)
                <div class="flex w-full gap-3 justify-end my-1">
                    {!! $enable->input([
                          'id' => "features-$item->key",
                          'name' => "features[$item->key]",
                          'value' => 1,
                          'label' => $item->name,
                          'checked' => $item->enable
                    ]) !!}
                </div>
            @endforeach
        </div>
        <x-button.store/>
    </form>
@endsection
