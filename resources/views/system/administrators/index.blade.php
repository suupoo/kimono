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
        $routePrefix = $prefix ?? $model->getTable();
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

                        @if($column instanceof \App\ValueObjects\Column\Master\Administrator\Id)
                            {!! $column->input(['class' => 'no-spinner']) !!}
                        @endif

                        @if($column instanceof \App\ValueObjects\Column\Master\Administrator\Name)
                            {!! $column->input(['class' => '']) !!}
                        @endif

                        @if($column instanceof \App\ValueObjects\Column\Master\Administrator\Email)
                            {!! $column->input(['class' => '']) !!}
                        @endif

                        @if($column instanceof \App\ValueObjects\Column\Master\Administrator\EmailVerifiedAt)
                            {!! $column->input(['class' => '']) !!}
                        @endif

                        @if($column instanceof \App\ValueObjects\Column\Master\Administrator\Role)
                            {!! $column->input(['class' => '']) !!}
                        @endif

                        @if($column instanceof \App\ValueObjects\Column\Master\Administrator\StartAt)
                            {!! $column->input(['class' => '', 'type' => 'date']) !!}
                        @endif

                        @if($column instanceof \App\ValueObjects\Column\Master\Administrator\EndAt)
                            {!! $column->input(['class' => '', 'type' => 'date']) !!}
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
                <x-button.create type="link" type="link" href="{{ route($routePrefix . '.create') }}"/>
            </div>
        </div>
        <div class="relative overflow-x-auto">
            <table class="w-full mt-2 border rounded-xl text-sm text-left rtl:text-right text-gray-500">
                <thead class="text-xs text-white uppercase bg-gray-700">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        {{ __('resource.operation') }}
                    </th>

                    <th scope="col" class="px-3 py-3 text-center">
                        {{ __('resource.operation-relation') }}
                    </th>

                    @foreach($model::getColumns() as $column)
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
                </thead>
                <tbody>

                @foreach($items as $item)
                    <tr>
                        <td class="actions">
                            <x-button.edit type="link" href="{{ route($routePrefix . '.edit', ['id' => $item->id]) }}"/>
                            <x-button.show type="link" href="{{ route($routePrefix . '.show', ['id' => $item->id]) }}"/>
                            <x-button.copy type="link"
                                           href="{{ route($routePrefix . '.create', ['copy' => $item->id]) }}"/>
                            @if(\Illuminate\Support\Facades\Auth::user()->id !== $item->id && $item->role !== \App\Enums\AdministratorRole::SYSTEM)
                                <x-button.delete
                                    href="{{ route($routePrefix . '.destroy', ['id' => $item->id]) }}"
                                    data-id="{{ $item->id }}"
                                />
                            @endif
                        </td>

                        <td class="px-3 py-4 text-xs m-1 w-full">
                            <x-button.relation
                                href="{{ route($routePrefix . '.companies.list', ['id' => $item->id]) }}">
                                {{ __('menu.system.administrators.companies.list') }}
                            </x-button.relation>
                        </td>

                        @foreach($model::getColumns() as $column)
                            <td class="column">
                                @php
                                    $columnName = $column->column();
                                    $value = $item?->$columnName
                                @endphp
                                @if($value instanceof UnitEnum )
                                    {{ $value->label() }}
                                @else
                                    @if($column instanceof \App\ValueObjects\Column\Master\Administrator\Password)
                                        {{-- $columnsがパスワードカラムの場合は********を表示 --}}
                                        ********
                                    @else
                                        {{ $item?->$columnName }}
                                    @endif
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
