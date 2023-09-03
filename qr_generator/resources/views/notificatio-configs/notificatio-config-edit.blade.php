@extends('layout')

@section('title', 'Notification confg')

@section('content')
    <form action="{{ route('notification-config.update', ['notification_config' => $config->id]) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="company_id">company</label>
        <select name="company_id" id="company_id">
            <option value="">select company</option>
            @foreach ($companies as $company)
                <option value="{{ $company->id }}" @selected($company->id === $config->company_id)>{{ $company->name }}</option>
            @endforeach
        </select>
        <label for="email">email</label>
        <input type="text" name="email" id="email" placeholder="Email" value="{{ $config->email ?? '' }}">
        <label for="send_positive">Positive</label>
        <input type="checkbox" name="send_positive" id="send_positive" @checked($config->is_send_positive)>
        <label for="send_negative">Negative</label>
        <input type="checkbox" name="send_negative" id="send_negative" @checked($config->is_send_negative)>
        <button>update</button>
    </form>
@endsection
