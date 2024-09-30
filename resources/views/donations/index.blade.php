@extends('layouts.adminLayout')

@section('content')
<div class="card-header d-flex justify-content-between align-items-center">
    <h4 class="mb-0">List of Donations</h4>
    <a href="{{ route('donations.create') }}" class="btn btn-success">+ Add a Donation</a>
</div>
<div class="card-body">
    <div class="row mt-3">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Donations Table</h5>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                 
                                    <th scope="col">Amount</th>
                                    <th scope="col">Doner Name</th>
                                    <th scope="col">Cause</th>
                                    <th scope="col">Actions</th>

                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($donations as $donation)
                                    <tr>
                                        
                                        <td>{{ $donation->amount }}</td>
                                        <td>{{ $donation->donorName }}</td>
                                        <td>{{ $donation->cause }}</td>
                                        <td>
                                            <a href="{{ route('donations.edit', $donation->id) }}" class="btn btn-warning">Edit</a>
                                            
                                            <form action="{{ route('donations.destroy', $donation->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this donation ?');">
                                                    Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6">No donation found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
