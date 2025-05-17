@extends('kimono::layout')

@props(['columns', 'model', 'route', 'items', 'container'])

@section('contents')
<div class="w-full {{ $container }}">
    <h1 class="contents__title font-bold text-2xl my-4">
        {{ $model::archetype().__('kimono::admin.index') }}
    </h1>
    <div class="w-full flex justify-end items-center">
        @if( Route::has($route.'.entry') && $items->isEmpty() )
        @php $onclick = "location.href='".route($route.'.entry')."'" @endphp
        <x-kimono::buttons.button
            type="button"
            class="button__create bg-[var(--color-success)] text-[var(--color-white)] p-2 rounded rounded-lg"
            onclick="{!! $onclick !!}"
        >
            {{ __('kimono::admin.entry') }}
        </x-kimono::buttons.button>
        @endif
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
                    <a href="{{ route("{$route}.entry", ['id' => $item?->id]) }}" class="">
                        {{ __('kimono::admin.entry') }}
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
