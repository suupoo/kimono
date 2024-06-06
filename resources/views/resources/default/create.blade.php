@extends('layouts')

@section('content')
<div class="resource create flex flex-col">
    <h1>{{ $data->model->tableName() }}</h1>
    @foreach($data->model::columns() as $column)
    <div class="w-full">
        <label
            for="{{ $column->value }}"
        >
            {{ $column->label() }}
        </label>
        <input
            class="w-full "
            id="{{ $column->value }}"
            type="{{ $column->inputType() }}"
            name="{{ $column->value }}"
        />
    </div>
    @endforeach
<div>
@endsection
