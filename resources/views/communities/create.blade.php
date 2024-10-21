@extends('layouts.adminLayout')

@section('content')
<div class="container p-4">
    <div class="card shadow" style="border-radius: 10px;">
        <div class="card-header text-center" style="background-color: #008080; color: white;">
            <h2 class="mb-0">Créer une nouvelle communauté <i class="fas fa-users" style="font-size: 1.5rem;"></i></h2>
        </div>
        <div class="card-body">
            <form action="{{ route('communities.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label"><i class="fas fa-users"></i> Nom de la communauté</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Entrez le nom de la communauté" required>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label"><i class="fas fa-comment-dots"></i> Description</label>
                    <textarea name="description" id="description" class="form-control" rows="4" placeholder="Décrivez votre communauté" required></textarea>
                </div>

                <div class="mb-3">
                    <label for="image_url" class="form-label"><i class="fas fa-image"></i> Image</label>
                    <input type="file" name="image_url" id="image_url" class="form-control" accept="image/*" required>
                </div>

                <button type="submit" class="btn btn-teal" style="background-color: #008080; border-color: #008080; color: white;">
                    <i class="fas fa-plus"></i> Créer
                </button>
            </form>
        </div>
    </div>

    <!-- Ligne de séparation pour la communauté -->
    <hr style="border: 1px solid #008080; margin: 20px 0;">

    <h3 class="text-center" style="color: #008080;"><i class="fas fa-users"></i> Communautés</h3>
    <div class="community-list">
        <!-- Liste des communautés ici -->
    </div>
</div>
@endsection

@section('styles')
<style>
    .container {
        max-width: 600px;
        margin-top: 20px;
    }

    .card {
        border-radius: 10px;
    }

    .card-header {
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
    }

    .btn-teal {
        background-color: #008080;
        border-color: #008080;
        color: white;
    }

    .form-label {
        font-weight: bold;
    }

    .form-control {
        border-radius: 5px;
    }
</style>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
@endsection