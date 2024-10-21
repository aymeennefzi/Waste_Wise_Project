@extends('layouts.user')

@section('content')
<div class="task-grid">
    @foreach ($tasks as $task)
    <div class="task-card">
        <div class="card-header">
            <h2>{{ $task->task_type }}</h2>
        </div>

        <div class="card-content">
            <p><strong>Description:</strong> {{ \Illuminate\Support\Str::limit($task->description, 100) }}</p>
            <p><strong>Start Time:</strong> {{ $task->start_time }}</p>
            <p><strong>End Time:</strong> {{ $task->end_time }}</p>
            <p><strong>Duration:</strong> {{ $task->estimated_duration }} hours</p>
            <p><strong>Cost Estimate:</strong> {{ number_format($task->cost_estimate, 2) }} DT</p>
        </div>

        {{-- <div class="card-footer">
            <a href="{{ route('events.show', $task->event_id) }}" class="event-link">View Associated Event</a>
        </div> --}}
    </div>
    @endforeach
</div>

<style>
    .task-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 20px;
    }

    .task-card {
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        overflow: hidden;
        transition: transform 0.3s;
        display: flex;
        flex-direction: column;
    }

    .task-card:hover {
        transform: translateY(-5px);
    }

    .card-header {
        background-color: #121212;
        color: white;
        padding: 15px;
    }

    .card-header h2 {
        font-size: 1.2rem;
        margin: 0;
        color: #f8f9fa;
    }

    .card-content {
        padding: 15px;
        flex-grow: 1;
    }

    .card-content p {
        margin-bottom: 10px;
    }

    .card-footer {
        background-color: #f8f9fa;
        padding: 10px;
        text-align: center;
    }

    .event-link {
        background-color: #0c0c0c;
        color: white;
        padding: 10px 15px;
        border-radius: 5px;
        text-decoration: none;
        font-size: 0.9rem;
        display: inline-block;
    }

    @media (max-width: 1200px) {
        .task-grid {
            grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
        }
    }

    @media (max-width: 768px) {
        .task-grid {
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        }
    }
</style>
@endsection
