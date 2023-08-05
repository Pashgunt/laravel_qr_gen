@extends('layout')

@section('title', 'Feedbacks')

@section('content')
    @if ($feedbacks)
        @foreach ($feedbacks as $feedback)
            <div>{{ $feedback->rating }}</div>
            <div>{{ $feedback->feedback_text }}</div>
            <div>{{ $feedback->feedback_user_name }}</div>
            <form action="{{ route('feedback.destroy', ['id' => $feedback->id]) }}" method="POST">
                @csrf
                @method('DELETE')
                <button>Delete</button>
            </form>
            <hr>
        @endforeach
        {{ $feedbacks->links() }}
    @else
        No Feedback yet
    @endif
@endsection
