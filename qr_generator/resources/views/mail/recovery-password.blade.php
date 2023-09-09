@component('mail::message')
Смена пароля {{ config('app.name') }}

@component('mail::panel')
Для смены пароля передите по ссылке ниже
@endcomponent

@component('mail::button', ['url' => $link])
Сменить пароль
@endcomponent