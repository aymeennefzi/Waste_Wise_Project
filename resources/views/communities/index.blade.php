@extends('layouts.adminLayout')

@section('content')
<div class="container p-4" style="background: rgba(240, 244, 248, 0.9); border-radius: 10px; border: 1px solid rgba(224, 224, 224, 0.5);">
    <!-- Header Section -->
    <div class="d-flex align-items-center mb-4">
        <i class="fa fa-users" style="font-size: 2rem; color: #008080; margin-right: 10px;"></i>
        <h2 class="text-teal" style="color: #008080;">Communities</h2>
    </div>

    <!-- Ligne de séparation -->
    <hr style="border-top: 2px solid #008080; margin-top: -10px; margin-bottom: 20px;">

    <a href="{{ route('communities.create') }}" class="btn btn-teal mb-4">
        <i class="fa fa-plus"></i> Ajouter une Communauté
    </a>

    <!-- Communities List -->
    <div class="row mt-4">
        @foreach($communities as $community)
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow" style="transition: transform 0.3s ease; cursor: pointer; border-radius: 10px;">
                <img src="{{ Storage::url($community->image_url) }}" class="card-img-top" alt="{{ $community->name }}" style="object-fit: cover; height: 200px; border-top-left-radius: 10px; border-top-right-radius: 10px;">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title text-dark">{{ $community->name }}</h5>
                    <p class="card-text flex-grow-1 text-muted">{{ $community->description }}</p>
                    <div class="d-flex justify-content-between mt-auto">
                        <a href="{{ route('communities.show', $community->id) }}" class="btn btn-outline-primary">
                            <i class="fa fa-info-circle"></i> Détails
                        </a>
                        <a href="{{ route('communities.edit', $community->id) }}" class="btn btn-outline-warning">
                            <i class="fa fa-pencil"></i> Modifier
                        </a>
                        <form action="{{ route('communities.destroy', $community->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger">
                                <i class="fa fa-trash"></i> Supprimer
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-KyZXEAg3QhqLMpG8r+Knujsl5/6iWb0I1iw8Y/iI7lY1ImC2j85vZc9C9g3xQHe" crossorigin="anonymous">
<style>
    .container {
        background: rgba(240, 244, 248, 0.9);
        border-radius: 10px;
        border: 1px solid rgba(224, 224, 224, 0.5);
        padding: 20px;
    }

    .card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border: none;
        border-radius: 10px;
    }

    .card:hover {
        transform: scale(1.05);
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.2);
    }

    .text-teal {
        color: #008080;
    }

    .btn-teal {
        background-color: #007060; /* Légèrement plus foncé */
        border-color: #007060; /* Légèrement plus foncé */
        color: white;
        transition: background-color 0.3s;
    }

    .btn-teal:hover {
        background-color: #006050; /* Plus foncé au survol */
    }

    .btn-outline-primary {
        color: #007bff;
        border-color: #007bff;
    }

    .btn-outline-primary:hover {
        background-color: rgba(0, 123, 255, 0.1);
    }

    .btn-outline-warning {
        color: #ffc107;
        border-color: #ffc107;
    }

    .btn-outline-warning:hover {
        background-color: rgba(255, 193, 7, 0.1);
    }

    .btn-outline-danger {
        color: #dc3545;
        border-color: #dc3545;
    }

    .btn-outline-danger:hover {
        background-color: rgba(220, 53, 69, 0.1);
    }

    /* Text styles */
    .card-title {
        font-weight: bold;
    }

    .card-text {
        font-size: 0.9rem;
    }
</style>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
@endsection
