@extends('layouts.adminLayout')

@section('content')
<div class="container-fluid">
    <h5 class="card-title mt-5">Events List</h5>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12 mb-3">
                    <a href="{{ route('events.create') }}" class="btn btn-primary">
                        <i class="bi bi-plus"></i> Create New Event
                    </a>
                </div>
                <div class="table-responsive w-100">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Event Name</th>
                                <th scope="col">Date</th>
                                <th scope="col">Description</th>
                                <th scope="col">Location</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($events->isEmpty())
                                <tr>
                                    <td colspan="6">
                                        <div class="alert alert-secondary text-center" role="alert">
                                            No events available at the moment...
                                        </div>
                                    </td>
                                </tr>
                            @else
                                @foreach($events as $event)
                                    <tr>
                                        <th scope="row">{{ $event->id }}</th>
                                        <td>{{ $event->eventName }}</td>
                                        <td>{{ $event->eventDate }}</td>
                                        <td>{{ Str::limit($event->descreption, 50) }}</td>
                                        <td>
                                            <a href="https://www.google.com/maps?q={{ $event->location }}" target="_blank" class="btn btn-sm btn-info">
                                                <i class="bi bi-geo-alt"></i> View Map
                                            </a>
                                        </td>
                                        <td>
                                            {{-- <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $event->id }}">
                                                <i class="bi bi-pencil"></i> Edit
                                            </button> --}}



                                            <form action="{{ route('events.edit', $event->id) }}" method="GET" style="display: inline;">
                                                <button type="submit" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $event->id }}">
                                                    Edit
                                                </button>
                                            </form>

                                            <form action="{{ route('events.destroy', $event->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this event?');">
                                                    <i class="bi bi-trash"></i> Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    <!-- Edit Modal for each event -->
                                    <div class="modal fade" id="editModal{{ $event->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $event->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title text-dark" id="editModalLabel{{ $event->id }}">Edit Event</h5>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('events.update', $event->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="mb-3">
                                                            <label for="eventName" class="form-label text-dark">Event Name</label>
                                                            <input type="text" class="form-control bg-dark" id="eventName" name="eventName" value="{{ $event->eventName }}" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="eventDate" class="form-label text-dark">Event Date</label>
                                                            <input type="date" class="form-control bg-dark" id="eventDate" name="eventDate" value="{{ $event->eventDate }}" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="descreption" class="form-label text-dark">Description</label>
                                                            <textarea class="form-control bg-dark" id="descreption" name="descreption" rows="3" required>{{ $event->descreption }}</textarea>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="location" class="form-label text-dark">Location</label>
                                                            <input type="text" class="form-control bg-dark" id="location" name="location" value="{{ $event->location }}" required>
                                                        </div>
                                                        <div class="text-center">
                                                            <button type="submit" class="btn btn-primary">Update Event</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
