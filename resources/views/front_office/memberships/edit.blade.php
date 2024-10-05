@extends('layouts.user')

@section('content')
<div class="container">
    <h2>Edit Membership</h2>
    <form action="{{ route('membership.update', $membership->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="communityId">Community</label>
            <select class="form-control" name="communityId" id="communityId" required>
                @foreach($communities as $community)
                    <option value="{{ $community->id }}" {{ $membership->communityId == $community->id ? 'selected' : '' }}>
                        {{ $community->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="joinedAt">Joined At</label>
            <input type="date" class="form-control" name="joinedAt" id="joinedAt" value="{{ $membership->joinedAt }}" required>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Update Membership</button>
    </form>
</div>
@endsection
