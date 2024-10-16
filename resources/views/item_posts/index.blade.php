
@extends('HomePage.home') <!-- Adjust the path as necessary -->

@section('content')
<body>
    <div class="container my-5">
        <div class="d-flex  mb-4">
            <h1 class="h3 mr-auto p-2"> Posts Of Still Usebale Items </h1>
            <a href="{{ route('item-posts.user') }}" class="btn btn-primary d-flex justify-content-end mx-2">Your Posts</a>
            <a href="{{ route('item-posts.create') }}" class="btn btn-primary d-flex justify-content-end ">Create New Post</a>

        </div>

        <div class="row">
            @foreach ($itemPosts as $itemPost)
            <div class="col-md-6 mb-4">
                    <div class="card h-100 shadow-sm">
                        <div class="row no-gutters">
                            <div class="col-md-4">
                                <img src="{{ asset('storage/' . $itemPost->image) }}" class="card-img" alt="{{ $itemPost->name }}" style="max-height: 150px; object-fit: cover;">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $itemPost->name }}</h5>
                                    <p class="card-text text-muted">{{ Str::limit($itemPost->description, 200) }}</p>
                                    <p class="card-text"><strong>Location:</strong> {{ $itemPost->address }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="btn-sm position-absolute" style="top: 10px; right: 15px;">
                        @if($itemPost->user_id == Auth::id())

                        <a href="{{ route('item-posts.edit', $itemPost->id) }}" class="btn btn-primary btn-sm">Edit</a>
                        @else

                        <a href="{{ route('meetings.create', ['item_post_id' => $itemPost->id]) }}" class="btn btn-primary btn-sm">Buy</a>
                        @endif
                            </div>
                </div>
            @endforeach
        </div>
    </div>

    @endsection