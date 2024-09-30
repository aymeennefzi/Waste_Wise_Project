@extends('layouts.user')

@section('content')
<div class="container">
    <h2 class="my-4">Membership List</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="mb-4">
        <form action="{{ route('membership.search') }}" method="GET">
            <div class="form-group d-flex justify-content-between">
                <input type="text" name="query" class="form-control me-2" placeholder="Search memberships...">
                <button type="submit" class="btn btn-primary">Search</button>
            </div>
        </form>
    </div>

    <a href="{{ route('membership.create') }}" class="btn btn-success mb-3 float-end">Add New Membership</a>

    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>User</th>
                <th>Community</th>
                <th>Joined At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($memberships as $membership)
                <tr>
                    <td>{{ $membership->id }}</td>
                    <td>{{ $membership->user->name }}</td>
                    <td>{{ $membership->community->name }}</td>
                    <td>{{ $membership->joinedAt }}</td>
                    <td>
                        <a href="{{ route('membership.edit', $membership->id) }}" class="btn btn btn-sm" style="background-color: #206B75 ;color:white">Edit</a>
                        <form action="{{ route('membership.destroy', $membership->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
