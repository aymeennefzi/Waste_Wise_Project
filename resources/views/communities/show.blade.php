{{-- resources/views/communities/show.blade.php --}}
@extends('layouts.user')

@section('content')
    <div class="container">
        <h1>{{ $community->name }}</h1>
        <img src="{{ Storage::url($community->image_url) }}" class="img-fluid mb-3" alt="{{ $community->name }}">

        <p>{{ $community->description }}</p>
        <a href="{{ route('communities.edit', $community->id) }}" class="btn btn-primary">Modifier</a>
        <form action="{{ route('communities.destroy', $community->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Supprimer</button>
        </form>
    </div>
@endsection
