@extends('layout')

@section('title', 'Qr Edit')

@section('content')
    Qr Update
    <div>{{ $qr->link }}</div>
    <div>{{ $qr->svg_file_path }}</div>
    <div>{{ $qr->file_path }}</div>
    <form action="{{ route('qr.update', ['link_id' => $qr->id]) }}" method="post">
        @csrf
        @method('put')
        <button>Update</button>
    </form>
@endsection
