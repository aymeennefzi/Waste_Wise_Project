
@extends('HomePage.home') <!-- Adjust the path as necessary -->

@section('content')
<body>
    <div class="container my-5">
        <div>             
            <h1 class="h3 mr-auto p-2"> Posts Of Still Usebale Items </h1>
        </div>
        <div class="d-flex justify-content-between align-items-center mb-4">

                        <!-- Right-side search form -->
                        <form action="{{ route('item-posts.index') }}" method="GET" class="d-flex">
                            <div class="d-flex">
                                <input type="text" name="search" class="form-control w-80 mr-3" placeholder="Search by name or category" value="{{ request('search') }}">
                                <button class="btn btn-primary" type="submit">Search</button>
                            </div>
                        </form>
            <!-- Left-side buttons -->
            <div class="d-flex">
                <a href="{{ route('meetings.index') }}" class="btn btn-primary mx-2">Meetings</a>
                <a href="{{ route('item-posts.user') }}" class="btn btn-primary mx-2">Your Posts</a>
                <a href="{{ route('item-posts.create') }}" class="btn btn-primary">Create New Post</a>
            </div>
        

        </div>
        
        @if($itemPosts->isEmpty())
        <div class="alert alert-info text-center" role="alert">
            No posts available at the moment.
        </div>
    @else
        <div class="row">
            @foreach ($itemPosts as $itemPost)
            <div class="col-md-6 mb-4">
                    <div class="card h-100 shadow-sm">
                        <div class="row no-gutters">
                            <div class="col-md-4">
                                <img src="{{ asset('storage/' . $itemPost->image) }}" class="card-img" alt="{{ $itemPost->name }}" style="    max-height: 150px;
    margin-top: 11%;
    bject-fit: cover;
    margin-left: 4%;">
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
                    <div class="btn-group position-absolute" style="top: 10px;right: 15px;margin-right: 1%;">
                        @if($itemPost->user_id == Auth::id())
                            <a href="{{ route('item-posts.edit', $itemPost->id) }}" class="btn btn-primary btn-sm" style="padding: 23px 27px; margin-inline:5px " > Edit </a>
                            <form action="{{ route('item-posts.destroy', $itemPost->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this item post?');" style="display: inline;">
                                @csrf
                                @method('DELETE') <!-- Spoofing DELETE method -->
                                <button type="submit" class="btn btn-danger btn-sm" style="background: #c32424; padding: 23px 27px;"> Delete </button>
                            </form>                            
                        
                        @else

                        <a href="{{ route('meetings.create', ['item_post_id' => $itemPost->id]) }}" class="btn btn-primary btn " style="padding: 23px 27px; margin-inline: -14%; " >Take</a>
                        @endif
                            </div>
                </div>
            @endforeach
        </div>
          <!-- Pagination -->
          <div class="d-flex justify-content-center mt-4">
            <ul class="pagination">
                @if ($itemPosts->onFirstPage())
                    <li class="page-item disabled"><span class="page-link">Previous</span></li>
                @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $itemPosts->previousPageUrl() }}" aria-label="Previous">Previous</a>
                    </li>
                @endif

                @foreach ($itemPosts->getUrlRange(1, $itemPosts->lastPage()) as $page => $url)
                    <li class="page-item {{ $itemPosts->currentPage() == $page ? 'active' : '' }}">
                        <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                    </li>
                @endforeach

                @if ($itemPosts->hasMorePages())
                    <li class="page-item">
                        <a class="page-link" href="{{ $itemPosts->nextPageUrl() }}" aria-label="Next">Next</a>
                    </li>
                @else
                    <li class="page-item disabled"><span class="page-link">Next</span></li>
                @endif
            </ul>
        </div>
    @endif
</div>
    </div>

    @endsection
