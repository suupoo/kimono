@extends('layouts')

@section('content')
    @props([
      'now' => \Carbon\CarbonImmutable::now(),
    ])
    <div class="flex w-full flex flex-col">
        <div class="flex flex-col md:flex-row w-full gap-1">
            <div class="custom-dashboard-item w-full md:w-1/3 flex flex-col justify-center items-center">
                <h2 class="text-3xl font-bold text-center">
                    <div class="flex flex-col gap-1 justify-center items-center">
                        <div>
                            {{ $now->format('Y年n月j日') }}
                        </div>
                        <div>
                            {{ $now->isoFormat('ddd') }}
                        </div>
                    </div>
                </h2>
            </div>
            <div class="custom-dashboard-item text-sm gap-1 w-full md:w-2/3 flex flex-col items-end">
                <div class="font-bold text-lg">
                    {{ __("Today's New Create Records") }}：{{ $newRecords->sum('count'). __('Records') }}
                </div>
                @foreach($newRecords as $newRecord)
                <div>
                    {{$newRecord->name}}：{{ $newRecord->count. __('Records') }}
                </div>
                @endforeach
            </div>
        </div>

        <div class="flex flex-row w-full gap-1">
            <div class="custom-dashboard-item w-full">
                <h2 class="text-2xl font-bold text-center">ダッシュボード</h2>
                <div>
                    <x-dashboard.dashboard />
                </div>
            </div>
        </div>
    </div>
@endsection
