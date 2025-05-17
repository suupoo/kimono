@extends('kimono::layout')

@section('contents')
<div class="kimono__term__{{ $className }}">
    <x-kimono-text-scroller>
        {!! $content !!}
    </x-kimono-text-scroller>
</div>
@endsection
