@component('mail::message')
Вы успешно зарегистрировались на сервисе {{ config('app.name') }}

@component('mail::panel')
Для подтверждения регистрации передите по ссылке ниже
@endcomponent

@component('mail::button', ['url' => $link])
Подтвердить регистрацию
@endcomponent

Спаисбо за выбор нашего сервиса,<br>
{{ config('app.name') }}
@endcomponent