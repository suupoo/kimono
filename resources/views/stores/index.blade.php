@extends('layouts')

@section('content')

    <h1 class="custom-headline">
        {{ $model::NAME. __('resource.list') }}
    </h1>

    @php
        $currentRouteName = request()->route()->getName();
        $sort = request()->get('sort');
        $order = request()->get('order');
        // 検索可能カラムコレクションをカラム名配列に変換
        $searchable = $listConditions['searchable'] ?? [];
        foreach($searchable as $searchableItem) {
            $arraySearchable[] = $searchableItem->column();
        }
        // ソート可能カラムコレクションをカラム名配列に変換
        $sortable = $listConditions['sortable'] ?? [];
        foreach ($sortable as $sortableItem) {
            $arraySortable[] = $sortableItem->column();
        };
    @endphp

    {{--　検索エリア --}}
    @if(!empty($searchable))
        <div class="custom-full-container">
            <x-list.search-box>
                @foreach($model::getColumns() as $column)
                    @php
                        // 検索可能カラムコレクションをカラム名配列に変換
                        $arraySearchable = [];
                        foreach($searchable as $value) {
                            $arraySearchable[] = $value->column();
                        }
                    @endphp
                    @if(in_array($column->column(), $arraySearchable))

                        @if($column instanceof \App\ValueObjects\Store\OwnerSequenceNo)
                            {!! $column->input(['class' => 'no-spinner']) !!}
                        @endif

                        @if($column instanceof \App\ValueObjects\Store\Name)
                            {!! $column->input(['class' => '']) !!}
                        @endif

                        @if($column instanceof \App\ValueObjects\Store\Code)
                            {!! $column->input(['class' => '']) !!}
                        @endif

                        @if($column instanceof \App\ValueObjects\Store\PostCode)
                            {!! $column->input(['class' => '']) !!}
                        @endif

                        @if($column instanceof \App\ValueObjects\Store\Prefecture)
                            {!! $column->input(['class' => '']) !!}
                        @endif

                        @if($column instanceof \App\ValueObjects\Store\Address1)
                            {!! $column->input(['class' => '']) !!}
                        @endif

                        @if($column instanceof \App\ValueObjects\Store\Address2)
                            {!! $column->input(['class' => '']) !!}
                        @endif

                    @endif
                @endforeach
            </x-list.search-box>
        </div>
    @endif

    {{--　リスト --}}
    <div class="custom-full-container">
        <div class="flex w-full justify-end m-1">
            <div class="w-fit flex flex-row gap-1">
                <x-button.export export-type="CSV" id="export-csv" href="{{ route($model->getTable() . '.export.csv') }}" />
                <x-button.create type="link" href="{{ route($model->getTable() . '.create') }}"/>
            </div>
        </div>
        <div class="relative overflow-x-auto">
            <x-table.table>
                @slot('tHead')
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            {{ __('resource.operation') }}
                        </th>

                        <th scope="col" class="px-3 py-3 text-center">
                            {{ __('resource.operation-relation') }}
                        </th>

                        @foreach($model::getColumns() as $column)
                            @php
                                if ($column instanceof \App\ValueObjects\Store\Id) continue;
                                elseif ($column instanceof \App\ValueObjects\Store\OwnerSystemCompany) continue;
                                elseif ($column instanceof \App\ValueObjects\Store\DeletedAt) continue;
                            @endphp
                            <th scope="col" class="px-6 py-3 whitespace-nowrap">
                                <div class="flex w-full items-center justify-center space-x-1">
                                    @if(in_array($column->column(), $arraySortable))
                                        <a
                                            class="p-0.5 @if($sort === $column->column() && $order == 'asc' ) bg-red-400 text-white @else bg-gray-100 text-gray-400 @endif"
                                            href="{{ route($currentRouteName, ['sort' => $column->column(), 'order' => 'asc'])}}"
                                        >
                                            @include('icons.sort-up')
                                        </a>
                                    @endif

                                    <span>{{ $column->label() }}</span>
                                    @if(in_array($column->column(), $arraySortable))
                                        <a
                                            class="p-0.5
                                @if($sort === $column->column() && $order == 'desc' ) bg-blue-400 text-white @else bg-gray-100 text-gray-400 @endif
                            "
                                            href="{{ route($currentRouteName, ['sort' => $column->column(), 'order' => 'desc'])}}"
                                        >
                                            @include('icons.sort-down')
                                        </a>
                                    @endif
                                </div>
                            </th>
                        @endforeach
                    </tr>
                @endslot
                @slot('tBody')
                    @foreach($items as $item)
                        <tr class="bg-white border-b"  data-id="{{ $item->id }}">
                            <td class="w-full text-xs flex flex-col justify-center space-y-1 m-1 actions">
                                <x-button.edit type="link" href="{{ route($model->getTable() . '.edit', ['id' => $item->id]) }}"/>
                                <x-button.show type="link" href="{{ route($model->getTable() . '.show', ['id' => $item->id]) }}"/>
                                <x-button.copy type="link" href="{{ route($model->getTable() . '.create', ['copy' => $item->id]) }}"/>
                                <x-button.delete
                                    href="{{ route($model->getTable() . '.destroy', ['id' => $item->id]) }}"
                                    data-id="{{ $item->id }}"
                                />
                            </td>

                            <td class="px-3 py-4 text-xs m-1 w-full actions">
                                <x-button.relation href="{{ route($model->getTable() . '.staffs.list', ['id' => $item->id]) }}">
                                    {{ __('menu.stores.staffs.list') }}
                                </x-button.relation>
                            </td>

                            @foreach($model::getColumns() as $column)
                                @php
                                    if ($column instanceof \App\ValueObjects\Store\Id) continue;
                                    elseif ($column instanceof \App\ValueObjects\Store\OwnerSystemCompany) continue;
                                    elseif ($column instanceof \App\ValueObjects\Store\DeletedAt) continue;
                                @endphp
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
                @endslot
                @slot('pagination')
                    {{ $items->links() }}
                @endslot
            </x-table.table>
        </div>
    </div>
@endsection
