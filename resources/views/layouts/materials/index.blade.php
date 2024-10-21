{{-- resources/views/materials/index.blade.php --}}
@extends('layouts.adminLayout')

@section('content')
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
