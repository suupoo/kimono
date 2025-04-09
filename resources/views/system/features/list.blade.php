@extends('layouts')

@section('content')

    <div class="custom-headline">
        <div>{{ $model::NAME  }}</div>
    </div>

    <div class="custom-description">
        {!! str_replace("\n", "<br/>", __('description.'.$model::class.'.description')) !!}
    </div>

    <form action="{{ route('system.saveFeature') }}" method="post" class="flex flex-col py-2">
        @csrf
        @if ($errors->any())
            <div class="error">
                @foreach($errors->all() as $error)
                    <div class="text-red-500">{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <div class="flex flex-col w-full">
            @php
                $key = new \App\ValueObjects\Column\Master\Feature\Key;
                $name = new \App\ValueObjects\Column\Master\Feature\Name;
                $enable = new \App\ValueObjects\Column\Master\Feature\Enable;
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
