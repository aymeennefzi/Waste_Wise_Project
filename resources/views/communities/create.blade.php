{{-- resources/views/communities/create.blade.php --}}
@extends('layouts.user')

@section('content')
    <div class="container">
        <h1>Créer une nouvelle communauté</h1>
        
        <form action="{{ route('communities.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Nom de la communauté</label>
                <input type="text" name="name" id="name" class="form-control">
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" id="description" class="form-control"></textarea>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                <input type="file" name="image_url" id="image_url" class="form-control" accept="image/*">
            </div>

            <button type="submit" class="btn btn-primary">Créer</button>
        </form>
    </div>
@endsection
