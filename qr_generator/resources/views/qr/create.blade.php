@extends('layout')
@section('title', 'QrCode Gen')

@section('content')
    <form action="{{ route('qr.store') }}" method="POST">
        @csrf
        <label for="company_id">Companies</label>
        <select name="company_id" id="company_id">
            <option value="">Select company</option>
            @foreach ($companies as $company)
                <option value="{{ $company->id }}" @selected(Request::get('company_id') == $company->id)>
                    {{ $company->name }}</option>
            @endforeach
        </select>
        <div>
            <input type="checkbox" name="create_new_company" id="create_new_company">
            <label for="create_new_company" class="form-label">Choose company from created list yet</label>
        </div>
        <div class="row mb-3">
            <input type="text" placeholder="Название заведения" class="form-control" name="name">
        </div>
        <div class="row">
            <input type="text" placeholder="Адресс" class="form-control" name="adress">
        </div>
        <div class="row">
            <input type="text" placeholder="Ссылка на сайт" class="form-control" name="link">
        </div>
        <div class="row g-3">
            <input type="checkbox" name="places_sit_areas" id="places_sit_areas">
            <label for="places_sit_areas" class="form-label">Нужна разметка по посадочным местам</label>
        </div>
        <div class="">
            <label for="" class="form-label">Укажите диапазон номеров столов</label>
            <div class="">
                <input type="text" name="place_sit_from" id="" placeholder="От">
                <input type="text" name="place_sit_to" id="" placeholder="До">
            </div>
            <input type="checkbox" id="" value="">
            <label for="" class="form-label">Указать номера столов по одному</label>
            <div class="">
                <input type="text" name="place_sit_number[]" id="" placeholder="Номер стола">
                <a href="">+</a>
            </div>
        </div>
        <button>Send</button>
    </form>
@endsection
