@extends('layouts.adminLayout')

@section('content')
<div class="container-fluid">
    <h5 class="card-title mt-5">Tasks List by Event</h5>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12 mb-3">
                    <a href="{{ route('tasks.create') }}" class="btn btn-primary">
                        <i class="bi bi-plus"></i> Create New Task
                    </a>
                </div>
                <div class="table-responsive w-100">
                    @php
                        $tasksByEvent = $tasks->groupBy(function($task) {
                            return $task->event->eventName ?? 'No Event';
                        });
                    @endphp

                    @foreach ($tasksByEvent as $eventName => $eventTasks)
                        <h6 class="mt-4 mb-3">{{ $eventName }}</h6>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">Task Type</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Start Time</th>
                                    <th scope="col">End Time</th>
                                    <th scope="col">Duration</th>
                                    <th scope="col">Cost Estimate</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($eventTasks->isEmpty())
                                    <tr>
                                        <td colspan="7">
                                            <div class="alert alert-secondary text-center" role="alert">
                                                No tasks available for this event...
                                            </div>
                                        </td>
                                    </tr>
                                @else
                                    @foreach($eventTasks as $task)
                                        <tr>
                                            <td>{{ $task->task_type }}</td>
                                            <td>{{ Str::limit($task->description, 50) }}</td>
                                            <td>{{ $task->start_time }}</td>
                                            <td>{{ $task->end_time }}</td>
                                            <td>{{ $task->estimated_duration }} minutes</td>
                                            <td>{{ number_format($task->cost_estimate, 2) }}DT</td>
                                            <td>
                                                {{-- <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $task->id }}">
                                                    <i class="bi bi-pencil"></i> Edit
                                                </button> --}}




                                                <form action="{{ route('tasks.editTask', $task->id) }}" method="GET" style="display: inline;">
                                                    <button type="submit" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $task->id }}">
                                                        Edit
                                                    </button>
                                                </form>


                                                <form action="{{ route('tasks.destroyTask', $task->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this task?');">
                                                        <i class="bi bi-trash"></i> Delete
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                        <!-- Edit Modal for each task -->
                                        <div class="modal fade" id="editModal{{ $task->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $task->id }}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title text-dark" id="editModalLabel{{ $task->id }}">Edit Task</h5>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('tasks.editTask', $task->id) }}" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="mb-3">
                                                                <label for="task_type" class="form-label text-dark">Task Type</label>
                                                                <input type="text" class="form-control bg-dark" id="task_type" name="task_type" value="{{ $task->task_type }}" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="description" class="form-label text-dark">Description</label>
                                                                <textarea class="form-control bg-dark" id="description" name="description" rows="3" required>{{ $task->description }}</textarea>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="start_time" class="form-label text-dark">Start Time</label>
                                                                <input type="datetime-local" class="form-control bg-dark" id="start_time" name="start_time" value="{{ $task->start_time }}" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="end_time" class="form-label text-dark">End Time</label>
                                                                <input type="datetime-local" class="form-control bg-dark" id="end_time" name="end_time" value="{{ $task->end_time }}" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="estimated_duration" class="form-label text-dark">Estimated Duration (minutes)</label>
                                                                <input type="number" class="form-control bg-dark" id="estimated_duration" name="estimated_duration" value="{{ $task->estimated_duration }}" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="cost_estimate" class="form-label text-dark">Cost Estimate (DT)</label>
                                                                <input type="number" step="0.01" class="form-control bg-dark" id="cost_estimate" name="cost_estimate" value="{{ $task->cost_estimate }}" required>
                                                            </div>
                                                            <div class="text-center">
                                                                <button type="submit" class="btn btn-primary">Update Task</button>
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
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
