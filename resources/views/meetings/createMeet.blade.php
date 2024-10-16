@extends('HomePage.home')

@section('content')
<div class="container my-5">
    <h1 class="h3">Schedule a Meeting</h1>

    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">{{ $itemPost->name }}</h5>
            <p class="card-text"><strong>Description:</strong> {{ $itemPost->description }}</p>
            <p class="card-text"><strong>Location:</strong> {{ $itemPost->address }}</p>
        </div>
    </div>

    <form action="{{ route('meetings.store') }}" method="POST">
        @csrf
        <input type="hidden" name="owner_id" value="{{ $itemPost->user_id }}">
        <input type="hidden" name="buyer_id" value="{{ Auth::id() }}">
        <input type="hidden" name="status" value="1">
    
        <div class="mb-3">
            <label for="meeting_time" class="form-label">Meeting Time</label>
            <input type="datetime-local" name="meeting_time" class="form-control" required>
        </div>
    
        <button type="submit" class="btn btn-primary">Schedule Meeting</button>
    </form>
    
</div>
@endsection
