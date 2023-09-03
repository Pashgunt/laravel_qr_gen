@extends('layout')

@section('title', 'Page setting create')

@section('content')
    <form action="{{ route('page-settings.updateLink', ['link_id' => $link->id]) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="map_wrapper">
            <label for="map_links">Map Setting Links</label>
            <input type="text" id="map_link" name="map_link" placeholder="Map link" value="{{ $link->link }}">
            <input type="text" id="map_name" name="map_name" placeholder="Map name" value="{{ $link->link_title }}">
        </div>
        <button>update</button>
    </form>
@endsection

@section('js', '/assets/js/page-setting.js')
