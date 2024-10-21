@extends('layouts.adminLayout')
    @section('content')

    <div class="container my-5">
        <div class="d-flex  mb-4">
            <h1 class="h3 mr-auto p-2"> Posts Of Still Usebale Items </h1>


        </div>

        <div class="row">
            @foreach ($itemPosts as $itemPost)
            <div class="col-md-6 mb-4">
                    <div class="card h-100 shadow-sm">
                        <div class="row no-gutters">
                            <div class="col-md-4">
                                <img src="{{ asset('storage/' . $itemPost->image) }}" class="card-img" alt="{{ $itemPost->name }}" style="    max-height: 229px;    object-fit: cover;    width: 107%;    height: 92%;margin-top: 11%;">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $itemPost->name }}</h5>
                                    <p class="card-text text-muted">{{ Str::limit($itemPost->description, 200) }}</p>
                                    <p class="card-text"><strong>Owner:</strong>     {{ $itemPost->user ? $itemPost->user->name : 'Unknown' }}


                                    <p class="card-text"><strong>Location:</strong> {{ $itemPost->address }}</p>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="btn-group position-absolute" style="top: 10px; right: 15px;">
                        @if($itemPost->user_id == Auth::id())
                            <a href="{{ route('admin.itemposts.edit', $itemPost->id) }}" class="btn btn-primary btn-sm" style="padding: 10px 9px;margin-right: 4px; margin-inline:5px"> Edit </a>
                            <form action="{{ route('admin.itemposts.destroy', $itemPost->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this item post?');" style="display: inline;">
                                @csrf
                                @method('DELETE') <!-- Spoofing DELETE method -->
                                <button type="submit" class="btn btn-danger btn-sm" style="background: #e94f4f;padding: 10px 9px;margin-right: 4px;"> Delete </button>
                            </form>                            
                        

                        @endif
                            </div>
                </div>
            @endforeach
        </div>
    </div>




    @endsection
