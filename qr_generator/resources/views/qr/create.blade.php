@extends('layout')
@section('title', 'QrCode Gen')

@section('content')
    <form action="{{route('qr.store')}}" method="POST">
        @csrf
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
            <div class="col-auto">
                <input type="checkbox" name="places_sit_areas" id="places_sit_areas">
            </div>
            <div class="col-auto">
                <label for="places_sit_areas" class="form-label">Нужна разметка по посадочным местам</label>
            </div>
        </div>
        <div class="">
            <label for="" class="form-label">Укажите диапазон номеров столов</label>
            <div class="">
                <input type="text" name="place_sit_from" id="" placeholder="От">
                <input type="text" name="place_sit_to" id="" placeholder="До">
            </div>
            <div class="">
                <input type="text" name="place_sit_number[]" id="" placeholder="Номер стола">
                <input type="text" name="place_sit_number[]" id="" placeholder="Номер стола">
                <a href="">+</a>
            </div>
            <label for="" class="form-label">Указать номера столов по одному</label>`
            <input type="checkbox" id="" value="">
        </div>
        <button>Send</button>
    </form>
@endsection
