@extends('layouts.app')

@section('content')
    <h1>Create New Client</h1>
    <form action="{{ route('clients.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group mb-3">
            <label for="name">Client Name</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>
        <div class="form-group mb-3">
            <label for="slug">Slug</label>
            <input type="text" name="slug" id="slug" class="form-control" required>
        </div>
        <div class="form-group mb-3">
            <label for="is_project">Is Project?</label>
            <select name="is_project" id="is_project" class="form-control" required>
                <option value="0">No</option>
                <option value="1">Yes</option>
            </select>
        </div>
        <div class="form-group mb-3">
            <label for="self_capture">Self Capture?</label>
            <select name="self_capture" id="self_capture" class="form-control" required>
                <option value="1">Yes</option>
                <option value="0">No</option>
            </select>
        </div>
        <div class="form-group mb-3">
            <label for="client_prefix">Client Prefix</label>
            <input type="text" name="client_prefix" id="client_prefix" class="form-control" required>
        </div>
        <div class="form-group mb-3">
            <label for="client_logo">Client Logo</label>
            <input type="file" name="client_logo" id="client_logo" class="form-control">
        </div>
        <div class="form-group mb-3">
            <label for="address">Address</label>
            <textarea name="address" id="address" class="form-control"></textarea>
        </div>
        <div class="form-group mb-3">
            <label for="phone_number">Phone Number</label>
            <input type="text" name="phone_number" id="phone_number" class="form-control">
        </div>
        <div class="form-group mb-3">
            <label for="city">City</label>
            <input type="text" name="city" id="city" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary mb-3">Save Client</button>
    </form>
@endsection
