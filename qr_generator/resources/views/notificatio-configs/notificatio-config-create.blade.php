@extends('layout')

@section('title', 'Notification confg')

@section('content')
    <form action="{{ route('notification-config.store') }}" method="POST">
        @csrf
        <label for="company_id">company</label>
        <select name="company_id" id="company_id">
            <option value="">select company</option>
            @foreach ($companies as $company)
                <option value="{{ $company->id }}" >{{ $company->name }}</option>
            @endforeach
        </select>
        <label for="email">email</label>
        <input type="text" name="email" id="email" placeholder="Email">
        <label for="send_positive">Positive</label>
        <input type="checkbox" name="send_positive" id="send_positive">
        <label for="send_negative">Negative</label>
        <input type="checkbox" name="send_negative" id="send_negative">
        <button>Create</button>
    </form>
@endsection
