@extends('layouts.adminLayout')

@section('content')
<div class="container">
    <h1>Update Task</h1>

    <form method="POST" action="{{ route('tasks.update', $task->id) }}" class="form-container">
        @csrf
        @method('PUT')

        <div class="form-group">
            <div class="input-group">
                <div class="input-wrapper">
                    <label for="event_id">Event:</label>
                    <select id="event_id" name="event_id" required>
                        @foreach($events as $event)
                            <option value="{{ $event->id }}" {{ old('event_id', $task->event_id) == $event->id ? 'selected' : '' }}>
                                {{ $event->eventName }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="input-wrapper">
                    <label for="task_type">Task Type:</label>
                    <input type="text" id="task_type" name="task_type" value="{{ old('task_type', $task->task_type) }}" required>
                </div>
            </div>

            <div class="input-wrapper">
                <label for="description">Description:</label>
                <textarea id="description" name="description" required>{{ old('description', $task->description) }}</textarea>
            </div>

            <div class="input-group">
                <div class="input-wrapper">
                    <label for="start_time">Start Time:</label>
                    <input type="time" id="start_time" name="start_time" value="{{ old('start_time', $task->start_time) }}" required>
                </div>

                <div class="input-wrapper">
                    <label for="end_time">End Time:</label>
                    <input type="time" id="end_time" name="end_time" value="{{ old('end_time', $task->end_time) }}" required>
                </div>
            </div>

            <div class="input-group">
                <div class="input-wrapper">
                    <label for="estimated_duration">Estimated Duration (minutes):</label>
                    <input type="number" id="estimated_duration" name="estimated_duration" value="{{ old('estimated_duration', $task->estimated_duration) }}" required>
                </div>

                <div class="input-wrapper">
                    <label for="cost_estimate">Cost Estimate ($):</label>
                    <input type="number" step="0.01" id="cost_estimate" name="cost_estimate" value="{{ old('cost_estimate', $task->cost_estimate) }}" required>
                </div>
            </div>

            <div class="form-group">
                <div class="input-wrapper">
                    <button type="submit" class="btn">Update Task</button>
                </div>
            </div>
        </div>
    </form>
</div>

<style>
    .form-container {
        max-width: 600px;
        margin: auto;
        margin-top: 30px;
    }

    .input-group {
        display: flex;
        gap: 20px;
        margin-bottom: 15px;
    }

    .input-wrapper {
        display: flex;
        flex-direction: column;
        flex: 1;
    }

    label {
        margin-bottom: 5px;
    }

    input, select, textarea {
        width: 100%;
        padding: 8px;
        box-sizing: border-box;
    }

    button {
        padding: 8px 15px;
        background-color: #4CAF50;
        color: white;
        border: none;
        cursor: pointer;
    }

    button:hover {
        background-color: #45a049;
    }
</style>
@endsection
