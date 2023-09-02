@extends('layout')

@section('title', 'Page settings')

@section('content')
    <a href="{{ route('page-settings.create') }}">Create New Page Setting</a>
@endsection
