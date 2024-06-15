@extends('layouts')

@section('content')
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
                // 検索可能カラムコレクションをカラム名配列に変換
                $arraySearchable = [];
                foreach($searchable as $value) {
                    $arraySearchable[] = $value->column();
                }
            @endphp
            @if(in_array($column->column(), $arraySearchable))

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
        {{ $model::NAME . __('resource.list') }}
    </h3>
    <div class="w-full flex my-2 justify-end">
        <a href="{{ route($model->getTable() . '.create') }}" class="bg-green-500 text-white rounded-lg p-2">
            {{ __('resource.create') }}
        </a>
    </div>
    <div class="relative overflow-x-auto">
        <table class="w-full border rounded-xl text-sm text-left rtl:text-right text-gray-500">
            <thead class="text-xs text-white uppercase bg-gray-700">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        {{ __('resource.operation') }}
                    </th>
                    @foreach($model::getColumns() as $column)
                    <th scope="col" class="px-6 py-3">
                        <div class="flex w-full items-center justify-center space-x-1">
                            @if(in_array($column->column(), $arraySortable))
                                <a
                                    class="p-0.5 @if($sort === $column->column() && $order == 'asc' ) bg-red-400 text-white @else bg-gray-100 text-gray-400 @endif
                            "
                                    href="{{ route($currentRouteName, ['sort' => $column->column(), 'order' => 'asc'])}}"
                                >
                                    @include('components.list.icons.sort-up')
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
                                    @include('components.list.icons.sort-down')
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
                    <td class="px-2 py-4 text-xs flex flex-col justify-center space-y-1">
                        <a href="{{ route($model->getTable() . '.edit', ['id' => $item->id]) }}" class="text-blue-500 p-0.5 text-center border border-blue-500">
                            {{ __('resource.edit') }}
                        </a>
                        <a href="{{ route($model->getTable() . '.show', ['id' => $item->id]) }}" class="text-gray-500 p-0.5 text-center border border-gray-500">
                            {{ __('resource.show') }}
                        </a>
                        <button  data-modal-target="popup-modal" data-modal-toggle="popup-modal" class="text-red-500 p-0.5 text-center border border-red-500">
                            {{ __('resource.delete') }}
                        </button>

                        <div id="popup-modal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div class="relative p-4 w-full max-w-md max-h-full">
                                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                    <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="popup-modal">
                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                        </svg>
                                        <span class="sr-only">Close modal</span>
                                    </button>
                                    <div class="p-4 md:p-5 text-center">
                                        <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                        </svg>
                                        <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">{{ __('resource.is_delete_selected_data') }}</h3>

                                        <form method="post" action="{{ route($model->getTable() . '.destroy', ['id' => $item->id]) }}">
                                            @csrf
                                            @method('delete')
                                            <input type="hidden" name="search" value="{{ \Illuminate\Support\Facades\Crypt::encrypt(request()->all()) }}">

                                            <input type="submit"
                                                   class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center"
                                                   value="{{ __('resource.delete') }}"
                                            >
                                        </form>
                                        <button data-modal-hide="popup-modal" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                                            {{ __('resource.cancel') }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
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
