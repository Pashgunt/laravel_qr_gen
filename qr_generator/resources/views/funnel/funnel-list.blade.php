@extends('layout')

@section('title', 'Companies')

@section('content')
    <a href="{{ route('funnel.create') }}">Add Funnels</a>
    @if ($funnels)
        @foreach ($funnels as $funnel)
            <div>{{ $funnel['field_name'] }}</div>
            <div>{{ $funnel['operator'] }}</div>
            <div>{{ $funnel['value'] ?? '-' }}</div>
            <div>{{ $funnel['value_range_from'] ?? '-' }}</div>
            <div>{{ $funnel['value_range_to'] ?? '-' }}</div>
            <div>{{ $funnel['logic_operator'] ?? '-' }}</div>
            <a href="{{ route('funnel.edit', ['funnel_id' => $funnel['funnel_config_id']]) }}">Funnel edit</a>
            <a href="{{ route('funnel.edit.field', ['field_id' => $funnel['funnel_field_id']]) }}">Field edit</a>
            <form action="{{ route('funnel.destroyField', ['field_id' => $funnel['funnel_field_id']]) }}" method="POST">
                @csrf
                @method('DELETE')
                <button>delete field</button>
            </form>
            <form action="{{ route('funnel.destroyFunnel', ['funnel_id' => $funnel['funnel_config_id']]) }}" method="POST">
                @csrf
                @method('DELETE')
                <button>delete funnel</button>
            </form>
            <hr>
        @endforeach
    @else
        No Funnels yet
    @endif
@endsection
