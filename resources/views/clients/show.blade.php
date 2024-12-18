@extends('layouts.app')

@section('content')
    <h1>{{ $client->name }}</h1>
    <img src="{{ $client->client_logo }}" alt="{{ $client->name }}" class="img-fluid">
    <p><strong>Slug:</strong> {{ $client->slug }}</p>
    <p><strong>Project:</strong> {{ $client->is_project == '1' ? 'Yes' : 'No' }}</p>
    <p><strong>Self Capture:</strong> {{ $client->self_capture == '1' ? 'Yes' : 'No' }}</p>
    <p><strong>Prefix:</strong> {{ $client->client_prefix }}</p>
    <p><strong>Address:</strong> {{ $client->address }}</p>
    <p><strong>Phone:</strong> {{ $client->phone_number }}</p>
    <p><strong>City:</strong> {{ $client->city }}</p>
    <p><strong>Created at:</strong> {{ $client->created_at }}</p>
    <a href="{{ route('clients.index') }}" class="btn btn-secondary">Back to Clients</a>
@endsection