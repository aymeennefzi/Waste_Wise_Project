@extends('layouts.adminLayout')

@section('content')
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0">Campaigns</h4>
    <a href="{{ route('admin.campaigns.create') }}" class="btn btn-success">+ Add Campaign</a>
</div>
<div class="card-body">
    <div class="row ">
        <div class="col-lg-12">
        <div class="table-responsive">

            <table class="table ">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Image</th>
                        <th>Donations</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($campaigns as $campaign)
                    <tr>
                        <td>{{ $campaign->name }}</td>
                        <td>{{ $campaign->description }}</td>
                        <td>            <img src="{{ Storage::url($campaign->image) }}" class="card-img-top" alt="{{ $campaign->name }}" style="object-fit: fit; height: 40px; width:80px;">
                        </td>
                        <td >{{ $campaign->donations_count }}</td>
                        
                        <td>
                            <a href="{{ route('admin.campaigns.edit', $campaign->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('admin.campaigns.destroy', $campaign->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this campaign?');">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
</div>
        </div>
    </div>
</div>
@endsection
