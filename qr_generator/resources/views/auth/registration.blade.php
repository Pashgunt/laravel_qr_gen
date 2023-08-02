@extends('layout')

@section('title', 'Registration')

@section('content')
    Registration
    <div class="">
        <form action="{{ route('registration.store') }}" method="post">
            @csrf
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
            <button>registration</button>
        </form>
    </div>
@endsection
