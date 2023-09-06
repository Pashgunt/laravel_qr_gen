@extends('layout')
@section('title', 'Verified')

@section('content')
    Для подтверждения почты перейдите по ссылке из письма
    Ссылка на подтверждение создание аакаунта была отправлена на почту {{ Auth::user()->email }}
    Если письма не пришло, нажите
    <form action="{{ route('verification.send') }}" method="post" class="resend_verification">
        <button>Отправить ещё раз</button>
    </form>
    <span class="timer"></span>
@endsection

@vite('resources/js/verify-email.js')
