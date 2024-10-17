@extends('layouts.adminLayout')

@section('content')
<div class="container">
    <h1>Add Task</h1>

    <form method="POST" action="{{ route('tasks.store') }}" class="form-container">
        @csrf

        <div class="form-group">
            <div class="input-group">
                <div class="input-wrapper">
                    <label for="event_id">Event:</label>
                    <select style="background-color: white" id="event_id" name="event_id" required>
                        @foreach($events as $event)
                            <option value="{{ $event->id }}">{{ $event->eventName }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="input-wrapper">
                    <label for="task_type">Task Type:</label>
                    <input type="text" id="task_type" name="task_type" required>
                </div>
            </div>

            <div class="input-wrapper">
                <label for="description">Description:</label>
                <textarea id="description" name="description" required></textarea>
            </div>

            <div class="input-group">
                <div class="input-wrapper">
                    <label for="start_time">Start Time:</label>
                    <input type="time" id="start_time" name="start_time" required>
                </div>

                <div class="input-wrapper">
                    <label for="end_time">End Time:</label>
                    <input type="time" id="end_time" name="end_time" required>
                </div>
            </div>

            <div class="input-group">
                <div class="input-wrapper">
                    <label for="estimated_duration">Estimated Duration (minutes):</label>
                    <input type="number" id="estimated_duration" name="estimated_duration" required>
                </div>

                <div class="input-wrapper">
                    <label for="cost_estimate">Cost Estimate:</label>
                    <input type="number" id="cost_estimate" name="cost_estimate" step="0.01" required>
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="input-wrapper">
                <button type="submit" class="btn">Add Task</button>
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
