@extends('layout')

@section('title', 'Организации')

@section('home')
    <x-dashboard.company.company-list :companies="$companies" />
@endsection
