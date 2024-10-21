@extends('layouts.adminLayout')

@section('content')
<div class="container p-4">
    <div class="card shadow mb-4" style="border-radius: 10px;">
        <div class="card-header text-center" style="background-color: #008080; color: white;">
            <h1 class="mb-0">{{ $community->name }}</h1>
            <i class="fas fa-users" style="font-size: 2rem;"></i>
        </div>
        <div class="card-body text-center">
            <img src="{{ Storage::url($community->image_url) }}" class="img-fluid mb-3" alt="{{ $community->name }}" style="border-radius: 10px;">
            <p class="lead">{{ $community->description }}</p>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h3>Tâches associées</h3>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Task Name</th>
                        <th>Task Description</th>
                    </tr>
                </thead>
                <tbody>
                    @if($community->tasksc)
                        @foreach($community->tasksc as $task)
                            <tr>
                                <td>{{ $task->title }}</td>
                                <td>{{ $task->description }}</td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="2">No tasks found.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    .container {
        max-width: 800px;
        margin-top: 20px;
    }

    .card-header {
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
    }

    .lead {
        font-size: 1.2rem;
        font-weight: 300;
    }

    th i {
        margin-right: 5px; /* Spacing between icon and text */
    }
</style>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
@endsection
