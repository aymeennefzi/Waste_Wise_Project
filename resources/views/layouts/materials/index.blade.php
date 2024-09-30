{{-- resources/views/materials/index.blade.php --}}
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

    /* Styles pour le tableau */
    .table {
        border-collapse: collapse; /* Suppression de l'espace entre les cellules */
        width: 100%; /* Prendre toute la largeur */
        margin-top: 20px; /* Espacement supérieur */
    }

    /* Styles pour les cellules du tableau */
    .table th, .table td {
        padding: 12px 15px; /* Espacement intérieur des cellules */
        text-align: left; /* Alignement à gauche */
    }

    /* Styles pour les en-têtes de tableau */
    .table th {
        background-color: #007bff; /* Couleur de fond bleu */
        color: white; /* Couleur du texte blanc */
        font-weight: bold; /* Texte en gras */
    }

    /* Styles pour les lignes du tableau */
    .table tbody tr:nth-child(even) {
        background-color: #f2f2f2; /* Couleur de fond alternée */
    }

    .table tbody tr:hover {
        background-color: #e0e0e0; /* Couleur de fond au survol */
    }

    /* Styles pour les boutons */
    .btn {
        border-radius: 4px; /* Coins arrondis pour les boutons */
        padding: 10px 15px; /* Espacement intérieur des boutons */
        font-weight: bold; /* Texte en gras pour les boutons */
        transition: background-color 0.3s ease, transform 0.2s; /* Transition douce */
    }

    .btn-primary {
        background-color: #007bff; /* Couleur du bouton primaire */
        color: white; /* Couleur du texte */
    }

    .btn-primary:hover {
        background-color: #0056b3; /* Couleur au survol */
        transform: scale(1.05); /* Légère augmentation de la taille au survol */
    }

    .btn-warning {
        background-color: #ffc107; /* Couleur du bouton d'édition */
        color: white; /* Couleur du texte */
    }

    .btn-warning:hover {
        background-color: #e0a800; /* Couleur au survol */
        transform: scale(1.05); /* Légère augmentation de la taille au survol */
    }

    .btn-danger {
        background-color: #dc3545; /* Couleur du bouton de suppression */
        color: white; /* Couleur du texte */
    }

    .btn-danger:hover {
        background-color: #c82333; /* Couleur au survol */
        transform: scale(1.05); /* Légère augmentation de la taille au survol */
    }
</style>

<div class="container">
    <h1>Liste des Matériaux</h1>
    <a href="{{ route('materials.create') }}" class="btn btn-primary">Ajouter un Matériau</a>
    
    <table class="table mt-4">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom du Matériau</th>
                <th>Description</th>
                <th>Centre de Recyclage</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($materials as $material)
                <tr>
                    <td>{{ $material->id }}</td>
                    <td>{{ $material->material_name }}</td>
                    <td>{{ $material->description }}</td>
                    <td>{{ $material->recyclingCenter->name }}</td>
                    <td>
                        <a href="{{ route('materials.edit', $material->id) }}" class="btn btn-warning">Éditer</a>
                        <form action="{{ route('materials.destroy', $material->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce matériau ?');">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
