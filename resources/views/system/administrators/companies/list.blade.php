@extends('layouts')

@section('content')
    <form action="{{ route($prefix.'.companies.save', ['id' => $model->id, ]) }}" method="post" class="flex flex-col py-2">
        @csrf
        @if ($errors->any())
            <div class="error">
                @foreach($errors->all() as $error)
                    <div class="text-red-500">{{ $error }}</div>
                @endforeach
            </div>
        @endif
        <h1 class="text-xl font-bold">
            {{ __('menu.system.administrators.companies.list') }}
        </h1>
        <div class="flex flex-col w-full space-y-0.5 my-2">
            <x-list.simple>
                @foreach($systemAdministratorsCompaniesList as $systemAdministratorsCompany)
                <x-list.simple-item>
                    {{ $systemAdministratorsCompany->name }}
                </x-list.simple-item>
                @endforeach
            </x-list.simple>
        </div>
        {{-- 追加するスタッフ --}}
        <h1 class="text-xl font-bold">
            {{ __('the administrator to add to the company') }}
        </h1>
        <div class="flex flex-col w-full my-2">
            <div class="w-full">
                {{ __('Please select the administrator to add to the company.') }}
            </div>

            <x-list.simple>
                @foreach($systemCompaniesList as $systemCompany)
                    <x-list.simple-item>
                        @php
                            $attributes = [
                                'id'   => "system-companies-$systemCompany->id",
                                'name' => "system_companies[]",
                                'type' => 'checkbox',
                                'value' => $systemCompany->id,
                                'label' => $systemCompany->name,
                                'class' => 'checkbox-system-companies',
                                'checked' => $systemAdministratorsCompaniesList->contains($systemCompany->id)
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
