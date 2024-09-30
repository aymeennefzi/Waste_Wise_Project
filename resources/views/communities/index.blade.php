@extends('layouts.usER')

@section('content')
<div class="container p-4" style="background: linear-gradient(135deg, #f0f4f8, #d9e2ec); border-radius: 10px; border: 1px solid #ccc;">
    <!-- Autocollant avant le titre -->
    <div style="display: flex; align-items: center;">
        <i class="fas fa-users" style="font-size: 2rem; color: #000; margin-right: 10px;"></i>
        <h2 class="mb-4" style="color: #000;">Communities</h2>
    </div>
    <hr style="border-top: 2px solid #000; width: 100px; margin-top: -20px;">

    <!-- Liste des communautés -->
    <div class="row">
        @foreach($communities as $community)
        <div class="col-md-4 mb-3">
            <div class="card">
            <img src="{{ Storage::url($community->image_url) }}" class="card-img-top" alt="{{ $community->name }}">

                <div class="card-body">
                    <h5 class="card-title">{{ $community->name }}</h5>
                    <p class="card-text">{{ $community->description }}</p>
                    <a href="{{ route('communities.show', $community->id) }}" class="btn btn-primary">
                        <i class="fas fa-list"></i> Details
                    </a>                    <!-- Remplacer le bouton Edit par une icône de stylo -->
                    <a href="{{ route('communities.edit', $community->id) }}" class="btn btn-warning">
                        <i class="fas fa-pen"></i>
                    </a>
                    <!-- Remplacer le bouton Delete par une icône de poubelle -->
                    <form action="{{ route('communities.destroy', $community->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Bouton pour ajouter une nouvelle communauté avec une icône de stylo -->
    <a href="{{ route('communities.create') }}" class="btn btn-primary mt-4">
        <i class="fas fa-plus"></i> Add New Community
    </a>
</div>
@endsection

@section('styles')
<!-- CSS pour le style -->
<style>
    .container {
        background: linear-gradient(135deg, #f0f4f8, #d9e2ec);
        border-radius: 10px;
        border: 1px solid #ccc;
        padding: 20px;
    }

    .container hr {
        border-top: 2px solid #000;
        width: 100px;
        margin-top: -20px;
    }

    .btn .fas {
        margin-right: 5px;
    }

    .fa-users {
        color: #000;
    }
</style>
@endsection

@section('scripts')
<!-- Assurez-vous d'inclure FontAwesome pour les icônes -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
@endsection
