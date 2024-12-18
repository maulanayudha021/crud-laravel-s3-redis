@extends('layouts.app')

@section('content')
    <h1>Edit Client: {{ $client->name }}</h1>
    <form action="{{ route('clients.update', $client->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="form-group mb-3">
            <label for="name">Client Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $client->name) }}" required>
        </div>
        
        <div class="form-group mb-3">
            <label for="slug">Slug</label>
            <input type="text" name="slug" id="slug" class="form-control" value="{{ old('slug', $client->slug) }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="is_project">Is Project?</label>
            <select name="is_project" id="is_project" class="form-control" required>
                <option value="0" {{ $client->is_project == '0' ? 'selected' : '' }}>No</option>
                <option value="1" {{ $client->is_project == '1' ? 'selected' : '' }}>Yes</option>
            </select>
        </div>

        <div class="form-group mb-3">
            <label for="self_capture">Self Capture?</label>
            <select name="self_capture" id="self_capture" class="form-control" required>
                <option value="1" {{ $client->self_capture == '1' ? 'selected' : '' }}>Yes</option>
                <option value="0" {{ $client->self_capture == '0' ? 'selected' : '' }}>No</option>
            </select>
        </div>

        <div class="form-group mb-3">
            <label for="client_prefix">Client Prefix</label>
            <input type="text" name="client_prefix" id="client_prefix" class="form-control" value="{{ old('client_prefix', $client->client_prefix) }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="client_logo">Client Logo</label>
            <input type="file" name="client_logo" id="client_logo" class="form-control">
            @if($client->client_logo && $client->client_logo != 'no-image.jpg')
                <p><img src="{{ $client->client_logo }}" alt="{{ $client->name }}" class="img-fluid" width="100"></p>
            @endif
        </div>

        <div class="form-group mb-3">
            <label for="address">Address</label>
            <textarea name="address" id="address" class="form-control">{{ old('address', $client->address) }}</textarea>
        </div>

        <div class="form-group mb-3">
            <label for="phone_number">Phone Number</label>
            <input type="text" name="phone_number" id="phone_number" class="form-control" value="{{ old('phone_number', $client->phone_number) }}">
        </div>

        <div class="form-group mb-3">
            <label for="city">City</label>
            <input type="text" name="city" id="city" class="form-control" value="{{ old('city', $client->city) }}">
        </div>

        <button type="submit" class="btn btn-primary">Update Client</button>
        <a href="{{ route('clients.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
@endsection