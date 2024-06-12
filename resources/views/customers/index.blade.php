@extends('layouts')

@section('content')
@php
    $currentRouteName = request()->route()->getName();
    $sort = request()->get('sort');
    $order = request()->get('order');
    $sortable = $listConditions['sortable'] ?? [];
@endphp
<div class="flex flex-col gap-2 px-12 py-2">
    <h1 class="text-xl font-bold">
        {{ $model::NAME }}
    </h1>

    <table class="table-auto border-collapse border border-slate-400">
        <thead>
            <tr>
                @foreach($model::getColumns() as $column)
                <th class="border border-slate-300 p-2">
                    <div class="flex w-full items-center justify-center space-x-1">
                        @if(in_array('*', $sortable) || in_array($column->column(), $sortable))
                        <a
                            class="bg-gray-100 p-0.5
                                @if($sort === $column->column() && $order == 'asc' ) text-gray-800 @else text-gray-400 @endif
                            "
                            href="{{ route($currentRouteName, ['sort' => $column->column(), 'order' => 'asc'])}}"
                        >
                            @include('components.list.sort-up')
                        </a>
                        @endif

                        <span>{{ $column->label() }}</span>
                        @if(in_array('*', $sortable) || in_array($column->column(), $sortable))
                        <a
                            class="bg-gray-100 p-0.5
                                @if($sort === $column->column() && $order == 'desc' ) text-gray-800 @else text-gray-400 @endif
                            "
                            href="{{ route($currentRouteName, ['sort' => $column->column(), 'order' => 'desc'])}}"
                        >
                            @include('components.list.sort-down')
                        </a>
                        @endif
                    </div>
                </th>
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
