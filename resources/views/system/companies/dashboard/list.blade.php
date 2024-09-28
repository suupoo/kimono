@extends('layouts')

@section('content')
    <form action="{{ route('me.company.save') }}" method="post" class="flex flex-col py-2">
        @csrf
        @if ($errors->any())
            <div class="error">
                @foreach($errors->all() as $error)
                    <div class="text-red-500">{{ $error }}</div>
                @endforeach
            </div>
        @endif
        <h1 class="text-xl font-bold">
            {{ __('Company Dashboard') }}
        </h1>

        <div class="flex flex-col w-full mt-4">
            @php
                $dashboard = (new \App\ValueObjects\Column\Master\CompanyDashboard\Dashboard);
                $dashboardColumn = $dashboard->column();
                $dashboardValue  = $model?->$dashboardColumn;
            @endphp

            {!! $dashboard->input(['required' => false, 'value' => $dashboardValue]) !!}

        </div>
        <x-button.store/>
    </form>
@endsection
