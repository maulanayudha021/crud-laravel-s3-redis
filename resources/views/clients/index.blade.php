@extends('layouts.app')

@section('content')
    <h1 class="mb-3">Clients</h1>
    <a href="{{ route('clients.create') }}" class="btn btn-primary mb-3">Add New Client</a>
    <table class="table mb-3">
        <thead>
            <tr>
                <th>Name</th>
                <th>Slug</th>
                <th>Project</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($clients as $client)
                <tr>
                    <td>{{ $client->name }}</td>
                    <td>{{ $client->slug }}</td>
                    <td>{{ $client->is_project == '1' ? 'Yes' : 'No' }}</td>
                    <td>
                        <a href="{{ route('clients.edit', $client->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('clients.destroy', $client->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
