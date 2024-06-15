@extends('layouts')

@section('content')
@php
    $currentRouteName = request()->route()->getName();
    $sort = request()->get('sort');
    $order = request()->get('order');
    $sortable = $listConditions['sortable'] ?? [];
    $searchable = $listConditions['searchable'] ?? [];
@endphp
{{--　コンテンツタイトル --}}
<x-content.title>
    {{ $model::NAME }}
</x-content.title>

{{--　検索エリア --}}
@if(!empty($searchable))
<x-content.full>
    <x-list.search-box>
        @foreach($model::getColumns() as $column)
            @php
                // todo:改良したさの極み
                $searchableArray = $searchable->toArray();
                $searchableColumn = [];
                foreach($searchableArray as $key => $value) {
                    $searchableColumn[] = $value->column();
                }
            @endphp
            @if(in_array($column->column(), $searchableColumn))

                @if($column instanceof \App\ValueObjects\Customer\Id)
                    {!! $column->input(['class' => ''])?->render() !!}
                @endif

                @if($column instanceof \App\ValueObjects\Customer\CustomerName)
                    {!! $column->input(['class' => ''])?->render() !!}
                @endif

                @if($column instanceof \App\ValueObjects\Customer\Prefecture)
                    {!! $column->input(['class' => ''])?->render() !!}
                @endif

                @if($column instanceof \App\ValueObjects\Customer\Address1)
                    {!! $column->input(['class' => ''])?->render() !!}
                @endif

                @if($column instanceof \App\ValueObjects\Customer\Address2)
                    {!! $column->input(['class' => ''])?->render() !!}
                @endif

                @if($column instanceof \App\ValueObjects\Customer\PostCode)
                    {!! $column->input(['class' => ''])?->render() !!}
                @endif
            @endif
        @endforeach
    </x-list.search-box>
</x-content.full>
@endif

{{--　リスト --}}
<x-content.full>
    <h3 class="text-xl font-bold my-2">
        {{ $model::NAME }}一覧
    </h3>

    <div class="relative overflow-x-auto">
        <table class="w-full border rounded-xl text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-white uppercase bg-gray-500 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    @foreach($model::getColumns() as $column)
                    <th scope="col" class="px-6 py-3">
                        <div class="flex w-full items-center justify-center space-x-1">
                            @if(in_array('*', $sortable) || in_array($column->column(), $sortable))
                                <a
                                    class="bg-gray-100 p-0.5
                                @if($sort === $column->column() && $order == 'asc' ) text-red-500 @else text-gray-400 @endif
                            "
                                    href="{{ route($currentRouteName, ['sort' => $column->column(), 'order' => 'asc'])}}"
                                >
                                    @include('components.list.sort-up')
                                </a>
                            @endif

                            <span>{{ $column->label() }}</span>
                            @if(in_array('*', $sortable) || in_array($column->column(), $sortable))
                                <a
                                    class="bg-white p-0.5
                                @if($sort === $column->column() && $order == 'desc' ) text-blue-500 @else text-gray-400 @endif
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
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    @foreach($model::getColumns() as $column)
                        <td class="px-6 py-4">
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
            </tbody>
        </table>
        {{ $items->links() }}
    </div>
</x-content.full>
@endsection
