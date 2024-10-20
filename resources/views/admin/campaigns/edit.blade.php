@extends('layouts.adminLayout')

@section('content')
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
<div class="card-header">
    <h4 class="mb-0">Edit Campaign</h4>
</div>
<div class="card-body">
    <form action="{{ route('admin.campaigns.update', $campaign->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Campaign Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $campaign->name }}" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description" required>{{ $campaign->description }}</textarea>
        </div>
        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" class="form-control" id="image" name="image">
            <img src="{{ asset($campaign->image) }}" alt="{{ $campaign->name }}" width="100">
        </div>
        <button type="submit" class="btn btn-primary">Update Campaign</button>
    </form>
</div>
@endsection
