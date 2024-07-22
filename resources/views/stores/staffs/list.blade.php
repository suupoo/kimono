@extends('layouts')

@section('content')
    <form action="{{ route('stores.staffs.save', ['id' => $model->id, ]) }}" method="post" class="flex flex-col py-2">
        @csrf
        @if ($errors->any())
            <div class="error">
                @foreach($errors->all() as $error)
                    <div class="text-red-500">{{ $error }}</div>
                @endforeach
            </div>
        @endif
        <h1 class="text-xl font-bold">
            {{ __('menu.stores.staffs.list') }}
        </h1>
        <div class="flex flex-col w-full space-y-0.5 my-2">
            <x-list.simple>
                @foreach($storeStaffList as $staffStaff)
                <x-list.simple-item>
                    {{ $staffStaff->name }}
                </x-list.simple-item>
                @endforeach
            </x-list.simple>
        </div>
        {{-- 追加するスタッフ --}}
        <h1 class="text-xl font-bold">
            {{ __('the staff to add to the store') }}
        </h1>
        <div class="flex flex-col w-full my-2">
            <div class="w-full">
                {{ __('Please select the staff to add to the store.') }}
            </div>

            <x-list.simple>
                @foreach($staffList as $staff)
                    <x-list.simple-item>
                        @php
                            $attributes = [
                                'id'   => "staffs-$staff->id",
                                'name' => "staffs[]",
                                'type' => 'checkbox',
                                'value' => $staff->id,
                                'label' => $staff->name,
                                'class' => 'checkbox-staffs',
                                'checked' => $storeStaffList->contains($staff->id)
                            ];
                        @endphp
                        {!!
                            \App\Facades\Utility\CustomForm::make()
                            ->input($attributes)
                            ->label($attributes)
                            ->render()
                         !!}
                    </x-list.simple-item>
                @endforeach
            </x-list.simple>
        </div>
        <x-button.store/>
    </form>
@endsection
