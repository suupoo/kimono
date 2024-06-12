@extends('layouts')

@section('content')
<div class="flex flex-col gap-2 px-12 py-2">
    <h1 class="text-xl font-bold">
        {{ $model::NAME }}
    </h1>

    <table class="table-auto border-collapse border border-slate-400">
        <thead>
            <tr>
                @foreach($model::getColumns() as $column)
                <th class="border border-slate-300">{{ $column->label() }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach($items as $item)
            <tr class="border border-slate-300 ">
                @foreach($model::getColumns() as $column)
                <td class="px-1 py-2 border border-slate-300">
                    @php
                        $columnName = $column->column();
                        $value = $item?->$columnName
                    @endphp
                    @if($value instanceof UnitEnum )
                        {{ $value->label() }}
                    @else
                        {{ $item?->$columnName }}
                    @endif
                </td>
                @endforeach
            </tr>
            @endforeach
    </table>
    {{ $items->links() }}
</div>
@endsection
