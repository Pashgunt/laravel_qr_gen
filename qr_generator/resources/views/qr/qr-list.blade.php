@extends('layout')

@section('title', 'Qr List')

@section('content')
    <a href="{{ route('qr.create') }}">Add Qr Codes</a>
    @if ($qr)
        <a href="#" class="qr_update">Update Selected Qr Codes</a>
        @foreach ($qr as $qrItem)
            <div>
                <input type="checkbox" name="link_ids[]" id="links_ids" class="link_ids" value="{{ $qrItem->link_id }}">
                <div>{{ $qrItem->link }}</div>
                <div>{{ $qrItem->svg_file_path }}</div>
                <div>{{ $qrItem->file_path }}</div>
                <div>
                    <a href="{{ route('qr.show', ['link_id' => $qrItem->link_id]) }}">Show Detai Info</a>
                    <a
                        href="{{ route('qr.edit', [
                            'link_id' => $qrItem->link_id,
                        ]) }}">Update
                        Qr Code</a>
                    <form action="{{ route('qr.destroy', ['link_id' => $qrItem->link_id]) }}" method="POST">
                        @csrf
                        @method('delete')
                        <button>Delete QR</button>
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
            </div>
            <hr>
        @endforeach
        {{ $qr->links() }}
    @else
        No QR yet
    @endif
@endsection

@section('js', '/assets/js/qr.js')
