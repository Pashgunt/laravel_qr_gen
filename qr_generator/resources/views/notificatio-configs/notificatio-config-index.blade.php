@extends('layout')

@section('title', 'Notification confg')

@section('content')
<a href="{{ route('notification-config.create') }}">Create new</a>
    @foreach ($configs as $config)
        <div>
            {{ $config->name }}
            {{ $config->email }}
            <a href="{{ route('notification-config.edit', ['notification_config' => $config->notification_id]) }}">Edit</a>
            <form action="{{ route('notification-config.destroy', ['notification_config' => $config->notification_id]) }}"
                method="post">
                @csrf
                @method('DELETE')
                <button>Delete</button>
            </form>
        </div>
    @endforeach
@endsection
