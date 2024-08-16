@extends('layouts')

@section('content')
<div class="term">

    <h1 class="custom-headline">
        {{ __('Terms of service') }}
    </h1>

    <x-scrollbar.simple maxHeight="200px">
        <div class="flex flex-col space-y-2">
            <div>
                <p class="font-bold">免責事項</p>
                <ul>
                    <li>本システム...</li>
                </ul>
            </div>

            <div>
                <p class="font-bold">XXXXXXX︎</p>
                <ul>
                    <li>XXXXXXX︎...</li>
                </ul>
            </div>
        </div>
    </x-scrollbar.simple>

</div>
@endsection
