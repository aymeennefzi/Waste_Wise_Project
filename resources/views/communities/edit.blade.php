<<<<<<< HEAD
@extends('layouts.user')
=======
@extends('layouts.adminLayout')
>>>>>>> 8b3de3b7daf35623eeedd959dfe5676281983156

@section('content')
<div class="container p-4">
    <div class="card shadow" style="border-radius: 10px;">
        <div class="card-header text-center" style="background-color: #008080; color: white;">
            <h2 class="mb-0">Modifier la communauté : {{ $community->name }}</h2>
            <i class="fas fa-users" style="font-size: 1.5rem;"></i>
        </div>
        <div class="card-body">
            <form action="{{ route('communities.update', $community->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT') <!-- Utilise la méthode PUT pour la mise à jour -->

                <div class="mb-3">
                    <label for="current_image" class="form-label"><i class="fas fa-image"></i> Image actuelle</label><br>
                    <img src="{{ Storage::url($community->image_url) }}" class="img-fluid mb-3" alt="{{ $community->name }}" style="max-width: 300px; border-radius: 5px;">
                </div>
                
                <div class="mb-3">
                    <label for="name" class="form-label"><i class="fas fa-users"></i> Nom de la communauté</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ $community->name }}" required>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label"><i class="fas fa-comment-dots"></i> Description</label>
                    <textarea name="description" id="description" class="form-control" rows="4" required>{{ $community->description }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="image_url" class="form-label"><i class="fas fa-upload"></i> Changer l'image</label>
                    <input type="file" name="image_url" id="image_url" class="form-control" accept="image/*">
                </div>

                <button type="submit" class="btn btn-teal" style="background-color: #008080; border-color: #008080; color: white;">
                    <i class="fas fa-pencil-alt"></i> Mettre à jour
                </button>
            </form>
        </div>
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
