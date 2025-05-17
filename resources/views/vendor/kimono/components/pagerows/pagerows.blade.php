@props([
    'request' => null,
    'route' => null,
    'defaultRows' => 20,
    'RowsList' =>  config('kimono.resources.pagination.list', [20]),
])
<label for="kimono__pagerows">
    {{ __('kimono::admin.pagerows') }}
</label>
<select id="kimono__pagerows" class="kimono__pagerows w-[100px] p-2 border border-[var(--color-gray)] rounded-lg"
        onchange="location.href=this.options[this.selectedIndex].dataset.link"
>
    @foreach($RowsList as $perRows)
        <option
            value="{{ $perRows }}"
            data-link="{{ route($route.".index", array_merge($request->all(), ['rows'=> $perRows])) }}"
            @selected($request->get('rows', $defaultRows) == $perRows)
        >
            {{ $perRows }}
        </option>
    @endforeach
</select>
