@extends('layouts.user')

@section('content')
<div class="container">
    <h2>Create New Membership</h2>

    <form action="{{ route('membership.store') }}" method="POST">
        @csrf

        
        <div class="form-group">
            <label for="communityId">Community</label>
            <select class="form-control" name="communityId" id="communityId" required>
                @foreach($communities as $community)
                    <option value="{{ $community->id }}">{{ $community->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="joinedAt">Joined At</label>
            <input type="date" class="form-control" name="joinedAt" id="joinedAt" required>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Create Membership</button>
    </form>
</div>
@endsection
