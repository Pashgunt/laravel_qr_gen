@component('mail::message')
Посетитель оставил отзыв на сервисе {{ config('app.name') }}

@component('mail::panel')
Оставлен новый {{ $filterResult['result'] ? 'положительный' : 'негативный' }} отзыв <br>
{{ $filterResult['description'] }}
<p>
    Текст отзыва: <br>
    {{ $feedback->feedback_text }}
</p>
@endcomponent