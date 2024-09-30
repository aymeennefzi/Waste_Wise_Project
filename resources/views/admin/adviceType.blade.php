@extends('layouts.adminLayout')
    @section('content')
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <style>
        .form-control {
            background-color: ##808080; /* Gris clair */
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
                    <h5 class="card-title">Advice Type</h5>
                
                    <form action="{{ route('admin.adviceType') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Advice Type Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                        </div>
                        <div class="mb-3 text-center">
                            <button type="submit" class="btn btn-primary">Add Advice Type</button>
                        </div>
                    </form>

                    <h5 class="card-title mt-5">Advice Types List</h5>

                    <div class="table-responsive w-100">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($adviceTypes->isEmpty())
                                    <tr>
                                        <td colspan="4">
                                            <div class="alert alert-secondary text-center" role="alert">
                                                Aucune demande disponible pour le moment...
                                            </div>
                                        </td>
                                    </tr>
                                @else
                                    @foreach($adviceTypes as $adviceType)
                                        <tr>
                                            <th scope="row">{{ $adviceType->id }}</th>
                                            <td>{{ $adviceType->name }}</td>
                                            <td>{{ $adviceType->description }}</td>
                                            <td>
                                                <!-- Bouton pour ouvrir le modal d'édition -->
                                                <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $adviceType->id }}">
                                                    <i class="bi bi-pencil"></i> Edit
                                                </button>
                                                <form action="{{ route('admin.adviceType.destroy', $adviceType->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this advice type?');">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                       <!-- Modal pour éditer le Advice Type -->
                                        <div class="modal fade" id="editModal{{ $adviceType->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $adviceType->id }}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title text-dark" id="editModalLabel{{ $adviceType->id }}">Edit Advice Type</h5>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('admin.adviceType.update', $adviceType->id) }}" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="mb-3">
                                                                <label for="name{{ $adviceType->id }}" class="form-label text-dark">Advice Type Name</label>
                                                                <input type="text" class="form-control bg-dark" id="name{{ $adviceType->id }}" name="name" value="{{ $adviceType->name }}" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="description{{ $adviceType->id }}" class="form-label text-dark">Description</label>
                                                                <textarea class="form-control bg-dark" id="description{{ $adviceType->id }}" name="description" rows="3" required>{{ $adviceType->description }}</textarea>
                                                            </div>
                                                            <div class="text-center">
                                                                <button type="submit" class="btn btn-primary">Save changes</button>
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
