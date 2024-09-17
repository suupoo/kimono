@extends('layouts')

@section('content')

    <h1 class="custom-headline">
        {{ $model::NAME  }}

        <x-tooltip.tooltip
            icon="icons.lucide.question"
            icon-class="w-4 h-4"
        >
            {!! str_replace("\n", "<br/>", __('resource.meta.'.$model::class.'.description')) !!}
        </x-tooltip.tooltip>
    </h1>

    @php
        $currentRouteName = request()->route()->getName();
        $sort = request()->get('sort');
        $order = request()->get('order');
        $rows = request()->get('rows');
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

                        @if($column instanceof \App\ValueObjects\Column\Notification\OwnerSequenceNo )
                            {!! $column->input(['class' => 'no-spinner']) !!}
                        @endif

                        @if($column instanceof \App\ValueObjects\Column\Notification\Title )
                            {!! $column->input(['class' => '']) !!}
                        @endif

                        @if($column instanceof \App\ValueObjects\Column\Notification\Type )
                            {!! $column->input(['class' => '']) !!}
                        @endif

                        @if($column instanceof \App\ValueObjects\Column\Notification\Status )
                            {!! $column->input(['class' => '']) !!}
                        @endif

                        @if($column instanceof \App\ValueObjects\Column\Notification\PublishAt )
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
                        @foreach($model::getColumns() as $column)
                            @php
                                if ($column instanceof \App\ValueObjects\Column\Notification\Id) continue;
                                elseif ($column instanceof \App\ValueObjects\Column\Notification\OwnerSystemCompany) continue;
                                elseif ($column instanceof \App\ValueObjects\Column\Notification\DeletedAt) continue;
                            @endphp
                            <th scope="col" class="px-6 py-3 whitespace-nowrap">
                                <div class="flex w-full items-center justify-center space-x-1">
                                    @if(in_array($column->column(), $arraySortable))
                                        <a
                                            class="p-0.5 @if($sort === $column->column() && $order == 'asc' ) bg-red-400 text-white @else bg-gray-100 text-gray-400 @endif
                                "
                                            href="{{ route($currentRouteName, ['sort' => $column->column(), 'order' => 'asc', 'rows' => $rows])}}"
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
                                            href="{{ route($currentRouteName, ['sort' => $column->column(), 'order' => 'desc', 'rows' => $rows])}}"
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
                        <tr class="bg-white border-b">
                            <td class="w-full text-xs flex flex-col justify-center space-y-1 m-1">
                                <x-button.edit type="link"
                                               href="{{ route($model->getTable() . '.edit', ['id' => $item->id]) }}"/>
                                <x-button.show type="link"
                                               href="{{ route($model->getTable() . '.show', ['id' => $item->id]) }}"/>
                                <x-button.copy type="link"
                                               href="{{ route($model->getTable() . '.create', ['copy' => $item->id]) }}"/>
                                <x-button.delete
                                    href="{{ route($model->getTable() . '.destroy', ['id' => $item->id]) }}"
                                    data-id="{{ $item->id }}"
                                />
                            </td>
                            @foreach($model::getColumns() as $column)
                                @php
                                    if ($column instanceof \App\ValueObjects\Column\Notification\Id) continue;
                                    elseif ($column instanceof \App\ValueObjects\Column\Notification\OwnerSystemCompany) continue;
                                    elseif ($column instanceof \App\ValueObjects\Column\Notification\DeletedAt) continue;
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
