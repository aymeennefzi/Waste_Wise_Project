{{-- resources/views/materials/create.blade.php --}}
@extends('layouts.adminLayout')

@section('content')
<style>
    /* Styles pour le conteneur principal */
    .container {
        background-color: #ffffff; /* Fond blanc pour un look propre */
        border-radius: 10px; /* Coins arrondis */
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1); /* Ombre douce */
        padding: 40px; /* Espacement intérieur */
        margin-top: 30px; /* Marges supérieures */
        max-width: 600px; /* Largeur maximale pour un meilleur centrage */
        margin-left: auto; /* Centrer le conteneur horizontalement */
        margin-right: auto; /* Centrer le conteneur horizontalement */
    }

    /* Styles pour le titre */
    h1 {
        font-family: 'Arial', sans-serif; /* Police sans-serif pour un look moderne */
        color: #333; /* Couleur sombre */
        font-size: 26px; /* Taille de police */
        margin-bottom: 20px; /* Espacement en bas du titre */
        text-align: center; /* Centrer le titre */
    }

    /* Styles pour les champs du formulaire */
    .form-label {
        font-weight: bold; /* Texte en gras pour les labels */
        color: #555; /* Couleur des labels */
        margin-bottom: 5px; /* Espacement en bas des labels */
        display: block; /* Affichage en bloc pour une meilleure structure */
    }

    .form-control {
        border: 1px solid #ccc; /* Bordure gris clair */
        border-radius: 5px; /* Coins arrondis */
        transition: border-color 0.3s, box-shadow 0.3s; /* Transition douce */
        padding: 12px 15px; /* Espacement intérieur */
        width: 100%; /* Prendre toute la largeur du conteneur */
        font-size: 16px; /* Taille de police pour le contenu */
        color: #333; /* Couleur du texte */
    }

    .form-control:focus {
        border-color: #007bff; /* Bordure bleue au focus */
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.5); /* Ombre au focus */
        outline: none; /* Enlever l'outline par défaut */
    }

    /* Styles pour le bouton */
    .btn-primary {
        background-color: #007bff; /* Couleur du bouton primaire */
        color: white; /* Couleur du texte */
        padding: 10px 15px; /* Espacement intérieur du bouton */
        font-weight: bold; /* Texte en gras pour le bouton */
        border-radius: 5px; /* Coins arrondis pour le bouton */
        transition: background-color 0.3s ease, transform 0.2s; /* Transition douce */
        border: none; /* Pas de bordure par défaut */
        width: 100%; /* Prendre toute la largeur du conteneur */
        font-size: 16px; /* Taille de police pour le bouton */
    }

    .btn-primary:hover {
        background-color: #0056b3; /* Couleur au survol */
        transform: scale(1.05); /* Légère augmentation de la taille au survol */
    }
</style>

<div class="container">
    <h1>Ajouter un Matériau</h1>

    <form action="{{ route('materials.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="material_name" class="form-label">Nom du Matériau</label>
            <input type="text" class="form-control" id="material_name" name="material_name" required>
        </div>
        <div class="mb-4">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" required></textarea>
        </div>
        <div class="mb-4">
            <label for="recycling_center_id" class="form-label">Centre de Recyclage</label>
            <select class="form-control" id="recycling_center_id" name="recycling_center_id" required>
                @foreach($recyclingCenters as $recyclingCenter)
                    <option value="{{ $recyclingCenter->id }}">{{ $recyclingCenter->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Créer</button>
    </form>
</div>
@endsection
