@extends('layout');
@section('title', 'Feedback Form')

@section('content')
    Оставьте отзыв 
    <input type="number" name="rating" placeholder="Оцените от 1 до 10">
    <textarea name="feedback_text" id="feedback_text" cols="30" rows="10" placeholder="Текст отзыва"></textarea>
    <input type="text" name="name" id="name" placeholder="Имя">
    <label for="contact">Хотите, чтобы с Вами связались?</label>
    <input type="text" name="cotact" id="contact" placeholder="Телефон или почта">
    <button>Отправить</button>
    <span>
        Нажимая на кнопку "Отправить", вы даёте согласие на оьработку персональных данных и соглашаетесь с <a href="">политикой конфиденциальности</a>
    </span>
    <a href="">Сервис предоставлен .....</a>
@endsection
