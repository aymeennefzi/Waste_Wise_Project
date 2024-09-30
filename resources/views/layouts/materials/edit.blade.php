{{-- resources/views/materials/edit.blade.php --}}
@extends('layouts.app')

@section('content')
<style>
    /* Styles pour le conteneur principal */
    .container {
        background-color: #f9f9f9; /* Fond léger pour le conteneur */
        border-radius: 8px; /* Coins arrondis */
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); /* Ombre douce */
        padding: 20px; /* Espacement intérieur */
        margin-top: 20px; /* Marges supérieures */
    }

    /* Styles pour le titre */
    h1 {
        font-family: 'Arial', sans-serif; /* Police sans-serif pour un look moderne */
        color: #333; /* Couleur sombre */
        font-size: 24px; /* Taille de police */
        border-bottom: 2px solid #007bff; /* Ligne sous le titre */
        padding-bottom: 10px; /* Espacement sous le titre */
    }

    /* Styles pour les champs du formulaire */
    .form-label {
        font-weight: bold; /* Texte en gras pour les labels */
        color: #555; /* Couleur des labels */
    }

    .form-control {
        border: 1px solid #ccc; /* Bordure gris clair */
        border-radius: 4px; /* Coins arrondis */
        transition: border-color 0.3s; /* Transition douce pour les bordures */
    }

    .form-control:focus {
        border-color: #007bff; /* Bordure bleue au focus */
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.5); /* Ombre au focus */
    }

    /* Styles pour le bouton */
    .btn-success {
        background-color: #28a745; /* Couleur du bouton de succès */
        color: white; /* Couleur du texte */
        padding: 10px 15px; /* Espacement intérieur du bouton */
        font-weight: bold; /* Texte en gras pour le bouton */
        border-radius: 4px; /* Coins arrondis pour le bouton */
        transition: background-color 0.3s ease, transform 0.2s; /* Transition douce */
    }

    .btn-success:hover {
        background-color: #218838; /* Couleur au survol */
        transform: scale(1.05); /* Légère augmentation de la taille au survol */
    }
</style>

<div class="container">
    <h1>Éditer le Matériau</h1>
    
    <form action="{{ route('materials.update', $material->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="material_name" class="form-label">Nom du Matériau</label>
            <input type="text" class="form-control" id="material_name" name="material_name" value="{{ $material->material_name }}" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" required>{{ $material->description }}</textarea>
        </div>
        <div class="mb-3">
            <label for="recycling_center_id" class="form-label">Centre de Recyclage</label>
            <select class="form-control" id="recycling_center_id" name="recycling_center_id" required>
                @foreach($recyclingCenters as $recyclingCenter)
                    <option value="{{ $recyclingCenter->id }}" {{ $material->recycling_center_id == $recyclingCenter->id ? 'selected' : '' }}>{{ $recyclingCenter->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-success">Mettre à Jour</button>
    </form>
</div>
@endsection
