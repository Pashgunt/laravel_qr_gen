@extends('layout')

@section('title', 'Company Info')

@section('content')
Company info
    <div>{{ $companyData['company']->name }}</div>
    <div>{{ $companyData['company']->adress }}</div>
    <div>{{ $companyData['company']->link }}</div>
    <hr>
    <h2>Qr</h2>
    @if ($companyData['qr'])
        @foreach ($companyData['qr'] as $qrItem)
            <div>{{ $qrItem->link }}</div>
            <div>{{ $qrItem->svg_file_path }}</div>
            <div>{{ $qrItem->file_path }}</div>
            <hr>
        @endforeach
        {{ $companyData['qr']->links() }}
    @else
        No QR yet
    @endif
    <h2>Feedback</h2>
    @if ($companyData['feedback'])
        @foreach ($companyData['feedback'] as $feedback)
            <div>{{ $feedback->rating }}</div>
            <div>{{ $feedback->feedback_text }}</div>
            <div>{{ $feedback->feedback_user_name }}</div>
            <hr>
        @endforeach
        {{ $companyData['feedback']->links() }}
    @else
        No Feedback yet
    @endif
    <hr>
    <h2>Funnel</h2>
    @if ($companyData['funnel'])
        @foreach ($companyData['funnel'] as $funnel)
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
