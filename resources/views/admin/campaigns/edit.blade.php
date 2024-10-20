@extends('layouts.adminLayout')

@section('content')
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
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
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $campaign->name) }}" >
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" >{{ old('description', $campaign->description) }}</textarea>
            @error('description')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" accept="image/*">
            @error('image')
                <div class="text-danger">{{ $message }}</div>
            @enderror
            <img src="{{ asset($campaign->image) }}" alt="{{ $campaign->name }}" width="100" class="mt-2">
        </div>

        <button type="submit" class="btn btn-primary">Update Campaign</button>
    </form>
</div>
@endsection
