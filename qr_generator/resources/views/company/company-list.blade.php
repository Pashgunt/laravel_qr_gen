@extends('layout')

@section('title', 'Companies')

@section('content')
    <a href="{{ route('qr.create') }}">Create New Company</a>
    @if ($companies)
        @foreach ($companies as $company)
            <div>{{ $company->name }}</div>
            <div>{{ $company->adress }}</div>
            <div>{{ $company->link }}</div>
            <div class="">
                <a href="{{ route('company.show', ['company_id' => $company->id]) }}">Show Full Company Info</a>
            </div>
            <div class="">
                <a href="{{ route('funnel.create', ['company_id' => $company->id]) }}">Add Funnels</a>
            </div>
            <div class="">
                <a href="{{ route('company.edit', ['company_id' => $company->id]) }}">Edit Company</a>
            </div>
            <form action="{{ route('company.destroy', ['company_id' => $company->id]) }}" method="POST">
                @csrf
                @method('delete')
                <button>Delete Company</button>
            </form>
            <a href="#">Add Qr Codes</a>
            <hr>
        @endforeach
        {{ $companies->links() }}
    @else
        No Company yet
    @endif
@endsection
