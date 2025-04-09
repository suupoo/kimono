@extends('layouts')

@section('content')

    <div class="custom-headline">
        <div>{{ $model::NAME  }}</div>
    </div>

    <div class="custom-description">
        {!! str_replace("\n", "<br/>", __('description.'.$model::class.'.description')) !!}
    </div>

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

                        @if($column instanceof \App\ValueObjects\Column\Staff\OwnerSequenceNo)
                            {!! $column->input(['class' => 'no-spinner']) !!}
                        @endif

                        @if($column instanceof \App\ValueObjects\Column\Staff\Name)
                            {!! $column->input(['class' => '']) !!}
                        @endif

                        @if($column instanceof \App\ValueObjects\Column\Staff\Code)
                            {!! $column->input(['class' => '']) !!}
                        @endif

                        @if($column instanceof \App\ValueObjects\Column\Staff\Tel)
                            {!! $column->input(['class' => '']) !!}
                        @endif

                        @if($column instanceof \App\ValueObjects\Column\Staff\StaffPosition)
                            {!! $column->input(['class' => '']) !!}
                        @endif

                        @if($column instanceof \App\ValueObjects\Column\Staff\JoinDate)
                            {!! $column->input(['class' => '']) !!}
                        @endif

                        @if($column instanceof \App\ValueObjects\Column\Staff\QuitDate)
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
                <x-button.export export-type="CSV" id="export-csv"
                                 href="{{ route($model->getTable() . '.export.csv') }}"/>
                <x-button.create type="link" href="{{ route($model->getTable() . '.create') }}"/>
            </div>
        </div>

        <x-table.table>
            @slot('tHead')
                <tr>
                    <th scope="col" class="px-6 py-3">
                        {{ __('resource.operation') }}
                    </th>
                    @foreach($model::getColumns() as $column)
                        @php
                            if ($column instanceof \App\ValueObjects\Column\Staff\Id) continue;
                            elseif ($column instanceof \App\ValueObjects\Column\Staff\OwnerSystemCompany) continue;
                            elseif ($column instanceof \App\ValueObjects\Column\Staff\DeletedAt) continue;
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
                    <tr data-id="{{ $item->id }}">
                        <td class="actions">
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
                                if ($column instanceof \App\ValueObjects\Column\Staff\Id) continue;
                                elseif ($column instanceof \App\ValueObjects\Column\Staff\OwnerSystemCompany) continue;
                                elseif ($column instanceof \App\ValueObjects\Column\Staff\DeletedAt) continue;
                            @endphp
                            <td class="column">
                                @php
                                    $columnName = $column->column();
                                    $value = $item?->$columnName
                                @endphp
                                @if($column instanceof \App\ValueObjects\Column\Staff\Image)
                                    <div class="flex w-full space-x-2 flex-row items-center">
                                        <div
                                            class="w-40 h-40 rounded-full border border-gray-200 flex justify-center items-center">
                                            @if($item->image)
                                                <img src="{{ $item->image_url }}" alt="profile-icon"
                                                     class="w-full h-full">
                                            @else
                                                <span>{{ __('Not Upload') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                @elseif($value instanceof UnitEnum )
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
@endsection
