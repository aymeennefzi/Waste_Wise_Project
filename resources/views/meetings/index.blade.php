@extends('HomePage.home')

@section('content')

<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Your Meetings</h1>
        <div>
            <a href="{{ route('meetings.index') }}" class="btn btn-primary mx-2">Meetings</a>
            <a href="{{ route('item-posts.user') }}" class="btn btn-primary mx-2">Your Posts</a>
            <a href="{{ route('item-posts.create') }}" class="btn btn-primary">Create New Post</a>
        </div>
    </div>

    @if($meetings->isEmpty())
        <p>You have no scheduled meetings.</p>
    @else
        
    <table class="table">
        <thead>
            <tr>
                <th>Giver </th>
                <th>Item Name</th>
                <th>Meeting Time</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($meetings as $meeting)
                <tr>
                    <td>{{ $meeting->buyer->name }}</td>
                    <td>{{ $meeting->itemPost->name ?? 'N/A' }}</td>
                    <td>{{ $meeting->meeting_time }}</td>
                    <td>
                        @if($meeting->status == 1)
                            <span class="badge bg-warning text-dark">Pending</span>
                        @elseif($meeting->status == 2)
                            <span class="badge bg-success">Accepted</span>
                        @elseif($meeting->status == 3)
                            <span class="badge bg-danger">Refused</span>
                        @endif
                    </td>
                    
                    <td>
                        @if($meeting->owner_id == Auth::id() && $meeting->status == 1)
                        <form action="{{ route('meetings.accept', $meeting->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('PATCH') <!-- Use this hidden input to spoof the PATCH method -->
                            <button type="submit" class="btn btn-success btn-sm">Accept</button>
                        </form>
                    
                        <form action="{{ route('meetings.refuse', $meeting->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('PATCH') <!-- Use this hidden input to spoof the PATCH method -->
                            <button type="submit" class="btn btn-danger btn-sm">Refuse</button>
                        </form>
                    @else
                        No action available
                    @endif
                    
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</div>
@endsection
