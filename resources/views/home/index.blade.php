@extends('layouts')

@section('content')
    <div class="flex flex-col ">
        <div class="w-full">
            ホームだよ
        </div>
        <div class="w-full">
            今日は{{ \Carbon\Carbon::now()->format('Y年n月j日') }}
        </div>
        <div class="w-full">
            時刻は{{ \Carbon\Carbon::now()->format('H時i分') }}
        </div>
    </div>
@endsection
