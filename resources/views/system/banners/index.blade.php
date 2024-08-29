@extends('layouts')

@section('content')
    @php
        $currentRouteName = request()->route()->getName();
        $routePrefix = $prefix ?? $model->getTable();
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

                        @if($column instanceof \App\ValueObjects\Master\Banner\Id)
                            {!! $column->input(['class' => 'no-spinner']) !!}
                        @endif

                        @if($column instanceof \App\ValueObjects\Master\Banner\Priority)
                            {!! $column->input(['class' => 'no-spinner']) !!}
                        @endif

                    @endif
                @endforeach
            </x-list.search-box>
        </div>
    @endif

    {{--　リスト --}}
    <div class="custom-full-container">
        <h3 class="text-xl font-bold my-2">
            {{ $model::NAME . __('resource.list') }}
        </h3>
        <div class="flex w-full justify-end">
            <div class="w-fit flex flex-col">
                <x-button.create href="{{ route($prefix.'.create') }}"/>
            </div>
        </div>
        <div class="relative overflow-x-auto">
            <table class="w-full mt-2 border rounded-xl text-sm text-left rtl:text-right text-gray-500 break-keep">
                <thead class="text-xs text-white uppercase bg-gray-700">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        {{ __('resource.operation') }}
                    </th>
                    @foreach($model::getColumns() as $column)
                        <th scope="col" class="px-6 py-3 whitespace-nowrap">
                            <div class="flex w-full items-center justify-center space-x-1">
                                @if(in_array($column->column(), $arraySortable))
                                    <a
                                        class="p-0.5 @if($sort === $column->column() && $order == 'asc' ) bg-red-400 text-white @else bg-gray-100 text-gray-400 @endif
                            "
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
                </thead>
                <tbody>

                @foreach($items as $item)
                    <tr class="bg-white border-b">
                        <td class="w-full text-xs flex flex-col justify-center space-y-1 m-1">
                            <x-button.edit href="{{ route($prefix.'.edit', ['id' => $item->id]) }}"/>
                            <x-button.show href="{{ route($prefix.'.show', ['id' => $item->id]) }}"/>
                            <x-button.copy href="{{ route($prefix.'.create', ['copy' => $item->id]) }}"/>
                            <x-button.delete
                                href="{{ route($prefix.'.destroy', ['id' => $item->id]) }}"
                                data-id="{{ $item->id }}"
                            />
                        </td>
                        @foreach($model::getColumns() as $column)
                            <td class="px-6 py-4">
                                @php
                                    $columnName = $column->column();
                                    $value = $item?->$columnName
                                @endphp
                                @if($column instanceof \App\ValueObjects\Master\Banner\Image)
                                    <div class="flex w-full space-x-2 flex-row items-center">
                                        <div class="w-28 h-28 rounded-full border border-gray-200 flex justify-center items-center">
                                            @if($item->image)
                                                <img src="{{ $item->image_url }}" alt="profile-icon" class="w-full h-full">
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
                </tbody>
            </table>
            {{ $items->links() }}
        </div>
    </div>
@endsection
