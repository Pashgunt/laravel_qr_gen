@extends('layout')

@section('title', 'Feedbacks')

@section('content')
    <a href="#">Add Fakers Feedbacks</a>
    @if ($feedbacks)
        @foreach ($feedbacks as $feedback)
            <div>{{ $feedback->rating }}</div>
            <div>{{ $feedback->feedback_text }}</div>
            <div>{{ $feedback->feedback_user_name }}</div>
            <hr>
        @endforeach
        {{ $feedbacks->links() }}
    @else
        No Feedback yet
    @endif
@endsection
