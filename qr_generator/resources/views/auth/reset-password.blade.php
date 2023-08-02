@extends('layout')

@section('title', 'New Password')

@section('content')
    Change Password
    <div class="">
        <form action="{{ route('password.update') }}" method="post">
            @csrf
            <input type="text" value="{{ $token }}" hidden name="token" id="token">
            <div>
                <label for="email">
                    Email
                </label>
                <input type="email" placeholder="Email" id="email" name="email">
            </div>
            <div>
                <label for="password">Password</label>
                <input type="password" name="password" id="password" placeholder="Password">
            </div>
            <div>
                <label for="password_confirmation">Re Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Re Password">
            </div>
            <button>change password</button>
        </form>
    </div>
@endsection
