{{-- resources/views/tasks/show.blade.php --}}
@extends('layouts.adminLayout')

@section('content')
    <div class="container">
        <h1>Détails de la Tâche : {{ $task->title }}</h1>

        <!-- Informations sur la tâche -->
        <div class="mb-3">
            <strong>Communauté :</strong> {{ $task->community->name }}
        </div>

        <div class="mb-3">
            <strong>Description :</strong>
            <p>{{ $task->description }}</p>
        </div>

        <div class="mb-3">
            <strong>Date d'échéance :</strong> {{ $task->due_date ? $task->due_date->format('d/m/Y H:i') : 'Non définie' }}
        </div>

        <div class="mb-3">
            <strong>Statut :</strong> {{ ucfirst($task->status) }}
        </div>

        <!-- Actions -->
        <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-warning">Modifier</a>
        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Supprimer</button>
        </form>
    </div>
@endsection
