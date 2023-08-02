@extends('layout')

@section('title', 'Login')
@section('content')
    Login
    <div class="">
        <form action="{{ route('login.store') }}" method="post">
            @csrf
            <div>
                <label for="email">
                    Email
                </label>
                <input type="email" placeholder="Email" id="email" name="email"
                    value="{{ Session::get('email') ?? '' }}">
            </div>
            <div>
                <label for="password">Password</label>
                <input type="password" name="password" id="password" placeholder="Password">
            </div>
            <button>login</button>
        </form>
        <a href="{{ route('password.request') }}">Forgot password?</a>
    </div>
@endsection
