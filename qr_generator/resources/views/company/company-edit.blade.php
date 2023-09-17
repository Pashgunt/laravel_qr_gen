@extends('layout')

@section('title', 'Company edit')

@section('home')
    <div x-data="{ show: true }">
        <x-dashboard.company.company-list :companies="$companies" />
        <x-dashboard.components.side-over title="Изменение данных организации"
            subtitle="Здесь Вы можете изменить основные данные об организации" route="company.index">
            <x-dashboard.company.c-r-u-d.edit :company="$company" />
        </x-dashboard.components.side-over>
    </div>
@endsection
