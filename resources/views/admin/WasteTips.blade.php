@extends('layouts.adminLayout')

@section('content')
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
<h5 class="card-title">Waste Tips</h5>

<div class="card">
    <div class="card-body">
        <div class="row">
            <!-- Formulaire pour ajouter un Waste Tip -->
            <div class="col-md-6">
            <form action="{{ route('admin.WasteTips') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <!-- Afficher les messages d'erreur globaux -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="mb-3">
        <label for="title" class="form-label">Waste Tip Title</label>
        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}" required>
        @error('title')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="content" class="form-label">Content</label>
        <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content" rows="3" required>{{ old('content') }}</textarea>
        @error('content')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="advice_type_id" class="form-label">Advice Type</label>
        <select class="form-control @error('advice_type_id') is-invalid @enderror" id="advice_type_id" name="advice_type_id" required>
            <option value="">-- Select Advice Type --</option>
            @foreach($adviceTypes as $adviceType)
                <option value="{{ $adviceType->id }}" {{ old('advice_type_id') == $adviceType->id ? 'selected' : '' }}>{{ $adviceType->name }}</option>
            @endforeach
        </select>
        @error('advice_type_id')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="image" class="form-label">Upload Image</label>
        <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" required>
        @error('image')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3 text-center">
        <button type="submit" class="btn btn-primary">Add Waste Tip</button>
    </div>
</form>

</div>

            <!-- Colonne pour l'image -->
            <div class="col-md-6 text-center">
                <h6>"Un geste de recyclage aujourd'hui est un acte de préservation pour demain"</h6>
                <img src="{{ asset('Back_office/assets/images/Waste.png') }}" alt="Description of image" class="img-fluid w-50"> <!-- Ajuste w-75 selon tes préférences -->
            </div>
        </div>
    </div>
</div>

<h5 class="card-title mt-5">Waste Tips List</h5>
<div class="card">
    <div class="card-body">
        <div class="row">
        <div class="table-responsive w-100">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Title</th>
                <th scope="col">Content</th>
                <th scope="col">Advice Type</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @if($wasteTips->isEmpty())
                <tr>
                    <td colspan="5">
                        <div class="alert alert-secondary text-center" role="alert">
                            Aucun Waste Tip disponible pour le moment...
                        </div>
                    </td>
                </tr>
            @else
                @foreach($wasteTips as $wasteTip)
                    <tr>
                        <th scope="row">{{ $wasteTip->id }}</th>
                        <td>{{ $wasteTip->title }}</td>
                        <td>{{ $wasteTip->content }}</td>
                        <td>{{ $wasteTip->adviceType->name }}</td>
                        <td>
                            <!-- Bouton pour ouvrir le modal d'édition -->
                            <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $wasteTip->id }}">
                                <i class="bi bi-pencil"></i> Edit
                            </button>

                            <!-- Bouton pour supprimer un Waste Tip -->
                            <form action="{{ route('wasteTips.destroy', $wasteTip->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this waste tip?');">Delete</button>
                            </form>
                        </td>
                    </tr>
                    <div class="modal fade" id="editModal{{ $wasteTip->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $wasteTip->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-dark" id="editModalLabel{{ $wasteTip->id }}">Edit Waste Tip</h5>
                <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
            </div>
            <div class="modal-body">
            <form action="{{ route('admin.WasteTips.update', $wasteTip->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Affichage des messages d'erreur globaux -->
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="mb-3">
                    <label for="title" class="form-label text-dark">Waste Tip Title</label>
                    <input type="text" class="form-control bg-dark @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $wasteTip->title) }}" required>
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="content" class="form-label text-dark">Content</label>
                    <textarea class="form-control bg-dark @error('content') is-invalid @enderror" id="content" name="content" rows="3" required>{{ old('content', $wasteTip->content) }}</textarea>
                    @error('content')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="advice_type_id" class="form-label text-dark">Advice Type</label>
                    <select class="form-control bg-dark @error('advice_type_id') is-invalid @enderror" id="advice_type_id" name="advice_type_id" required>
                        <option value="">-- Select Advice Type --</option>
                        @foreach($adviceTypes as $adviceType)
                            <option value="{{ $adviceType->id }}" {{ $wasteTip->advice_type_id == $adviceType->id ? 'selected' : '' }}>
                                {{ $adviceType->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('advice_type_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label text-dark">Upload New Image (optional)</label>
                    <input type="file" class="form-control bg-dark @error('image') is-invalid @enderror" id="image" name="image">
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Update Waste Tip</button>
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
