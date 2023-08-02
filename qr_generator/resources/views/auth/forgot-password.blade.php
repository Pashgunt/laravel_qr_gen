@extends('layout')

@section('title','Forgot Password')

@section('content')
    Forgot Password
    <div class="">
        <form action="{{route('password.email')}}" method="POST">
            @csrf
            <label for="email">
                укажит почту на которую зарегистрирован аккаунт
            </label>
            <input type="email" placeholder="Email" name="email" id="email">
            <button>send</button>
        </form>
    </div>
@endsection