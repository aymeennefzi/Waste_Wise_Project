@extends('layouts.user')

@section('content')
<div class="container p-4" style="background: #f0f4f8; border-radius: 10px; border: 1px solid #e0e0e0;">
    <!-- Header Section -->
    <div class="d-flex align-items-center mb-4">
        <i class="fas fa-users" style="font-size: 2rem; color: #008080; margin-right: 10px;"></i>
        <h2 class="text-teal" style="color: #008080;">Communities</h2>
    </div>
    <hr style="border-top: 2px solid #007bff; width: 100px; margin-top: -20px;">

    <a href="{{ route('communities.create') }}" class="btn btn-teal mb-4" style="background-color: #008080; border-color: #008080; color: white;">
        <i class="fas fa-plus"></i> Add New Community
    </a>

    <!-- Communities List -->
    <div class="row mt-4">
        @foreach($communities as $community)
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow" style="transition: transform 0.3s ease; cursor: pointer;">
                <img src="{{ Storage::url($community->image_url) }}" class="card-img-top" alt="{{ $community->name }}" style="object-fit: cover; height: 200px;">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title text-dark">{{ $community->name }}</h5>
                    <p class="card-text flex-grow-1 text-muted">{{ $community->description }}</p>
                    <div class="d-flex justify-content-between mt-auto">
                        <a href="{{ route('communities.show', $community->id) }}" class="btn btn-outline-primary">
                            <i class="fas fa-info-circle"></i> Details
                        </a>
                        <a href="{{ route('communities.edit', $community->id) }}" class="btn btn-outline-warning">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <form action="{{ route('communities.destroy', $community->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger">
                                <i class="fas fa-trash-alt"></i> Delete
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
<style>
    .container {
        background: #f0f4f8;
        border-radius: 10px;
        border: 1px solid #e0e0e0;
        padding: 20px;
    }

    .card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border: none;
    }

    .card:hover {
        transform: scale(1.05); /* Zoom effect */
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.2); /* Shadow effect */
    }

    .text-teal {
        color: #008080; /* Teal color for the title */
    }

    .btn-teal {
        background-color: #008080; /* Teal color for the button */
        border-color: #008080;
        color: white; /* White text color for buttons */
    }

    .btn-outline-primary {
        color: #007bff;
        border-color: #007bff;
    }

    .btn-warning {
        background-color: #ffc107; /* Warning color */
        border-color: #ffc107;
    }

    .btn-outline-warning {
        color: #ffc107;
        border-color: #ffc107;
    }

    .btn-danger {
        background-color: #dc3545; /* Danger color */
        border-color: #dc3545;
    }

    .btn-outline-danger {
        color: #dc3545;
        border-color: #dc3545;
    }

    /* Customize button hover effects */
    .btn-outline-primary:hover, .btn-outline-warning:hover, .btn-outline-danger:hover {
        background-color: rgba(0, 123, 255, 0.1); /* Light background on hover */
    }

    /* Text styles */
    .card-title {
        font-weight: bold;
    }

    .card-text {
        font-size: 0.9rem; /* Slightly smaller text for descriptions */
    }
</style>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
@endsection
