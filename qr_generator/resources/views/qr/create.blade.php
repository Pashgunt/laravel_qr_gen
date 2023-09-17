@extends('layout')

@section('title', 'Добавление организации')

@section('home')
    <div x-data="{ show: true }">
        <x-dashboard.company.company-list :companies="$companies" />
        <x-dashboard.components.side-over title="Создание новой организации"
            subtitle="Создайте новую организацию для контроля отзывов. Также через этот интерфейс Вы можете добавлять QR кода для организации." route="company.index">
            <x-dashboard.company.c-r-u-d.create :companies="$companies"/>
        </x-dashboard.components.side-over>
    </div>
@endsection

@vite('resources/js/company.js')