@extends('layouts')

@section('content')
    @props([
      'now' => \Carbon\CarbonImmutable::now(),
    ])
    <div class="flex w-full flex flex-col space-y-2">
        <p class="w-full text-center">
            {{ $now->format('Y年n月j日') }}（{{$now->isoFormat('ddd')}}）
        </p>
        <div class="flex flex-col w-full shadow-md gap-1">
            <h2 class="text-2xl text-center w-full">ダッシュボード</h2>
            <div class="custom-dashboard-item px-2 md:px-4  w-full min-h-[180px]">
                <x-dashboard.dashboard />
            </div>
        </div>
    </div>
@endsection
