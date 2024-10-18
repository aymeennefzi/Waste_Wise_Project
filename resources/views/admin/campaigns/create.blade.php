@extends('layouts.adminLayout')

@section('content')
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
<div class="card-header">
    <h4 class="mb-0">Add Campaign</h4>
</div>
<div class="card-body">
    <form action="{{ route('admin.campaigns.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">Campaign Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description" required></textarea>
        </div>
        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" name="image" id="image" class="form-control" accept="image/*" required>
            </div>
        <button type="submit" class="btn btn-primary">Add Campaign</button>
    </form>
</div>
@endsection
