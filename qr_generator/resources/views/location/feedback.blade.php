@extends('layout')
@section('title', 'Feedback Form')

@section('content')
    <div class="">{{ $data['rating'] }}</div>
    <div class="">
        {{ $data['company_name'] }} @if ($data['company_table_number'])
            Стол {{ $data['company_table_number'] }}
        @endif
    </div>
    <div class="">
        {{ $data['company_address'] }}
    </div>
    <div>
        @if ($data['company_link'])
            {{ $data['company_link'] }}
        @endif
    </div>
    Оставьте отзыв
    <form action="{{ route('location.store', ['qr' => app('request')->route()->parameters('qr')['qr']]) }}" method="POST">
        @csrf
        <input type="number" name="rating" placeholder="Оцените от 1 до 10">
        <textarea name="feedback_text" id="feedback_text" cols="30" rows="10" placeholder="Текст отзыва"></textarea>
        <input type="text" name="name" id="name" placeholder="Имя">
        <label for="contact">Хотите, чтобы с Вами связались?</label>
        <input type="text" name="contact" id="contact" placeholder="Телефон или почта">
        <button>Отправить</button>
    </form>
    <span>
        Нажимая на кнопку "Отправить", вы даёте согласие на оьработку персональных данных и соглашаетесь с <a
            href="">политикой конфиденциальности</a>
    </span>
    <div class="">
        @foreach ($data['feedback_list'] as $feedback)
            <div class="">
                {{ $feedback->rating }}
                {{ $feedback->feedback_text }}
            </div>
        @endforeach
    </div>
    <a href="">Сервис предоставлен .....</a>
@endsection
