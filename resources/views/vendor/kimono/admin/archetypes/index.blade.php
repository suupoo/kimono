{{-- @var $model --}}
{{-- @var $container --}}
{{-- @var $columns --}}
{{-- @var $route --}}
{{-- @var $items --}}
@props(['columns', 'model', 'route', 'items', 'container'])

@extends('kimono::layout')
@section('contents')
<div class="w-full {{ $container }}">
    <h1 class="contents__title font-bold text-2xl my-4">
        {{ $model::archetype().__('kimono::admin.resource') }}
    </h1>
    <div>
        <x-kimono::search-bar.search-bar :model="$model" :columns="$columns" :searchable="$model::searchable()->toArray()" />
    </div>
    <div class="w-full flex justify-end items-center">
        @if( Route::has($route.'.create') )
        @php $onclick = "location.href='".route($route.'.create')."'" @endphp
        <x-kimono::buttons.button
            type="button"
            class="button__create bg-[var(--color-success)] text-[var(--color-white)] p-2 rounded rounded-lg"
            onclick="{!! $onclick !!}"
        >
            {{ __('kimono::admin.create') }}
        </x-kimono::buttons.button>
        @endif
    </div>
    <div class="w-full text-center mt-2">
        <x-kimono::pagerows.pagerows :request="request()" :route="$route" />
    </div>
    <table class="mt-5 table-auto overflow-x-scroll">
        <thead class="contents__table-head ">
            <tr class="contents__table-head__row ">
                @foreach($columns as $column)
                <td class="contents__table-head__col p-2 border border-[var(--color-black)]">
                    {{ $column['form']['label'] }}
                </td>
                @endforeach
                <td class="contents__table-head__col p-2 border border-[var(--color-black)]">
                    {{ __('kimono::admin.actions') }}
                </td>
            </tr>
        </thead>
        <tbody class="contents__table-body">
            @foreach($items as $item)
            <tr class="contents__table-body__row ">
                @foreach($columns as $column)
                @php $columnName = $column['db']['name'] @endphp
                <td class="contents__table-body__col p-2 border border-[var(--color-black)]">
                    {{ $item->schemaFormatter($columnName) }}
                </td>
                @endforeach
                <td class="contents__table-body__col w-[300px] p-2 border border-[var(--color-black)]">
                    <a href="{{ route("{$route}.create", ['copy' => $item->id]) }}" class="">
                        {{ __('kimono::admin.copy') }}
                    </a>

                    <a href="{{ route("{$route}.edit", ['id' => $item->id]) }}" class="">
                        {{ __('kimono::admin.edit') }}
                    </a>

                    <a href="{{ route("{$route}.show", ['id' => $item->id]) }}" class="">
                        {{ __('kimono::admin.show') }}
                    </a>

                    <form action="{{ route("{$route}.destroy", ['id' => $item->id]) }}" method="post" class="">
                        @php $onClickScript = "return confirm('".__('kimono::admin.delete-confirm')."') && (this.disabled=true, this.form.submit(), false)" @endphp
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="" onclick="{{ $onClickScript }}">
                            {{ __('kimono::admin.delete') }}
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="w-full text-center mt-2">
        {{ $items->links('kimono::components.pagination.tailwind') }}
    </div>
</div>
@endsection
