@extends('layouts.user')

@section('content')
{{-- <div class="container">
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
</div> --}}


<div class="row mb-3">
    <div class="col-12 d-sm-flex justify-content-between align-items-center">
        <h1 class="h3 mb-2 mb-sm-0">Membership</h1>
        <a class="btn btn-sm btn-primary-soft mb-0" href="{{ route('membership.create') }}" >Add New Membership</a>
    </div>
</div>
<div class="card bg-transparent border">
    <div class="card-header bg-light border-bottom">
        <div class="row g-3 align-items-center justify-content-between">
            <div class="col-md-12">
                    <form class="rounded position-relative" action="{{ route('membership.search') }}" method="GET">

                        <input type="text" name="query" class="form-control me-2" placeholder="Search memberships...">
                    <button
                    class="bg-transparent p-2 position-absolute top-50 end-0 translate-middle-y border-0 text-primary-hover text-reset"
                    type="submit"
                    >
                    <i class="fas fa-search fs-6"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
<div class="card-body">
    <!-- Table START -->
    <div class="table-responsive border-0 rounded-3">
      <table
        class="table table-dark-gray align-middle   table-hover"
      >
        <!-- Table head -->
        <thead>
          <tr>
            <th scope="col" class="border-0 rounded-start">User</th>
            <th scope="col" class="border-0">Community</th>
            <th scope="col" class="border-0">Joined At</th>
            <th scope="col" class="border-0">Actions</th>
          </tr>
        </thead>

        <tbody>
            @foreach($memberships as $membership)
                <tr>
                    <td>{{ $membership->user->name }}</td>
                    <td>{{ $membership->community->name }}</td>
                    <td>{{ $membership->joinedAt }}</td>
                        <td>
                            <a href="{{ route('membership.edit', $membership->id) }}" 
                               class="btn btn-info-soft btn-round me-1 mb-1 mb-md-0"
                               data-bs-toggle="tooltip"
                               data-bs-placement="top"
                               title="Edit"
                               data-bs-original-title="Voir les détails">
                               <i class="bi bi-person-badge-fill"></i>
                            </a>
                        
                            @if ($membership->status !== 'APPROVED' && $membership->status !== 'REFUSED')
                            <form action="{{ route('membership.destroy', $membership->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this membership?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="btn btn-danger-soft btn-round me-1 mb-1 mb-md-0"
                                        data-bs-toggle="tooltip"
                                        data-bs-placement="top"
                                        title="Delete"
                                        data-bs-original-title="Delete">
                                    <i class="bi bi-trash"></i>
                                </button>
                                </form>
                            @endif
                        </td>
                        
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    


      </table>
    </div>
    <!-- Table END -->
  </div>
@endsection
