{{-- resources/views/communities/edit.blade.php --}}
@extends('layouts.user')

@section('content')
    <div class="container">
        <h1>Modifier la communauté : {{ $community->name }}</h1>
        
        <form action="{{ route('communities.update', $community->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT') <!-- Utilise la méthode PUT pour la mise à jour -->

            <div class="mb-3">
            <label for="current_image" class="form-label">Image actuelle</label><br>
            <img src="{{ Storage::url($community->image_url) }}" class="img-fluid mb-3" alt="{{ $community->name }}" style="max-width: 300px;">
        </div>
            
            <div class="mb-3">
                <label for="name" class="form-label">Nom de la communauté</label>
                <input type="text" name="name" id= "name" class="form-control" value="{{ $community->name }}">
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" id="description" class="form-control">{{ $community->description }}</textarea>
            </div>

            <div class="mb-3">
                <label for="image_url" class="form-label">Changer l'image</label>
                <input type="file" name="image_url" id="image_url" class="form-control" accept="image/*">
            </div>



            <button type="submit" class="btn btn-primary">Mettre à jour</button>
        </form>
    </div>
@endsection
