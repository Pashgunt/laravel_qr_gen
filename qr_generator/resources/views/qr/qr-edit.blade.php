@extends('layout')

@section('title', 'Qr Edit')

@section('content')
    Qr Edit
    <div>{{ $qr->link }}</div>
    <div>{{ $qr->svg_file_path }}</div>
    <div>{{ $qr->file_path }}</div>
    <form action="{{ route('qr.update', ['link_id' => $qr->id]) }}" method="post">
        @csrf
        @method('put')
        <div>
            <label for="update_link">update link
                <input type="checkbox" name="update_link" id="update_link" value="1" />
            </label>
            <label for="update_view"> update view
                <input type="checkbox" name="update_view[]" id="update_view" value="1" />
            </label>
        </div>
        <button>Update</button>
    </form>
@endsection
