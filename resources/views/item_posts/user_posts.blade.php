
@extends('HomePage.home') <!-- Adjust the path as necessary -->

@section('content')
<div class="container my-5">
    <h1 class="h3 mb-4">Your Posts</h1>

    @if($userPosts->isEmpty())
        <p>You haven't created any posts yet.</p>
    @else
        <div class="row">
            @foreach($userPosts as $post)
                <div class="col-md-6 mb-4">
                    <div class="card h-100 shadow-sm">
                        <div class="row no-gutters">
                            <div class="col-md-4">
                                <img src="{{ asset('storage/' . $post->image) }}" class="card-img" alt="{{ $post->name }}" style="max-height: 150px; object-fit: cover;">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $post->name }}</h5>
                                    <p class="card-text text-muted">{{ Str::limit($post->description, 100) }}</p>
                                    <p class="card-text"><small class="text-muted">address: {{ $post->address }}</small></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="btn-sm position-absolute" style="top: 10px; right: 15px;">
                        <a href="{{ route('item-posts.edit', $post->id) }}" class="btn btn-primary btn-sm">Edit</a>
                        <a href="{{ route('meetings.show', $post->id) }}" class="btn btn-primary btn-sm">Meet ({{ $post->meetings_count }})</a>

                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>

@endsection