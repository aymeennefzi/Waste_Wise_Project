@extends('layouts.adminLayout')

@section('content')
<div class="container p-4">
    <div class="card shadow mb-4" style="border-radius: 10px;">
        <div class="card-header text-center" style="background-color: #008080; color: white;">
            <h1 class="mb-0">Créer une Tâche</h1>
            <i class="fas fa-plus-circle" style="font-size: 2rem;"></i>
        </div>
        <div class="card-body">
            <form action="{{ route('tasks.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="community_id" class="form-label"><i class="fas fa-users"></i> Communauté</label>
                    <select name="community_id" id="community_id" class="form-control" required>
                        <option value="">Sélectionner une communauté</option>
                        @foreach ($communities as $community)
                            <option value="{{ $community->id }}">{{ $community->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="title" class="form-label"><i class="fas fa-heading"></i> Titre</label>
                    <input type="text" name="title" id="title" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label"><i class="fas fa-align-left"></i> Description</label>
                    <textarea name="description" id="description" class="form-control"></textarea>
                </div>

                <div class="mb-3">
                    <label for="due_date" class="form-label"><i class="fas fa-calendar-alt"></i> Date d'échéance</label>
                    <input type="datetime-local" name="due_date" id="due_date" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="status" class="form-label"><i class="fas fa-check-circle"></i> Statut</label>
                    <select name="status" id="status" class="form-control" required>
                        <option value="pending">En attente</option>
                        <option value="completed">Complétée</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-success"><i class="fas fa-plus"></i> Créer</button>
            </form>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    .container {
        max-width: 600px; /* Adjusted max-width for better layout */
        margin-top: 20px;
    }

    .card-header {
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
    }

    .form-label i {
        margin-right: 5px; /* Spacing between icon and text */
    }
</style>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
@endsection
