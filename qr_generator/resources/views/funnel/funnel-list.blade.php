@extends('layout')

@section('title', 'Companies')

@section('content')
    <a href="{{ route('funnel.create') }}">Add Funnels</a>
    @if ($funnels)
        @foreach ($funnels as $funnel)
            <div>{{ $funnel['field_name'] }}</div>
            <div>{{ $funnel['operator'] }}</div>
            <div>{{ $funnel['value'] }}</div>
            <div>{{ $funnel['value_range_from'] }}</div>
            <div>{{ $funnel['value_range_to'] }}</div>
            <div>{{ $funnel['logic_operator'] ?? '-' }}</div>
            <hr>
        @endforeach
    @else
        No Funnels yet
    @endif
@endsection
