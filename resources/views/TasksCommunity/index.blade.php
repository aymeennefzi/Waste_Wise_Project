@extends('layouts.adminLayout')

@section('content')
    <div class="container">
        <h1 class="mb-4">Liste des Tâches</h1>

        <div class="d-flex justify-content-between align-items-center mb-3">
            @if(session('success'))
                <div class="alert alert-success mb-0 me-3">{{ session('success') }}</div>
            @endif

            <a href="{{ route('tasks.create') }}" class="btn btn-success">
                <i class="fa fa-plus"></i> Ajouter une Tâche
            </a>
        </div>

        <div class="d-flex justify-content-between mb-3">
            <!-- Search Form -->
            <form action="{{ route('tasks.index') }}" method="GET" class="d-flex me-2">
                <input type="text" name="search" placeholder="Rechercher" value="{{ request('search') }}" class="form-control me-2" style="width: auto;">
                <button type="submit" class="btn btn-primary">Rechercher</button>
            </form>

            <!-- Community Filter -->
            <form action="{{ route('tasks.index') }}" method="GET" class="d-flex">
                <select name="community_id" class="form-select me-2">
                    <option value="">Toutes les communautés</option>
                    @foreach($communities as $community)
                        <option value="{{ $community->id }}" {{ request('community_id') == $community->id ? 'selected' : '' }}>
                            {{ $community->name }}
                        </option>
                    @endforeach
                </select>
                <button type="submit" class="btn btn-secondary">Filtrer</button>
            </form>
        </div>

        <!-- Task Table -->
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th><i class="fa fa-title"></i> Titre</th>
                    <th><i class="fa fa-file-text"></i> Description</th>
                    <th><i class="fa fa-users"></i> Communauté</th>
                    <th><i class="fa fa-calendar"></i> Date d'échéance</th>
                    <th><i class="fa fa-flag"></i> Statut</th>
                    <th><i class="fa fa-cog"></i> Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tasks as $task)
                    <tr>
                        <td>{{ $task->title }}</td>
                        <td>{{ $task->description }}</td>
                        <td>{{ $task->community->name }}</td>
                        <td>{{ $task->due_date ? $task->due_date->format('d/m/Y') : 'Non défini' }}</td>
                        <td>{{ ucfirst($task->status) }}</td>
                        <td>
                            <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-outline-success btn-sm">
                                <i class="fa fa-pencil" style="color: green;"></i> Modifier
                            </a>

                            <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger btn-sm">
                                    <i class="fa fa-trash"></i> Supprimer
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
