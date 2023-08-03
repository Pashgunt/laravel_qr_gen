@extends('layout')

@section('title', 'Qr List')

@section('content')
    @if ($qr)
        @foreach ($qr as $qrItem)
            <div>{{ $qrItem->link }}</div>
            <div>{{ $qrItem->svg_file_path }}</div>
            <div>{{ $qrItem->file_path }}</div>
            <div>
                <a href="{{ route('qr.show', ['link_id' => $qrItem->link_id]) }}">Show Detai Info</a>
                <a href="{{ route('qr.edit', ['link_id' => $qrItem->link_id]) }}">Edit Qr Code</a>
                <form action="{{ route('qr.destroy', ['link_id' => $qrItem->link_id]) }}" method="POST">
                    @csrf
                    @method('delete')
                    <button>Delete Company</button>
                </form>
                <a
                    href="{{ route('download', [
                        'folder' => current(explode('/', $qrItem->file_path)),
                        'file' => $qrItem->file_name,
                    ]) }}">Download
                    PDF</a>
                <a
                    href="{{ route('download', [
                        'folder' => current(explode('/', $qrItem->svg_file_path)),
                        'file' => $qrItem->svg_file_name,
                    ]) }}">Download
                    SVG</a>
            </div>
            <hr>
        @endforeach
        {{ $qr->links() }}
    @else
        No QR yet
    @endif
@endsection
