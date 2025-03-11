@extends('layouts')

@section('content')
<div>
    @if ($errors->any())
        <div class="error">
            @foreach($errors->all() as $error)
                <div class="text-red-500">{{ $error }}</div>
            @endforeach
        </div>
    @endif
    <h1 class="text-xl font-bold">
        {{ __('menu.staffs.attendances.list') }}
    </h1>
    <div class="flex flex-col w-full space-y-0.5 my-2">
        <div class="flex w-full justify-end m-1">
            <div class="w-fit flex flex-row gap-1">
                <x-button.create type="link" href="{{ route($relationModel->getTable() . '.create', ['staff_id' => $model->id]) }}"/>
            </div>
        </div>
        <x-list.simple>
            @foreach($staffAttendanceList as $staffAttendance)
            <x-list.simple-item>
                {{ $staffAttendance->working->text() }}
            </x-list.simple-item>
            @endforeach
        </x-list.simple>
    </div>
</div>
@endsection
