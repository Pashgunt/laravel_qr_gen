@extends('layout')

@section('title', 'Qr Detail')

@section('content')
    Qr Detail Info Page
    <div>{{ $qr->link }}</div>
    <div>{{ $qr->svg_file_path }}</div>
    <div>{{ $qr->file_path }}</div>
    <div>
        <a
            href="{{ route('download', [
                'folder' => current(explode('/', $qr->file_path)),
                'file' => $qr->file_name,
            ]) }}">Download
            PDF</a>
        <a
            href="{{ route('download', [
                'folder' => current(explode('/', $qr->svg_file_path)),
                'file' => $qr->svg_file_name,
            ]) }}">Download
            SVG</a>
    </div>
    <hr>
@endsection
