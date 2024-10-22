@extends('layouts.adminLayout')

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <!-- Form to update a Task -->
            <div class="col-md-6">
                <h5 class="card-title">Update Task</h5>
                <form action="{{ route('taskse.update', $task->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="event_id" class="form-label">Event</label>
                        <select class="form-control" id="event_id" name="event_id" >
                            <option value="">-- Select Event --</option>
                            @foreach($events as $event)
                                <option value="{{ $event->id }}" {{ $event->id == $task->event_id ? 'selected' : '' }}>
                                    {{ $event->eventName }}
                                </option>
                            @endforeach
                        </select>
                        <span class="text-danger">@error('event_id') {{ $message }} @enderror</span>
                    </div>
                    <div class="mb-3">
                        <label for="task_type" class="form-label">Task Type</label>
                        <input type="text" class="form-control" id="task_type" name="task_type" value="{{ old('task_type', $task->task_type) }}" >
                        <span class="text-danger">@error('task_type') {{ $message }} @enderror</span>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3" >{{ old('description', $task->description) }}</textarea>
                        <span class="text-danger">@error('description') {{ $message }} @enderror</span>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="start_time" class="form-label">Start Time</label>
                            <input type="time" class="form-control" id="start_time" name="start_time" value="{{ old('start_time', $task->start_time) }}" >
                            <span class="text-danger">@error('start_time') {{ $message }} @enderror</span>
                        </div>
                        <div class="col">
                            <label for="end_time" class="form-label">End Time</label>
                            <input type="time" class="form-control" id="end_time" name="end_time" value="{{ old('end_time', $task->end_time) }}" >
                            <span class="text-danger">@error('end_time') {{ $message }} @enderror</span>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="estimated_duration" class="form-label">Estimated Duration (minutes)</label>
                            <input type="number" class="form-control" id="estimated_duration" name="estimated_duration" value="{{ old('estimated_duration', $task->estimated_duration) }}" >
                            <span class="text-danger">@error('estimated_duration') {{ $message }} @enderror</span>
                        </div>
                        <div class="col">
                            <label for="cost_estimate" class="form-label">Cost Estimate ($)</label>
                            <input type="number" class="form-control" id="cost_estimate" name="cost_estimate" step="0.01" value="{{ old('cost_estimate', $task->cost_estimate) }}" >
                            <span class="text-danger">@error('cost_estimate') {{ $message }} @enderror</span>
                        </div>
                    </div>
                    <div class="mb-3 text-center">
                        <button type="submit" class="btn btn-primary">Update Task</button>
                    </div>
                </form>
            </div>
            <!-- Column for image -->
            <div class="col-md-6 text-center" style="margin-top: 50px">
                <img src="{{ asset('Back_office/assets/images/2.webp') }}" alt="Task update illustration" class="img-fluid w-50">
                <h6>"Refine your tasks for optimal event success"</h6>
            </div>
        </div>
    </div>
</div>

<style>
    .card {
        margin-top: 30px;
    }
    .form-label {
        font-weight: bold;
    }
    .btn-primary {
        background-color: #4CAF50;
        border-color: #4CAF50;
    }
    .btn-primary:hover {
        background-color: #45a049;
        border-color: #45a049;
    }
</style>
@endsection