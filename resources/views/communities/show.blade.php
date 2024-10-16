@extends('layouts.user')

@section('content')
<div class="container p-4">
    <div class="card shadow mb-4" style="border-radius: 10px;">
        <div class="card-header text-center" style="background-color: #008080; color: white;">
            <h1 class="mb-0">{{ $community->name }}</h1>
            <i class="fas fa-users" style="font-size: 2rem;"></i>
        </div>
        <div class="card-body text-center">
            <img src="{{ Storage::url($community->image_url) }}" class="img-fluid mb-3" alt="{{ $community->name }}" style="border-radius: 10px;">
            <p class="lead">{{ $community->description }}</p>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h3>Tâches associées</h3>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th><i class="fas fa-heading"></i> Titre</th>
                        <th><i class="fas fa-align-left"></i> Description</th>
                        <th><i class="fas fa-calendar-alt"></i> Date d'échéance</th>
                        <th><i class="fas fa-check-circle"></i> Statut</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($community->tasks as $task)
                        <tr>
                            <td>{{ $task->title }}</td>
                            <td>{{ $task->description }}</td>
                            <td>{{ $task->due_date ? $task->due_date->format('d/m/Y H:i') : 'Non définie' }}</td>
                            <td>
                                @if ($task->status === 'completed')
                                    <span style="color: green;">
                                        <i class="fas fa-check-circle"></i> {{ ucfirst($task->status) }}
                                    </span>
                                @elseif ($task->status === 'pending')
                                    <span style="color: red;">
                                        <i class="fas fa-clock"></i> {{ ucfirst($task->status) }}
                                    </span>
                                @else
                                    <span>{{ ucfirst($task->status) }}</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">Aucune tâche associée à cette communauté.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    .container {
        max-width: 800px;
        margin-top: 20px;
    }

    .card-header {
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
    }

    .lead {
        font-size: 1.2rem;
        font-weight: 300;
    }

    th i {
        margin-right: 5px; /* Spacing between icon and text */
    }
</style>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
@endsection
