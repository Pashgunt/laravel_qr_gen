@extends('layout')

@section('title', 'Company edit')

@section('content')
    Edit Company
    <form action="{{ route('company.update', ['company' => $company->id]) }}" method="POST">
        @csrf
        @method('put')
        <div class="row mb-3">
            <input type="text" placeholder="Название заведения" class="form-control" name="name"
                value="{{ $company->name ?? '' }}">
        </div>
        <div class="row">
            <input type="text" placeholder="Адресс" class="form-control" name="adress"
                value="{{ $company->adress ?? '' }}">
        </div>
        <div class="row">
            <input type="text" placeholder="Ссылка на сайт" class="form-control" name="link"
                value="{{$company->link ?? '' }}">
        </div>
        <button>Update</button>
    </form>
@endsection
