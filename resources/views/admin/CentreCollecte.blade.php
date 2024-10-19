@extends('layouts.adminLayout')
@section('content')
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
<style>
    .form-control {
        border: 1px solid #ccc; /* Bordure gris clair */
    }

    .form-control:focus {
        background-color: #e0e0e0; /* Gris légèrement plus foncé lors du focus */
        border-color: #007bff; /* Couleur de bordure lors du focus */
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25); /* Ombre lors du focus */
    }
</style>
<div class="row">
    <div class="w-100">
    <div class="card">
    <div class="card-body">
        <div class="row">
            <!-- Formulaire pour ajouter un Centre de Collecte -->
            <div class="col-md-6">
                <form action="{{ route('admin.collectionCenter') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="nom" class="form-label">Collection Center Name</label> <!-- Changement ici -->
                        <input type="text" class="form-control custom-input" id="nom" name="nom" required>
                    </div>

                    <div class="mb-3">
                        <label for="adresse" class="form-label">Address</label>
                        <input type="text" class="form-control" id="adresse" name="adresse" required>
                    </div>
                    <div class="mb-3">
                        <label for="capacite" class="form-label">Capacity</label>
                        <input type="number" class="form-control" id="capacite" name="capacite" required>
                    </div>
                    <div class="mb-3 text-center">
                        <button type="submit" class="btn btn-primary">Add center</button>
                    </div>
                </form>
            </div>

            <!-- Colonne pour l'image -->
            <div class="col-md-6 text-center">
                <h6>"Waste not, want not"</h6>
                <img src="{{ asset('Back_office/assets/images/3793347.jpg') }}" alt="Description de l'image" class="img-fluid w-50"> <!-- Ajuste w-75 selon tes préférences -->
            </div>
        </div>
    </div>
</div>

<h5 class="card-title mt-5">List of Collection Centers</h5>
<div class="card">
    <div class="card-body">
        <div class="table-responsive w-100">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Collection Center Name</th>
                        <th scope="col">Address</th>
                        <th scope="col">Capacity</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @if($centreCollectes->isEmpty())
                        <tr>
                            <td colspan="5">
                                <div class="alert alert-secondary text-center" role="alert">
                                    Aucun centre de collecte disponible pour le moment...
                                </div>
                            </td>
                        </tr>
                    @else
                        @foreach($centreCollectes as $centreCollecte)
                            <tr>
                                <th scope="row">{{ $centreCollecte->id }}</th>
                                <td>{{ $centreCollecte->nom }}</td>
                                <td>{{ $centreCollecte->adresse }}</td>
                                <td>{{ $centreCollecte->capacite }}</td>
                                <td>
                                    <!-- Bouton pour ouvrir le modal d'édition -->
                                    <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $centreCollecte->id }}">
                                        <i class="bi bi-pencil"></i> Modifier
                                    </button>
                                    <form action="{{ route('admin.collectionCenter.destroy', $centreCollecte->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce centre de collecte ?');">Supprimer</button>
                                    </form>
                                </td>
                            </tr>
                            <!-- Modal pour éditer le Centre de Collecte -->
                            <div class="modal fade" id="editModal{{ $centreCollecte->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $centreCollecte->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title text-dark" id="editModalLabel{{ $centreCollecte->id }}">Modifier Centre de Collecte</h5>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('admin.collectionCenter.update', $centreCollecte->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="mb-3">
                                                    <label for="nom{{ $centreCollecte->id }}" class="form-label text-dark">Nom du Centre</label>
                                                    <input type="text" class="form-control bg-dark" id="nom{{ $centreCollecte->id }}" name="nom" value="{{ $centreCollecte->nom }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="adresse{{ $centreCollecte->id }}" class="form-label text-dark">Adresse</label>
                                                    <textarea class="form-control bg-dark" id="adresse{{ $centreCollecte->id }}" name="adresse" rows="3" required>{{ $centreCollecte->adresse }}</textarea>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="capacite{{ $centreCollecte->id }}" class="form-label text-dark">Capacité</label>
                                                    <input type="number" class="form-control bg-dark" id="capacite{{ $centreCollecte->id }}" name="capacite" value="{{ $centreCollecte->capacite }}" required>
                                                </div>
                                                <div class="text-center">
                                                    <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const editButtons = document.querySelectorAll('button[data-bs-toggle="modal"]');

        editButtons.forEach(button => {
            button.addEventListener('click', function() {
                const modalId = this.getAttribute('data-bs-target');
                console.log('Modal ID:', modalId);
            
                // Ouvrir le modal
                const modalElement = document.querySelector(modalId);
                const modal = new bootstrap.Modal(modalElement);
                modal.show();
            });
        });
    });
</script>
@endsection
