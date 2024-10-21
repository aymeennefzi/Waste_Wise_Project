@extends('HomePage.home')

@section('content')

<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Show Meetings</h1>
        <div>
            <a href="{{ route('meetings.index') }}" class="btn btn-primary mx-2">Meetings</a>
            <a href="{{ route('item-posts.user') }}" class="btn btn-primary mx-2">Your Posts</a>
            <a href="{{ route('item-posts.create') }}" class="btn btn-primary">Create New Post</a>
        </div>
    </div>
    @if($meeting->isEmpty())
        <p>You have no scheduled meetings.</p>
    @else
        
    <div class="container">
        <h1>Meetings for Item Post</h1>
    
        @foreach($meeting as $meeting)
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">{{ $meeting->itemPost->name }}</h5>
                <p class="card-text"><strong>Description:</strong> {{ $meeting->itemPost->description }}</p>
                <p class="card-text"><strong>Location:</strong> {{ $meeting->itemPost->address }}</p>
                <p class="card-text"><strong>Meeting Time:</strong> {{ $meeting->meeting_time }}</p>
                <p class="card-text"><strong>Status:</strong>
                    @if($meeting->status == 1)
                    <span class="badge bg-warning">Meeting pending</span>
                    @elseif($meeting->status == 2)
                    <span class="badge bg-success">Meeting Accepted</span>
                    @elseif($meeting->status == 3)
                    <span class="badge bg-danger">Meeting Refused</span>

                    @endif
                </p>
    
                <div class="mt-3">
                    @if (!$isAccepted)
                        <form action="{{ route('meetings.accept', $meeting->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-success">Accept</button>
                        </form>
                
                            <form action="{{ route('meetings.refuse', $meeting->id) }}" method="POST" class="d-inline refuse-meeting-form">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-danger">Refuse</button>
                            </form>
                        
                        <script>
                            document.querySelectorAll('.refuse-meeting-form').forEach(form => {
                                form.addEventListener('submit', function (event) {
                                    event.preventDefault(); // Prevent the default form submission
                        
                                    const formData = new FormData(form);
                                    const url = form.action;
                        
                                    fetch(url, {
                                        method: 'POST',
                                        body: formData,
                                        headers: {
                                            'X-Requested-With': 'XMLHttpRequest'
                                        }
                                    })
                                    .then(response => response.json())
                                    .then(data => {
                                        if (data.success) {
                                            // Refresh the page if the meeting was refused successfully
                                            location.reload();
                                        } else {
                                            // Handle error (optional)
                                            alert(data.message);
                                        }
                                    })
                                    .catch(error => {
                                        console.error('Error:', error);
                                    });
                                });
                            });
                        </script>
                        
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endif
    @endsection
