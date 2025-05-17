@extends('kimono::layout')

@section('contents')
<div class="w-full p-8 bg-[var(--color-white)] rounded-lg {{ $container }}">
    <button
        class="contents__form__back text-sm text-[var(--color-white)] bg-[var(--color-gray)] rounded-lg border border-[var(--color-gray)] p-2 mb-4"
        onclick="history.back()"
        type="button"
    >
        {{ __('kimono::admin.back')  }}
    </button>

    <h1 class="contents__title text-2xl py-4 px-2 text-[var(--color-black)]">
        {{ $model::archetype() }}
    </h1>
    <form class="mt-6 py-2 px-2" action="{{ route("{$route}.store") }}" method="post" enctype="multipart/form-data">
        @csrf
        <x-kimono::forms.form
            class="contents__form__create"
            :columns="$columns"
            :model="$model"
        />
    </form>
</div>
@endsection
